<?php
// create brand repository
namespace App\Repositories;

use App\Models\Brand;

class BrandRepository
{
    public function all()
    {
        return Brand::all();
    }
    public function paginate($perPage = 10)
    {
        return Brand::paginate($perPage);
    }
    public function find($id)
    {
        return Brand::find($id);
    }
    public function create($data)
    {
        return Brand::create($data);
    }
    public function update($id, $data)
    {
        $brand = Brand::find($id);
        return $brand->update($data);
    }
    public function delete($id)
    {
        $brand = Brand::find($id);
        return $brand->delete();
    }

}