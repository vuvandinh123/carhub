<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Car;

Route::get('/cars/search', function (Request $request) {
    $query = $request->input('q', '');
    
    if (empty($query)) {
        return response()->json(['cars' => []]);
    }
    
    $cars = Car::with('brand')
        ->where(function($q) use ($query) {
            $q->where('name', 'LIKE', "%{$query}%")
              ->orWhere('description', 'LIKE', "%{$query}%")
              ->orWhereHas('brand', function($brandQuery) use ($query) {
                  $brandQuery->where('name', 'LIKE', "%{$query}%");
              });
        })
        ->where('status', 'available')
        ->limit(5)
        ->get()
        ->map(function($car) {
            return [
                'id' => $car->id,
                'name' => $car->name,
                'brand' => $car->brand->name ?? '',
                'price' => number_format($car->price, 0, ',', '.') . ' VNĐ',
                'image' => $car->images->first()->image_url ?? null,
            ];
        });
    
    return response()->json(['cars' => $cars]);
});
