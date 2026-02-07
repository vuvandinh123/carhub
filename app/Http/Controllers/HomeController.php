<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Car;
use App\Models\Category;
use App\Models\Post;
use App\Repositories\BrandRepository;
use App\Repositories\CarRepository;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $carRepository;
    private $brandRepository;
    private $categoryRepository;

    public function __construct(BrandRepository $brandRepository, CarRepository $carRepository, CategoryRepository $categoryRepository)
    {
        $this->brandRepository = $brandRepository;
        $this->carRepository = $carRepository;
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands  = $this->brandRepository->all();
        $categories = Category::where("is_active","=", 1)->limit(10)->get();
        $cars = $this->carRepository->paginate(8);
        $categoriesByVehicleType = $this->categoryRepository->getByVehicleType();
        $posts = Post::where('is_published', true)
            ->orderByDesc('published_at')
            ->take(4)
            ->get();
        return view('pages.home.index', compact('brands', 'cars', 'categoriesByVehicleType', 'posts','categories'));
    }


    /**
     * Display about page
     */
    public function about()
    {
        return view('pages.about.index');
    }

    /**
     * Display contact page
     */
    public function contact()
    {
        return view('pages.contact.index');
    }

    /**
     * Display loan calculator page
     */
    public function loan()
    {
        return view('pages.loan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(Car $car)
    {
        // Get related cars - same brand or category
        $relatedCars = Car::where('id', '!=', $car->id)
            ->where(function($query) use ($car) {
                $query->where('brand_id', $car->brand_id)
                      ->orWhereHas('categories', function($q) use ($car) {
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
