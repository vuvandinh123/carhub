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
        return Car::with(['brand','fuelType','color','bodyType','transmission','origin'])->paginate($perPage);
    }
    public function find($id)
    {
        return Car::with(['brand','fuelType','color','bodyType','transmission','origin','images'])->find($id);
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