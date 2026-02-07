<div class="container max-w-7xl mx-auto text-main my-12 px-4">
    <div class="text-center">
        <div class="mb-5">
            <h2 class="text-3xl font-semibold m-0  mb-2 capitalize">Tìm kiếm nhiều nhất</h2>
            <p class="text-sub text-sm">Cung cấp cho người dùng nhà tìm kiếm xe mơ ước</p>

        </div>
        <div class="border-b relative border-gray-200 dark:border-gray-700 mb-6">
            <ul class="flex justify-end space-x-5 capitalize">
                @foreach ($categoriesByVehicleType as $item)
                    <li><a href="#"
                            class="font-semibold relative block h-full after:content-[''] after:absolute after:w-full   pb-3 after:bottom-0 after:left-0">{{ $item->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3">
        @foreach ($cars as $car)
            <x-card-car :carid="$car['id']" :slug="$car['slug']" :image="$car['thumbnail']" :title="$car['title']" :year="$car['year']" :price="$car['price']" :date="date('d M Y', strtotime($car['created_at']))"
                :location="'HCM'" :mileage="$car->mileage" :fuel="$car->fuel" :gearbox="'12'" 
                :bodytype="$car->bodytype"
                {{-- :badges="$car['badges']" --}} />
            {{-- @include('partials.cards.card') --}}
        @endforeach
    </div>

</div>
