<x-layouts::main-layout>

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

    <livewire:carousel-coffee />
    <livewire:carousel-coffee header="Our Special Dessert" />


    <div class="flex justify-between items-center h-64 mt-10 bg-[#E2D9C8] ">
        <div>
            <img src="beans_hand.png" alt="" class="h-64">
        </div>
        <div class="space-y-6">
            <p class="text-3xl font-semibold font-serif">Check Out Our Best <br /> Coffee Beans</p>
            <flux:button href="/coffee" icon:trailing="chevron-double-right"
                class="rounded-full! text-white! bg-[#2A0000]! text-xs!">
                Explore Out Products
            </flux:button>
        </div>
        <div>
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

        <div class="carousel rounded-box w-6xl space-x-2 text-[#2A0000]">
            <div class="carousel-item border-2 rounded-md h-fit w-90 bg-[#E2D9C8] border-[#e2bf7d]">
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
                        eum eveniet blanditiis voluptatem fugit nesciunt tenetur vitae veniam! Corrupti explicabo iste
                        cum sunt possimus laborum et ut voluptas! </p>
                </div>
            </div>
            <div class="carousel-item border-2 rounded-md h-fit w-90 bg-[#E2D9C8] border-[#e2bf7d]">
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
                        eum eveniet blanditiis voluptatem fugit nesciunt tenetur vitae veniam! Corrupti explicabo iste
                        cum sunt possimus laborum et ut voluptas! </p>
                </div>
            </div>

            <div class="carousel-item border-2 rounded-md h-fit w-90 bg-[#E2D9C8] border-[#e2bf7d]">
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
                        eum eveniet blanditiis voluptatem fugit nesciunt tenetur vitae veniam! Corrupti explicabo iste
                        cum sunt possimus laborum et ut voluptas! </p>
                </div>
            </div>

            <div class="carousel-item border-2 rounded-md h-fit w-90 bg-[#E2D9C8] border-[#e2bf7d]">
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
                        eum eveniet blanditiis voluptatem fugit nesciunt tenetur vitae veniam! Corrupti explicabo iste
                        cum sunt possimus laborum et ut voluptas! </p>
                </div>
            </div>

            <div class="carousel-item border-2 rounded-md h-fit w-90 bg-[#E2D9C8] border-[#e2bf7d]">
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
                        eum eveniet blanditiis voluptatem fugit nesciunt tenetur vitae veniam! Corrupti explicabo iste
                        cum sunt possimus laborum et ut voluptas! </p>
                </div>
            </div>

            <div class="carousel-item border-2 rounded-md h-fit w-90 bg-[#E2D9C8] border-[#e2bf7d]">
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
                        eum eveniet blanditiis voluptatem fugit nesciunt tenetur vitae veniam! Corrupti explicabo iste
                        cum sunt possimus laborum et ut voluptas! </p>
                </div>
            </div>

            <div class="carousel-item border-2 rounded-md h-fit w-90 bg-[#E2D9C8] border-[#e2bf7d]">
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
                        eum eveniet blanditiis voluptatem fugit nesciunt tenetur vitae veniam! Corrupti explicabo iste
                        cum sunt possimus laborum et ut voluptas! </p>
                </div>
            </div>

            <div class="carousel-item border-2 rounded-md h-fit w-90 bg-[#E2D9C8] border-[#e2bf7d]">
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
                        eum eveniet blanditiis voluptatem fugit nesciunt tenetur vitae veniam! Corrupti explicabo iste
                        cum sunt possimus laborum et ut voluptas! </p>
                </div>
            </div>
        </div>
    </div>

    <x-footer />
</x-layouts::main-layout>
