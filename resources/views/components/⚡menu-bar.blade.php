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
                <flux:icon.bars-3 class="size-10  text-white" />
            </label>
        </div>
        <div class="drawer-side">
            <label for="my-drawer-1" aria-label="close sidebar" class="drawer-overlay"></label>
            <flux:navlist class="menu bg-base-200 min-h-full w-72 p-4">
                <flux:navlist.item icon="home" class="text-black!" href="/" wire:navigate.hover>HOME
                </flux:navlist.item>

                <flux:navlist.item icon="coffee" class="text-black!" href="/coffee" wire:navigate.hover>COFFEE
                </flux:navlist.item>

                <flux:navlist.item icon="dessert" class="text-black!" href="/dessert" wire:navigate.hover>DESSERT
                </flux:navlist.item>

                <flux:navlist.item icon="info" class="text-black!" href="/about" wire:navigate.hover>ABOUT
                </flux:navlist.item>

                <flux:navlist.item icon="users" class="text-black!"href="/testimonial" wire:navigate.hover>TESTIMONIAL
                </flux:navlist.item>
            </flux:navlist>

        </div>
    </div>

    <livewire:cart drawerId="menu-cart" />
</div>
