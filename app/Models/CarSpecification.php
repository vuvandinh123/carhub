<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarSpecification extends Model
{
    use HasFactory;

    protected $table = 'car_specifications';

    protected $fillable = [
        'car_id',
        'name',
        'value',
    ];

    /**
     * Quan hệ: CarSpecification thuộc về 1 Car
     */
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
