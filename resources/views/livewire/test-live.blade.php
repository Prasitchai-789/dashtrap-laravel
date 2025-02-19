<div>
    <div>
        <h1 class="mb-4 text-3xl text-center text-blue-500 font-anuphan">WELCOME TO <span class="text-3xl font-bold text-blue-800"> ISAN PALM </span> </h1>
    </div>
    <div id="default-carousel" class="relative w-full px-3 mb-3 rounded-lg" data-carousel="slide">
        <!-- Carousel wrapper -->
        <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
            <!-- Item 1 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="images/isp/1_0.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="1">
            </div>
            <!-- Item 2 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="images/isp/2_0.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="2">
            </div>
            <!-- Item 3 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="images/isp/3_0.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="3">
            </div>
            <!-- Item 4 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="images/isp/4_0.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
            <!-- Item 5 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="images/isp/5_0.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
            <!-- Item 6 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="images/isp/6_0.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
        </div>
        <!-- Slider indicators -->
        <div class="absolute z-30 flex space-x-3 -translate-x-1/2 bottom-5 left-1/2 rtl:space-x-reverse">
            <button type="button" class="w-3 h-3 rounded-full bg-white/50 dark:bg-gray-800/50" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
            <button type="button" class="w-3 h-3 rounded-full bg-white/50 dark:bg-gray-800/50" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
            <button type="button" class="w-3 h-3 rounded-full bg-white/50 dark:bg-gray-800/50" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
            <button type="button" class="w-3 h-3 rounded-full bg-white/50 dark:bg-gray-800/50" aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button>
            <button type="button" class="w-3 h-3 rounded-full bg-white/50 dark:bg-gray-800/50" aria-current="false" aria-label="Slide 5" data-carousel-slide-to="4"></button>
            <button type="button" class="w-3 h-3 rounded-full bg-white/50 dark:bg-gray-800/50" aria-current="false" aria-label="Slide 6" data-carousel-slide-to="5"></button>
        </div>
        <!-- Slider controls -->
        <button type="button" class="absolute top-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer start-0 group focus:outline-none" data-carousel-prev>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                </svg>
                <span class="sr-only">Previous</span>
            </span>
        </button>
        <button type="button" class="absolute top-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer end-0 group focus:outline-none" data-carousel-next>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                </svg>
                <span class="sr-only">Next</span>
            </span>
        </button>
    </div>
    <div id="gallery-wrapper" class="flex justify-center">
        <div class="p-3 xl:w-1/4 lg:w-1/3 picture-item" data-groups='["creative", "photography"]'>
            <a class="image-popup" href="/images/small/img-1.jpg">
                <div class="relative block overflow-hidden transition-all duration-500 rounded group">
                    <img src="/images/small/img-1.jpg" class="transition-all duration-500 rounded group-hover:scale-105" alt="work-image">
                    {{-- <div class="absolute flex items-end p-3 transition-all duration-500 bg-white rounded opacity-0 cursor-pointer inset-3 group-hover:opacity-80">
                        <div>
                            <p class="text-sm text-default-400">Media, Icons</p>
                            <h6 class="text-base font-medium text-black">Open Imagination</h6>
                        </div>
                    </div> --}}
                </div>
            </a>
        </div>

        <div class="p-3 xl:w-1/4 lg:w-1/3 picture-item" data-groups='["design", "digital"]'>
            <a class="image-popup" href="/images/small/img-2.jpg">
                <div class="relative block overflow-hidden transition-all duration-500 rounded group">
                    <img src="/images/small/img-2.jpg" class="transition-all duration-500 rounded group-hover:scale-105" alt="work-image">
                    {{-- <div class="absolute flex items-end p-3 transition-all duration-500 bg-white rounded opacity-0 cursor-pointer inset-3 group-hover:opacity-80">
                        <div>
                            <p class="text-sm text-default-400">Illustrations</p>
                            <h6 class="text-base font-medium text-black">Locked Steel Gate</h6>
                        </div>
                    </div> --}}
                </div>
            </a>
        </div>

        <div class="p-3 xl:w-1/4 lg:w-1/3 picture-item" data-groups='["creative", "photography"]'>
            <a class="image-popup" href="/images/small/img-3.jpg">
                <div class="relative block overflow-hidden transition-all duration-500 rounded group">
                    <img src="/images/small/img-3.jpg" class="transition-all duration-500 rounded group-hover:scale-105" alt="work-image">
                    {{-- <div class="absolute flex items-end p-3 transition-all duration-500 bg-white rounded opacity-0 cursor-pointer inset-3 group-hover:opacity-80">
                        <div>
                            <p class="text-sm text-default-400">Graphics, UI Elements</p>
                            <h6 class="text-base font-medium text-black">Mac Sunglasses</h6>
                        </div>
                    </div> --}}
                </div>
            </a>
        </div>

        <div class="p-3 xl:w-1/4 lg:w-1/3 picture-item" data-groups='["design", "photography"]'>
            <a class="image-popup" href="/images/small/img-4.jpg">
                <div class="relative block overflow-hidden transition-all duration-500 rounded group">
                    <img src="/images/small/img-4.jpg" class="transition-all duration-500 rounded group-hover:scale-105" alt="work-image">
                    {{-- <div class="absolute flex items-end p-3 transition-all duration-500 bg-white rounded opacity-0 cursor-pointer inset-3 group-hover:opacity-80">
                        <div>
                            <p class="text-sm text-default-400">Icons, Illustrations</p>
                            <h6 class="text-base font-medium text-black">Morning Dew</h6>
                        </div>
                    </div> --}}
                </div>
            </a>
        </div>

    </div>

</div>

