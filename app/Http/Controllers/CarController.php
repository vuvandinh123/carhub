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

    public function __construct(CarRepository $carRepository, CategoryRepository $categoryRepository)
    {
        $this->carRepository = $carRepository;
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = $this->carRepository->paginate(8);
        dd($cars);
        return view('pages.cars.index', compact('cars'));
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
        $car = $this->carRepository->find($car->id);
        // dd($car->toArray());
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
