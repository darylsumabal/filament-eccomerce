<?php

use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component {
    public ?Product $selectedCoffee = null;

    #[Computed]
    public function coffees()
    {
        return Product::latest()->paginate(12);
    }

    public function getCoffee($id)
    {
        $this->selectedCoffee = Product::find($id);
    }
};

?>

<div class="flex flex-col justify-center items-center mt-10 gap-4">
    <div class="grid grid-cols-4 items-center gap-4">
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
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{ $this->coffees->links() }}

    <livewire:card-add-to-cart :selectedCoffee="$selectedCoffee" />
</div>
