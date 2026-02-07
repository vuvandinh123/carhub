<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Cars;
use App\Repositories\CarRepository;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class CarController extends Controller
{
    private $carRepository;
    private $brandRepository;
    private $categoryRepository;

    public function __construct(CarRepository $carRepository, CategoryRepository $categoryRepository, \App\Repositories\BrandRepository $brandRepository)
    {
        $this->carRepository = $carRepository;
        $this->categoryRepository = $categoryRepository;
        $this->brandRepository = $brandRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get all brands for filter
        $brands = $this->brandRepository->all();

        // Get all categories for filter
        $categories = $this->categoryRepository->all();

        // Collect filters from request
        $filters = [
            'search' => $request->input('search'),
            'condition' => $request->input('condition'),
            'brand_id' => $request->input('brand_id'),
            'categories' => $request->input('categories', []),
            'price_min' => $request->input('price_min'),
            'price_max' => $request->input('price_max'),
            'year_min' => $request->input('year_min'),
            'year_max' => $request->input('year_max'),
            'mileage_max' => $request->input('mileage_max'),
            'fuel' => $request->input('fuel', []),
            'seats' => $request->input('seats'),
            'sort_by' => $request->input('sort_by', 'newest'),
        ];

        // Filter and paginate results
        $cars = $this->carRepository->filterAndPaginate($filters, 12);

        // Get active filters for display
        $activeFilters = array_filter($filters, function ($value) {
            return !empty($value) && $value !== '' && $value !== [];
        });

        return view('pages.cars.index', compact('cars', 'brands', 'categories', 'filters', 'activeFilters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function search(Request $request)
    {

        $query = $request->input('q', '');

        if (empty($query)) {
            return response()->json(['cars' => []]);
        }

        $cars = Car::with(['brand', 'images'])
            ->where(function ($q) use ($query) {
                $q->where('title', 'LIKE', "%{$query}%")
                    ->orWhere('description', 'LIKE', "%{$query}%")
                    ->orWhereHas('brand', function ($brandQuery) use ($query) {
                        $brandQuery->where('name', 'LIKE', "%{$query}%");
                    });
            })
            ->where('status', 'available')
            ->limit(10)
            ->get()
            ->map(function ($car) {
                return [
                    'id' => $car->id,
                    'slug' => $car->slug,
                    'title' => $car->title,
                    'brand' => $car->brand->name ?? 'N/A',
                    'year' => $car->year,
                    'price' => $car->price,
                    'price_formatted' => number_format($car->price, 0, ',', '.') . ' VNĐ',
                    'thumbnail' => $car->thumbnail ? asset('storage/' . $car->thumbnail) : null,
                    'url' => route('cars.show', $car->slug),
                ];
            });

        return response()->json([
            'success' => true,
            'count' => $cars->count(),
            'cars' => $cars
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $car = $this->carRepository->findSlug($slug);
        
        if (!$car) {
            abort(404, 'Không tìm thấy xe');
        }
        
        $relatedCars = Car::where('slug', '!=', $car->slug)
            ->where(function ($query) use ($car) {
                $query->where('brand_id', $car->brand_id)
                    ->orWhereHas('categories', function ($q) use ($car) {
                        $q->whereIn('categories.id', $car->categories->pluck('id'));
                    });
            })
            ->inRandomOrder()
            ->take(4)
            ->get();
            
        if (!$relatedCars || $relatedCars->isEmpty()) {
            $relatedCars = Car::where('id', '!=', $car->id)
                ->inRandomOrder()
                ->take(4)
                ->get();
        }

        return view('pages.car-detail.index', compact('car', 'relatedCars'));
    }

    /**
     * Compare multiple cars
     */
    public function compare(Request $request)
    {
        $ids = explode(',', $request->input('ids', ''));

        // Validate: must have 2-3 cars
        // if (count($ids) < 2 || count($ids) > 3) {
        //     return redirect()->route('cars.index')->with('error', 'Vui lòng chọn từ 2 đến 3 xe để so sánh');
        // }

        // Get cars with all relationships
        $cars = $this->carRepository->findMultiple($ids);

        // Ensure we have the requested cars
        // if ($cars->count() < 2) {
        //     return redirect()->route('cars.index')->with('error', 'Không tìm thấy đủ xe để so sánh');
        // }

        return view('pages.cars.compare', compact('cars'));
    }

    /**
     * Display saved cars page
     */
    public function saved()
    {
        return view('pages.cars.saved');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $cars)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        //
    }
}
