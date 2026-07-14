<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    @include('partials.head')
</head>

<body class="bg-[#F5F5F5] text-[#1b1b18]">
    <div class="flex min-h-screen flex-col bg-cover bg-center bg-no-repeat items-center"
        style="background-image: url('{{ asset('hero_image.png') }}');">
        <div class="flex items-center flex-col bg-cover
        bg-center bg-no-repeat w-full max-w-7xl gap-32">
            <div class="w-full flex  text-sm mb-6">
                <livewire:nav-bar />
            </div>
            <div
                class="flex flex-col justify-center w-full transition-opacity opacity-100 duration-750  text-white gap-6">
                <p class="tracking-widest">WELCOME</p>
                <p class="font-bold text-6xl font-serif">We serve the <br /> richest coffee in <br /> the city!</p>
                <p class="font-extralight ">Lorem ipsum dolor sit amet, consectetur adipisicing <br /> elit, sed do
                    eiusmod
                    tempor
                </p>
                <button class="w-32 h-12 font-medium bg-white text-black rounded-full p-2 text-sm">Order Now
                </button>
            </div>
        </div>
    </div>
    {{ $slot }}

    <flux:toast position="top center"/>
    @livewireScripts()
    @fluxScripts
</body>

</html>
