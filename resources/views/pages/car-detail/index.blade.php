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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@6.0/dist/fancybox/fancybox.css" />
    <style>
        /* Custom Navigation Buttons */
        .swiper-button-prev-custom,
        .swiper-button-next-custom {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 10;
            cursor: pointer;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #374151;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .swiper-button-prev-custom {
            left: 20px;
        }

        .swiper-button-next-custom {
            right: 20px;
        }

        .swiper-button-prev-custom:hover,
        .swiper-button-next-custom:hover {
            background: rgba(255, 255, 255, 1);
            transform: translateY(-50%) scale(1.1);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        }

        .swiper-button-prev-custom.swiper-button-disabled,
        .swiper-button-next-custom.swiper-button-disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Custom Pagination */
        .swiper-pagination-custom {
            bottom: 20px !important;
        }

        .swiper-pagination-custom .swiper-pagination-bullet {
            width: 12px;
            height: 12px;
            background: rgba(255, 255, 255, 0.7);
            opacity: 1;
            margin: 0 6px !important;
            transition: all 0.3s ease;
        }

        .swiper-pagination-custom .swiper-pagination-bullet-active {
            background: #fff;
            width: 32px;
            border-radius: 6px;
        }

        /* Thumbnail Active State */
        .mySwiperThumbs .swiper-slide-thumb-active>div {
            border-color: #3B82F6 !important;
            border-width: 3px;
        }

        .mySwiperThumbs .swiper-slide-thumb-active img {
            transform: scale(1.05);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {

            .swiper-button-prev-custom,
            .swiper-button-next-custom {
                width: 40px;
                height: 40px;
            }

            .swiper-button-prev-custom {
                left: 10px;
            }

            .swiper-button-next-custom {
                right: 10px;
            }
        }

       
    </style>

@endsection

@section('content')
    <section>
        <div class="container mx-auto mt-10 px-4 py-6">
            <x-breadcrumb :items="[['label' => 'Cars', 'url' => route('cars.index')], ['label' => 'Car Details']]" />
        </div>
        <div class="container mx-auto px-4 py-6">
            <!-- Car Title -->
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h1 class="text-3xl font-bold text-main">{{ $car->title }}</h1>
                    <span class="text-sub text-lg">({{ $car->year }})</span>
                </div>
                <div class="flex items-center space-x-2">
                    <button class="p-2 text-gray-400 hover:text-gray-600">
                        <i data-lucide="share" class="fas fa-share-alt"></i>
                    </button>
                    <button class="p-2 text-gray-400 hover:text-red-500">
                        <i data-lucide="heart" class="far fa-heart"></i>
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2">
                    <div class="relative mb-6">
                        <!-- Main Swiper -->
                        <div class="swiper mySwiper2 rounded-xl overflow-hidden shadow-2xl">
                            <div class="swiper-wrapper">
                                @foreach ($car->images as $item)
                                    <div class="swiper-slide">
                                        <a href="https://hoanghamobile.com/tin-tuc/wp-content/uploads/2024/07/hinh-anh-oto.jpg" data-fancybox="car-gallery"
                                            data-caption="Ảnh xe {{ $loop->iteration }} - {{ $car->name ?? 'Chi tiết xe' }}"
                                            class="block relative group">
                                            <img src="https://hoanghamobile.com/tin-tuc/wp-content/uploads/2024/07/hinh-anh-oto.jpg"
                                                alt="Ảnh xe {{ $loop->iteration }}"
                                                class="w-full h-96 lg:h-[550px] object-cover transition-transform duration-500 group-hover:scale-105">

                                            <!-- Overlay hover effect -->
                                            <div
                                                class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center">
                                                <div
                                                    class="text-center transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                                    <svg class="w-16 h-16 text-white mx-auto mb-2" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7">
                                                        </path>
                                                    </svg>
                                                    <p class="text-white font-semibold text-sm">Nhấn để phóng to</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Custom Navigation Buttons -->
                            <div class="swiper-button-prev-custom">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M15 19l-7-7 7-7"></path>
                                </svg>
                            </div>
                            <div class="swiper-button-next-custom">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>

                            <!-- Pagination -->
                            <div class="swiper-pagination-custom"></div>

                            <!-- Status Badges -->
                            <div class="absolute top-5 left-5 flex flex-wrap gap-2 z-10">
                                <span
                                    class="bg-gradient-to-r from-orange-500 to-orange-600 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg backdrop-blur-sm flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 2a8 8 0 100 16 8 8 0 000-16zm1 11H9v-2h2v2zm0-4H9V5h2v4z"></path>
                                    </svg>
                                    Đã qua sử dụng
                                </span>
                                <span
                                    class="bg-gradient-to-r from-green-500 to-green-600 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg backdrop-blur-sm flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    Đã xác minh
                                </span>
                            </div>

                            <!-- Image Counter -->
                            <div
                                class="absolute bottom-5 right-5 bg-black bg-opacity-70 text-white px-4 py-2 rounded-full text-sm font-medium backdrop-blur-sm z-10">
                                <span class="current-slide">1</span> / <span
                                    class="total-slides">{{ count($car->images) }}</span>
                            </div>
                        </div>

                        <!-- Thumbnail Swiper -->
                        <div class="swiper mySwiperThumbs mt-4">
                            <div class="swiper-wrapper">
                                @foreach ($car->images as $item)
                                    <div class="swiper-slide">
                                        <div
                                            class="relative group cursor-pointer overflow-hidden rounded-lg border-3 border-transparent hover:border-blue-500 transition-all duration-300">
                                            <img src="{{ asset('storage/' . $item->image_url) }}"
                                                alt="Thumbnail {{ $loop->iteration }}"
                                                class="w-full h-20 lg:h-24 object-cover transition-transform duration-300 group-hover:scale-110">
                                            <div
                                                class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300">
                                            </div>
                                            <!-- Thumbnail number badge -->
                                            <div
                                                class="absolute bottom-1 right-1 bg-black bg-opacity-70 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity">
                                                {{ $loop->iteration }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Specifications Section -->
                    <!-- Phần thông số kỹ thuật -->
                    <div class="mt-8 bg-main text-main rounded-lg p-6 shadow-sm">
                        <h2 class="text-2xl font-bold mb-6">Thông số kỹ thuật</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Cột trái -->
                            <div class="space-y-4">
                                <div class="flex justify-between border-b border-gray-200 dark:border-gray-700 pb-2">
                                    <span class="text-sub">Năm sản xuất:</span>
                                    <span class="font-medium">2021</span>
                                </div>
                                <div class="flex justify-between border-b border-gray-200 dark:border-gray-700 pb-2">
                                    <span class="text-sub">Số dặm đã đi:</span>
                                    <span class="font-medium">60K miles</span>
                                </div>
                                <div class="flex justify-between border-b border-gray-200 dark:border-gray-700 pb-2">
                                    <span class="text-sub">Kiểu dáng thân xe:</span>
                                    <span class="font-medium">Mui trần (Convertible)</span>
                                </div>
                                <div class="flex justify-between border-b border-gray-200 dark:border-gray-700 pb-2">
                                    <span class="text-sub">Dẫn động:</span>
                                    <span class="font-medium">Cầu sau (2WD - rear)</span>
                                </div>
                                <div class="flex justify-between border-b border-gray-200 dark:border-gray-700 pb-2">
                                    <span class="text-sub">Động cơ:</span>
                                    <span class="font-medium">6 xi-lanh tăng áp (Turbo)</span>
                                </div>
                                <div class="flex justify-between border-b border-gray-200 dark:border-gray-700 pb-2">
                                    <span class="text-sub">Hộp số:</span>
                                    <span class="font-medium">Tự động 7 cấp có thể chuyển số (Shiftable)</span>
                                </div>
                            </div>

                            <!-- Cột phải -->
                            <div class="space-y-4">
                                <div class="flex justify-between border-b border-gray-200 dark:border-gray-700 pb-2">
                                    <span class="text-sub">Loại nhiên liệu:</span>
                                    <span class="font-medium">Xăng (Gasoline)</span>
                                </div>
                                <div class="flex justify-between border-b border-gray-200 dark:border-gray-700 pb-2">
                                    <span class="text-sub">Tiêu hao nhiên liệu trong thành phố (MPG):</span>
                                    <span class="font-medium">20</span>
                                </div>
                                <div class="flex justify-between border-b border-gray-200 dark:border-gray-700 pb-2">
                                    <span class="text-sub">Tiêu hao nhiên liệu đường trường (MPG):</span>
                                    <span class="font-medium flex items-center">
                                        28
                                        <i class="fas fa-info-circle ml-1 text-gray-400 text-sm"></i>
                                    </span>
                                </div>
                                <div class="flex justify-between border-b border-gray-200 dark:border-gray-700 pb-2">
                                    <span class="text-sub">Màu ngoại thất:</span>
                                    <span class="font-medium flex items-center">
                                        Trắng Aspen
                                        <i class="fas fa-info-circle ml-1 text-gray-400 text-sm"></i>
                                    </span>
                                </div>
                                <div class="flex justify-between border-b border-gray-200 dark:border-gray-700 pb-2">
                                    <span class="text-sub">Màu nội thất:</span>
                                    <span class="font-medium">Than (Charcoal)</span>
                                </div>
                                <div class="flex justify-between border-b border-gray-200 dark:border-gray-700 pb-2">
                                    <span class="text-sub">Số khung (VIN):</span>
                                    <span class="font-medium">2VW821AU9JM754284</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Price and Contact -->
                <div class="lg:col-span-1">
                    <div class="bg-brand-white dark:bg-brand-gray text-main rounded-lg p-6 shadow-sm sticky top-18">
                        <!-- Price -->
                        <div class="mb-6">
                            <h2 class="text-3xl font-bold ">
                                {{ number_format($car->price) }} đ
                            </h2>
                        </div>

                        <!-- Car Details -->
                        <div class="grid grid-cols-2 gap-4 mb-6 text-sm">
                            <div class="flex items-center text-sub">
                                <i data-lucide="map-pin" class="fas fa-map-marker-alt mr-2"></i>
                                <span>{{ $car->brand->country }}</span>
                            </div>
                            <div class="flex items-center text-sub">
                                <i data-lucide="gauge" class="fas fa-road mr-2"></i>
                                <span>{{ number_format($car->mileage) }} km</span>
                            </div>
                            <div class="flex items-center text-sub">
                                <i data-lucide="fuel" class="fas fa-gas-pump mr-2"></i>
                                <span>{{ $car->fuel_type?->name }}</span>
                            </div>
                            <div class="flex items-center text-sub">
                                <i data-lucide="settings" class="fas fa-cogs mr-2"></i>
                                <span>{{ $car->transmission->name }}</span>
                            </div>
                        </div>

                        <!-- Seller Info -->
                        <div class="border-t border-gray-200 dark:border-gray-700 pt-6 mb-6">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center">
                                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=50&h=50&fit=crop&crop=face"
                                        alt="Seller" class="w-12 h-12 rounded-full mr-3">
                                    <div>
                                        <h3 class="font-semibold ">Nguyễn Định Quân</h3>
                                        <div class="flex items-center">
                                            <div class="flex text-orange-400 text-sm mr-2">
                                                <i data-lucide="star" class="w-4"></i>
                                                <i data-lucide="star" class="w-4"></i>
                                                <i data-lucide="star" class="w-4"></i>
                                                <i data-lucide="star" class="w-4"></i>
                                                <i data-lucide="star" class="w-4"></i>
                                            </div>
                                            <span class="text-sm text-sub">4.9 (6 reviews)</span>
                                        </div>
                                    </div>
                                </div>
                                <span class="text-sm text-sub">Nhân viên tư vấn</span>
                            </div>
                            <!-- Contact Buttons -->
                            <div class="space-y-3">
                                <button id="revealBtn" onclick="revealPhone()"
                                    class="w-full border-2 border-gray-300  py-3 px-4 rounded-lg font-medium hover:border-gray-400 flex justify-center items-center gap-2 transition">
                                    <i data-lucide="phone" class="fas fa-phone-alt mr-2"></i>
                                    <span id="phoneNumber">
                                        039 888 8888
                                    </span>
                                </button>

                                <button
                                    class="w-full bg-red-600 hover:bg-red-700 text-white py-3 px-4 rounded-lg font-medium transition flex items-center justify-center">
                                    <i class="fas fa-envelope mr-2"></i>
                                    Gọi ngay
                                </button>
                                <div
                                    class="text-center mt-6 before:content-['Hoặc'] before:absolute before:-top-full before:bg-white dark:before:bg-gray-900 before:translate-y-[-5px] before:px-3 before:left-1/2 before:-translate-x-1/2 relative h-[2px] bg-gray-200 dark:bg-gray-700 text-sm text-gray-500 dark:text-gray-300">
                                </div>
                                <div class=" border-gray-200 pt-6">
                                    <h3 class="font-semibold  mb-2">Để lại thông tin chúng tôi sẽ liên hệ với
                                        bạn</h3>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div class="">
                                            <input type="text" id="nameInput" placeholder="Tên của bạn"
                                                class="w-full dark:bg-gray-800 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 dark:border-gray-600 focus:ring-blue-500 focus:border-blue-500 outline-none">
                                        </div>
                                        <div>
                                            <input type="text" id="phoneInput" placeholder="Số điện thoại của bạn"
                                                class="w-full dark:bg-gray-800 px-4 py-2 border border-gray-300 
                                                dark:border-gray-600
                                                rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                                        </div>
                                    </div>

                                    <button
                                        class="mt-3 w-full bg-blue-600 hover:bg-blue-700 text-white py-3 px-4 rounded-lg font-medium transition">
                                        Gửi
                                    </button>

                                </div>
                            </div>
                        </div>

                        <!-- Email Subscription -->
                        <div class="border-t border-gray-200 pt-6">
                            <h3 class="font-semibold mb-2">
                                Đăng ký nhận thông tin khuyến mãi qua email
                            </h3>

                            <div class="flex mb-3">
                                <input type="email" id="emailInput" placeholder="Email của bạn"
                                    class="flex-1 px-4 py-2 border border-gray-300 rounded-l-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none dark:bg-gray-800 dark:border-gray-600">
                                <button onclick="subscribeEmail()"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-r-lg font-medium transition">
                                    Đăng ký
                                </button>
                            </div>

                            <label class="flex items-start text-sm ">
                                <input type="checkbox"
                                    class="w-4 h-4 text-blue-600  border-gray-300 rounded focus:ring-blue-500 mt-1 mr-2">
                                <span class="text-sub">Tôi đồng ý nhận thông báo giảm giá cho xe này và thông tin mua sắm
                                    hữu ích.</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@6.0/dist/fancybox/fancybox.umd.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize thumbnail swiper first
            var swiperThumbs = new Swiper(".mySwiperThumbs", {
                spaceBetween: 10,
                slidesPerView: 4,
                freeMode: true,
                watchSlidesProgress: true,
                breakpoints: {
                    640: {
                        slidesPerView: 5,
                        spaceBetween: 12
                    },
                    768: {
                        slidesPerView: 6,
                        spaceBetween: 14
                    },
                    1024: {
                        slidesPerView: 8,
                        spaceBetween: 16
                    }
                }
            });

            // Initialize main swiper
            var swiper2 = new Swiper(".mySwiper2", {
                spaceBetween: 10,
                loop: true,
                speed: 800,
                effect: 'fade',
                fadeEffect: {
                    crossFade: true
                },
                navigation: {
                    nextEl: ".swiper-button-next-custom",
                    prevEl: ".swiper-button-prev-custom",
                },
                pagination: {
                    el: ".swiper-pagination-custom",
                    clickable: true,
                    dynamicBullets: true,
                },
                thumbs: {
                    swiper: swiperThumbs,
                },
                keyboard: {
                    enabled: true,
                    onlyInViewport: true,
                },
                mousewheel: {
                    forceToAxis: true,
                },
                on: {
                    slideChange: function() {
                        var realIndex = this.realIndex + 1;
                        $('.current-slide').text(realIndex);
                    }
                }
            });

            // Configure Fancybox with Premium Settings
            Fancybox.bind("[data-fancybox='car-gallery']", {
                // Animation Settings
                showClass: "fancybox-zoomIn",
                hideClass: "fancybox-fadeOut",

                // UI Settings
                Toolbar: {
                    display: {
                        left: ["infobar"],
                        middle: [],
                        right: ["slideshow", "thumbs", "close"]
                    }
                },

                // Thumbnails
                Thumbs: {
                    type: "classic",
                    showOnStart: false
                },

                // Touch Gestures
                touch: {
                    vertical: false,
                    momentum: true
                },

                // Keyboard
                keyboard: {
                    Escape: "close",
                    Delete: "close",
                    Backspace: "close",
                    PageUp: "prev",
                    PageDown: "next",
                    ArrowUp: "prev",
                    ArrowDown: "next",
                    ArrowRight: "next",
                    ArrowLeft: "prev"
                },

                // Images
                Images: {
                    zoom: true,
                    click: "toggleZoom",
                    wheel: "zoom",
                    fit: "contain",
                    initialSize: "fit",
                    protected: true
                },

                // Slideshow
                Slideshow: {
                    playOnStart: false,
                    timeout: 3000
                },

                // Additional Settings
                animated: true,
                hideScrollbar: true,
                trapFocus: true,
                placeFocusBack: true,
                autoFocus: true,
                infinite: true,

                // Custom Events
                on: {
                    ready: (fancybox) => {
                        console.log('Fancybox is ready!');
                    },
                    // "Carousel.change": (fancybox, carousel, to, from) => {
                    //     // Sync with swiper when navigating in fancybox
                    //     if (swiper2 && !swiper2.destroyed) {
                    //         swiper2.slideToLoop(to);
                    //     }
                    // }
                }
            });

            // Prevent navigation buttons from triggering fancybox
            $('.swiper-button-prev-custom, .swiper-button-next-custom, .swiper-pagination-custom').on('click',
                function(e) {
                    e.stopPropagation();
                });

            // Sync swiper with fancybox
            swiper2.on('slideChange', function() {
                // Optional: Close fancybox when changing slides in swiper
                if (Fancybox.getInstance()) {
                    Fancybox.close();
                }
            });

            // Add keyboard navigation enhancement
            $(document).on('keydown', function(e) {
                if (!Fancybox.getInstance()) {
                    if (e.keyCode === 37) { // Left arrow
                        swiper2.slidePrev();
                    } else if (e.keyCode === 39) { // Right arrow
                        swiper2.slideNext();
                    } else if (e.keyCode === 32) { // Spacebar - open current image
                        e.preventDefault();
                        $('.mySwiper2 .swiper-slide-active a').trigger('click');
                    }
                }
            });

            // Add smooth hover effect
            $('.mySwiper2 .swiper-slide a').hover(
                function() {
                    $(this).find('img').css('transform', 'scale(1.05)');
                },
                function() {
                    $(this).find('img').css('transform', 'scale(1)');
                }
            );
        });
    </script>
@endsection
