<section class="bg-main ">
    <!-- Title Section -->
    <div class="text-center py-5 md:py-10 px-5">
        <h1 class=" text-2xl md:text-4xl font-bold  capitalize mb-4">Bài viết</h1>
        <p class="text-sm md:text-lg text-sub">
            Khám phá, khám phá và tìm cảm hứng qua những hành trình thú vị này.
        </p>
    </div>

    <div class="mx-auto container max-w-7xl px-5 md:px-0 lg:py-10 sm:py-16">
        <div class="grid gap-x-3 gap-y-3 sm:gap-y-16 grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
            @if (isset($posts) && count($posts) > 0)
                @foreach ($posts as $post)
                    @include('partials.cards.card-blog', ['post' => $post])
                @endforeach
            @else
                <p class="text-center text-gray-500 col-span-4">Chưa có bài viết nào được đăng tải.</p>
            @endif


        </div>
    </div>
</section>
