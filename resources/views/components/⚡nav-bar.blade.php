<?php

use Livewire\Component;

new class extends Component {
    //
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
    <div>
        <div class="drawer drawer-end">
            <input id="my-drawer-5" type="checkbox" class="drawer-toggle" />
            <div class="drawer-content">
                <!-- Page content here -->
                <label for="my-drawer-5" class="drawer-button btn bg-white border-0 btn-circle"> <flux:icon.shopping-cart variant="solid"
                        class="text-black drawer-button" /></label>
            </div>
            <div class="drawer-side">
                <label for="my-drawer-5" aria-label="close sidebar" class="drawer-overlay"></label>
                <ul class="menu bg-base-200 min-h-full w-80 p-4">
                    <!-- Sidebar content here -->
                    <li><a>Sidebar Item 1</a></li>
                    <li><a>Sidebar Item 2</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>
