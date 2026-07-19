<?php

use App\Models\Addons;
use App\Models\Product;
use Flux\Flux;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Reactive;
use Livewire\Component;

new class extends Component {
    #[Reactive]
    public ?Product $selectedProduct = null;
    public string $modalId = 'coffee-modal';
    public array $addons = [];
    public string $note = '';
    public int $quantity = 1;

    public function increment()
    {
        $this->quantity++;
    }

    public function decrement()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function addToCart()
    {
        $addons = Addons::whereIn('id', $this->addons)->get()->map(fn($addon) => $addon->only(['id', 'name', 'price']))->values();

        $shapedData = [
            'addons' => $addons,
            'coffee' => $this->selectedProduct->only(['id', 'name', 'description', 'price', 'image']),
            'note' => $this->note,
            'quantity' => $this->quantity,
        ];

        $this->dispatch('add-to-cart', item: $shapedData);

        $this->reset(['addons', 'note']);
        $this->quantity = 1;
        $this->dispatch('close-modal', modalId: $this->modalId);
        Flux::toast(duration: 1000, text: 'Coffee added to cart.', variant: 'success');
    }

    public function getCoffee(int $id)
    {
        $this->selectedProduct = Product::find($id);
    }

    #[Computed]
    public function availableAddons()
    {
        return Addons::all();
    }
};
?>

<div x-data="cart()" class="modal  text-black!" id="{{ $modalId }}" popover
    x-on:open-modal.window="$event.detail.modalId === '{{ $modalId }}' && $nextTick(() => $el.showPopover())"
    x-on:close-modal.window="$event.detail.modalId === '{{ $modalId }}' && $el.hidePopover()">
    <div class="modal-box w-72  md:w-96 bg-[#E2D9C8]! border-2 border-[#e2bf7d]!">
        <button @click="$el.closest('[popover]').hidePopover()"
            class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        @if ($selectedProduct)
            <h3 class="font-bold text-lg">Add {{ $selectedProduct->name }} to cart?</h3>
            <img src="{{ $selectedProduct->image ? Storage::url($selectedProduct->image) : asset('/coffee_alt.jpg') }}"
                alt="coffee.jpg" class="h-64 md:h-90! w-full rounded-md border-2 border-[#e2bf7d]!" />
            <p class="py-2 text-sm line-clamp-2">{{ $selectedProduct->description }}</p>
            <p class="font-black mt-2 text-black!">Price: ₱ {{ $selectedProduct->price }}</p>
            <label class="text-black!">Order notes:</label>
            <fieldset class="fieldset">
                <textarea class="textarea border-[#e2bf7d]" wire:model="note" placeholder="Enter note..."></textarea>
            </fieldset>
        @else
            <p class="py-4">Loading product details...</p>
        @endif
        <div class="mt-4 ">
            <div class="h-24 overflow-y-scroll ">
                @foreach ($this->availableAddons as $addon)
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input wire:model="addons" type="checkbox" wire:key="addon-{{ $addon->id }}"
                            label="{{ $addon->name }}" value="{{ $addon->id }}"
                            class="checkbox checkbox-sm border-[#e2bf7d]" />
                        <span>{{ $addon->name }}</span>
                        <span class="text-sm ml-auto">₱{{ $addon->price }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <div class="flex justify-between items-center  mt-4">
            <flux:button wire:click="addToCart" class="bg-[#2A0000]! text-white! p-2 rounded-md w-fit">Add to
                cart</flux:button>

            <div class="flex items-center gap-1">
                <flux:button wire:click="decrement" icon="minus-circle" class="bg-[#2A0000]! text-white!" />
                <p class="text-lg font-medium" wire:text="quantity">{{ $quantity }}</p>
                <flux:button wire:click="increment" icon="plus-circle" class="bg-[#2A0000]! text-white!" />
            </div>
        </div>
    </div>
    <div class="modal-backdrop" @click="$el.closest('[popover]').hidePopover()">
        <button popovertarget="{{ $modalId }}" popovertargetaction="hide">close</button>
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
