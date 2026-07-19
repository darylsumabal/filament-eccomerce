<?php

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

new class extends Component {
    public string $header = 'Our Special Coffee';
    public string $modalId;
    public ?Product $selectedCoffee = null;
    public array $coffeeIds = [];
    public Collection $items;

    public function getProduct(int $id)
    {
        $this->selectedCoffee = Product::find($id);
        $this->dispatch('open-modal', modalId: $this->modalId);
    }
};
?>

<div class="flex flex-col items-center justify-center py-4 gap-10 mt-8">
    <p class="font-serif uppercase text-2xl font-bold">
        {{ $header }}
    </p>

    <div class="carousel rounded-box w-xs md:w-2xl lg:3xl xl:w-6xl space-x-2 text-[#2A0000]">
        @forelse ($this->items as $item)
            <div class="carousel-item border-2 rounded-md h-142 w-xs md:w-90 bg-[#E2D9C8] border-[#e2bf7d]">
                <div class="p-4 w-full flex flex-col justify-between">
                    <figure class="hover-3d">
                        <img src="{{ $item->image ? Storage::url($item->image) : asset('/coffee_alt.jpg') }}"
                            alt="coffee.jpg" class="h-90 rounded-md w-full" />
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </figure>
                    <p class="text-2xl font-black">{{ $item->name }}</p>
                    <p class="font-medium line-clamp-1 break-all">{{ $item->description }}</p>
                    <div class="flex items-center justify-between">
                        <p class="font-bold">₱ {{ $item->price }}</p>
                        <button class="bg-[#2A0000] text-white rounded-md px-4 py-2 text-sm"
                            wire:click="getProduct({{ $item->id }})">Add to
                            cart</button>
                        <livewire:card-add-to-cart :selectedProduct="$selectedCoffee" :modalId="$modalId" />
                    </div>
                </div>
            </div>
        @empty
            <div class="text-black text-center">
                <p class="text-2xl font-medium">No items yet!</p>
            </div>
        @endforelse

    </div>
</div>
