<?php

use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts::main-layout')] class extends Component {
    public string $header = 'Our Special Coffee';
    public ?Product $selectedCoffee = null;
    public array $coffeeIds = [];
    public ?Product $selectedDessert = null;
    public array $dessertIds = [];

    public function mount()
    {
        $this->coffeeIds = Product::inRandomOrder()
            ->whereHas('category', function ($query) {
                $query->where('name', '!=', 'dessert');
            })
            ->take(8)
            ->pluck('id')
            ->toArray();
        $this->dessertIds = Product::inRandomOrder()
            ->whereHas('category', function ($query) {
                $query->where('name', 'dessert');
            })
            ->take(8)
            ->pluck('id')
            ->toArray();
    }

    #[Computed]
    public function coffees()
    {
        return Product::whereIn('id', $this->coffeeIds)->get()->sortBy(fn($p) => array_search($p->id, $this->coffeeIds))->values();
    }

    #[Computed]
    public function desserts()
    {
        return Product::whereIn('id', $this->dessertIds)->get()->sortBy(fn($p) => array_search($p->id, $this->dessertIds))->values();
    }
};
?>

<div>
    <div class="flex flex-col md:flex-row justify-center items-center gap-10 md:gap-32 bg-[#E2D9C8] py-12">
        <div class="text-center space-y-2 flex flex-col items-center">
            <img src="coffee.png" alt="coffee.png" class="h-16">
            <p class="font-medium text-sm">Hot Coffee</p>
        </div>
        <div class="text-center space-y-2 flex flex-col items-center">
            <img src="cup.png" alt="coffee.png" class="h-16">
            <p class="font-medium  text-sm">Cold Coffee</p>
        </div>
        <div class="text-center space-y-2 flex flex-col items-center">
            <img src="cup2.png" alt="coffee.png" class="h-16">
            <p class="font-medium  text-sm">Cup Coffee</p>
        </div>
        <div class="text-center space-y-2 flex flex-col items-center">
            <img src="cake.png" alt="dessert.png" class="h-16">
            <p class="font-medium  text-sm">Dessert</p>
        </div>
    </div>

    <div>
        <livewire:carousel-product modalId="coffee-modal" :selectedCoffee="$selectedCoffee" :items="$this->coffees" />
    </div>

    <div>
        <livewire:carousel-product header="Our Special Dessert" modalId="dessert-modal" :items="$this->desserts" />
    </div>

    <div class="flex justify-between items-center h-64 mt-10 bg-[#E2D9C8] px-2">
        <div class="hidden md:block">
            <img src="beans_hand.png" alt="" class="h-64">
        </div>
        <div class="space-y-6">
            <p class="text-3xl font-semibold font-serif">Check Out Our Best <br /> Coffee Beans</p>
            <flux:button href="/coffee" icon:trailing="chevron-double-right"
                class="rounded-full! text-white! bg-[#2A0000]! text-xs!" wire:navigate.hover>
                Explore Out Products
            </flux:button>
        </div>
        <div class="hidden md:block">
            <img src="beans.png" alt="" class="h-64">
        </div>
    </div>

    <div class="flex flex-col items-center justify-center py-4 gap-10 mt-8">

        <div class="space-y-2 text-center">
            <p class="font-serif text-2xl font-bold">
                Come and Join
            </p>
            <p class="font-serif uppercase text-2xl font-medium">
                OUR HAPPY CUSTOMER
            </p>
        </div>

        <div class="carousel rounded-box w-xs md:w-2xl lg:3xl xl:w-6xl space-x-2 text-[#2A0000]">
            @foreach (range(1, 8) as $i)
                <div class="carousel-item border-2 rounded-md h-fit w-xs md:w-90 bg-[#E2D9C8] border-[#e2bf7d]">
                    <div class="p-4 w-full space-y-5">
                        <div class="flex justify-between">
                            <div class="flex items-center gap-2">
                                <flux:avatar circle src="https://github.com/darylsumabal.png" />
                                <div>
                                    <p class="font-medium">Daryl Sumabal</p>
                                    <p class="text-xs">Developer</p>
                                </div>
                            </div>
                            <div class="flex text-amber-400!">
                                <flux:icon.star variant="mini" />
                                <flux:icon.star variant="mini" />
                                <flux:icon.star variant="mini" />
                                <flux:icon.star variant="mini" />
                            </div>
                        </div>
                        <p class="text-xs">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus placeat ab
                            eum eveniet blanditiis voluptatem fugit nesciunt tenetur vitae veniam! Corrupti explicabo
                            iste
                            cum sunt possimus laborum et ut voluptas! </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>
