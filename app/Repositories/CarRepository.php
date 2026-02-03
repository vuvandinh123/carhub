<?php 
// create car repository
namespace App\Repositories;

use App\Models\Car;

class CarRepository
{
    public function all()
    {
        return Car::all();
    }
    
    public function paginate($perPage = 10)
    {
        return Car::with(['brand','images','specifications'])->paginate($perPage);
    }
    
    public function filterAndPaginate($filters = [], $perPage = 12)
    {
        $query = Car::with(['brand', 'images', 'specifications', 'categories']);
        
        // Search by keyword
        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%")
                  ->orWhereHas('brand', function($brandQuery) use ($search) {
                      $brandQuery->where('title', 'LIKE', "%{$search}%");
                  });
            });
        }
        
        // Filter by condition (new/used)
        if (isset($filters['condition'])) {
            if ($filters['condition'] === 'new') {
                $query->where(function($q) {
                    $q->where('mileage', 0)->orWhereNull('mileage');
                });
            } elseif ($filters['condition'] === 'used') {
                $query->where('mileage', '>', 0);
            }
        }
        
        // Filter by brand
        if (!empty($filters['brand_id'])) {
            $query->where('brand_id', $filters['brand_id']);
        }
        
        // Filter by categories
        if (!empty($filters['categories']) && is_array($filters['categories'])) {
            $query->whereHas('categories', function($q) use ($filters) {
                $q->whereIn('categories.id', $filters['categories']);
            });
        }
        
        // Filter by price range
        if (!empty($filters['price_min'])) {
            $query->where('price', '>=', $filters['price_min'] * 1000000);
        }
        if (!empty($filters['price_max'])) {
            $query->where('price', '<=', $filters['price_max'] * 1000000);
        }
        
        // Filter by year range
        if (!empty($filters['year_min'])) {
            $query->where('year', '>=', $filters['year_min']);
        }
        if (!empty($filters['year_max'])) {
            $query->where('year', '<=', $filters['year_max']);
        }
        
        // Filter by mileage
        if (!empty($filters['mileage_max'])) {
            $query->where('mileage', '<=', $filters['mileage_max']);
        }
        
        // Filter by fuel type
        if (!empty($filters['fuel']) && is_array($filters['fuel'])) {
            $query->whereIn('fuel', $filters['fuel']);
        }
        
        // Filter by transmission
        if (!empty($filters['transmission'])) {
            // Assuming you have a transmission field or relation
            // Adjust this based on your actual database structure
        }
        
        // Filter by seats
        if (!empty($filters['seats'])) {
            $query->where('seats', $filters['seats']);
        }
        
        // Filter by status
        $query->where('status', 'available');
        
        // Sorting
        $sortBy = $filters['sort_by'] ?? 'created_at';
        $sortOrder = $filters['sort_order'] ?? 'desc';
        
        switch($sortBy) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'year_desc':
                $query->orderBy('year', 'desc');
                break;
            case 'mileage_asc':
                $query->orderBy('mileage', 'asc');
                break;
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }
        
        return $query->paginate($perPage)->withQueryString();
    }
    public function find($id)
    {
        return Car::with(['brand','images','specifications'])->find($id);
    }
    
    public function findMultiple($ids)
    {
        return Car::with(['brand', 'images', 'specifications', 'categories'])
            ->whereIn('id', $ids)
            ->get();
    }
    
    public function create($data)
    {
        return Car::create($data);
    }
    public function update($id, $data)
    {
        $car = Car::find($id);
        return $car->update($data);
    }
    public function delete($id)
    {
        $car = Car::find($id);
        return $car->delete();
    }

}