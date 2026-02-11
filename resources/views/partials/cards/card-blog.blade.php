<article
    class="group bg-gray-50 dark:bg-gray-800 rounded-md overflow-hidden shadow-md hover:shadow-2xl transition-all duration-300 border border-gray-200 dark:border-gray-700">
    <!-- Thumbnail -->
    <a href="{{ route('posts.show', $post) }}" class="block relative overflow-hidden">
        @if ($post->thumbnail)
            <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}"
                onerror="this.onerror=null;this.src='{{ asset('images/default.png') }}';"
                class="w-full h-56 object-contain group-hover:scale-110 transition-transform duration-500">
        @else
            <div
                class="w-full h-56 bg-gradient-to-br from-blue-500 via-purple-500 to-pink-500 flex items-center justify-center">
                <i data-lucide="newspaper" class="w-20 h-20 text-white opacity-50"></i>
            </div>
        @endif
        <div
            class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
        </div>
    </a>

    <!-- Content -->
    <div class="p-4 border-t border-gray-200 dark:border-gray-700">
        <!-- Category & Date -->
        <div class="flex items-center gap-3 mb-3">
            @if ($post->category)
                <a href="{{ route('posts.index', ['category' => $post->category->id]) }}"
                    class="px-3 py-1 bg-primary-800 text-white text-xs font-semibold rounded-full hover:bg-blue-700 transition-colors">
                    {{ $post->category->name }}
                </a>
            @endif
            <span class="text-xs text-sub flex items-center gap-1">
                <i data-lucide="calendar" class="w-3.5 h-3.5"></i>
                {{ $post->published_at->format('d/m/Y') }}
            </span>
        </div>

        <!-- Title -->
        <h3 class="text-xl font-bold text-main mb-3 line-clamp-2 group-hover:text-primary-800 transition-colors">
            <a href="{{ route('posts.show', $post) }}">
                {{ $post->title }}
            </a>
        </h3>

        <!-- Excerpt -->
        @if ($post->excerpt)
            <p class="text-sub text-sm line-clamp-3 mb-4">
                {{ $post->excerpt }}
            </p>
        @endif

        <!-- Tags -->
        @if ($post->tags->count() > 0)
            <div class="flex flex-wrap gap-2 mb-4">
                @foreach ($post->tags->take(3) as $tag)
                    <a href="{{ route('posts.index', ['tag' => $tag->id]) }}"
                        class="text-xs px-2 py-1 bg-gray-200 dark:bg-gray-700 text-sub rounded hover:bg-purple-100 dark:hover:bg-purple-900/30 transition-colors">
                        #{{ $tag->name }}
                    </a>
                @endforeach
            </div>
        @endif

        <!-- Read More -->
        <a href="{{ route('posts.show', $post) }}"
            class="inline-flex items-center gap-2 text-primary-800 hover:text-blue-700 font-semibold text-sm group/link">
            Đọc tiếp
            <i data-lucide="arrow-right" class="w-4 h-4 group-hover/link:translate-x-1 transition-transform"></i>
        </a>
    </div>
</article>
