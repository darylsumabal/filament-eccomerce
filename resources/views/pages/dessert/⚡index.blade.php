<?php

use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

new #[Layout('layouts::main-layout')] class extends Component {
    public ?Product $selectedDessert = null;
    use WithPagination;

    #[Computed]
    public function desserts()
    {
        return Product::whereHas('category', function ($query) {
            $query->where('name', 'dessert');
        })
            ->latest()
            ->paginate(12);
    }

    public function getDessert($id)
    {
        $this->selectedDessert = Product::whereHas('category', function ($query) {
            $query->where('name', 'dessert');
        })->find($id);
        $this->dispatch('open-coffee-modal');
    }
};
?>

<div>
    <div class="flex flex-col justify-center items-center mt-10 gap-4">

        <livewire:product-card :products="$this->desserts->getCollection()" action="getDessert" />

        {{ $this->desserts->links() }}

        <livewire:card-add-to-cart :selectedProduct="$selectedDessert" modalId="dessert-modal" />
    </div>

    <x-footer />
</div>
