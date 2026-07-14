<?php

use App\Models\Addons;
use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Reactive;
use Livewire\Component;

new class extends Component {
    #[Reactive]
    public ?Product $selectedCoffee = null;
    public array $addons = [];
    public string $note = '';

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

    public function getCoffee($id)
    {
        $this->selectedCoffee = Product::find($id);
    }

    #[Computed]
    public function availableAddons()
    {
        return Addons::all();
    }
};
?>

<div x-data="cart()" class="modal text-white!" id="coffee-modal" popover>
    @php
    logger($this->selectedCoffee);
    @endphp
    <div class="modal-box w-96">
        @if ($selectedCoffee)
        <h3 class="font-bold text-lg">Add {{ $selectedCoffee->name }} to cart?</h3>
        <img src="{{ $selectedCoffee->image ? Storage::url($selectedCoffee->image) : asset('/coffee_alt.jpg') }}"
            alt="coffee.jpg" class="h-90! w-full rounded-md" />
        <p class="py-2 text-sm line-clamp-2">{{ $selectedCoffee->description }}</p>
        <p class="font-black mt-2 text-[#e2bf7d]">Price: ₱ {{ $selectedCoffee->price }}</p>
        <flux:textarea rows="auto" wire:model="note" label="Order notes" placeholder="Enter note..." />
        @else
        <p class="py-4">Loading coffee details...</p>
        @endif
        <div class="mt-4">
            <flux:checkbox.group wire:model="addons" label="Addons" class="h-20 overflow-y-scroll">
                @foreach ($this->availableAddons as $addon)
                <flux:checkbox wire:key="addon-{{ $addon->id }}" label="{{ $addon->name }}"
                    value="{{ $addon->id }}" />
                @endforeach
            </flux:checkbox.group>

        </div>

        <div class="flex justify-between items-center  mt-4">
            <flux:button wire:click="addToCart" class="bg-green-700 text-white p-2 rounded-md w-fit">Add to
                cart</flux:button>

            <div>
                <flux:button icon="minus-circle"></flux:button>
                <flux:button icon="plus-circle"></flux:button>
            </div>
        </div>
    </div>
    <div class="modal-backdrop">
        <button popovertarget="coffee-modal" popovertargetaction="hide">close</button>
    </div>

</div>


@verbatim
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('cart', () => ({
            cart: Alpine.$persist([]).as('cart-items'),

            init() {
                // Listen to the window event safely
                window.addEventListener('add-to-cart', (event) => {
                    const newItem = event.detail?.item;

                    if (newItem) {
                        this.cart.push(newItem);

                        // Let the DOM update, then notify the navbar
                        this.$nextTick(() => {
                            window.dispatchEvent(new CustomEvent('cart-updated'));
                        });
                    }
                });
            }
        }))
    })
</script>
@endverbatim