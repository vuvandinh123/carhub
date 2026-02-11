<!-- Browse by Type Section -->
<div class="py-5 md:py-16 max-w-7xl mx-auto">
    <h2 class="text-xl uppercase md:text-3xl font-bold text-center  md:mb-12 mb-5 text-main">Danh mục</h2>
    <div class="swiper swiper-categories" style="width: 100%; height: auto;">
        <div class="swiper-wrapper">
            @foreach ($categories as $item)
                <div class="swiper-slide">
                    <a href="{{ route('cars.index', ['brand' => $item->id]) }}"
                        class="flex flex-col dark:bg-brand-gray bg-brand-white items-center justify-between  dark:border-gray-700 gap-2 rounded-sm shadow-primary-800/20 group min-h-[150px] cursor-pointer hover:shadow-lg transition-shadow duration-200 p-4 ">
                        <span class="">
                            <img width="100" height="100" class="group-hover:scale-110  object-center rounded-sm transition-all w-full h-[130px] duration-200"
                                src="{{ asset('storage/' . $item->thumbnail) }}"
                                onerror="this.onerror=null;this.src='{{ asset('images/default.png') }}';"
                                alt="{{ $item->name }}">

                        </span>
                        <span class="text-sm text-main group-hover:text-brand-blue-500 font-medium">{{ $item->name }}</span>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</div>
