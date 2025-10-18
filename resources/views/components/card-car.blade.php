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

<div
    class="card rounded-xl hover:translate-y-[-5px] transition-all duration-200  border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-md ">
    <div class="relative">
        <a href="{{ route('cars.show', $carid) }}">
            <img src="{{ asset('storage/' . $image) ?? $image ?? asset('images/products/default.png') }}" alt="{{ $title }}"
                class="w-full h-48 object-cover">
        </a>
        <!-- Badges -->
        @if (!empty($badges))
            <div class="absolute top-3 left-3 flex gap-2">
                @foreach ($badges as $badge)
                    <span
                        class="bg-{{ $badge['color'] ?? 'gray' }}-500 text-xs font-semibold px-2 py-1 rounded flex items-center gap-1">
                        <i class="w-3 h-3"></i>
                        {{ $badge['text'] }}
                    </span>
                @endforeach
            </div>
        @endif

        <!-- Action buttons -->
        <div class="absolute top-3 right-3 flex gap-2">
            <button
                class="bg-white/80 backdrop-blur-sm p-1 w-7 h-7 cursor-pointer flex items-center justify-center rounded-full hover:bg-blue-400 transition-colors">
                <i data-lucide="bookmark" class="text-gray-600 w-4"></i>
            </button>
        </div>
    </div>

    <div class="p-4">
        @if ($date)
            <div class="text-sm text-sub mb-2">{{ $date }}</div>
        @endif

        <h3 class="font-semibold text-lg  mb-1">
            <a href="{{ route('cars.show', $carid) }}">
                {{ $title }}
            </a>
            @if ($year)
                <span class="text-sub font-normal">({{ $year }})</span>
            @endif
        </h3>

        @if ($price)
            <div class="text-2xl font-bold  mb-4">{{ number_format($price, 0, ',', '.') }} <small>đ</small>
            </div>
        @endif

        <div class="h-[1px] bg-gray-200 dark:bg-gray-700 my-5"></div>

        <div class="grid grid-cols-2 gap-3 text-sm text-gray-600">
            @if ($location)
                <div class="flex items-center gap-2">
                    <i data-lucide="map-pin" class="fas fa-map-marker-alt text-sub"></i>
                    <span>{{ $location }}</span>
                </div>
            @endif

            @if ($mileage)
                <div class="flex items-center gap-2">
                    <i data-lucide="gauge" class="fas fa-tachometer-alt text-sub"></i>
                    <span>{{ $mileage }}</span>
                </div>
            @endif

            @if ($fuel)
                <div class="flex items-center gap-2">
                    <i data-lucide="fuel" class="fas fa-gas-pump text-sub"></i>
                    <span>{{ $fuel }}</span>
                </div>
            @endif

            @if ($bodytype)
                <div class="flex items-center gap-2">
                    <i data-lucide="cog" class="fas fa-cog text-sub"></i>
                    <span>{{ $bodytype }}</span>
                </div>
            @endif
        </div>
    </div>
</div>
