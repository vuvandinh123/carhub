<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarCategories extends Model
{
    use HasFactory;

    protected $table = 'car_categories';

    protected $fillable = [
        'car_id',
        'category_id',
    ];
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
