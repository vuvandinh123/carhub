<div class="flex-1">
    <!-- Sort Options -->
    <div class="flex items-center justify-between mb-6 mt-5">
        <select
            class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <option>Popular</option>
            <option>Price: Low to High</option>
            <option>Price: High to Low</option>
            <option>Year: Newest First</option>
        </select>
    </div>

    <!-- Car Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        @foreach ($cars as $car)
            <x-card-car :carid="$car['id']" :image="$car['thumbnail']" :title="$car['title']" :year="$car['year']" :price="$car['price']" :date="date('d M Y', strtotime($car['created_at']))"
                :location="'HCM'" :mileage="$car['mileage']" :fuel="$car->fuelType?->name" />
        @endforeach
    </div>

    <!-- Load More Button -->
    <div class="text-center mt-8">
        <button class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-medium transition-colors">
            Xem thêm
        </button>
    </div>
</div>
