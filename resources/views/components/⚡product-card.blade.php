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
                <div class="p-4 w-full flex flex-col justify-between">
                    <img src="{{ Storage::url($coffee->image) }}" alt="Burger" class="h-90 rounded-md" />
                    <p class="text-2xl font-black">{{ $coffee->name }}</p>
                    <p class="font-medium line-clamp-2 break-all">{{ $coffee->description }}</p>
                    <div class="flex items-center justify-between">
                        <p class="font-bold">PHP. {{ $coffee->price }}</p>
                        <button class="bg-[#2A0000] text-white rounded-md px-4 py-2 text-sm"
                            popovertarget="my-modal-2">Add to cart</button>

                        <div class="modal text-white!" id="my-modal-2" popover>
                            <div class="modal-box">
                                <h3 class="font-bold text-lg">Hello!</h3>
                                <p class="py-4">Press ESC key or click the button below to close</p>
                            </div>
                            <div class="modal-backdrop">
                                <button popovertarget="my-modal-2" popovertargetaction="hide">close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{ $this->coffees->links() }}
</div>
