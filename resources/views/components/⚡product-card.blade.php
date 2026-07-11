<?php

use App\Models\Addons;
use App\Models\Order;
use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;
use Livewire\Component;

new class extends Component {
    use WithPagination;
    public ?Product $selectedCoffee = null;
    public array $addons = [];
    public string $note = '';
    #[Computed]
    public function coffees()
    {
        return Product::latest()->paginate(10);
    }

    public function getCoffee($id)
    {
        $this->selectedCoffee = Product::find($id);
    }

    #[Computed]
    public function availableAddons()
    {
        return Addons::all();
    }

    public function addToCart()
    {
        $shapedData = [
            'addons' => $this->addons,
            'coffee' => $this->selectedCoffee->only(['id', 'name', 'description', 'price', 'image']),
            'note' => $this->note,
        ];

        $this->dispatch('add-to-cart', item: $shapedData);

        $this->reset(['addons', 'note']);
    }
};

?>

<div class="flex flex-col justify-center items-center mt-10 gap-4">
    <div class="grid grid-cols-4 items-center gap-4">
        @foreach ($this->coffees as $coffee)
        <div class="carousel-item border-2 rounded-md h-142 w-90 bg-[#E2D9C8] border-[#e2bf7d]">
            <div class="p-4 w-full flex flex-col justify-between">
                <img src="{{ Storage::url($coffee->image) }}" alt="Burger" class="h-90 rounded-md" />
                <p class="text-2xl font-black">{{ $coffee->name }}</p>
                <p class="font-medium line-clamp-2 break-all">{{ $coffee->description }}</p>
                <div class="flex items-center justify-between">
                    <p class="font-bold">PHP. {{ $coffee->price }}</p>
                    <button class="bg-[#2A0000] text-white rounded-md px-4 py-2 text-sm" popovertarget="my-modal-2"
                        wire:click="getCoffee({{ $coffee->id }})">Add to cart</button>


                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{ $this->coffees->links() }}

    <div class="modal text-white!" id="my-modal-2" popover>
        <div class="modal-box w-96">
            @if ($selectedCoffee)
            <h3 class="font-bold text-lg">Add {{ $selectedCoffee->name }} to cart?</h3>
            <img src="{{ Storage::url($selectedCoffee->image) }}" alt="Burger" class="h-90! rounded-md" />
            <p class="py-2 text-sm">{{ $selectedCoffee->description }}</p>
            <p class="font-black mt-2 text-[#e2bf7d]">Price: PHP. {{ $selectedCoffee->price }}</p>
            <flux:textarea rows="auto" wire:model="note" label="Order notes" placeholder="Enter note..." />
            @else
            <p class="py-4">Loading coffee details...</p>
            @endif
            <div class="mt-4">
                <flux:checkbox.group wire:model="addons" label="Addons">
                    @foreach ($this->availableAddons as $addon)
                    <flux:checkbox wire:key="addon-{{ $addon->id }}" label="{{ $addon->name }}"
                        value="{{ $addon->id }}" />
                    @endforeach
                </flux:checkbox.group>

            </div>

            <div class="flex justify-between items-center  mt-4">
                <flux:button wire:click="addToCart" class=" bg-green-700 text-white p-2 rounded-md w-fit">Add to
                    cart</flux:button>

                <div>
                    <flux:button icon="minus-circle"></flux:button>
                    <flux:button icon="plus-circle"></flux:button>
                </div>
            </div>
        </div>
        <div class="modal-backdrop">
            <button popovertarget="my-modal-2" popovertargetaction="hide">close</button>
        </div>

    </div>
</div>
