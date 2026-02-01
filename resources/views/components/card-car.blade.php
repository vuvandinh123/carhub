@props([
    'carid' => 1,
    'image' => null,
    'title' => '',
    'year' => null,
    'price' => null,
    'date' => null,
    'location' => null,
    'mileage' => null,
    'fuel' => null,
    'gearbox' => null,
    'badges' => [],
    'bodytype' => null,
])

<!-- Grid View Card -->
<div class="car-card-grid group relative card rounded-xl hover:translate-y-[-8px] transition-all duration-300 border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-xl bg-main">
    <!-- Image Section -->
    <div class="relative overflow-hidden">
        <a href="{{ route('cars.show', $carid) }}" class="block">
            <img src="https://cafefcdn.com/2018/6/16/photo-1-1529146484215497174285.png" 
                alt="{{ $title }}"
                class="w-full h-48 object-contain transform group-hover:scale-110 transition-transform duration-500">
            
            <!-- Overlay gradient -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        </a>

        <!-- Badges -->
        @if (!empty($badges))
            <div class="absolute top-3 left-3 flex flex-wrap gap-2">
                @foreach ($badges as $badge)
                    <span class="bg-{{ $badge['color'] ?? 'blue' }}-500 text-white text-xs font-semibold px-3 py-1 rounded-full shadow-lg backdrop-blur-sm flex items-center gap-1">
                        <i class="w-3 h-3"></i>
                        {{ $badge['text'] }}
                    </span>
                @endforeach
            </div>
        @endif

        <!-- Action buttons -->
        <div class="absolute top-3 right-3 flex gap-2">
            <button 
                onclick="addToCompare({{ $carid }}, '{{ addslashes($title) }}', {{ $price }}, {{ $year ?? 'null' }}, '{{ $fuel ?? '' }}', '{{ $mileage ?? '' }}', '{{ $bodytype ?? '' }}', '{{ $image ?? '' }}')"
                class="compare-btn bg-white/90 backdrop-blur-sm p-2 w-9 h-9 cursor-pointer flex items-center justify-center rounded-full hover:bg-purple-500 hover:text-white transition-all duration-300 shadow-lg group/btn"
                title="So sánh">
                <i data-lucide="git-compare" class="text-gray-600 group-hover/btn:text-white w-4 h-4"></i>
            </button>
            <button 
                onclick="toggleBookmark({{ $carid }}, '{{ addslashes($title) }}', {{ $price }}, {{ $year ?? 'null' }}, '{{ $fuel ?? '' }}', '{{ $mileage ?? '' }}', '{{ $bodytype ?? '' }}', '{{ $image ?? '' }}')"
                class="bookmark-btn bookmark-btn-{{ $carid }} bg-white/90 backdrop-blur-sm p-2 w-9 h-9 cursor-pointer flex items-center justify-center rounded-full hover:bg-blue-500 hover:text-white transition-all duration-300 shadow-lg group/btn"
                title="Lưu xe">
                <i data-lucide="bookmark" class="bookmark-icon text-gray-600 group-hover/btn:text-white w-4 h-4"></i>
            </button>
        </div>

        <!-- Price Badge -->
        
    </div>

    <!-- Content Section -->
    <div class="p-5">
        @if ($date)
            <div class="flex items-center gap-2 text-xs text-sub mb-3">
                <i data-lucide="clock" class="w-3.5 h-3.5"></i>
                <span>{{ $date }}</span>
            </div>
        @endif

        <h3 class="font-bold text-lg text-main mb-1 line-clamp-2 ">
            <a href="{{ route('cars.show', $carid) }}" class="hover:text-blue-600 transition-colors">
                {{ $title }} 
                @if ($year)
                    <span class="text-sub font-normal text-base">({{ $year }})</span>
                @endif
            </a>
        </h3>
        @if ($price)
            <div class="text-xl absolute top-3 left-3  text-red-500 font-bold">{{ number_format($price / 1000000, 0, ',', '.') }} <small class="text-sm">triệu</small></div>
        @endif

        <!-- Divider -->
        <div class="h-[1px] bg-gray-200 dark:bg-gray-700 my-4"></div>

        <!-- Features Grid -->
        <div class="grid grid-cols-2 gap-3 text-sm mb-4">
            @if ($location)
                <div class="flex items-center gap-2 text-sub">
                    <i data-lucide="map-pin" class="w-4 h-4 text-blue-500"></i>
                    <span class="truncate">{{ $location }}</span>
                </div>
            @endif

            @if ($mileage)
                <div class="flex items-center gap-2 text-sub">
                    <i data-lucide="gauge" class="w-4 h-4 text-green-500"></i>
                    <span class="truncate">{{ $mileage }}</span>
                </div>
            @endif

            @if ($fuel)
                <div class="flex items-center gap-2 text-sub">
                    <i data-lucide="fuel" class="w-4 h-4 text-orange-500"></i>
                    <span class="truncate">{{ $fuel }}</span>
                </div>
            @endif

            @if ($bodytype)
                <div class="flex items-center gap-2 text-sub">
                    <i data-lucide="cog" class="w-4 h-4 text-purple-500"></i>
                    <span class="truncate">{{ $bodytype }}</span>
                </div>
            @endif
        </div>

        <!-- Action Buttons -->
        <div class="flex gap-2 mt-4">
            <button class="flex-1 flex items-center justify-center gap-2 bg-primary-800 hover:bg-primary-700 text-white py-2.5 px-4 rounded-lg font-medium text-sm transition-all duration-300 shadow-md hover:shadow-lg">
                <i data-lucide="calculator" class="w-4 h-4"></i>
                <span>Báo giá</span>
            </button>
            <button class="flex-1 flex items-center justify-center gap-2 bg-green-600 hover:bg-green-700 text-white py-2.5 px-4 rounded-lg font-medium text-sm transition-all duration-300 shadow-md hover:shadow-lg">
                <i data-lucide="phone" class="w-4 h-4"></i>
                <span>Liên hệ</span>
            </button>
        </div>
    </div>
</div>

<!-- List View Card -->
<div class="car-card-list group relative card rounded-xl transition-all duration-300 border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-xl bg-main hidden">
    <div class="flex flex-col sm:flex-row">
        <!-- Image Section -->
        <div class="relative overflow-hidden sm:w-80 flex-shrink-0">
            <a href="{{ route('cars.show', $carid) }}" class="block">
                <img src="https://cafefcdn.com/2018/6/16/photo-1-1529146484215497174285.png" 
                    alt="{{ $title }}"
                    class="w-full h-56 sm:h-full object-contain transform group-hover:scale-110 transition-transform duration-500">
                
                <!-- Overlay gradient -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            </a>

            <!-- Badges -->
            @if (!empty($badges))
                <div class="absolute top-3 left-3 flex flex-wrap gap-2">
                    @foreach ($badges as $badge)
                        <span class="bg-{{ $badge['color'] ?? 'blue' }}-500 text-white text-xs font-semibold px-3 py-1 rounded-full shadow-lg backdrop-blur-sm flex items-center gap-1">
                            <i class="w-3 h-3"></i>
                            {{ $badge['text'] }}
                        </span>
                    @endforeach
                </div>
            @endif

            <!-- Price Badge -->
            @if ($price)
                <div class="absolute bottom-3 left-3 bg-red-500 text-white px-4 py-2 rounded-lg font-bold shadow-lg">
                    {{ number_format($price / 1000000, 0, ',', '.') }} <small class="text-sm">triệu</small>
                </div>
            @endif

            <!-- Action buttons for List View -->
            <div class="absolute top-3 right-3 flex gap-2">
                <button 
                    onclick="addToCompare({{ $carid }}, '{{ addslashes($title) }}', {{ $price }}, {{ $year ?? 'null' }}, '{{ $fuel ?? '' }}', '{{ $mileage ?? '' }}', '{{ $bodytype ?? '' }}', '{{ $image ?? '' }}')"
                    class="compare-btn bg-white/90 backdrop-blur-sm p-2 w-9 h-9 cursor-pointer flex items-center justify-center rounded-full hover:bg-purple-500 hover:text-white transition-all duration-300 shadow-lg group/btn"
                    title="So sánh">
                    <i data-lucide="git-compare" class="text-gray-600 group-hover/btn:text-white w-4 h-4"></i>
                </button>
                <button 
                    onclick="toggleBookmark({{ $carid }}, '{{ addslashes($title) }}', {{ $price }}, {{ $year ?? 'null' }}, '{{ $fuel ?? '' }}', '{{ $mileage ?? '' }}', '{{ $bodytype ?? '' }}', '{{ $image ?? '' }}')"
                    class="bookmark-btn bookmark-btn-{{ $carid }} bg-white/90 backdrop-blur-sm p-2 w-9 h-9 cursor-pointer flex items-center justify-center rounded-full hover:bg-blue-500 hover:text-white transition-all duration-300 shadow-lg group/btn"
                    title="Lưu xe">
                    <i data-lucide="bookmark" class="bookmark-icon text-gray-600 group-hover/btn:text-white w-4 h-4"></i>
                </button>
            </div>
        </div>

        <!-- Content Section -->
        <div class="flex-1 p-5 flex flex-col">
            @if ($date)
                <div class="flex items-center gap-2 text-xs text-sub mb-3">
                    <i data-lucide="clock" class="w-3.5 h-3.5"></i>
                    <span>{{ $date }}</span>
                </div>
            @endif

            <h3 class="font-bold text-xl text-main mb-2">
                <a href="{{ route('cars.show', $carid) }}" class="hover:text-blue-600 transition-colors">
                    {{ $title }} 
                    @if ($year)
                        <span class="text-sub font-normal text-lg">({{ $year }})</span>
                    @endif
                </a>
            </h3>

            <!-- Divider -->
            <div class="h-[1px] bg-gray-200 dark:bg-gray-700 my-4"></div>

            <!-- Features Grid -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 text-sm mb-4 flex-1">
                @if ($location)
                    <div class="flex items-center gap-2 text-sub">
                        <i data-lucide="map-pin" class="w-4 h-4 text-blue-500"></i>
                        <span class="truncate">{{ $location }}</span>
                    </div>
                @endif

                @if ($mileage)
                    <div class="flex items-center gap-2 text-sub">
                        <i data-lucide="gauge" class="w-4 h-4 text-green-500"></i>
                        <span class="truncate">{{ $mileage }}</span>
                    </div>
                @endif

                @if ($fuel)
                    <div class="flex items-center gap-2 text-sub">
                        <i data-lucide="fuel" class="w-4 h-4 text-orange-500"></i>
                        <span class="truncate">{{ $fuel }}</span>
                    </div>
                @endif

                @if ($bodytype)
                    <div class="flex items-center gap-2 text-sub">
                        <i data-lucide="cog" class="w-4 h-4 text-purple-500"></i>
                        <span class="truncate">{{ $bodytype }}</span>
                    </div>
                @endif
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-3">
                <button 
                    onclick="addToCompare({{ $carid }}, '{{ addslashes($title) }}', {{ $price }}, {{ $year ?? 'null' }}, '{{ $fuel ?? '' }}', '{{ $mileage ?? '' }}', '{{ $bodytype ?? '' }}', '{{ $image ?? '' }}')"
                    class="compare-btn flex items-center justify-center gap-2 bg-primary-800 hover:bg-primary-700 text-white py-2.5 px-6 rounded-lg font-medium text-sm transition-all duration-300 shadow-md hover:shadow-lg"
                    title="So sánh">
                    <i data-lucide="git-compare" class="w-4 h-4"></i>
                    <span>So sánh</span>
                </button>
                <button class="flex items-center justify-center gap-2 bg-primary-800 hover:bg-primary-700 text-white py-2.5 px-6 rounded-lg font-medium text-sm transition-all duration-300 shadow-md hover:shadow-lg">
                    <i data-lucide="calculator" class="w-4 h-4"></i>
                    <span>Báo giá</span>
                </button>
                <button class="flex items-center justify-center gap-2 bg-green-600 hover:bg-green-700 text-white py-2.5 px-6 rounded-lg font-medium text-sm transition-all duration-300 shadow-md hover:shadow-lg">
                    <i data-lucide="phone" class="w-4 h-4"></i>
                    <span>Liên hệ</span>
                </button>
            </div>
        </div>
    </div>
</div>
