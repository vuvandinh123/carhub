@extends('layouts.app')

@section('title', 'So sánh xe')

@section('content')
<div class="container mx-auto max-w-7xl px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center gap-3 mt-10 mb-4">
            <a href="{{ route('cars.index') }}" class="text-sub hover:text-main transition-colors">
                <i data-lucide="arrow-left" class="w-6 h-6"></i>
            </a>
            <h1 class="text-3xl font-bold text-main text-primary-800 flex items-center gap-3">
                <i data-lucide="git-compare" class="w-8 h-8 text-primary-800"></i>
                So sánh xe
            </h1>
        </div>
        <p class="text-primary-800">So sánh chi tiết các thông số kỹ thuật và tính năng</p>
    </div>

    <!-- Comparison Table -->
    <div class="bg-main rounded-xl shadow-lg overflow-hidden border border-gray-200 dark:border-gray-700">
        <div class="overflow-x-auto">
            <table class="w-full">
                <!-- Car Images and Names -->
                <thead class=" dark:from-purple-900/20 dark:to-purple-800/20">
                    <tr>
                        <th class="sticky left-0 z-10 bg-white dark:bg-purple-900/20 p-4 text-left font-semibold text-primary-800 w-48">
                            Thông tin
                        </th>
                        @foreach($cars as $car)
                        <th class="p-4 text-center min-w-[300px]">
                            <div class="space-y-3">
                                <!-- Image -->
                                <div class="relative h-48 rounded-lg overflow-hidden mb-3">
                                    @if($car->images->isNotEmpty())
                                        <img src="{{ asset('storage/' . $car->images->first()->image_path) }}" 
                                            alt="{{ $car->name }}"
                                            class="w-full h-full object-contain">
                                    @else
                                        <img src="https://cafefcdn.com/2018/6/16/photo-1-1529146484215497174285.png" 
                                            alt="{{ $car->name }}"
                                            class="w-full h-full object-contain">
                                    @endif
                                </div>
                                
                                <!-- Name -->
                                <a href="{{ route('cars.show', $car->id) }}" class="font-bold text-lg text-main hover:text-purple-600 transition-colors block">
                                    {{ $car->name }}
                                </a>
                                
                                <!-- Price -->
                                <div class="text-2xl font-bold text-primary-800">
                                    {{ formatPrice($car->price) }}
                                </div>
                                
                                <!-- Quick Actions -->
                                <div class="flex gap-2 justify-center mt-3">
                                    <a href="{{ route('cars.show', $car->id) }}" 
                                        class="px-4 py-2 bg-gradient-to-r from-primary-800 to-primary-700 text-white rounded-sm hover:from-primary-700 hover:to-primary-800 transition-colors text-sm font-medium">
                                        Xem chi tiết
                                    </a>
                                    <button onclick="removeCarFromCompare({{ $car->id }})" 
                                        class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-sm transition-colors text-sm font-medium flex items-center gap-2">
                                        <i data-lucide="x" class="w-4 h-4"></i>
                                        Xóa
                                    </button>
                                </div>
                            </div>
                        </th>
                        @endforeach
                    </tr>
                </thead>

                <tbody>
                    <!-- Basic Information -->
                    <tr class="border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50">
                        <td colspan="{{ $cars->count() + 1 }}" class="p-3 font-bold text-main">
                            <i data-lucide="info" class="w-5 h-5 inline mr-2 text-purple-600"></i>
                            Thông tin cơ bản
                        </td>
                    </tr>

                    <tr class="border-t border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                        <td class="sticky left-0 z-10 bg-main p-4 font-medium text-sub">Hãng xe</td>
                        @foreach($cars as $car)
                        <td class="p-4 text-center text-main">{{ $car->brand->name ?? 'N/A' }}</td>
                        @endforeach
                    </tr>

                    <tr class="border-t border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                        <td class="sticky left-0 z-10 bg-main p-4 font-medium text-sub">Năm sản xuất</td>
                        @foreach($cars as $car)
                        <td class="p-4 text-center text-main">{{ $car->year }}</td>
                        @endforeach
                    </tr>

                    <tr class="border-t border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                        <td class="sticky left-0 z-10 bg-main p-4 font-medium text-sub">Loại xe</td>
                        @foreach($cars as $car)
                        <td class="p-4 text-center text-main">
                            @if($car->categories->isNotEmpty())
                                {{ $car->categories->pluck('name')->join(', ') }}
                            @else
                                N/A
                            @endif
                        </td>
                        @endforeach
                    </tr>

                    <tr class="border-t border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                        <td class="sticky left-0 z-10 bg-main p-4 font-medium text-sub">Tình trạng</td>
                        @foreach($cars as $car)
                        <td class="p-4 text-center">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $car->mileage > 0 ? 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400' : 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' }}">
                                {{ $car->mileage > 0 ? 'Xe cũ' : 'Xe mới' }}
                            </span>
                        </td>
                        @endforeach
                    </tr>

                    <tr class="border-t border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                        <td class="sticky left-0 z-10 bg-main p-4 font-medium text-sub">Số chỗ ngồi</td>
                        @foreach($cars as $car)
                        <td class="p-4 text-center text-main">{{ $car->seats }} chỗ</td>
                        @endforeach
                    </tr>

                    <tr class="border-t border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                        <td class="sticky left-0 z-10 bg-main p-4 font-medium text-sub">Nhiên liệu</td>
                        @foreach($cars as $car)
                        <td class="p-4 text-center text-main">{{ $car->fuel }}</td>
                        @endforeach
                    </tr>

                    <tr class="border-t border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                        <td class="sticky left-0 z-10 bg-main p-4 font-medium text-sub">Số km đã đi</td>
                        @foreach($cars as $car)
                        <td class="p-4 text-center text-main">{{ number_format($car->mileage) }} km</td>
                        @endforeach
                    </tr>

                    <!-- Specifications -->
                    @php
                        // Collect all unique specification names
                        $allSpecs = collect();
                        foreach($cars as $car) {
                            if($car->specifications) {
                                $allSpecs = $allSpecs->merge($car->specifications->pluck('name'));
                            }
                        }
                        $uniqueSpecs = $allSpecs->unique()->sort()->values();
                    @endphp

                    @if($uniqueSpecs->isNotEmpty())
                    <tr class="border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50">
                        <td colspan="{{ $cars->count() + 1 }}" class="p-3 font-bold text-main">
                            <i data-lucide="settings" class="w-5 h-5 inline mr-2 text-purple-600"></i>
                            Thông số kỹ thuật
                        </td>
                    </tr>

                    @foreach($uniqueSpecs as $specName)
                    <tr class="border-t border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                        <td class="sticky left-0 z-10 bg-main p-4 font-medium text-sub">{{ $specName }}</td>
                        @foreach($cars as $car)
                        <td class="p-4 text-center text-main">
                            {{ $car->specifications->where('name', $specName)->first()->value ?? 'N/A' }}
                        </td>
                        @endforeach
                    </tr>
                    @endforeach
                    @endif

                    <!-- Description -->
                    <tr class="border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50">
                        <td colspan="{{ $cars->count() + 1 }}" class="p-3 font-bold text-main">
                            <i data-lucide="file-text" class="w-5 h-5 inline mr-2 text-purple-600"></i>
                            Mô tả
                        </td>
                    </tr>

                    <tr class="border-t border-gray-200 dark:border-gray-700">
                        <td class="sticky left-0 z-10 bg-main p-4 font-medium text-sub align-top">Mô tả chi tiết</td>
                        @foreach($cars as $car)
                        <td class="p-4 text-sub text-sm align-top">
                            <div class="line-clamp-4">{{ $car->description ?? 'Chưa có mô tả' }}</div>
                        </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Back Button -->
    <div class="mt-8 text-center">
        <a href="{{ route('cars.index') }}" 
            class="inline-flex items-center gap-2 px-6 py-3 bg-gray-200 dark:bg-gray-700 text-main rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-all duration-300 font-medium">
            <i data-lucide="arrow-left" class="w-5 h-5"></i>
            Quay lại danh sách
        </a>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function removeCarFromCompare(carId) {
        // Get current compare list
        let compareList = JSON.parse(localStorage.getItem('compareList') || '[]');
        
        // Remove the car
        compareList = compareList.filter(id => id !== carId);
        
        // Update localStorage
        localStorage.setItem('compareList', JSON.stringify(compareList));
        
        // Reload page with updated IDs
        if (compareList.length >= 2) {
            const ids = compareList.join(',');
            window.location.href = '{{ route("cars.compare") }}?ids=' + ids;
        } else {
            // If less than 2 cars, redirect to cars list
            window.location.href = '{{ route("cars.index") }}';
        }
    }
</script>
@endsection
