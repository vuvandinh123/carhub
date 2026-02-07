<header class="bg-main border-gray-200 dark:border-gray-600 border-b fixed left-0 top-0 w-full z-50">
    <div class="container max-w-7xl relative flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{ asset("/images/thacothuduclogo.png") }}" class="h-8" alt="Flowbite Logo" />
            <span class="self-center text-lg md:text-2xl whitespace-nowrap dark:text-white uppercase text-primary-800 font-bold">THACO Thủ Đức</span>
        </a>
        <div class="flex md:order-2 space-x-3 gap-2 md:space-x-0 rtl:space-x-reverse">
            <!-- Search Button -->
            <button id="search-modal-toggle" type="button"
                class="group border border-gray-200 relative flex items-center gap-2 text-gray-500 cursor-pointer dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2 transition-all">
                <i data-lucide="search" class="w-5 h-5"></i>
                
                <!-- Keyboard shortcut badge -->
                <span class="hidden md:flex items-center gap-1 px-2 py-0.5 text-xs font-medium text-gray-400 dark:text-gray-500 bg-gray-100 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded group-hover:border-gray-300 dark:group-hover:border-gray-600 transition-colors">
                    <kbd class="font-sans">Ctrl</kbd>
                    <span class="text-gray-300 dark:text-gray-600">+</kbd>
                    <kbd class="font-sans">K</kbd>
                </span>
            </button>

            
            <button data-modal-target="register-modal" data-modal-toggle="register-modal"
                class="hidden md:block text-white bg-primary-800 hover:bg-primary-700 focus:ring-4 focus:outline-none 
    focus:ring-primary-300 font-medium rounded-lg cursor-pointer text-sm px-5 py-2.5 text-center 
    dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                type="button">Đăng ký tư vấn </button>
            <button data-collapse-toggle="navbar-cta" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                aria-controls="navbar-cta" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>           

        </div>
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-cta">
            @include('partials.nav')
        </div>
    </div>
</header>

<!-- Search Modal -->
<div id="search-modal" class="hidden fixed inset-0 z-[60] overflow-y-auto">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-black/50 backdrop-blur-sm transition-opacity"></div>
    
    <!-- Modal Content -->
    <div class="flex min-h-full items-start justify-center p-4 pt-20">
        <div class="relative w-full max-w-2xl transform transition-all">
            <!-- Search Box -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl overflow-hidden">
                <!-- Search Input -->
                <div class="relative border-b border-gray-200 dark:border-gray-700">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-5">
                        <i data-lucide="search" class="w-6 h-6 text-gray-400"></i>
                    </div>
                    <input 
                        type="text" 
                        id="search-input" 
                        class="w-full pl-14 pr-4 py-5 text-lg bg-transparent border-0 focus:ring-0 text-gray-900 dark:text-white placeholder-gray-400" 
                        placeholder="Tìm kiếm xe theo tên, hãng, dòng xe..."
                        autocomplete="off"
                    />
                    <button id="close-search-modal" class="absolute inset-y-0 right-0 flex items-center pr-5 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                </div>

                <!-- Search Results -->
                <div id="search-results" class="max-h-[calc(100vh-280px)] overflow-y-auto">
                    <!-- Popular Searches (Default State) -->
                    <div id="popular-searches" class="p-6">
                        <h3 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase mb-4">Tìm kiếm phổ biến</h3>
                        <div class="space-y-2">
                            <a href="{{ route('cars.index', ['search' => 'XE TẢI FUSO']) }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors group">
                                <i data-lucide="trending-up" class="w-5 h-5 text-blue-500"></i>
                                <span class="text-gray-700 dark:text-gray-300 group-hover:text-blue-600 dark:group-hover:text-blue-400">
                                    XE TẢI FUSO
                                </span>
                            </a>
                            <a href="{{ route('cars.index', ['search' => 'THACO TF220']) }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors group">
                                <i data-lucide="trending-up" class="w-5 h-5 text-blue-500"></i>
                                <span class="text-gray-700 dark:text-gray-300 group-hover:text-blue-600 dark:group-hover:text-blue-400">
                                    THACO TF220
                                </span>
                            </a>
                            <a href="{{ route('cars.index', ['search' => 'linker T2-5.0']) }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors group">
                                <i data-lucide="trending-up" class="w-5 h-5 text-blue-500"></i>
                                <span class="text-gray-700 dark:text-gray-300 group-hover:text-blue-600 uppercase dark:group-hover:text-blue-400">
                                    linker T2-5.0
                                </span>
                            </a>
                            <a href="{{ route('cars.index', ['search' => 'XE TẢI KIA']) }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors group">
                                <i data-lucide="trending-up" class="w-5 h-5 text-blue-500"></i>
                                <span class="text-gray-700 dark:text-gray-300 group-hover:text-blue-600 dark:group-hover:text-blue-400">XE TẢI KIA</span>
                            </a>
                             <a href="{{ route('cars.index', ['search' => 'TF450 2 Chỗ']) }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors group">
                                <i data-lucide="trending-up" class="w-5 h-5 text-blue-500"></i>
                                <span class="text-gray-700 dark:text-gray-300 group-hover:text-blue-600 dark:group-hover:text-blue-400">
                                TF450 2 Chỗ    
                                </span>
                            </a>
                        </div>
                    </div>

                    <!-- Dynamic Results (Hidden by default) -->
                    <div id="dynamic-results" class="hidden p-6">
                        <!-- Loading State -->
                        <div id="loading-state" class="hidden text-center py-8">
                            <div class="inline-block w-8 h-8 border-4 border-blue-500 border-t-transparent rounded-full animate-spin"></div>
                            <p class="text-gray-500 dark:text-gray-400 mt-3">Đang tìm kiếm...</p>
                        </div>

                        <!-- Results List -->
                        <div id="results-list" class="space-y-2"></div>

                        <!-- No Results -->
                        <div id="no-results" class="hidden text-center py-8">
                            <i data-lucide="search-x" class="w-12 h-12 text-gray-300 dark:text-gray-600 mx-auto mb-3"></i>
                            <p class="text-gray-500 dark:text-gray-400">Không tìm thấy kết quả phù hợp</p>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="border-t border-gray-200 dark:border-gray-700 px-6 py-3 bg-gray-50 dark:bg-gray-900/50">
                    <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400">
                        <span>Nhấn <kbd class="px-2 py-1 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded">Enter</kbd> để tìm kiếm</span>
                        <span>Nhấn <kbd class="px-2 py-1 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded">Esc</kbd> để đóng</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    let searchTimeout;

    // Format price function - convert to million format
    function formatPrice(price) {
        if (!price || price === 0) return 'Liên hệ';
        
        const million = price / 1000000;
        
        if (million >= 1000) {
            const billion = million / 1000;
            return billion % 1 === 0 
                ? `${billion.toFixed(0)} tỷ` 
                : `${billion.toFixed(1)} tỷ`;
        }
        
        return million % 1 === 0 
            ? `${million.toFixed(0)} triệu` 
            : `${million.toFixed(1)} triệu`;
    }

    // Open modal
    $('#search-modal-toggle').on('click', function() {
        $('#search-modal').removeClass('hidden');
        $('#search-input').focus();
        $('body').css('overflow', 'hidden');
    });

    // Close modal function
    function closeModal() {
        $('#search-modal').addClass('hidden');
        $('#search-input').val('');
        $('#popular-searches').removeClass('hidden');
        $('#dynamic-results').addClass('hidden');
        $('body').css('overflow', '');
    }

    // Close button
    $('#close-search-modal').on('click', closeModal);
    
    // Close on backdrop click
    $('#search-modal').on('click', function(e) {
        if ($(e.target).is('#search-modal') || $(e.target).hasClass('backdrop-blur-sm')) {
            closeModal();
        }
    });

    // Close on Esc key
    $(document).on('keydown', function(e) {
        if (e.key === 'Escape' && !$('#search-modal').hasClass('hidden')) {
            closeModal();
        }
    });

    // Search on Enter
    $('#search-input').on('keydown', function(e) {
        if (e.key === 'Enter' && $(this).val().trim()) {
            window.location.href = `{{ route('cars.index') }}?search=${encodeURIComponent($(this).val().trim())}`;
        }
    });

    // Live search
    $('#search-input').on('input', function() {
        const query = $(this).val().trim();
        
        clearTimeout(searchTimeout);

        if (query.length === 0) {
            $('#popular-searches').removeClass('hidden');
            $('#dynamic-results').addClass('hidden');
            return;
        }

        $('#popular-searches').addClass('hidden');
        $('#dynamic-results').removeClass('hidden');
        $('#loading-state').removeClass('hidden');
        $('#results-list').addClass('hidden');
        $('#no-results').addClass('hidden');

        searchTimeout = setTimeout(() => {
            $.ajax({
                url: `/cars/search?q=${encodeURIComponent(query)}`,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#loading-state').addClass('hidden');
                    
                    if (data.cars && data.cars.length > 0) {
                        const resultsHtml = data.cars.map(car => `
                            <a href="/cars/${car.slug}" class="flex items-start gap-4 px-4 py-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors group">
                                <img src="${car.thumbnail || '/images/placeholder-car.jpg'}" alt="${car.title}" class="w-16 h-16 object-contain rounded-lg">
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-semibold text-gray-900 dark:text-white group-hover:text-primary-800 dark:group-hover:text-blue-400 truncate">${car.title}</h4>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">${car.brand}</p>
                                    <p class="text-sm font-semibold text-red-600 dark:text-blue-400 mt-1">${formatPrice(car.price)}</p>
                                </div>
                            </a>
                        `).join('');
                        
                        $('#results-list').html(resultsHtml).removeClass('hidden');
                    } else {
                        $('#no-results').removeClass('hidden');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Search error:', error);
                    $('#loading-state').addClass('hidden');
                    $('#no-results').removeClass('hidden');
                }
            });
        }, 300);
    });
});
</script>
