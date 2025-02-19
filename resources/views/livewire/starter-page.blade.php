<div>
    @include('layouts.root/page-title', ['subtitle' => 'Department', 'title' => 'Starter Page'])

    <div class="page-header">
        <div class="p-6 mb-0 bg-white rounded-lg shadow-lg page-block">
            <div class="p-4">
                <div class="p-2 mb-4 text-white bg-blue-500 rounded">
                    วันที่: {{ now()->format('d/m/Y') }}
                </div>
                <div class="p-4 mb-4 bg-green-200 rounded">
                    <h1 class="text-xl text-center">Production Dashboard {{ now()->format('d-m-Y') }}</h1>
                </div>
                <div class="p-4 mb-4 bg-gray-100 rounded">
                    <table class="w-full">
                        <tr class="bg-green-100">
                            <td class="p-2">ข้อมูล</td>
                            <td class="p-2 text-right">- ตัน</td>
                        </tr>
                        <tr class="bg-green-50">
                            <td class="p-2">ข้อมูลการผลิตเฉลี่ย</td>
                            <td class="p-2 text-right">195.080 ตัน</td>
                        </tr>
                        <tr class="bg-green-50">
                            <td class="p-2">รวมการผลิตเฉลี่ย</td>
                            <td class="p-2 text-right">195.080 ตัน</td>
                        </tr>
                    </table>
                </div>
                <div class="p-4 mb-4 bg-pink-100 rounded">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-pink-200">
                                <th class="p-2">พื้นที่การเก็บ</th>
                                <th class="p-2 text-right">ที่นั่ง</th>
                                <th class="p-2 text-right">เสริม</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-blue-100">
                                <td class="p-2">n: A</td>
                                <td class="p-2 text-right">- นาที</td>
                                <td class="p-2 text-right">- ตัน</td>
                            </tr>
                            <tr class="bg-blue-100">
                                <td class="p-2">n: B</td>
                                <td class="p-2 text-right">- นาที</td>
                                <td class="p-2 text-right">- ตัน</td>
                            </tr>
                            <tr class="bg-blue-100">
                                <td class="p-2">n: 3</td>
                                <td class="p-2 text-right">- นาที</td>
                                <td class="p-2 text-right">- ตัน</td>
                            </tr>
                            <tr class="bg-blue-100">
                                <td class="p-2">แอสซัมชัญศรี</td>
                                <td class="p-2 text-right">- นาที</td>
                                <td class="p-2 text-right">- ตัน</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="p-4 mb-4 bg-yellow-100 rounded">
                    <div class="mb-2 text-right text-red-500">(หน่วย 3.48 ตัน/นาที)</div>
                    <table class="w-full">
                        <tr class="bg-yellow-50">
                            <td class="p-2">dU (น:น)</td>
                            <td class="p-2 text-right">- นาที</td>
                            <td class="p-2 text-right">- ตัน</td>
                        </tr>
                        <tr class="bg-yellow-50">
                            <td class="p-2">USSQ (น:น)</td>
                            <td class="p-2 text-right">- นาที</td>
                            <td class="p-2 text-right">- ตัน</td>
                        </tr>
                        <tr class="bg-yellow-50">
                            <td class="p-2">อันน (ตัน)</td>
                            <td class="p-2 text-right">195.080 ตัน</td>
                        </tr>
                        <tr class="text-red-500 bg-yellow-50">
                            <td class="p-2">รวมการเก็บ</td>
                            <td class="p-2 text-right">195.080 ตัน</td>
                        </tr>
                    </table>
                </div>
                <div class="p-4 mb-4 bg-gray-200 rounded">
                    <table class="w-full">
                        <tr class="bg-blue-100">
                            <td class="p-2">ส:เอาฟินู CST.1</td>
                            <td class="p-2 text-right">0 cm.</td>
                            <td class="p-2 text-right">0 ตัน</td>
                        </tr>
                        <tr class="bg-blue-100">
                            <td class="p-2">ส:เอาฟินู CST.2</td>
                            <td class="p-2 text-right">3 cm.</td>
                            <td class="p-2 text-right">0.5067 ตัน</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="container p-4 mx-auto">
            <div class="flex flex-col items-center">
                <!-- Slide 1 -->
                <div class="w-full max-w-4xl mb-4 overflow-hidden bg-white rounded-lg shadow-lg">
                    <div class="p-6">
                        <h1 class="mb-2 text-2xl font-bold">Slide Title 1</h1>
                        <p class="text-gray-700">This is the content of the first slide. You can add text, images, or any other content here.</p>
                    </div>
                </div>
                <!-- Slide 2 -->
                <div class="w-full max-w-4xl mb-4 overflow-hidden text-white bg-blue-500 rounded-lg shadow-lg">
                    <div class="p-6">
                        <h1 class="mb-2 text-2xl font-bold">Slide Title 2</h1>
                        <p class="text-blue-100">This slide has a different background color to show variety. Use Tailwind classes to customize.</p>
                    </div>
                </div>
                <!-- Slide 3 -->
                <div class="w-full max-w-4xl mb-4 overflow-hidden bg-green-200 rounded-lg shadow-lg">
                    <div class="p-6">
                        <h1 class="mb-2 text-2xl font-bold">Slide Title 3</h1>
                        <p class="text-gray-700">You can add more slides here, each with different styles or content.</p>
                    </div>
                </div>
            </div>
        </div>
        <div id="default-carousel" class="relative w-full" data-carousel="slide">
            <!-- Carousel wrapper -->
            <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                <!-- Item 1 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="images/users/avatar-1.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="1">
                </div>
                <!-- Item 2 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="images/users/avatar-2.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="2">
                </div>
                <!-- Item 3 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="/docs/images/carousel/carousel-3.svg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="3">
                </div>
                <!-- Item 4 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="/docs/images/carousel/carousel-4.svg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
                <!-- Item 5 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="/docs/images/carousel/carousel-5.svg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
            </div>
            <!-- Slider indicators -->
            <div class="absolute z-30 flex space-x-3 -translate-x-1/2 bottom-5 left-1/2 rtl:space-x-reverse">
                <button type="button" class="w-3 h-3 rounded-full bg-white/50 dark:bg-gray-800/50" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                <button type="button" class="w-3 h-3 rounded-full bg-white/50 dark:bg-gray-800/50" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
                <button type="button" class="w-3 h-3 rounded-full bg-white/50 dark:bg-gray-800/50" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
                <button type="button" class="w-3 h-3 rounded-full bg-white/50 dark:bg-gray-800/50" aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button>
                <button type="button" class="w-3 h-3 rounded-full bg-white/50 dark:bg-gray-800/50" aria-current="false" aria-label="Slide 5" data-carousel-slide-to="4"></button>
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

        <button data-modal-target="example-modal" data-modal-toggle="example-modal">
            Open Modal
        </button>
    </div>
</div>
