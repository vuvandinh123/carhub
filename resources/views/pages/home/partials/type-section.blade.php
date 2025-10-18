<!-- Browse by Type Section -->
<div class="py-16 max-w-7xl mx-auto">
    <h2 class="text-3xl font-bold text-center  mb-12 text-main capitalize">Theo thương hiệu</h2>
    <div class="grid grid-cols-3 md:grid-cols-5 lg:grid-cols-7 gap-6  mx-auto">
        @foreach ($brands as $item)
            <a href="{{ route('cars.index', ['brand' => $item->id]) }}"
                class="flex flex-col dark:bg-brand-gray bg-brand-white items-center justify-between border  border-gray-200 dark:border-gray-700 gap-2 rounded-2xl group cursor-pointer hover:shadow-lg transition-shadow duration-200 p-4 ">
                <span class="">
                    <img width="100px" class="group-hover:scale-110 transition-all duration-200" height="100px" src="{{ $item->logo }}" alt="{{ $item->name }}">
                </span>
                <span class="text-sm text-main group-hover:text-brand-blue-500 font-medium">{{ $item->name }}</span>
            </a>
        @endforeach
    </div>
</div>
</div>
