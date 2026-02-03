@extends('layouts.app')

@section('title', $post->seo_title ?? $post->title)

@section('meta')
    @include('partials.meta-tag', [
        'title' => $post->seo_title ?? $post->title,
        'meta_description' => $post->seo_description ?? $post->excerpt,
        'meta_keywords' => $post->seo_keywords ?? '',
        'meta_image' => $post->thumbnail ?? asset('default-image.jpg'),
        'meta_robots' => 'index, follow',
    ])
@endsection

@section('content')
<div class="bg-main min-h-screen">
    <!-- Header Section -->
    <section class="relative bg-gradient-to-r from-primary-900 via-primary-800 to-primary-800 text-white py-12 overflow-hidden">
        <div class="absolute inset-0 opacity-20">
            <div class="absolute animate-pulse top-10 left-10 w-72 h-72 bg-white/30 rounded-full mix-blend-overlay filter blur-xl"></div>
            <div class="absolute animate-pulse bottom-10 right-10 w-96 h-96 bg-white/30 rounded-full mix-blend-overlay filter blur-xl"></div>
        </div>
        
        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-4xl mx-auto">
                <!-- Breadcrumb -->
                <nav class="mb-6 text-sm">
                    <ol class="flex items-center space-x-2">
                        <li><a href="{{ route('home') }}" class="hover:underline opacity-75">Trang chủ</a></li>
                        <li><i data-lucide="chevron-right" class="w-4 h-4"></i></li>
                        <li><a href="{{ route('posts.index') }}" class="hover:underline opacity-75">Tin tức</a></li>
                        <li><i data-lucide="chevron-right" class="w-4 h-4"></i></li>
                        <li class="opacity-100">{{ Str::limit($post->title, 50) }}</li>
                    </ol>
                </nav>

                <!-- Category -->
                @if($post->category)
                <div class="mb-4">
                    <span class="inline-block px-4 py-1.5 bg-white/20 backdrop-blur-sm rounded-full text-sm font-semibold">
                        {{ $post->category->name }}
                    </span>
                </div>
                @endif

                <!-- Title -->
                <h1 class="text-4xl md:text-5xl  mb-6 leading-tight">{{ $post->title }}</h1>

                <!-- Meta Info -->
                <div class="flex flex-wrap items-center gap-6 text-sm opacity-90">
                    <div class="flex items-center gap-2">
                        <i data-lucide="calendar" class="w-4 h-4"></i>
                        <span>{{ $post->published_at->format('d/m/Y') }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i data-lucide="clock" class="w-4 h-4"></i>
                        <span>{{ ceil(str_word_count(strip_tags($post->content)) / 200) }} phút đọc</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-12">
        <div class="max-w-4xl mx-auto">
            <!-- Featured Image -->
            @if($post->thumbnail)
            <div class="mb-10 rounded-2xl overflow-hidden shadow-2xl">
                <img src="{{ $post->thumbnail }}" alt="{{ $post->title }}" class="w-full h-auto object-cover">
            </div>
            @endif

            <!-- Content -->
            <article class="prose prose-lg dark:prose-invert max-w-none mb-12">
                {!! $post->content !!}
            </article>

            <!-- Tags -->
            @if($post->tags->count() > 0)
            <div class="mb-12 pt-8 border-t border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-bold text-main mb-4 flex items-center gap-2">
                    <i data-lucide="tag" class="w-5 h-5 text-blue-600"></i>
                    Tags
                </h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($post->tags as $tag)
                    <a href="{{ route('posts.index', ['tag' => $tag->id]) }}" 
                       class="px-4 py-2 bg-blue-50 dark:bg-blue-900/20 text-blue-700 dark:text-blue-300 rounded-full text-sm font-medium hover:bg-blue-100 dark:hover:bg-blue-900/40 transition-colors">
                        #{{ $tag->name }}
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Share Section -->
            <div class="mb-5 md:mb-12 pt-8 border-t border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-bold text-main mb-4 flex items-center gap-2">
                    <i data-lucide="share-2" class="w-5 h-5 text-blue-600"></i>
                    Chia sẻ bài viết
                </h3>
                <div class="flex gap-3">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                       target="_blank"
                       class="flex items-center gap-1 md:gap-2 px-2 md:px-5 py-1 md:py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                        <i data-lucide="facebook" class="w-5 h-5"></i>
                        Facebook
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->title) }}" 
                       target="_blank"
                       class="flex items-center gap-1 md:gap-2 px-2 md:px-5 py-1 md:py-3 bg-sky-500 text-white rounded-lg hover:bg-sky-600 transition-colors font-medium">
                        <i data-lucide="twitter" class="w-5 h-5"></i>
                        Twitter
                    </a>
                    <button onclick="copyToClipboard()" 
                            class="flex items-center gap-1 md:gap-2 px-2 md:px-5 py-1 md:py-3 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors font-medium">
                        <i data-lucide="link" class="w-5 h-5"></i>
                        Copy Link
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Posts -->
    @if($relatedPosts->count() > 0)
    <section class="bg-gray-50 dark:bg-gray-900 py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-bold text-main mb-8 flex items-center gap-3">
                    <i data-lucide="newspaper" class="w-8 h-8 text-blue-600"></i>
                    Bài viết liên quan
                </h2>
                
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach($relatedPosts as $relatedPost)
                    <div class="card rounded-lg overflow-hidden group hover:shadow-xl transition-all duration-300">
                        <a href="{{ route('posts.show', $relatedPost->slug) }}" class="block">
                            @if($relatedPost->thumbnail)
                            <div class="relative overflow-hidden h-48">
                                <img src="{{ $relatedPost->thumbnail }}" 
                                     alt="{{ $relatedPost->title }}" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            </div>
                            @endif
                            <div class="p-5">
                                @if($relatedPost->category)
                                <span class="text-xs font-semibold text-blue-600 uppercase">{{ $relatedPost->category->name }}</span>
                                @endif
                                <h3 class="text-lg font-bold text-main mt-2 mb-2 line-clamp-2 group-hover:text-blue-600 transition-colors">
                                    {{ $relatedPost->title }}
                                </h3>
                                <p class="text-sm text-sub line-clamp-2">{{ $relatedPost->excerpt }}</p>
                                <div class="flex items-center gap-2 mt-4 text-xs text-sub">
                                    <i data-lucide="calendar" class="w-3.5 h-3.5"></i>
                                    <span>{{ $relatedPost->published_at->format('d/m/Y') }}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif
</div>
@endsection

@section('scripts')
<script>
    function copyToClipboard() {
        const url = window.location.href;
        navigator.clipboard.writeText(url).then(() => {
            alert('Đã sao chép link!');
        });
    }
</script>
@endsection
