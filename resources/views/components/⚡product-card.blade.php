<?php

use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Reactive;
use Livewire\Component;

new class extends Component {
    #[Reactive]
    public Collection $products;
    public string $action;
};
?>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 items-center gap-4">
    @forelse ($products as $product)
        <div class="border-2 rounded-md h-142 w-xs md:w-90 bg-[#E2D9C8] border-[#e2bf7d] card">
            <div class="w-full flex flex-col justify-between h-full card-body">
                <div class="hover-3d">
                    <figure>
                        <img src="{{ $product->image ? Storage::url($product->image) : asset('/product.jpg') }}"
                            alt="product.jpg" class="h-90 rounded-md w-full" />
                    </figure>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>

                <h2 class="card-title font-black">{{ $product->name }}</h2>
                <p class="font-medium line-clamp-1 break-all">{{ $product->description }}</p>
                <div class="flex items-center justify-between">
                    <p class="font-bold">₱ {{ $product->price }}</p>
                    <button class="bg-[#2A0000] text-white rounded-md px-4 py-2 text-sm"
                        wire:click="$parent.{{ $action }}({{ $product->id }})">Add to
                        cart</button>
                </div>
            </div>

        </div>
    @empty
        <div class="text-black text-center">
            <p class="text-2xl font-medium">No items yet!</p>
        </div>
    @endforelse
</div>
