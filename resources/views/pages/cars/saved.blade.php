@extends('layouts.app')

@section('content')
<div class="container max-w-7xl mt-10 mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-main mb-2 text-primary-800 flex items-center gap-3">
                    <i data-lucide="bookmark" class="w-8 h-8 text-primary-600"></i>
                    Xe đã lưu
                </h1>
                <p class="text-sub text-sm text-gray-500 pl-2">Danh sách xe bạn đã lưu để xem sau</p>
            </div>
            <button 
                onclick="clearAllBookmarks()"
                class="flex items-center gap-2 px-3 py-1.5 border border-red-300 dark:border-red-600 text-red-600 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20 transition">
                <i data-lucide="trash-2" class="w-4 h-4"></i>
                <span>Xóa tất cả</span>
            </button>
        </div>
    </div>

    <!-- Stats -->
    <div class="bg-primary-800 rounded-sm p-6 mb-8 text-white">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="flex items-center gap-4">
                <div class="bg-white/20 backdrop-blur-sm p-4 rounded-sm">
                    <i data-lucide="bookmark" class="w-8 h-8"></i>
                </div>
                <div>
                    <div class="text-3xl font-bold bookmark-count">0</div>
                    <div class="text-blue-100">Xe đã lưu</div>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <div class="bg-white/20 backdrop-blur-sm p-4 rounded-sm">
                    <i data-lucide="calendar" class="w-8 h-8"></i>
                </div>
                <div>
                    <div class="text-xl font-bold" id="latestSaveDate">-</div>
                    <div class="text-blue-100">Lưu gần nhất</div>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <div class="bg-white/20 backdrop-blur-sm p-4 rounded-sm">
                    <i data-lucide="dollar-sign" class="w-8 h-8"></i>
                </div>
                <div>
                    <div class="text-xl font-bold" id="totalValue">0</div>
                    <div class="text-blue-100">Tổng giá trị ước tính</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Saved Cars List -->
    <div id="savedCarsList" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        <!-- Cars will be loaded here by JavaScript -->
    </div>

    <!-- Empty State -->
    <div id="emptyState" class="hidden">
        <div class="text-center py-16 bg-main rounded-xl border-2 border-dashed border-gray-300 dark:border-gray-700">
            <i data-lucide="bookmark-x" class="w-20 h-20 mx-auto text-gray-400 mb-4"></i>
            <h3 class="text-2xl font-semibold text-main mb-2">Chưa có xe nào được lưu</h3>
            <p class="text-sub mb-6">Hãy lưu những xe bạn quan tâm để xem lại sau</p>
            <a href="{{ route('cars.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-primary-800 text-white rounded-sm hover:bg-primary-700 transition">
                <i data-lucide="search" class="w-5 h-5"></i>
                Tìm xe ngay
            </a>
        </div>
    </div>
</div>

<script>
    function loadSavedCars() {
        const savedCars = JSON.parse(localStorage.getItem('savedCars') || '[]');
        const $container = $('#savedCarsList');
        const $emptyState = $('#emptyState');
        
        if (savedCars.length === 0) {
            $container.addClass('hidden');
            $emptyState.removeClass('hidden');
            return;
        }
        
        $container.removeClass('hidden');
        $emptyState.addClass('hidden');
        
        // Sort by saved date (newest first)
        savedCars.sort((a, b) => new Date(b.savedAt) - new Date(a.savedAt));
        
        const carCards = savedCars.map(car => `
            <div class="group relative card rounded-md transition-all duration-300 border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-xl bg-main">
                <!-- Saved Badge -->
                <div class="absolute top-3 left-3 bg-primary-800 text-white text-xs font-semibold px-3 py-1 rounded-sm shadow-lg backdrop-blur-sm flex items-center gap-1 z-10">
                    <i class="fa-solid fa-bookmark text-xs"></i>
                    Đã lưu
                </div>
                
                <!-- Remove Button -->
                <button 
                    onclick="removeBookmark(${car.id})"
                    class="absolute top-3 right-3 bg-red-500 hover:bg-red-600 w-7 text-xs h-7 text-white  rounded-full shadow-lg transition z-10"
                    title="Xóa khỏi danh sách">
                    <i class="fa-solid fa-xmark"></i>
                </button>
                
                <!-- Image Section -->
                <div class="relative overflow-hidden">
                    <a href="/cars/${car.id}" class="block">
                        <img src="https://cafefcdn.com/2018/6/16/photo-1-1529146484215497174285.png" 
                            alt="${car.title}"
                            class="w-full h-48 object-contain transform group-hover:scale-110 transition-transform duration-500">
                    </a>
                    
                    ${car.price ? `
                    <div class="absolute bottom-0 left-2 bg-red-500 text-white px-3 py-1 rounded-sm font-bold shadow-lg">
                        ${formatPrice(car.price)} <small class="text-sm">triệu</small>
                    </div>
                    ` : ''}
                </div>
                
                <!-- Content Section -->
                <div class="p-5">
                    <div class="flex items-center gap-2 text-xs text-sub mb-3">
                        <i class="fa-solid fa-calendar text-xs text-gray-500"></i>
                        <span>Lưu ${formatDate(car.savedAt)}</span>
                    </div>
                    
                    <h3 class="font-bold text-lg text-main mb-1 line-clamp-2">
                        <a href="/cars/${car.id}" class="hover:text-blue-600 transition-colors">
                            ${car.title} ${car.year ? `<span class="text-sub font-normal text-base">(${car.year})</span>` : ''}
                        </a>
                    </h3>
                    
                    <div class="h-[1px] bg-gray-200 dark:bg-gray-700 my-4"></div>
                    
                    <!-- Features Grid -->
                    <div class="grid grid-cols-2 gap-3 text-sm mb-4">
                        ${car.mileage ? `
                        <div class="flex items-center gap-2 text-sub">
                            <i class="fa-solid fa-gauge text-xs text-gray-500"></i>
                            <span class="truncate">${car.mileage}</span>
                        </div>
                        ` : ''}
                        
                        ${car.fuel ? `
                        <div class="flex items-center gap-2 text-sub">
                            <i class="fa-solid fa-gas-pump text-xs text-gray-500"></i>
                            <span class="truncate">${car.fuel}</span>
                        </div>
                        ` : ''}
                        
                        ${car.bodytype ? `
                        <div class="flex items-center gap-2 text-sub">
                            <i data-lucide="cog" class="w-4 h-4 text-purple-500"></i>
                            <span class="truncate">${car.bodytype}</span>
                        </div>
                        ` : ''}
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex gap-2 mt-4">
                        <a href="/cars/${car.id}" class="flex-1 flex items-center justify-center gap-2 bg-primary-800 hover:bg-primary-700 text-white py-2.5 px-4 rounded-sm font-medium text-sm transition-all duration-300 shadow-md hover:shadow-lg">
                            <i class="fa-solid fa-eye text-xs"></i>
                            <span>Xem chi tiết</span>
                        </a>
                    </div>
                </div>
            </div>
        `).join('');
        
        $container.html(carCards);
        
        // Reinitialize lucide icons
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
        
        // Update stats
        updateStats(savedCars);
    }
    
    function updateStats(savedCars) {
        // Update latest save date
        if (savedCars.length > 0) {
            const latest = savedCars[0];
            $('#latestSaveDate').text(formatDate(latest.savedAt));
        }
        
        // Calculate total value
        const totalValue = savedCars.reduce((sum, car) => sum + (parseFloat(car.price) || 0), 0);
        $('#totalValue').text(formatPrice(totalValue) + ' triệu');
    }
    
    function removeBookmark(carId) {
        if (confirm('Bạn có chắc muốn xóa xe này khỏi danh sách?')) {
            let bookmarks = JSON.parse(localStorage.getItem('savedCars') || '[]');
            bookmarks = bookmarks.filter(car => car.id !== carId);
            localStorage.setItem('savedCars', JSON.stringify(bookmarks));
            
            // Update UI
            if (typeof updateBookmarkCount === 'function') {
                updateBookmarkCount();
            }
            
            // Reload list
            loadSavedCars();
            
            showToast('Đã xóa xe khỏi danh sách', 'info');
        }
    }
    
    function clearAllBookmarks() {
        const savedCars = JSON.parse(localStorage.getItem('savedCars') || '[]');
        if (savedCars.length === 0) {
            showToast('Danh sách trống', 'info');
            return;
        }
        
        if (confirm(`Bạn có chắc muốn xóa tất cả ${savedCars.length} xe đã lưu?`)) {
            localStorage.setItem('savedCars', '[]');
            
            if (typeof updateBookmarkCount === 'function') {
                updateBookmarkCount();
            }
            
            loadSavedCars();
            showToast('Đã xóa tất cả xe đã lưu', 'success');
        }
    }
    
    function formatPrice(price) {
        return new Intl.NumberFormat('vi-VN').format(price / 1000000);
    }
    
    function formatDate(dateString) {
        const date = new Date(dateString);
        const now = new Date();
        const diffTime = Math.abs(now - date);
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        
        if (diffDays === 0) return 'Hôm nay';
        if (diffDays === 1) return 'Hôm qua';
        if (diffDays < 7) return `${diffDays} ngày trước`;
        if (diffDays < 30) return `${Math.floor(diffDays / 7)} tuần trước`;
        
        return date.toLocaleDateString('vi-VN', { day: '2-digit', month: '2-digit', year: 'numeric' });
    }
    
    function showToast(message, type = 'info') {
        let $toastContainer = $('#toast-container');
        if ($toastContainer.length === 0) {
            $toastContainer = $('<div>', {
                id: 'toast-container',
                class: 'fixed top-4 right-4 z-50 space-y-2'
            }).appendTo('body');
        }
        
        const bgColor = type === 'success' ? 'bg-green-500' : type === 'error' ? 'bg-red-500' : 'bg-blue-500';
        const icon = type === 'success' ? 'check-circle' : type === 'error' ? 'x-circle' : 'info';
        
        const $toast = $('<div>', {
            class: `${bgColor} text-white px-6 py-3 rounded-lg shadow-lg flex items-center gap-3 animate-slide-in`,
            html: `
                <i data-lucide="${icon}" class="w-5 h-5"></i>
                <span>${message}</span>
            `
        }).appendTo($toastContainer);
        
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
        
        setTimeout(function() {
            $toast.css({ opacity: '0', transform: 'translateX(100%)' });
            setTimeout(function() {
                $toast.remove();
            }, 300);
        }, 3000);
    }
    
    // Load saved cars on page load
    $(document).ready(function() {
        loadSavedCars();
        
        // Update bookmark count
        if (typeof updateBookmarkCount === 'function') {
            updateBookmarkCount();
        }
    });
</script>

<style>
    @keyframes slide-in {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    .animate-slide-in {
        animation: slide-in 0.3s ease-out;
    }
</style>
@endsection
