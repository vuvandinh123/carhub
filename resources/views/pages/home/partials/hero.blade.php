@php
    $slider = [
        "https://thacothuduc.com.vn/wp-content/uploads/2025/09/avatar2F5Rmqfe8WVshJZ3pmnY8DATExYMgMxQcLoVK0JNB6IKMKooPlYe.jpeg",
        "https://thacothuduc.com.vn/wp-content/uploads/2025/09/avatar2FZSwMReTQebKXiodWk2PKeTJV0XCT5JvYtyi0z8d1j7ntaryDTK-e1764390323960.jpeg",
        "https://thacothuduc.com.vn/wp-content/uploads/2025/09/avatar2FppJd9Z7wta9ApcVGgAuZSxQzUbTdTLkcicJ8YQrYROSaqVlWZz.jpeg",
        "https://thacothuduc.com.vn/wp-content/uploads/2025/09/lineup_xe_thaco_towner_tai_3857b3d3ebba44c1b018cc64a13acf27.png",
        "https://thacothuduc.com.vn/wp-content/uploads/2025/09/z7060948596897_a3f3ecbdbb66818169bdc27100a4ed76.jpg",

    ]
@endphp
<div class="relative h-[60vh] bg-main-gray overflow-hidden">
    <!-- Slider with 50vh height -->
    <div class="absolute inset-0 swiper swiper-slider">
        <!-- Car Image -->
        <div class="swiper-wrapper">
            @foreach ($slider as $image)
                <div class="swiper-slide">
                    <div class="h-[60vh]">
                        <img src="{{ asset($image) }}"
                            alt="" class="w-full h-full object-cover object-center">
                    </div>
                    
                </div>
            @endforeach
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>

    <!-- Overlay gradient -->
    <div class="absolute inset-0 bg-gradient-to-b from-black/50 via-transparent to-black/30 pointer-events-none"></div>

</div>
