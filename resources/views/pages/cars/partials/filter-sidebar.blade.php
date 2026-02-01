<form id="filterForm" action="{{ route('cars.index') }}" method="GET">
    <aside class="w-full lg:w-80 space-y-5">
        <!-- Filter Header -->
        <div class="bg-main rounded-sm shadow-sm border border-gray-200 dark:border-gray-700 p-5">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-main flex items-center gap-2">
                    <i data-lucide="filter" class="w-5 h-5 text-blue-600"></i>
                    Bộ lọc
                </h3>
                <a href="{{ route('cars.index') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium">
                    Reset
                </a>
            </div>

            <!-- Condition Toggle -->
            <input type="hidden" name="condition" id="conditionInput" value="{{ $filters['condition'] ?? '' }}">
            <div class="flex bg-gray-100 dark:bg-gray-800 rounded-lg p-1.5">
                <button type="button" data-condition="new" class="condition-btn flex-1 py-2.5 text-center text-sm font-medium rounded-md transition {{ ($filters['condition'] ?? '') === 'new' ? 'bg-white dark:bg-gray-700 shadow-sm text-blue-600' : 'text-gray-600 dark:text-gray-400' }}">
                    <i data-lucide="sparkles" class="w-4 h-4 inline mr-1"></i>
                    Xe mới
                </button>
                <button type="button" data-condition="used" class="condition-btn flex-1 py-2.5 text-center text-sm font-medium rounded-md transition {{ ($filters['condition'] ?? '') === 'used' ? 'bg-white dark:bg-gray-700 shadow-sm text-blue-600' : 'text-gray-600 dark:text-gray-400' }}">
                    <i data-lucide="car" class="w-4 h-4 inline mr-1"></i>
                    Xe cũ
                </button>
            </div>
        </div>

        <!-- Main Filters -->
        <div class="bg-main rounded-sm shadow-sm border border-gray-200 dark:border-gray-700 p-5 space-y-5">
            <!-- Brand -->
            <div class="space-y-2">
                <label class="flex items-center gap-2 text-sm font-semibold text-main">
                    <i data-lucide="tag" class="w-4 h-4 text-blue-600"></i>
                    Hãng xe
                </label>
                <select name="brand_id" class="filter-input w-full px-4 py-2.5 border border-gray-300 dark:bg-gray-800 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    <option value="">Tất cả hãng xe</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}" {{ ($filters['brand_id'] ?? '') == $brand->id ? 'selected' : '' }}>
                            {{ $brand->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Category -->
            <div class="space-y-2">
                <label class="flex items-center gap-2 text-sm font-semibold text-main">
                    <i data-lucide="package" class="w-4 h-4 text-purple-600"></i>
                    Loại xe
                </label>
                <div class="space-y-2">
                    @foreach($categories as $category)
                        <label class="flex items-center gap-2.5 p-2.5 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800 cursor-pointer transition group">
                            <input type="checkbox" name="categories[]" value="{{ $category->id }}" 
                                {{ in_array($category->id, $filters['categories'] ?? []) ? 'checked' : '' }}
                                class="filter-input w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-2 focus:ring-blue-500">
                            <span class="text-sm text-sub group-hover:text-main">{{ $category->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Price Range -->
            <div class="space-y-2">
                <label class="flex items-center gap-2 text-sm font-semibold text-main">
                    <i data-lucide="dollar-sign" class="w-4 h-4 text-green-600"></i>
                    Giá bán (triệu VNĐ)
                </label>
                <div class="grid grid-cols-2 gap-2">
                    <input type="number" name="price_min" placeholder="Từ" min="0" value="{{ $filters['price_min'] ?? '' }}"
                        class="filter-input px-3 py-2.5 border border-gray-300 dark:bg-gray-800 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <input type="number" name="price_max" placeholder="Đến" min="0" value="{{ $filters['price_max'] ?? '' }}"
                        class="filter-input px-3 py-2.5 border border-gray-300 dark:bg-gray-800 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <!-- Quick price buttons -->
                <div class="grid grid-cols-2 gap-2 pt-2">
                    <button type="button" data-price-min="0" data-price-max="500" class="quick-price px-3 py-1.5 text-xs font-medium border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-blue-50 dark:hover:bg-blue-900/30 hover:border-blue-500 transition">
                        &lt; 500tr
                    </button>
                    <button type="button" data-price-min="500" data-price-max="1000" class="quick-price px-3 py-1.5 text-xs font-medium border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-blue-50 dark:hover:bg-blue-900/30 hover:border-blue-500 transition">
                        500tr - 1tỷ
                    </button>
                    <button type="button" data-price-min="1000" data-price-max="2000" class="quick-price px-3 py-1.5 text-xs font-medium border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-blue-50 dark:hover:bg-blue-900/30 hover:border-blue-500 transition">
                        1tỷ - 2tỷ
                    </button>
                    <button type="button" data-price-min="2000" data-price-max="" class="quick-price px-3 py-1.5 text-xs font-medium border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-blue-50 dark:hover:bg-blue-900/30 hover:border-blue-500 transition">
                        &gt; 2tỷ
                    </button>
                </div>
            </div>

            <!-- Year Range -->
            <div class="space-y-2">
                <label class="flex items-center gap-2 text-sm font-semibold text-main">
                    <i data-lucide="calendar" class="w-4 h-4 text-orange-600"></i>
                    Năm sản xuất
                </label>
                <div class="grid grid-cols-2 gap-2">
                    <input type="number" name="year_min" placeholder="Từ năm" min="1990" max="{{ date('Y') }}" value="{{ $filters['year_min'] ?? '' }}"
                        class="filter-input px-3 py-2.5 border border-gray-300 dark:bg-gray-800 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <input type="number" name="year_max" placeholder="Đến năm" min="1990" max="{{ date('Y') }}" value="{{ $filters['year_max'] ?? '' }}"
                        class="filter-input px-3 py-2.5 border border-gray-300 dark:bg-gray-800 dark:border-gray-600 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>

            <!-- Mileage -->
            <div class="space-y-2">
                <label class="flex items-center gap-2 text-sm font-semibold text-main">
                    <i data-lucide="gauge" class="w-4 h-4 text-red-600"></i>
                    Số km đã đi
                </label>
                <input type="hidden" name="mileage_max" value="{{ $filters['mileage_max'] ?? '' }}">
                <div class="grid grid-cols-2 gap-2">
                    <button type="button" data-mileage="10000" class="mileage-btn px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-blue-50 dark:hover:bg-blue-900/30 hover:border-blue-500 transition {{ ($filters['mileage_max'] ?? '') == 10000 ? 'bg-blue-50 border-blue-500' : '' }}">
                        &lt; 10,000km
                    </button>
                    <button type="button" data-mileage="30000" class="mileage-btn px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-blue-50 dark:hover:bg-blue-900/30 hover:border-blue-500 transition {{ ($filters['mileage_max'] ?? '') == 30000 ? 'bg-blue-50 border-blue-500' : '' }}">
                        &lt; 30,000km
                    </button>
                    <button type="button" data-mileage="50000" class="mileage-btn px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-blue-50 dark:hover:bg-blue-900/30 hover:border-blue-500 transition {{ ($filters['mileage_max'] ?? '') == 50000 ? 'bg-blue-50 border-blue-500' : '' }}">
                        &lt; 50,000km
                    </button>
                    <button type="button" data-mileage="999999" class="mileage-btn px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-blue-50 dark:hover:bg-blue-900/30 hover:border-blue-500 transition {{ ($filters['mileage_max'] ?? '') == 999999 ? 'bg-blue-50 border-blue-500' : '' }}">
                        &gt; 50,000km
                    </button>
                </div>
            </div>

            <!-- Fuel Type -->
            <div class="space-y-2">
                <label class="flex items-center gap-2 text-sm font-semibold text-main">
                    <i data-lucide="fuel" class="w-4 h-4 text-yellow-600"></i>
                    Nhiên liệu
                </label>
                <div class="grid grid-cols-2 gap-2">
                    @foreach(['Xăng', 'Dầu diesel', 'Hybrid', 'Điện'] as $fuelType)
                        <label class="flex items-center gap-2 p-2.5 rounded-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 cursor-pointer transition">
                            <input type="checkbox" name="fuel[]" value="{{ $fuelType }}" 
                                {{ in_array($fuelType, $filters['fuel'] ?? []) ? 'checked' : '' }}
                                class="filter-input w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-2 focus:ring-blue-500">
                            <span class="text-sm">{{ $fuelType }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Transmission -->
            <div class="space-y-2">
                <label class="flex items-center gap-2 text-sm font-semibold text-main">
                    <i data-lucide="settings" class="w-4 h-4 text-indigo-600"></i>
                    Hộp số
                </label>
                <div class="grid grid-cols-2 gap-2">
                    <label class="flex items-center gap-2 p-2.5 rounded-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 cursor-pointer transition">
                        <input type="radio" name="transmission" value="automatic" {{ ($filters['transmission'] ?? '') === 'automatic' ? 'checked' : '' }}
                            class="filter-input w-4 h-4 text-blue-600 border-gray-300 focus:ring-2 focus:ring-blue-500">
                        <span class="text-sm">Tự động</span>
                    </label>
                    <label class="flex items-center gap-2 p-2.5 rounded-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 cursor-pointer transition">
                        <input type="radio" name="transmission" value="manual" {{ ($filters['transmission'] ?? '') === 'manual' ? 'checked' : '' }}
                            class="filter-input w-4 h-4 text-blue-600 border-gray-300 focus:ring-2 focus:ring-blue-500">
                        <span class="text-sm">Số sàn</span>
                    </label>
                </div>
            </div>

            <!-- Seats -->
            <div class="space-y-2">
                <label class="flex items-center gap-2 text-sm font-semibold text-main">
                    <i data-lucide="users" class="w-4 h-4 text-pink-600"></i>
                    Số chỗ ngồi
                </label>
                <input type="hidden" name="seats" value="{{ $filters['seats'] ?? '' }}">
                <div class="grid grid-cols-4 gap-2">
                    @foreach([2, 4, 5, 7] as $seat)
                        <button type="button" data-seats="{{ $seat }}" class="seats-btn px-3 py-2 text-sm font-medium border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-blue-50 dark:hover:bg-blue-900/30 hover:border-blue-500 transition {{ ($filters['seats'] ?? '') == $seat ? 'bg-blue-50 border-blue-500' : '' }}">
                            {{ $seat }}
                        </button>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="grid grid-cols-2 gap-3">
            <button type="submit" class="flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-medium transition shadow-lg shadow-blue-600/30">
                <i data-lucide="search" class="w-4 h-4"></i>
                Tìm kiếm
            </button>
            <a href="{{ route('cars.index') }}" class="flex items-center justify-center gap-2 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 text-main py-3 rounded-lg font-medium transition">
                <i data-lucide="rotate-ccw" class="w-4 h-4"></i>
                Đặt lại
            </a>
        </div>
    </aside>
</form>
