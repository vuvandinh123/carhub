<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Car extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'cars';

    protected $fillable = [
        'title',
        'thumbnail',
        'slug',
        'brand_id',
        'category_id',
        'price',
        'year',
        'quantity',
        'mileage',
        'fuel_type_id',
        'body_type_id',
        'transmission_id',
        'color_id',
        'origin_id',
        'engine',
        'seats',
        'status',
        'description',
        'content',
        'created_by',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'fuel',
        'bodytype',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'year' => 'integer',
        'quantity' => 'integer',
        'mileage' => 'integer',
        'seats' => 'integer',
    ];


    /* ==================== Relationships ==================== */

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'car_category', 'car_id', 'category_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // // Thuộc tính dạng CarAttribute
    // public function fuelType()
    // {
    //     return $this->belongsTo(CarAttribute::class, 'fuel_type_id');
    // }

    // public function bodyType()
    // {
    //     return $this->belongsTo(CarAttribute::class, 'body_type_id');
    // }

    // public function transmission()
    // {
    //     return $this->belongsTo(CarAttribute::class, 'transmission_id');
    // }

    // public function color()
    // {
    //     return $this->belongsTo(CarAttribute::class, 'color_id');
    // }

    // public function origin()
    // {
    //     return $this->belongsTo(CarAttribute::class, 'origin_id');
    // }
    public function images()
    {
        return $this->hasMany(CarImage::class);
    }

    public function primaryImage()
    {
        return $this->hasOne(CarImage::class)->where('is_primary', true);
    }
    public function specifications()
    {
        return $this->hasMany(CarSpecification::class);
    }
}
