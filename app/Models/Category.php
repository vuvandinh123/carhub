<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'categories';
    static $VEHICLE_TYPE = 'vehicle_type';
    static $MAIN_TYPE = 'main';
    static $PRICE_RANGE_TYPE = 'price_range';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'content',
        'thumbnail',
        'parent_id',
        'is_active',
        'sort_order',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    

    /**
     * Quan hệ: danh mục cha
     */
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * Quan hệ: danh mục con
     */
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /**
     * Ví dụ: Một Category có nhiều Car (nếu có bảng cars liên kết)
     */
    public function cars()
    {
        return $this->hasMany(Car::class);
    }
}
