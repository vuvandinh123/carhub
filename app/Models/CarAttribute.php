<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CarAttribute extends Model
{
    use HasFactory;

    protected $table = 'car_attributes';

    protected $fillable = [
        'type',
        'name',
        'slug',
        'extra',
    ];

    protected $casts = [
        'extra' => 'array',
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($carAttr) {
            if (empty($carAttr->slug)) {
                $carAttr->slug = Str::slug($carAttr->name);
            }

            // Ensure unique slug
            $originalSlug = $carAttr->slug;
            $counter = 1;
            while (static::where('slug', $carAttr->slug)->exists()) {
                $carAttr->slug = $originalSlug . '-' . $counter;
                $counter++;
            }
        });

        static::updating(function ($carAttr) {
            if ($carAttr->isDirty('name') && !$carAttr->isDirty('slug')) {
                $carAttr->slug = Str::slug($carAttr->name);

                // Ensure unique slug
                $originalSlug = $carAttr->slug;
                $counter = 1;
                while (static::where('slug', $carAttr->slug)
                    ->where('id', '!=', $carAttr->id)
                    ->exists()
                ) {
                    $carAttr->slug = $originalSlug . '-' . $counter;
                    $counter++;
                }
            }
        });
    }
    /**
     * Ví dụ: Một CarAttribute có thể gắn với nhiều Car (qua bảng trung gian car_car_attribute)
     */
    public function cars()
    {
        return $this->belongsToMany(Car::class, 'car_car_attribute', 'car_attribute_id', 'car_id');
    }
}
