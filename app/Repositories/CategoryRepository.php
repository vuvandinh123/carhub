<?php 
namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    public function all()
    {
        return Category::all();
    }
    public function paginate($perPage = 10)
    {
        return Category::paginate($perPage);
    }
    // Lấy theo vehicle_type
    public function getByVehicleType()
    {
        return Category::where('type', Category::$VEHICLE_TYPE)->get();
    }
    public function find($id)
    {
        return Category::find($id);
    }
    public function create($data)
    {
        return Category::create($data);
    }
    public function update($id, $data)
    {
        $category = Category::find($id);
        return $category->update($data);
    }
    public function delete($id)
    {
        $category = Category::find($id);
        return $category->delete();
    }

}