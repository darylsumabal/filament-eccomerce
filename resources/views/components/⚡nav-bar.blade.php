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

<div class="flex text-white! items-center py-10 justify-between w-full">
    <h1 class="font-bold text-xl font-serif">
        <a class="link link-hover" href="/" wire:navigate.hover>Coffea</a>
    </h1>

    <flux:navbar>
        <flux:navbar.item icon="home" class="text-white!" href="/" wire:navigate.hover>HOME</flux:navbar.item>
        <flux:navbar.item icon="coffee" class="text-white!" href="/coffee" wire:navigate.hover>COFFEE</flux:navbar.item>
        <flux:navbar.item icon="dessert" class="text-white!" href="/dessert" wire:navigate.hover>DESSERT
        </flux:navbar.item>
        <flux:navbar.item icon="info" class="text-white!" href="/about" wire:navigate.hover>ABOUT</flux:navbar.item>
        <flux:navbar.item icon="users" class="text-white!"href="/testimonial" wire:navigate.hover>TESTIMONIAL
        </flux:navbar.item>
    </flux:navbar>

    <livewire:cart drawerId="nav-cart" />
</div>
