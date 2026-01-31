<div class=" mx-auto px-4 bg-main-gray">
    <!-- Header -->
    <div class="text-center py-16">
        <p class=" text-sm mb-4 text-gray-600 dark:text-gray-300">
            Tìm chiếc xe mơ ước của bạn
        </p>
        <h1 class="text-5xl  font-bold mb-12">Tìm chiếc xe mơ ước của bạn</h1>

        <!-- Search Filters -->
        <form action="{{ route('cars.index') }}" method="GET" id="heroSearchForm">
            <div
                class="hidden md:block md:bg-brand-white md:dark:bg-brand-black md:rounded-full rounded-2xl shadow  p-1 px-6 md:max-w-4xl mx-auto">
                <div class="flex-col flex md:flex-row flex-wrap gap-4 items-center justify-center">
                    <!-- Condition Dropdown -->
                    <div
                        class="relative w-full md:w-auto after:content-[''] after:absolute after:w-[2px] after:h-full after:bg-gray-200 dark:after:bg-gray-800 after:ms-3 after:rounded-lg ">
                        <select name="condition"
                            class="appearance-none w-full md:w-auto text-lg cursor-pointer border-none rounded-lg px-4 py-3 pr-10 bg-main focus:outline-none focus:ring-2 focus:ring-transparent focus:border-transparent">
                            <option value="">Tình trạng</option>
                            <option value="new">Xe mới</option>
                            <option value="used">Xe cũ</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Brands Dropdown -->
                    <div
                        class="relative w-full md:w-auto after:content-[''] after:absolute after:w-[2px] after:h-full after:bg-gray-200 dark:after:bg-gray-800  after:ms-3 after:rounded-lg ">
                        <select name="brand_id"
                            class="appearance-none w-full md:w-auto text-lg cursor-pointer border-none rounded-lg px-4 py-3 pr-10 bg-main focus:outline-none focus:ring-2 focus:ring-transparent focus:border-transparent">
                            <option value="">Thương hiệu</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Categories Dropdown -->
                    <div
                        class="relative w-full md:w-auto after:content-[''] after:absolute after:w-[2px] after:h-full after:bg-gray-200 dark:after:bg-gray-800 after:ms-3 after:rounded-lg ">
                        <select name="categories[]"
                            class="appearance-none w-full md:w-auto text-lg cursor-pointer border-none rounded-lg px-4 py-3 pr-10 bg-main focus:outline-none focus:ring-2 focus:ring-transparent focus:border-transparent">
                            <option value="">Dòng xe</option>
                            @if (isset($categoriesByVehicleType) && isset($categoriesByVehicleType['oto']))
                                @foreach ($categoriesByVehicleType['oto'] as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Price Range Dropdown -->
                    <div class="relative w-full md:w-auto ">
                        <select name="price_range" id="priceRange"
                            class="appearance-none w-full md:w-auto text-lg cursor-pointer border-none rounded-lg px-4 py-3 pr-10 bg-main focus:outline-none focus:ring-2 focus:ring-transparent focus:border-transparent">
                            <option value="">Giá</option>
                            <option value="0-500000000">Dưới 500 triệu</option>
                            <option value="500000000-1000000000">500 triệu - 1 tỷ</option>
                            <option value="1000000000-2000000000">1 tỷ - 2 tỷ</option>
                            <option value="2000000000-">Trên 2 tỷ</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                        <!-- Hidden inputs for price_min and price_max -->
                        <input type="hidden" name="price_min" id="priceMin">
                        <input type="hidden" name="price_max" id="priceMax">
                    </div>

                    <!-- Search Button -->
                    <button type="submit"
                        class="btn-primary w-full md:w-auto text-center text-white font-medium px-6 py-3 rounded-lg flex items-center gap-2 transition-colors duration-200 transform hover:scale-105">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Car Image Section -->
    <div class="relative max-w-6xl mx-auto">
        <!-- Car Image -->
        <div class="relative">
            <img src="{{ asset('images/hero-car.png') }}" alt="">
        </div>
    </div>
</div>

@push('scripts')
    <script>
        // Handle price range conversion
        document.getElementById('priceRange').addEventListener('change', function() {
            const value = this.value;
            const priceMin = document.getElementById('priceMin');
            const priceMax = document.getElementById('priceMax');

            if (value === '') {
                priceMin.value = '';
                priceMax.value = '';
            } else {
                const [min, max] = value.split('-');
                priceMin.value = min || '';
                priceMax.value = max || '';
            }
        });
    </script>
@endpush
