@extends('layouts.app')

@section('title', 'Cars')

@section('meta')
    @include('partials.meta-tag', [
        'title' => 'Cars',
        'meta_description' => 'Explore our collection of cars',
        'meta_keywords' => 'cars, vehicles, automotive',
        'meta_author' => 'Your Name',
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
    <div class="container mx-auto my-8 mt-20 px-4">
        <x-breadcrumb :items="[['label' => 'Danh sách xe']]" />
    </div>

    <section class="container  mx-auto my-8 px-4">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl text-center uppercase md:text-4xl font-bold text-main mb-3">
                Khám phá xe
            </h1>
            <p class="text-sub text-lg">
                Tìm chiếc xe hoàn hảo từ <span class="font-semibold text-blue-600">{{ $cars->total() }}</span> xe có sẵn
            </p>
        </div>

        <!-- Results and filters header -->
        @include('pages.cars.partials.filter-header')

        <div class="flex flex-col lg:flex-row gap-6">
            <!-- Sidebar Filters (Hidden on mobile, toggle with button) -->
            <div class="hidden lg:block">
                @include('pages.cars.partials.filter-sidebar')
            </div>

            <!-- Car Listings -->
            <div class="flex-1">
                @include('pages.cars.partials.list-cars', ['cars' => $cars])
            </div>
        </div>

        <!-- Mobile Filter Button -->
        <button class="lg:hidden fixed bottom-6 right-6 z-50 bg-blue-600 text-white p-4 rounded-full shadow-2xl hover:bg-blue-700 transition-all hover:scale-110">
            <i data-lucide="sliders-horizontal" class="w-6 h-6"></i>
        </button>
    </section>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            const filterForm = $('#filterForm');
            
            // Mobile filter toggle
            const filterBtn = $('.lg\\:hidden.fixed');
            const filterSidebar = $('aside');

            if (filterBtn.length && filterSidebar.length) {
                filterBtn.on('click', function() {
                    filterSidebar.toggleClass('hidden fixed inset-0 z-40 bg-white dark:bg-gray-900 overflow-y-auto p-6');
                });
            }

            // Condition toggle buttons
            $('.condition-btn').on('click', function() {
                const condition = $(this).data('condition');
                const currentCondition = $('#conditionInput').val();
                
                // Toggle condition
                if (currentCondition === condition) {
                    $('#conditionInput').val('');
                } else {
                    $('#conditionInput').val(condition);
                }
                
                // Update button styles
                $('.condition-btn').removeClass('bg-white dark:bg-gray-700 shadow-sm text-blue-600')
                    .addClass('text-gray-600 dark:text-gray-400');
                
                if ($('#conditionInput').val()) {
                    $(this).removeClass('text-gray-600 dark:text-gray-400')
                        .addClass('bg-white dark:bg-gray-700 shadow-sm text-blue-600');
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
