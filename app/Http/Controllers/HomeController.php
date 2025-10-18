<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Car;
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
        $cars = $this->carRepository->paginate(8);
        $categoriesByVehicleType = $this->categoryRepository->getByVehicleType();
        // dd($cars->toArray());
        return view('pages.home.index', compact('brands', 'cars', 'categoriesByVehicleType'));
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
        return view('pages.car-detail.index', compact('car'));
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
