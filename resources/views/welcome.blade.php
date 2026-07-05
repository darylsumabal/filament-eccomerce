<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')
</head>

<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18]">
    <div class="flex min-h-screen flex-col bg-cover bg-center bg-no-repeat items-center"
        style="background-image: url('{{ asset('hero_image.png') }}');">
        <div class="flex items-center flex-col bg-cover
        bg-center bg-no-repeat w-full max-w-7xl gap-32">
            <div class="w-full flex  text-sm mb-6">
                <livewire:nav-bar />
            </div>
            <div
                class="flex flex-col justify-center w-full transition-opacity opacity-100 duration-750  text-white gap-6">
                <p>WELCOME</p>
                <p class="font-bold text-6xl font-serif">We serve the <br /> richest coffee in <br /> the city!</p>
                <p class="font-extralight ">Lorem ipsum dolor sit amet, consectetur adipisicing <br /> elit, sed do
                    eiusmod
                    tempor
                </p>
                <button class="w-32 h-12 font-medium bg-white text-black rounded-full p-2 text-sm">Order Now</button>
            </div>
        </div>
    </div>
    <div class="flex justify-center gap-32 bg-[#E2D9C8] py-12">
        <div class="text-center space-y-2 flex flex-col items-center">
            <img src="coffee.png" alt="" class="h-16">
            <p class="font-medium text-sm">Hot Coffee</p>
        </div>
        <div class="text-center space-y-2 flex flex-col items-center">
            <img src="cup.png" alt="" class="h-16">
            <p class="font-medium  text-sm">Hot Coffee</p>
        </div>
        <div class="text-center space-y-2 flex flex-col items-center">
            <img src="cup2.png" alt="" class="h-16">
            <p class="font-medium  text-sm">Hot Coffee</p>
        </div>
        <div class="text-center space-y-2 flex flex-col items-center">
            <img src="cake.png" alt="" class="h-16">
            <p class="font-medium  text-sm">Hot Coffee</p>
        </div>
    </div>

    {{-- @if (Route::has('login'))
        <div class="h-14.5 hidden lg:block"></div>
    @endif --}}
</body>

</html>
