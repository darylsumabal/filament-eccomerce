<?php

use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;
use Livewire\Component;

new class extends Component {
    use WithPagination;

    #[Computed]
    public function coffees()
    {
        return Product::latest()->paginate(10);
    }
};
?>

<div class="flex flex-col justify-center items-center mt-10 gap-4">
    <div class="grid grid-cols-4 items-center gap-4">
        @foreach ($this->coffees as $coffee)
            <div class="carousel-item border-2 rounded-md h-142 w-90 bg-[#E2D9C8] border-[#e2bf7d]">
                <div class="p-4 w-full space-y-5">
                    <img src="{{ Storage::url($coffee->image) }}" alt="Burger" class="h-90 rounded-md" />
                    <p class="text-2xl font-black">{{ $coffee->name }}</p>
                    <p class="font-medium">{{ $coffee->description }}</p>
                    <div class="flex items-center justify-between">
                        <p class="font-bold">PHP. {{ $coffee->price }}</p>
                        <button class="bg-[#2A0000] text-white rounded-md px-4 py-2 text-sm">Order Now</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{ $this->coffees->links() }}
</div>
