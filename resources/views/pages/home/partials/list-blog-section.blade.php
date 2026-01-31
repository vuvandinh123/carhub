<section class="bg-main ">
  <!-- Title Section -->
  <div class="text-center py-10">
    <h1 class="text-4xl font-bold  capitalize mb-4">Bài viết</h1>
    <p class="text-lg text-sub">
        Khám phá, khám phá và tìm cảm hứng qua những hành trình thú vị này.
    </p>
  </div>

  <div class="mx-auto container max-w-7xl lg:py-10 sm:py-16">
    <div class="grid gap-x-3 gap-y-12 sm:gap-y-16 md:grid-cols-2 lg:grid-cols-4">
      @for ($i = 0; $i < 4; $i++)
          @include('partials.cards.card-blog')
      @endfor
    </div>
  </div>
</section>