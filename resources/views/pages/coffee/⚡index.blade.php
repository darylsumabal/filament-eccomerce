<?php

use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

new #[Layout('layouts::main-layout')] class extends Component {
    public ?Product $selectedCoffee = null;
    use WithPagination;

    #[Computed]
    public function coffees()
    {
        return Product::whereHas('category', function ($query) {
            $query->where('name', '!=', 'dessert');
        })
            ->latest()
            ->paginate(12);
    }

    public function getCoffee(int $id)
    {
        $this->selectedCoffee = Product::find($id);
        $this->dispatch('open-coffee-modal');
    }
};
?>

<div>
    <div class="flex flex-col justify-center items-center mt-10 gap-4">

        <livewire:product-card :products="$this->coffees->getCollection()" action="getCoffee" />

        {{ $this->coffees->links() }}

        <livewire:card-add-to-cart :selectedProduct="$selectedCoffee" modalId="coffee-modal" />
    </div>


    <x-footer />

</div>