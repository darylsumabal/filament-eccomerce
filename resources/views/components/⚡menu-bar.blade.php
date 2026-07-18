<?php

use App\Models\Addons;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component {
    public array $addons = [];

    #[Computed]
    public function availableAddons()
    {
        return Addons::all();
    }
};

?>
<div class="flex justify-between w-full">
    <div class="drawer">
        <input id="my-drawer-1" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content">
            <label for="my-drawer-1">
                <flux:icon.bars-3 class=" text-white" />
            </label>
        </div>
        <div class="drawer-side">
            <label for="my-drawer-1" aria-label="close sidebar" class="drawer-overlay"></label>
            <flux:navlist class=" menu bg-base-200 min-h-full w-80 p-4">
                <flux:navlist.item icon="home" class="text-black!" href="/">HOME</flux:navlist.item>

                <flux:navlist.item icon="coffee" class="text-black!" href="/coffee">COFFEE</flux:navlist.item>

                <flux:navlist.item icon="dessert" class="text-black!" href="/dessert">DESSERT</flux:navlist.item>

                <flux:navlist.item icon="info" class="text-black!" href="/about">ABOUT</flux:navlist.item>

                <flux:navlist.item icon="users" class="text-black!"href="/testimonial">TESTIMONIAL</flux:navlist.item>
            </flux:navlist>

        </div>
    </div>

    <div x-data="cartItem()" x-init="$nextTick(() => availableAddons = JSON.parse($el.dataset.addons))" data-addons="{{ $this->availableAddons->toJson() }}">
        <div class="drawer">
            <input id="cart-drawer" type="checkbox" class="drawer-toggle" />
            <div class="drawer-content">
                <label for="cart-drawer" class="drawer-button btn bg-white border-0 btn-circle relative">
                    <flux:icon.shopping-cart variant="solid" class="text-black drawer-button" />
                    <span x-show="cart.length > 0" x-text="cart.length"
                        class="absolute -top-1 -right-1 bg-[#2A0000] text-white text-xs rounded-full h-5 w-5 flex items-center justify-center"></span>
                </label>
            </div>
            <div class="drawer-side text-black!">
                <label for="cart-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
                <ul class="menu bg-base-200 min-h-full w-80 p-4 space-y-4">
                    <template x-for="(item, index) in cart" :key="index">
                        <li>
                            <div
                                class="flex flex-col justify-between items-center border-2 border-[#e2bf7d] w-full  p-0 bg-[#E2D9C8]">
                                <div class="w-full aspect-square overflow-hidden">
                                    <img :src="'{{ Storage::url('') }}' + (item.coffee?.image)" alt="coffee.jpg"
                                        class="w-full h-full">
                                </div>

                                <flux:button size="xs" icon="plus-circle"
                                    class="bg-[#2A0000]! text-white! rounded-md! px-4! py-2! text-sm! border-[#e2bf7d]!"
                                    x-on:click="openAddonModal(index)">
                                    Addons
                                </flux:button>

                                <div class="p-2 w-full space-y-2">
                                    <label>Addons</label>
                                    <template x-for="(addon,addonIndex) in item.addons" :key="addonIndex">
                                        <div class="flex justify-between items-center gap-2">
                                            <span x-text="addon.name ?? ''"></span>
                                            <span x-text="'₱ ' + ( addon.price ?? '')"></span>
                                        </div>
                                    </template>
                                    <label class="text-black!">Note:</label>
                                    <fieldset class="fieldset">
                                        <textarea class="textarea h-24 border-[#e2bf7d]" x-model="item.note" placeholder="Enter note..."></textarea>
                                    </fieldset>
                                    <div class="flex flex-col justify-between">
                                        <label>Coffee</label>
                                        <div class="flex justify-between w-full">
                                            <span x-text="item.coffee?.name ?? 'Item'"></span>
                                            <span class="text-sm" x-text="'₱ ' + (item.coffee?.price ?? '')"></span>
                                        </div>
                                        <div class="flex justify-between items-center text-sm">
                                            <p>Total:</p>
                                            <span x-text="'₱ ' + itemTotal(item)"></span>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <flux:button x-on:click="removeItem(index)" icon="trash" variant="danger" />

                                        <div class="flex items-center gap-1">
                                            <flux:button icon="minus-circle" class="bg-[#2A0000]! text-white!"
                                                x-on:click="decrementQuantity(index)" />
                                            <p class="text-lg font-medium" x-text="item.quantity"></p>
                                            <flux:button icon="plus-circle" class="bg-[#2A0000]! text-white!"
                                                x-on:click="incrementQuantity(index)" />
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </li>
                    </template>

                    <li x-show="cart.length === 0"><a>Your cart is empty</a></li>
                </ul>
            </div>
        </div>

        <dialog x-ref="addonDialog" class="modal text-black!">
            <div class="modal-box bg-[#E2D9C8]! border-2 border-[#e2bf7d]!">
                <h3 class="font-bold text-lg mb-4">Select Addons</h3>
                <div class="space-y-2">
                    <template x-for="addon in availableAddons" :key="addon.id">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" :value="addon.id" x-model.number="selectedAddonIds"
                                class="checkbox checkbox-sm border-[#e2bf7d]" />
                            <span x-text="addon.name"></span>
                            <span class="text-sm ml-auto" x-text="'₱ ' + addon.price"></span>
                        </label>
                    </template>
                </div>
                <div class="modal-action">
                    <flux:button size="xs" icon="plus-circle"
                        class="bg-[#2A0000]! text-white! rounded-md! px-4! py-2! text-sm! border-[#e2bf7d]!"
                        x-on:click="applyAddons()">
                        Add
                    </flux:button>
                    <flux:button size="xs" variant="danger" class="rounded-md! px-4! py-2! text-sm!"
                        x-on:click="$refs.addonDialog.close()">
                        Cancel
                    </flux:button>
                </div>
            </div>
            <form method="dialog" class="modal-backdrop">
                <button>close</button>
            </form>
        </dialog>
    </div>
</div>

@verbatim
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('cartItem', () => ({
                cart: JSON.parse(localStorage.getItem('cart-items') || '[]'),
                availableAddons: [],
                editingAddonIndex: null,
                selectedAddonIds: [],
                openAddonModal(index) {
                    this.editingAddonIndex = index
                    this.selectedAddonIds = (this.cart[index].addons || []).map(a => a.id)
                    this.$refs.addonDialog.showModal()
                },
                applyAddons() {
                    if (this.editingAddonIndex === null) return
                    const selected = this.availableAddons.filter(a => this.selectedAddonIds.includes(a
                        .id))
                    this.cart[this.editingAddonIndex].addons = selected
                    localStorage.setItem('cart-items', JSON.stringify(this.cart))
                    this.editingAddonIndex = null
                    this.selectedAddonIds = []
                    this.$refs.addonDialog.close()
                },
                itemTotal(item) {
                    if (!item) return 0;
                    const coffeePrice = Number(item.coffee?.price || 0);
                    const quantity = Number(item.quantity || 1);
                    const addonsPrice = (item.addons || []).reduce((addonSum, addon) => {
                        return addonSum + Number(addon.price || 0);
                    }, 0);
                    return Number((quantity * coffeePrice) + addonsPrice).toFixed(2);
                },
                init() {
                    window.addEventListener('cart-updated', () => {
                        this.cart = JSON.parse(localStorage.getItem('cart-items') || '[]')
                    })
                },
                removeItem(index) {
                    const data = localStorage.getItem('cart-items')
                    if (data) {
                        const array = JSON.parse(data)
                        array.splice(index, 1)
                        localStorage.setItem('cart-items', JSON.stringify(array))
                        this.cart = JSON.parse(localStorage.getItem('cart-items') || '[]')
                    }
                },
                incrementQuantity(index) {
                    this.cart[index].quantity = Number(this.cart[index].quantity || 1) + 1
                    localStorage.setItem('cart-items', JSON.stringify(this.cart))
                },
                decrementQuantity(index) {
                    if (this.cart[index].quantity > 1) {
                        this.cart[index].quantity = Number(this.cart[index].quantity) - 1
                        localStorage.setItem('cart-items', JSON.stringify(this.cart))
                    }
                }
            }))
        })
    </script>
@endverbatim
