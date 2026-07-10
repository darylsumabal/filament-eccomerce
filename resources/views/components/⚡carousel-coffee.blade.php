<?php

use App\Models\Product;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component {
    public string $header = 'our special coffee';

    #[Computed]
    public function coffees()
    {
        return Product::inRandomOrder()->take(8)->get();
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
            <div class="p-4 w-full space-y-5">
                <img src="{{ Storage::url($coffee->image) }}" alt="Burger" class="h-90 rounded-md" />
                <p class="text-2xl font-black">{{ $coffee->name }}</p>
                <p class="font-medium text-ellipsis">{{ $coffee->description }}</p>
                <div class="flex items-center justify-between">
                    <p class="font-bold">PHP. {{ $coffee->price }}</p>
                    <button class="bg-[#2A0000] text-white rounded-md px-4 py-2 text-sm">Order Now</button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>