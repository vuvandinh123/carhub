<div class=" mx-auto px-4 bg-main-gray">
        <!-- Header -->
        <div class="text-center py-16">
            <p class=" text-sm mb-4 text-gray-600 dark:text-gray-300">
                Tìm chiếc xe mơ ước của bạn
            </p>
            <h1 class="text-5xl  font-bold mb-12">Tìm chiếc xe mơ ước của bạn</h1>

            <!-- Search Filters -->
            <div class="hidden md:block md:bg-brand-white md:dark:bg-brand-black md:rounded-full rounded-2xl shadow  p-4 px-6 md:max-w-5xl mx-auto">
                <div class="flex-col flex md:flex-row flex-wrap gap-4 items-center justify-center">
                    <!-- Used Cars Dropdown -->
                    <div class="relative w-full md:w-auto after:content-[''] after:absolute after:w-[2px] after:h-full after:bg-gray-200 dark:after:bg-gray-800 after:ms-3 after:rounded-lg ">
                        <select class="appearance-none w-full md:w-auto text-lg cursor-pointer border-none rounded-lg px-4 py-3 pr-10 bg-main focus:outline-none focus:ring-2 focus:ring-transparent focus:border-transparent">
                            <option>Xe mới</option>
                            <option>Xe cũ</option>
                            <option>Xe đã qua sử dụng chứng nhận</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Any Makes Dropdown -->
                    <div class="relative w-full md:w-auto after:content-[''] after:absolute after:w-[2px] after:h-full after:bg-gray-200 dark:after:bg-gray-800  after:ms-3 after:rounded-lg ">
                        <select class="appearance-none w-full md:w-auto text-lg cursor-pointer border-none rounded-lg px-4 py-3 pr-10 bg-main focus:outline-none focus:ring-2 focus:ring-transparent focus:border-transparent">
                            <option>Hãng xe</option>
                            <option>Toyota</option>
                            <option>Honda</option>
                            <option>BMW</option>
                            <option>Mercedes</option>
                            <option>Audi</option>
                            <option>Tesla</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Any Models Dropdown -->
                    <div class="relative w-full md:w-auto after:content-[''] after:absolute after:w-[2px] after:h-full after:bg-gray-200 dark:after:bg-gray-800 after:ms-3 after:rounded-lg ">
                        <select class="appearance-none w-full md:w-auto text-lg cursor-pointer border-none rounded-lg px-4 py-3 pr-10 bg-main focus:outline-none focus:ring-2 focus:ring-transparent focus:border-transparent">
                            <option>Loại</option>
                            <option value="0">Bán tải</option>
                            <option value="1">SUV</option>
                            <option value="2">Sedan</option>
                            <option value="3">Hatchback</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- All Prices Dropdown -->
                    <div class="relative w-full md:w-auto ">
                        <select class="appearance-none w-full md:w-auto text-lg cursor-pointer border-none rounded-lg px-4 py-3 pr-10 bg-main focus:outline-none focus:ring-2 focus:ring-transparent focus:border-transparent">
                            <option>Giá</option>
                            <option>Dưới 10.000 USD</option>
                            <option>10.000 - 25.000 USD</option>
                            <option>25.000 - 50.000 USD</option>
                            <option>50.000 USD trở lên</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Search Button -->
                    <button class="btn-primary w-full md:w-auto text-center text-white font-medium px-6 py-3 rounded-lg flex items-center gap-2 transition-colors duration-200 transform hover:scale-105">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Car Image Section -->
        <div class="relative max-w-6xl mx-auto">
            <!-- Car Image -->
            <div class="relative">
                <img src="{{ asset('images/hero-car.png') }}" alt="">
            </div>
        </div>
    </div>