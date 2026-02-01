<div class="bg-main rounded-sm hidden md:block shadow-sm border border-gray-200 dark:border-gray-700 p-6 md:mb-6">
    <div class="flex flex-wrap items-center justify-between gap-4">
        <!-- Results count and active filters -->
        <div class="flex-1 min-w-0">
            <div class="flex items-center gap-3 mb-3">
                <h2 class="text-lg hidden md:block font-semibold text-main">
                    Tìm thấy <span class="text-blue-600">{{ $cars->total() }}</span> xe phù hợp với bạn
                </h2>
            </div>
            
            <!-- Active filters badges -->
            @if(!empty($activeFilters) && count($activeFilters) > 0)
                <div class="flex flex-wrap gap-2">
                    @php
                        $filterLabels = [
                            'condition' => [
                                'new' => 'Xe mới',
                                'used' => 'Xe cũ'
                            ],
                            'brand_id' => 'Hãng: ',
                            'price_min' => 'Giá từ: ',
                            'price_max' => 'Giá đến: ',
                            'year_min' => 'Năm từ: ',
                            'year_max' => 'Năm đến: ',
                            'mileage_max' => 'Km tối đa: ',
                            'seats' => 'Số chỗ: ',
                            'transmission' => [
                                'automatic' => 'Tự động',
                                'manual' => 'Số sàn'
                            ]
                        ];
                        
                        $colors = ['blue', 'green', 'purple', 'orange', 'pink', 'indigo'];
                        $colorIndex = 0;
                        $hasVisibleFilters = false;
                    @endphp

                    @foreach($activeFilters as $key => $value)
                        @if($key === 'sort_by')
                            @continue
                        @endif
                        
                        @php
                            $hasVisibleFilters = true;
                            $currentColor = $colors[$colorIndex % count($colors)];
                            $colorIndex++;
                        @endphp

                        @if($key === 'condition')
                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-sm bg-{{ $currentColor }}-50 dark:bg-{{ $currentColor }}-900/30 text-{{ $currentColor }}-700 dark:text-{{ $currentColor }}-300 border border-{{ $currentColor }}-200 dark:border-{{ $currentColor }}-800">
                                <i data-lucide="check" class="w-4 h-4"></i>
                                <span>{{ $filterLabels['condition'][$value] ?? $value }}</span>
                                <a href="{{ route('cars.index', array_merge(request()->except('condition'), ['page' => 1])) }}" class="hover:text-red-600 transition">
                                    <i data-lucide="x" class="w-3.5 h-3.5"></i>
                                </a>
                            </span>

                        @elseif($key === 'brand_id')
                            @php
                                $brand = $brands->firstWhere('id', $value);
                            @endphp
                            @if($brand)
                                <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-sm bg-{{ $currentColor }}-50 dark:bg-{{ $currentColor }}-900/30 text-{{ $currentColor }}-700 dark:text-{{ $currentColor }}-300 border border-{{ $currentColor }}-200 dark:border-{{ $currentColor }}-800">
                                    <i data-lucide="tag" class="w-4 h-4"></i>
                                    <span>{{ $brand->name }}</span>
                                    <a href="{{ route('cars.index', array_merge(request()->except('brand_id'), ['page' => 1])) }}" class="hover:text-red-600 transition">
                                        <i data-lucide="x" class="w-3.5 h-3.5"></i>
                                    </a>
                                </span>
                            @endif

                        @elseif($key === 'categories' && is_array($value))
                            @foreach($value as $catId)
                                @php
                                    $category = $categories->firstWhere('id', $catId);
                                    $currentColor = $colors[$colorIndex % count($colors)];
                                    $colorIndex++;
                                @endphp
                                @if($category)
                                    <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-sm bg-{{ $currentColor }}-50 dark:bg-{{ $currentColor }}-900/30 text-{{ $currentColor }}-700 dark:text-{{ $currentColor }}-300 border border-{{ $currentColor }}-200 dark:border-{{ $currentColor }}-800">
                                        <i data-lucide="package" class="w-4 h-4"></i>
                                        <span>{{ $category->name }}</span>
                                        <a href="{{ route('cars.index', array_merge(request()->all(), ['categories' => array_diff($value, [$catId]), 'page' => 1])) }}" class="hover:text-red-600 transition">
                                            <i data-lucide="x" class="w-3.5 h-3.5"></i>
                                        </a>
                                    </span>
                                @endif
                            @endforeach

                        @elseif($key === 'fuel' && is_array($value))
                            @foreach($value as $fuel)
                                @php
                                    $currentColor = $colors[$colorIndex % count($colors)];
                                    $colorIndex++;
                                @endphp
                                <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-sm bg-{{ $currentColor }}-50 dark:bg-{{ $currentColor }}-900/30 text-{{ $currentColor }}-700 dark:text-{{ $currentColor }}-300 border border-{{ $currentColor }}-200 dark:border-{{ $currentColor }}-800">
                                    <i data-lucide="fuel" class="w-4 h-4"></i>
                                    <span>{{ $fuel }}</span>
                                    <a href="{{ route('cars.index', array_merge(request()->all(), ['fuel' => array_diff($value, [$fuel]), 'page' => 1])) }}" class="hover:text-red-600 transition">
                                        <i data-lucide="x" class="w-3.5 h-3.5"></i>
                                    </a>
                                </span>
                            @endforeach

                        @elseif($key === 'price_min')
                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-sm bg-{{ $currentColor }}-50 dark:bg-{{ $currentColor }}-900/30 text-{{ $currentColor }}-700 dark:text-{{ $currentColor }}-300 border border-{{ $currentColor }}-200 dark:border-{{ $currentColor }}-800">
                                <i data-lucide="dollar-sign" class="w-4 h-4"></i>
                                <span>Giá từ {{ number_format($value) }}tr</span>
                                <a href="{{ route('cars.index', array_merge(request()->except('price_min'), ['page' => 1])) }}" class="hover:text-red-600 transition">
                                    <i data-lucide="x" class="w-3.5 h-3.5"></i>
                                </a>
                            </span>

                        @elseif($key === 'price_max')
                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-sm bg-{{ $currentColor }}-50 dark:bg-{{ $currentColor }}-900/30 text-{{ $currentColor }}-700 dark:text-{{ $currentColor }}-300 border border-{{ $currentColor }}-200 dark:border-{{ $currentColor }}-800">
                                <i data-lucide="dollar-sign" class="w-4 h-4"></i>
                                <span>Giá đến {{ number_format($value) }}tr</span>
                                <a href="{{ route('cars.index', array_merge(request()->except('price_max'), ['page' => 1])) }}" class="hover:text-red-600 transition">
                                    <i data-lucide="x" class="w-3.5 h-3.5"></i>
                                </a>
                            </span>

                        @elseif($key === 'year_min')
                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-sm bg-{{ $currentColor }}-50 dark:bg-{{ $currentColor }}-900/30 text-{{ $currentColor }}-700 dark:text-{{ $currentColor }}-300 border border-{{ $currentColor }}-200 dark:border-{{ $currentColor }}-800">
                                <i data-lucide="calendar" class="w-4 h-4"></i>
                                <span>Từ năm {{ $value }}</span>
                                <a href="{{ route('cars.index', array_merge(request()->except('year_min'), ['page' => 1])) }}" class="hover:text-red-600 transition">
                                    <i data-lucide="x" class="w-3.5 h-3.5"></i>
                                </a>
                            </span>

                        @elseif($key === 'year_max')
                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-sm bg-{{ $currentColor }}-50 dark:bg-{{ $currentColor }}-900/30 text-{{ $currentColor }}-700 dark:text-{{ $currentColor }}-300 border border-{{ $currentColor }}-200 dark:border-{{ $currentColor }}-800">
                                <i data-lucide="calendar" class="w-4 h-4"></i>
                                <span>Đến năm {{ $value }}</span>
                                <a href="{{ route('cars.index', array_merge(request()->except('year_max'), ['page' => 1])) }}" class="hover:text-red-600 transition">
                                    <i data-lucide="x" class="w-3.5 h-3.5"></i>
                                </a>
                            </span>

                        @elseif($key === 'mileage_max')
                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-sm bg-{{ $currentColor }}-50 dark:bg-{{ $currentColor }}-900/30 text-{{ $currentColor }}-700 dark:text-{{ $currentColor }}-300 border border-{{ $currentColor }}-200 dark:border-{{ $currentColor }}-800">
                                <i data-lucide="gauge" class="w-4 h-4"></i>
                                <span>Tối đa {{ number_format($value) }}km</span>
                                <a href="{{ route('cars.index', array_merge(request()->except('mileage_max'), ['page' => 1])) }}" class="hover:text-red-600 transition">
                                    <i data-lucide="x" class="w-3.5 h-3.5"></i>
                                </a>
                            </span>

                        @elseif($key === 'seats')
                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-sm bg-{{ $currentColor }}-50 dark:bg-{{ $currentColor }}-900/30 text-{{ $currentColor }}-700 dark:text-{{ $currentColor }}-300 border border-{{ $currentColor }}-200 dark:border-{{ $currentColor }}-800">
                                <i data-lucide="users" class="w-4 h-4"></i>
                                <span>{{ $value }} chỗ</span>
                                <a href="{{ route('cars.index', array_merge(request()->except('seats'), ['page' => 1])) }}" class="hover:text-red-600 transition">
                                    <i data-lucide="x" class="w-3.5 h-3.5"></i>
                                </a>
                            </span>

                        @elseif($key === 'transmission')
                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-sm bg-{{ $currentColor }}-50 dark:bg-{{ $currentColor }}-900/30 text-{{ $currentColor }}-700 dark:text-{{ $currentColor }}-300 border border-{{ $currentColor }}-200 dark:border-{{ $currentColor }}-800">
                                <i data-lucide="settings" class="w-4 h-4"></i>
                                <span>{{ $filterLabels['transmission'][$value] ?? $value }}</span>
                                <a href="{{ route('cars.index', array_merge(request()->except('transmission'), ['page' => 1])) }}" class="hover:text-red-600 transition">
                                    <i data-lucide="x" class="w-3.5 h-3.5"></i>
                                </a>
                            </span>
                        @endif
                    @endforeach

                    <!-- Clear all filters button - only show if there are visible filters -->
                    @if($hasVisibleFilters)
                        <a href="{{ route('cars.index') }}" class="text-sm text-red-600 hover:text-red-700 font-medium px-3 py-1.5 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-full transition">
                            <i data-lucide="x-circle" class="w-4 h-4 inline mr-1"></i>
                            Xóa tất cả
                        </a>
                    @endif
                </div>
            @endif
        </div>

        <!-- View mode and compare -->
        <div class="flex items-center gap-3  ">
            <button class="flex items-center gap-2 px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800 transition group">
                <i data-lucide="git-compare" class="w-5 h-5 text-blue-600 group-hover:scale-110 transition"></i>
                <span class="font-medium hidden md:block">So sánh (0)</span>
            </button>
            
            <div class="md:flex border hidden border-gray-300 dark:border-gray-600 rounded-lg overflow-hidden">
                <button id="gridViewBtn" class="p-2.5 bg-blue-600 text-white hover:bg-blue-700 transition" title="Dạng lưới">
                    <i data-lucide="layout-grid" class="w-5 h-5"></i>
                </button>
                <button id="listViewBtn" class="p-2.5 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition" title="Dạng danh sách">
                    <i data-lucide="list" class="w-5 h-5"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        const $gridBtn = $('#gridViewBtn');
        const $listBtn = $('#listViewBtn');
        const $carContainer = $('#carListContainer');
        
        // Load saved view preference
        const savedView = localStorage.getItem('carViewMode') || 'grid';
        setViewMode(savedView);
        
        // Grid view button click
        $gridBtn.on('click', function() {
            setViewMode('grid');
            localStorage.setItem('carViewMode', 'grid');
        });
        
        // List view button click
        $listBtn.on('click', function() {
            setViewMode('list');
            localStorage.setItem('carViewMode', 'list');
        });
        
        function setViewMode(mode) {
            if (mode === 'grid') {
                $carContainer.removeClass('list-view').addClass('grid-view');
                $gridBtn.addClass('bg-blue-600 text-white').removeClass('bg-white dark:bg-gray-800');
                $listBtn.removeClass('bg-blue-600 text-white').addClass('bg-white dark:bg-gray-800');
            } else {
                $carContainer.removeClass('grid-view').addClass('list-view');
                $listBtn.addClass('bg-blue-600 text-white').removeClass('bg-white dark:bg-gray-800');
                $gridBtn.removeClass('bg-blue-600 text-white').addClass('bg-white dark:bg-gray-800');
            }
        }
    });
</script>
