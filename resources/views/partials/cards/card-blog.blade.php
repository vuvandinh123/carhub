<div class="relative hover:shadow-lg group transition-shadow border border-gray-200 dark:border-gray-700 card rounded-sm ">
    <a href="{{ route('posts.show', $post->slug) }}" class="block overflow-hidden object-cover rounded-sm shadow-xl">
        <img src="{{ $post->thumbnail ?? 'https://images.unsplash.com/photo-1508974239320-0a029497e820?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' }}"
            class="object-contain md:object-contain w-full group-hover:shadow-lg md:h-56 transition-all duration-300 ease-out sm:h-64 group-hover:scale-110"
            alt="{{ $post->title }}">
    </a>
    <div class="relative mt-3 p-4">
        <p class="uppercase font-semibold text-[9px] mb-1 md:mb-2.5 text-blue-600">{{ $post->category->name ?? 'Tin tức' }}</p>
        <a href="{{ route('posts.show', $post->slug) }}" class="block mb-3 hover:underline">
            <h2
                class="text-sm md:text-2xl font-bold text-black dark:text-white transition-colors duration-200 hover:text-blue-700 dark:hover:text-blue-400">
                {{ $post->title }}
            </h2>
        </a>
        <p class="mb-1 md:mb-4 text-xs text-gray-500 md:text-sm line-clamp-2 dark:text-gray-300">
            {{ $post->excerpt }}
        </p>
        <a href="{{ route('posts.show', $post->slug) }}" class="font-medium text-xs underline text-blue-600 dark:text-blue-400">Đọc thêm</a>
    </div>
</div>
