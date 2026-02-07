@extends('layouts.app')

@section('title', 'Tin Tức & Bài Viết - Xedep.vn')

@section('content')
<div class="bg-main">
    <!-- Hero Section -->
    <section class="relative  bg-gradient-to-r from-primary-900 via-primary-800 to-primary-900 text-white py-16 overflow-hidden">
        <div class="absolute inset-0 opacity-20">
            <div class="absolute animate-pulse top-10 left-10 w-72 h-72 bg-white/30 rounded-full mix-blend-overlay filter blur-xl"></div>
            <div class="absolute animate-pulse bottom-10 right-10 w-96 h-96 bg-white/30 rounded-full mix-blend-overlay filter blur-xl"></div>
        </div>
        
        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-5xl md:text-5xl font-bold mb-6">Tin Tức & Xu Hướng</h1>
                <p class="text-xl md:text-xl opacity-90 mb-8">
                    Cập nhật thông tin mới nhất về thế giới ô tô, công nghệ và xu hướng thị trường
                </p>
                
                <!-- Search Bar -->
                <form action="{{ route('posts.index') }}" method="GET" class="max-w-2xl mx-auto">
                    <div class="relative">
                        <input 
                            type="text" 
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Tìm kiếm bài viết..." 
                            class="w-full px-6 py-4 pr-32 rounded-full text-gray-900 dark:text-white bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm focus:outline-none focus:ring-4 focus:ring-white/20 shadow-2xl">
                        <button 
                            type="submit"
                            class="absolute right-2 top-1/2 -translate-y-1/2 px-6 py-2 bg-primary-800 text-white rounded-full hover:bg-primary-700 transition-all duration-300 font-semibold">
                            <i data-lucide="search" class="w-5 h-5 inline"></i>
                            Tìm kiếm
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-12 container mx-auto max-w-7xl">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Sidebar -->
                <aside class="lg:w-80 flex-shrink-0">
                    <div class="sticky top-24 space-y-4">
                        <!-- Categories -->
                        <div class="bg-gray-50 dark:bg-gray-800 rounded-md p-6 shadow-sm border border-gray-200 dark:border-gray-700">
                            <h3 class="text-xl font-bold text-main mb-4 flex items-center gap-2">
                                <i data-lucide="folder" class="w-5 h-5 text-primary-800"></i>
                                Danh Mục
                            </h3>
                            <ul class="space-y-2 h-[300px] overflow-y-auto pr-2">
                                <li>
                                    <a href="{{ route('posts.index') }}" 
                                        class="flex items-center justify-between py-2 px-3 rounded-lg hover:bg-main transition-colors {{ !request('category') ? 'bg-blue-50 dark:bg-blue-900/20 text-primary-800' : 'text-sub' }}">
                                        <span>Tất cả bài viết</span>
                                        <span class="text-xs bg-gray-200 dark:bg-gray-700 px-2 py-1 rounded-full">{{ $posts->total() }}</span>
                                    </a>
                                </li>
                                @foreach($categories as $category)
                                <li>
                                    <a href="{{ route('posts.index', ['category' => $category->id]) }}" 
                                        class="flex items-center justify-between py-2 px-3 rounded-lg hover:bg-main transition-colors {{ request('category') == $category->id ? 'bg-blue-50 dark:bg-blue-900/20 text-primary-800' : 'text-sub' }}">
                                        <span>{{ $category->name }}</span>
                                        <span class="text-xs bg-gray-200 dark:bg-gray-700 px-2 py-1 rounded-full">{{ $category->posts_count }}</span>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Tags -->
                        <div class="bg-gray-50 dark:bg-gray-800 rounded-md p-6 shadow-sm border border-gray-200 dark:border-gray-700">
                            <h3 class="text-xl font-bold text-main mb-4 flex items-center gap-2">
                                <i data-lucide="tag" class="w-5 h-5 text-gray-500"></i>
                                Thẻ Tag
                            </h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach($tags as $tag)
                                <a href="{{ route('posts.index', ['tag' => $tag->id]) }}" 
                                    class="px-3 py-1 text-sm rounded-full transition-all duration-300 {{ request('tag') == $tag->id ? 'bg-purple-600 text-white' : 'bg-gray-200 dark:bg-gray-700 text-sub hover:bg-purple-100 dark:hover:bg-purple-900/30' }}">
                                    {{ $tag->name }}
                                </a>
                                @endforeach
                            </div>
                        </div>

                        <!-- Featured Posts -->
                        <div class="bg-gray-50 dark:bg-gray-800 rounded-md p-6 shadow-sm border border-gray-200 dark:border-gray-700">
                            <h3 class="text-xl font-bold text-main mb-10 flex items-center gap-2">
                                <i data-lucide="star" class="w-5 h-5 text-yellow-500"></i>
                                Bài Viết Nổi Bật
                            </h3>
                            <div class="space-y-4">
                                @foreach($featuredPosts as $featured)
                                <a href="{{ route('posts.show', $featured) }}" class="block group border-b border-gray-200 dark:border-gray-700 pb-4 last:border-0">
                                    <div class="flex gap-3">
                                        @if($featured->thumbnail)
                                        <img src="{{ asset('storage/' . $featured->thumbnail) }}"
                                            onerror="this.onerror=null;this.src='{{ asset('images/default.png') }}';" 
                                            alt="{{ $featured->title }}"
                                            class="w-20 h-20 object-contain rounded-lg group-hover:scale-105 transition-transform">
                                        @else
                                        <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-purple-500 rounded-lg flex items-center justify-center">
                                            <i data-lucide="newspaper" class="w-8 h-8 text-white"></i>
                                        </div>
                                        @endif
                                        <div class="flex-1">
                                            <h4 class="font-semibold text-sm text-main line-clamp-2 group-hover:text-primary-800 transition-colors">
                                                {{ $featured->title }}
                                            </h4>
                                            <p class="text-xs text-sub mt-1">
                                                <i data-lucide="calendar" class="w-3 h-3 inline"></i>
                                                {{ $featured->published_at->format('d/m/Y') }}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </aside>

                <!-- Posts Grid -->
                <main class="flex-1">
                    <!-- Active Filters -->
                    @if(request('search') || request('category') || request('tag'))
                    <div class="mb-6 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-xl border border-blue-200 dark:border-blue-800">
                        <div class="flex items-center justify-between flex-wrap gap-3">
                            <div class="flex items-center gap-2 flex-wrap">
                                <span class="text-sm font-semibold text-blue-900 dark:text-blue-100">Lọc theo:</span>
                                @if(request('search'))
                                <span class="px-3 py-1 bg-primary-800 text-white rounded-full text-sm flex items-center gap-2">
                                    "{{ request('search') }}"
                                    <a href="{{ route('posts.index', request()->except('search')) }}" class="hover:bg-blue-700 rounded-full p-0.5">
                                        <i data-lucide="x" class="w-3 h-3"></i>
                                    </a>
                                </span>
                                @endif
                                @if(request('category'))
                                <span class="px-3 py-1 bg-green-600 text-white rounded-full text-sm flex items-center gap-2">
                                    {{ $categories->find(request('category'))->name ?? 'Danh mục' }}
                                    <a href="{{ route('posts.index', request()->except('category')) }}" class="hover:bg-green-700 rounded-full p-0.5">
                                        <i data-lucide="x" class="w-3 h-3"></i>
                                    </a>
                                </span>
                                @endif
                                @if(request('tag'))
                                <span class="px-3 py-1 bg-purple-600 text-white rounded-full text-sm flex items-center gap-2">
                                    {{ $tags->find(request('tag'))->name ?? 'Tag' }}
                                    <a href="{{ route('posts.index', request()->except('tag')) }}" class="hover:bg-purple-700 rounded-full p-0.5">
                                        <i data-lucide="x" class="w-3 h-3"></i>
                                    </a>
                                </span>
                                @endif
                            </div>
                            <a href="{{ route('posts.index') }}" class="text-sm text-primary-800 hover:text-blue-700 font-medium">
                                Xóa tất cả
                            </a>
                        </div>
                    </div>
                    @endif

                    <!-- Results Count -->
                    <div class="mb-6 flex items-center justify-between">
                        <h2 class="text-2xl font-bold text-main">
                            Tìm thấy {{ $posts->total() }} bài viết
                        </h2>
                    </div>

                    @if($posts->count() > 0)
                    <!-- Posts Grid -->
                    <div class="grid md:grid-cols-3 gap-2 mb-8">
                        @foreach($posts as $post)
                        <article class="group bg-gray-50 dark:bg-gray-800 rounded-md overflow-hidden shadow-md hover:shadow-2xl transition-all duration-300 border border-gray-200 dark:border-gray-700">
                            <!-- Thumbnail -->
                            <a href="{{ route('posts.show', $post) }}" class="block relative overflow-hidden">
                                @if($post->thumbnail)
                                <img src="{{ asset('storage/' . $post->thumbnail) }}" 
                                    alt="{{ $post->title }}"
                                    onerror="this.onerror=null;this.src='{{ asset('images/default.png') }}';"
                                    class="w-full h-56 object-contain group-hover:scale-110 transition-transform duration-500">
                                @else
                                <div class="w-full h-56 bg-gradient-to-br from-blue-500 via-purple-500 to-pink-500 flex items-center justify-center">
                                    <i data-lucide="newspaper" class="w-20 h-20 text-white opacity-50"></i>
                                </div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            </a>

                            <!-- Content -->
                            <div class="p-4 border-t border-gray-200 dark:border-gray-700">
                                <!-- Category & Date -->
                                <div class="flex items-center gap-3 mb-3">
                                    @if($post->category)
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
                                @if($post->excerpt)
                                <p class="text-sub text-sm line-clamp-3 mb-4">
                                    {{ $post->excerpt }}
                                </p>
                                @endif

                                <!-- Tags -->
                                @if($post->tags->count() > 0)
                                <div class="flex flex-wrap gap-2 mb-4">
                                    @foreach($post->tags->take(3) as $tag)
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
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    @if($posts->hasPages())
                    <div class="mt-8">
                        {{ $posts->links() }}
                    </div>
                    @endif

                    @else
                    <!-- Empty State -->
                    <div class="text-center py-16">
                        <div class="mb-6">
                            <i data-lucide="search-x" class="w-24 h-24 text-gray-300 dark:text-gray-600 mx-auto"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-main mb-3">Không tìm thấy bài viết</h3>
                        <p class="text-sub mb-6">Thử thay đổi điều kiện tìm kiếm hoặc bộ lọc của bạn</p>
                        <a href="{{ route('posts.index') }}" 
                            class="inline-flex items-center gap-2 px-6 py-3 bg-primary-800 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            <i data-lucide="refresh-cw" class="w-5 h-5"></i>
                            Xem tất cả bài viết
                        </a>
                    </div>
                    @endif
                </main>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="py-16 bg-gradient-to-r from-primary-800 to-primary-900 text-white">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center">
                <div class="mb-6">
                    <i data-lucide="mail" class="w-16 h-16 mx-auto mb-4 opacity-90"></i>
                </div>
                <h2 class="text-2xl font-bold mb-4">Đăng Ký Nhận Tin</h2>
                <p class="text-sm mb-8 opacity-90">
                    Cập nhật những tin tức mới nhất về thế giới ô tô ngay vào email của bạn
                </p>
                <form class="flex gap-3 max-w-md mx-auto">
                    <input 
                        type="email" 
                        placeholder="Email của bạn..." 
                        class="flex-1 px-6 py-3 rounded-full text-gray-900 dark:text-white bg-white/90 dark:bg-gray-800/90 focus:outline-none focus:ring-4 focus:ring-white/30">
                    <button 
                        type="submit"
                        class="px-8 py-3 bg-white text-primary-800 rounded-full hover:bg-gray-100 transition-colors font-bold whitespace-nowrap">
                        Đăng ký
                    </button>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
