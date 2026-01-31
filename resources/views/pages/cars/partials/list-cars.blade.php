<div class="flex-1 w-full">
    <!-- Sort and View Options -->
    <div class="bg-main rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-4 mb-6">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <label class="text-sm font-medium text-sub">Sắp xếp theo:</label>
                <select id="sortSelect" name="sort_by" form="filterForm" class="px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-800 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    <option value="newest" {{ ($filters['sort_by'] ?? 'newest') == 'newest' ? 'selected' : '' }}>Mới nhất</option>
                    <option value="price_asc" {{ ($filters['sort_by'] ?? '') == 'price_asc' ? 'selected' : '' }}>Giá: Thấp → Cao</option>
                    <option value="price_desc" {{ ($filters['sort_by'] ?? '') == 'price_desc' ? 'selected' : '' }}>Giá: Cao → Thấp</option>
                    <option value="year_desc" {{ ($filters['sort_by'] ?? '') == 'year_desc' ? 'selected' : '' }}>Năm: Mới nhất</option>
                    <option value="mileage_asc" {{ ($filters['sort_by'] ?? '') == 'mileage_asc' ? 'selected' : '' }}>Km: Ít nhất</option>
                </select>
            </div>
            
            <div class="flex items-center gap-2">
                <span class="text-sm text-sub">{{ $cars->firstItem() }}-{{ $cars->lastItem() }} trong {{ $cars->total() }}</span>
            </div>
        </div>
    </div>

    <!-- Car Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        @forelse ($cars as $car)
            <x-card-car 
                :carid="$car->id" 
                :image="$car->thumbnail" 
                :title="$car->title" 
                :year="$car->year" 
                :price="$car->price" 
                :date="$car->created_at->format('d M Y')"
                :location="$car->brand->country ?? 'N/A'" 
                :mileage="number_format($car->mileage) . ' km'" 
                :fuel="$car->fuel" 
            />
        @empty
            <div class="col-span-full">
                <div class="text-center py-16 bg-main rounded-xl border-2 border-dashed border-gray-300 dark:border-gray-700">
                    <i data-lucide="search-x" class="w-16 h-16 mx-auto text-gray-400 mb-4"></i>
                    <h3 class="text-xl font-semibold text-main mb-2">Không tìm thấy xe phù hợp</h3>
                    <p class="text-sub mb-4">Hãy thử điều chỉnh bộ lọc của bạn</p>
                    <a href="{{ route('cars.index') }}" class="inline-block px-6 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        Xóa bộ lọc
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    @if($cars->hasPages())
        <div class="mt-8">
            {{ $cars->links() }}
        </div>
    @endif

    <!-- Load More Button (Optional Alternative) -->
    {{-- <div class="text-center mt-8">
        <button class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-medium transition-all shadow-lg shadow-blue-600/30 hover:shadow-xl">
            <i data-lucide="chevrons-down" class="w-5 h-5"></i>
            Xem thêm xe
        </button>
        <p class="text-sm text-sub mt-3">Hiển thị {{ $cars->count() }} trong {{ $cars->total() }} xe</p>
    </div> --}}
</div>
