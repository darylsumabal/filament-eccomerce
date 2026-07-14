<?php

use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component {
    public string $header = 'Our Special Coffee';
    public ?Product $selectedCoffee = null;
    public array $coffeeIds = [];

    public function mount()
    {
        $this->coffeeIds = Product::inRandomOrder()->take(8)->pluck('id')->toArray();
    }

    public function getCoffee($id)
    {
        $this->selectedCoffee = Product::find($id);
    }

    #[Computed]
    public function coffees()
    {
        return Product::whereIn('id', $this->coffeeIds)->get()->sortBy(fn($p) => array_search($p->id, $this->coffeeIds))->values();
    }
};
?>

<div class="flex flex-col items-center justify-center py-4 gap-10 mt-8">
    <p class="font-serif uppercase text-2xl font-bold">
        {{ $header }}
    </p>
    <div class="carousel rounded-box w-6xl space-x-2 text-[#2A0000]">
        @foreach ($this->coffees as $coffee)
            <div class="carousel-item border-2 rounded-md h-142 w-90 bg-[#E2D9C8] border-[#e2bf7d]">
                <div class="p-4 w-full flex flex-col justify-between">
                    <img src="{{ $coffee->image ? Storage::url($coffee->image) : asset('/coffee_alt.jpg') }}"
                        alt="coffee.jpg" class="h-90 rounded-md w-full" />
                    <p class="text-2xl font-black">{{ $coffee->name }}</p>
                    <p class="font-medium line-clamp-1 break-all">{{ $coffee->description }}</p>
                    <div class="flex items-center justify-between">
                        <p class="font-bold">₱ {{ $coffee->price }}</p>
                        <button class="bg-[#2A0000] text-white rounded-md px-4 py-2 text-sm"
                            popovertarget="coffee-modal" wire:click="getCoffee({{ $coffee->id }})">Add to
                            cart</button>
                        <livewire:card-add-to-cart :selectedCoffee="$selectedCoffee" />
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
