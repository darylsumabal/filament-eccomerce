<?php

use App\Models\Addons;
use App\Models\Product;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component {
    public string $header = 'our special coffee';
    public ?Product $selectedCoffee = null;
    public array $addons = [];
    public string $note = '';
    public array $coffeeIds = [];

    public function mount()
    {
        $this->coffeeIds = Product::inRandomOrder()->take(8)->pluck('id')->toArray();
    }

    public function getCoffee($id)
    {
        $this->selectedCoffee = Product::find($id);
    }

    #[Computed]
    public function coffees()
    {
        return Product::whereIn('id', $this->coffeeIds)->get()->sortBy(fn($p) => array_search($p->id, $this->coffeeIds))->values();
    }

    #[Computed]
    public function availableAddons()
    {
        return Addons::all();
    }

    public function addToCart()
    {
        $addons = Addons::whereIn('id', $this->addons)->get()->map(fn($addon) => $addon->only(['id', 'name', 'price']))->values();

        $shapedData = [
            'addons' => $addons,
            'coffee' => $this->selectedCoffee->only(['id', 'name', 'description', 'price', 'image']),
            'note' => $this->note,
        ];

        $this->dispatch('add-to-cart', item: $shapedData);

        $this->reset(['addons', 'note']);
    }
};
?>

<div class="flex flex-col items-center justify-center py-4 gap-10 mt-8">

    <p class="font-serif uppercase text-2xl font-bold">
        {{ $header }}
    </p>

    <div class="carousel rounded-box w-6xl space-x-2 text-[#2A0000]">
        @foreach ($this->coffees as $coffee)
            <div class="carousel-item border-2 rounded-md h-142 w-90 bg-[#E2D9C8] border-[#e2bf7d]">
                <div class="p-4 w-full space-y-5">
                    <img src="{{ $coffee->image ? Storage::url($coffee->image) : asset('/coffee_alt.jpg') }}"
                        alt="coffee.jpg" class="h-90 rounded-md w-full" />
                    <p class="text-2xl font-black">{{ $coffee->name }}</p>
                    <p class="font-medium line-clamp-2 break-all">{{ $coffee->description }}</p>
                    <div class="flex items-center justify-between">
                        <p class="font-bold">PHP. {{ $coffee->price }}</p>
                        <button class="bg-[#2A0000] text-white rounded-md px-4 py-2 text-sm"
                            popovertarget="{{ $coffee->id }}" wire:click="getCoffee({{ $coffee->id }})">Add to
                            cart</button>

                        <div x-data="{ cart: $persist([]).as('cart-items') }" x-on:add-to-cart.window="cart.push($event.detail.item)"
                            class="modal text-white!" id="{{ $coffee->id }}" popover>
                            <div class="modal-box w-96">
                                @if ($selectedCoffee)
                                    <h3 class="font-bold text-lg">Add {{ $selectedCoffee->name }} to cart?</h3>
                                    <img src="{{ $selectedCoffee->image ? Storage::url($selectedCoffee->image) : asset('/coffee_alt.jpg') }}"
                                        alt="coffee.jpg" class="h-90! rounded-md" />
                                    <p class="py-2 text-sm">{{ $selectedCoffee->description }}</p>
                                    <p class="font-black mt-2 text-[#e2bf7d]">Price: PHP. {{ $selectedCoffee->price }}
                                    </p>
                                    <flux:textarea rows="auto" wire:model="note" label="Order notes"
                                        placeholder="Enter note..." />
                                @else
                                    <p class="py-4">Loading coffee details...</p>
                                @endif
                                <div class="mt-4">
                                    <flux:checkbox.group wire:model="addons" label="Addons"
                                        class="h-20 overflow-y-scroll">
                                        @foreach ($this->availableAddons as $addon)
                                            <flux:checkbox wire:key="addon-{{ $addon->id }}"
                                                label="{{ $addon->name }}" value="{{ $addon->id }}" />
                                        @endforeach
                                    </flux:checkbox.group>
                                </div>
                                <div class="flex justify-between items-center mt-4">
                                    <flux:button wire:click="addToCart"
                                        class="bg-green-700 text-white p-2 rounded-md w-fit">Add to cart</flux:button>
                                    <div>
                                        <flux:button icon="minus-circle"></flux:button>
                                        <flux:button icon="plus-circle"></flux:button>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-backdrop">
                                <button popovertarget="{{ $coffee->id }}" popovertargetaction="hide">close</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
