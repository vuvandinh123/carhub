@extends('layouts.app')

@section('title', "Danh sách xe | THACO Thủ Đức")

@section('meta')
    @include('partials.meta-tag', [
        'title' => 'Danh sách xe | THACO Thủ Đức',
        'meta_description' => 'Tìm kiếm và khám phá danh sách xe đa dạng tại THACO Thủ Đức. Chọn lựa xe phù hợp với nhu cầu của bạn ngay hôm nay.',
        'meta_keywords' => 'cars, vehicles, automotive',
        'meta_image' => asset('default-image.jpg'),
        'meta_robots' => 'index, follow',
        'meta_googlebot' => 'index, follow',
        'meta_bingbot' => 'index, follow',
        'meta_yandex' => 'index, follow',
    ])
@endsection

@section('styles')
@endsection

@section('content')
    <div class="container max-w-7xl mx-auto my-8 md:mt-20 px-4">
        <x-breadcrumb :items="[['label' => 'Danh sách xe']]" />
    </div>

    <section class="container max-w-7xl mx-auto my-8 px-4">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl text-center uppercase md:text-4xl font-bold text-main mb-3">
                DANH SÁCH XE
            </h1>
            <p class="text-sub text-sm md:text-lg">
                Tìm chiếc xe hoàn hảo từ <span class="font-semibold text-blue-600">{{ $cars->total() }}</span> xe có sẵn
            </p>
        </div>

        <!-- Results and filters header -->
        @include('pages.cars.partials.filter-header')

        <!-- Car Listings (Full Width) -->
        <div class="w-full">
            @include('pages.cars.partials.list-cars', ['cars' => $cars])
        </div>

        <!-- Filter Modal Button -->
        <button id="filterModalBtn" class="fixed bottom-4 right-40 z-50 bg-primary-800 hover:bg-primary-700 text-white px-6 py-2 rounded-full shadow-2xl hover:shadow-primary-500/50 transition-all hover:scale-110 flex items-center gap-2 font-medium">
            <i data-lucide="sliders-horizontal" class="w-5 h-5"></i>
            <span>Bộ lọc</span>
        </button>

        <!-- Filter Modal -->
        <div id="filterModal" class="fixed inset-0 z-[60] hidden items-center justify-center p-4">
            <!-- Overlay -->
            <div id="filterModalOverlay" class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>
            
            <!-- Modal Panel -->
            <div id="filterModalPanel" class="relative overflow-hidden bg-white dark:bg-gray-900 rounded-sm shadow-2xl w-full max-w-4xl max-h-[85vh] flex flex-col transform scale-95 opacity-0 transition-all duration-300">
                <!-- Modal Header -->
                <div class="flex items-center justify-between p-3 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-gray-200 to-gray-200 text-white ">
                    <h3 class="text-xl font-bold uppercase text-primary-800 flex items-center gap-3">
                        <i data-lucide="filter" class="w-7 h-7"></i>
                        Bộ lọc
                    </h3>
                    <button id="closeFilterModal" class="p-1 text-gray-600 hover:bg-red-500 hover:text-white hover:shadow-lg hover:shadow-red-500/20 rounded-lg transition">
                        <i data-lucide="x" class="w-7 h-7"></i>
                    </button>
                </div>
                
                <!-- Modal Body (Scrollable) -->
                <div class="overflow-y-auto p-6 flex-1">
                    @include('pages.cars.partials.filter-sidebar')
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            const filterForm = $('#filterForm');
            const $filterModal = $('#filterModal');
            const $filterModalPanel = $('#filterModalPanel');
            const $filterModalBtn = $('#filterModalBtn');
            const $closeFilterModal = $('#closeFilterModal');
            const $filterModalOverlay = $('#filterModalOverlay');
            
            // Open modal
            $filterModalBtn.on('click', function() {
                $filterModal.removeClass('hidden').addClass('flex');
                $('body').addClass('overflow-hidden');
                // Trigger animation
                setTimeout(function() {
                    $filterModalPanel.removeClass('scale-95 opacity-0').addClass('scale-100 opacity-100');
                }, 10);
            });
            
            // Close modal
            function closeModal() {
                $filterModalPanel.removeClass('scale-100 opacity-100').addClass('scale-95 opacity-0');
                setTimeout(function() {
                    $filterModal.removeClass('flex').addClass('hidden');
                    $('body').removeClass('overflow-hidden');
                }, 300);
            }
            
            $closeFilterModal.on('click', closeModal);
            $filterModalOverlay.on('click', closeModal);
            
            // Close on Escape key
            $(document).on('keydown', function(e) {
                if (e.key === 'Escape' && $filterModal.hasClass('flex')) {
                    closeModal();
                }
            });

            // Quick price buttons
            $('.quick-price').on('click', function() {
                const priceMin = $(this).data('price-min');
                const priceMax = $(this).data('price-max');
                
                $('input[name="price_min"]').val(priceMin);
                $('input[name="price_max"]').val(priceMax || '');
                
                // Highlight active button
                $('.quick-price').removeClass('bg-blue-50 border-blue-500');
                $(this).addClass('bg-blue-50 border-blue-500');
            });

            // Mileage buttons
            $('.mileage-btn').on('click', function() {
                const mileage = $(this).data('mileage');
                $('input[name="mileage_max"]').val(mileage);
                
                // Update button styles
                $('.mileage-btn').removeClass('bg-blue-50 border-blue-500');
                $(this).addClass('bg-blue-50 border-blue-500');
            });

            // Seats buttons
            $('.seats-btn').on('click', function() {
                const seats = $(this).data('seats');
                const currentSeats = $('input[name="seats"]').val();
                
                // Toggle seats selection
                if (currentSeats == seats) {
                    $('input[name="seats"]').val('');
                    $(this).removeClass('bg-blue-50 border-blue-500');
                } else {
                    $('input[name="seats"]').val(seats);
                    $('.seats-btn').removeClass('bg-blue-50 border-blue-500');
                    $(this).addClass('bg-blue-50 border-blue-500');
                }
            });

            // Sort select - auto submit on change
            $('#sortSelect').on('change', function() {
                filterForm.submit();
            });

            // Auto-submit on filter input changes (optional - can be removed if you want manual submit only)
            $('.filter-input').on('change', function() {
                // Optional: Add a small delay before auto-submit
                // clearTimeout(window.filterTimeout);
                // window.filterTimeout = setTimeout(function() {
                //     filterForm.submit();
                // }, 500);
            });
        });
    </script>
@endsection
