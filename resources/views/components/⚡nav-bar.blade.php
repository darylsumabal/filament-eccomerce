<?php

use App\Models\Addons;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component {
    #[Computed]
    public function availableAddons()
    {
        return Addons::all();
    }
};

?>

<nav class="flex text-white items-center py-10 justify-between w-full">
    <h1 class="font-bold text-xl font-serif">Coffea</h1>
    <flux:navbar>
        <flux:navbar.item href="/">HOME</flux:navbar.item>
        <flux:navbar.item href="/coffee">COFFEE</flux:navbar.item>
        <flux:navbar.item href="/bakery">BAKERY</flux:navbar.item>
        <flux:navbar.item href="/shop">SHOP</flux:navbar.item>
        <flux:navbar.item href="/login">LOGIN</flux:navbar.item>
    </flux:navbar>
    <div x-data="{ cart: JSON.parse(localStorage.getItem('cart-items') || '[]') }" x-init="window.addEventListener('cart-updated', () => { cart = JSON.parse(localStorage.getItem('cart-items') || '[]') })">
        <div class="drawer drawer-end">
            <input id="my-drawer-5" type="checkbox" class="drawer-toggle" />
            <div class="drawer-content">
                <label for="my-drawer-5" class="drawer-button btn bg-white border-0 btn-circle relative">
                    <flux:icon.shopping-cart variant="solid" class="text-black drawer-button" />
                    <span x-show="cart.length > 0" x-text="cart.length"
                        class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center"></span>
                </label>
            </div>
            <div class="drawer-side text-black!">
                <label for="my-drawer-5" aria-label="close sidebar" class="drawer-overlay"></label>
                <ul class="menu bg-base-200 min-h-full w-80 p-4 space-y-4">
                    <template x-for="(item, index) in cart" :key="index">
                        <li>
                            <div
                                class="flex flex-col justify-between items-center border-2 border-[#e2bf7d] w-full  p-0 bg-[#E2D9C8]">
                                <div class="w-full aspect-square overflow-hidden">
                                    <img :src="'{{ Storage::url('') }}' + (item.coffee?.image)" alt="coffee.jpg"
                                        class="w-full h-full">
                                </div>

                                <flux:modal.trigger name="edit-profile">
                                    <flux:button  size="xs" icon="plus-circle" class="bg-[#2A0000]! text-white! rounded-md! px-4! py-2! text-sm! border-[#e2bf7d]!">Addons</flux:button>
                                </flux:modal.trigger>

                                <div class="p-2 w-full space-y-2">
                                    <label>Addons</label>
                                    <template x-for="(addon,addonIndex) in item.addons" :key="addonIndex">
                                        <div class="flex justify-between items-center gap-2">
                                            <span x-text="addon.name ?? ''"></span>
                                            <span x-text="'₱. ' + ( addon.price ?? '')"></span>
                                        </div>
                                    </template>
                                    <label>Note</label>
                                    <flux:textarea rows="auto" x-model="item.note"
                                        class="border-[#e2bf7d]! bg-white! text-black!" />
                                    <div class="flex flex-col justify-between">
                                        <label>Coffee</label>
                                        <div class="flex justify-between w-full">
                                            <span x-text="item.coffee?.name ?? 'Item'"></span>
                                            <span class="text-sm" x-text="'₱. ' + (item.coffee?.price ?? '')"></span>
                                        </div>
                                        <div class="flex justify-between items-center text-sm">
                                            <p>Total:</p>
                                            <p>300</p>
                                        </div>
                                    </div>
                                    <flux:button icon="trash" variant="danger" />

                                </div>

                            </div>
                        </li>
                    </template>

                    <li x-show="cart.length === 0"><a>Your cart is empty</a></li>

                    <flux:modal name="edit-profile" class="md:w-96">
                        <flux:checkbox.group wire:model="addons" label="Addons">
                            @foreach ($this->availableAddons as $addon)
                                <flux:checkbox wire:key="addon-{{ $addon->id }}" label="{{ $addon->name }}"
                                    value="{{ $addon->id }}" />
                            @endforeach
                        </flux:checkbox.group>
                    </flux:modal>
                </ul>
            </div>
        </div>
    </div>
</nav>
