<?php

use Livewire\Component;
use App\Models\Product;
use Livewire\Attributes\Computed;

new class extends Component {
    public ?Product $selectedProduct = null;
    public array $dessertIds = [];

    public function mount()
    {
        $this->dessertIds = Product::inRandomOrder()
            ->whereHas('category', function ($query) {
                $query->where('name', 'dessert');
            })
            ->take(8)
            ->pluck('id')
            ->toArray();
    }

    public function getDessert(int $id)
    {
        $this->selectedProduct = Product::find($id);
        $this->dispatch('open-coffee-modal');
    }

    #[Computed]
    public function desserts()
    {
        return Product::whereIn('id', $this->dessertIds)->get()->sortBy(fn($p) => array_search($p->id, $this->dessertIds))->values();
    }
};
?>

<div class="flex flex-col items-center justify-center py-4 gap-10 mt-8">
    <p class="font-serif uppercase text-2xl font-bold">
        Our Special Dessert
    </p>
    <div class="carousel rounded-box w-6xl space-x-2 text-[#2A0000]">
        @foreach ($this->desserts as $dessert)
            <div class="carousel-item border-2 rounded-md h-142 w-90 bg-[#E2D9C8] border-[#e2bf7d]">
                <div class="p-4 w-full flex flex-col justify-between">
                    <img src="{{ $dessert->image ? Storage::url($dessert->image) : asset('/dessert.jpg') }}"
                        alt="dessert.jpg" class="h-90 rounded-md w-full" />
                    <p class="text-2xl font-black">{{ $dessert->name }}</p>
                    <p class="font-medium line-clamp-1 break-all">{{ $dessert->description }}</p>
                    <div class="flex items-center justify-between">
                        <p class="font-bold">₱ {{ $dessert->price }}</p>
                        <button class="bg-[#2A0000] text-white rounded-md px-4 py-2 text-sm"
                            wire:click="getDessert({{ $dessert->id }})">Add to
                            cart</button>
                        <livewire:card-add-to-cart :selectedProduct="$selectedProduct" modalId="dessert-modal" />
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
