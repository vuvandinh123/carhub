<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Str;

class Brand extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'brands';

    protected $fillable = [
        'name',
        'slug',
        'logo',
        'description',
        'content',
        'country',
        'website',
        'founded_year',
        'is_active',
        'sort_order',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];


    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'founded_year' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected $attributes = [
        'is_active' => true,
        'sort_order' => 0,
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($brand) {
            if (empty($brand->slug)) {
                $brand->slug = Str::slug($brand->name);
            }

            // Ensure unique slug
            $originalSlug = $brand->slug;
            $counter = 1;
            while (static::where('slug', $brand->slug)->exists()) {
                $brand->slug = $originalSlug . '-' . $counter;
                $counter++;
            }
        });

        static::updating(function ($brand) {
            if ($brand->isDirty('name') && !$brand->isDirty('slug')) {
                $brand->slug = Str::slug($brand->name);

                // Ensure unique slug
                $originalSlug = $brand->slug;
                $counter = 1;
                while (static::where('slug', $brand->slug)
                    ->where('id', '!=', $brand->id)
                    ->exists()
                ) {
                    $brand->slug = $originalSlug . '-' . $counter;
                    $counter++;
                }
            }
        });
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Scope a query to only include active brands.
     */
    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', true);
    }

    /**
     * Scope a query to order brands by sort order.
     */
    public function scopeOrdered(Builder $query): void
    {
        $query->orderBy('sort_order')->orderBy('name');
    }

    /**
     * Scope a query to search brands by name or description.
     */
    public function scopeSearch(Builder $query, string $search): void
    {
        $query->where(function ($query) use ($search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%")
                ->orWhere('slug', 'like', "%{$search}%");
        });
    }

    /**
     * Scope a query to filter by country.
     */
    public function scopeByCountry(Builder $query, string $country): void
    {
        $query->where('country', $country);
    }

    /**
     * Get the logo URL.
     */
    public function getLogoUrlAttribute(): ?string
    {
        return $this->logo ? asset('storage/' . $this->logo) : null;
    }

    /**
     * Get the full website URL.
     */
    public function getFullWebsiteUrlAttribute(): ?string
    {
        if (!$this->website) {
            return null;
        }

        return str_starts_with($this->website, 'http')
            ? $this->website
            : 'https://' . $this->website;
    }

    /**
     * Get the country name.
     */
    public function getCountryNameAttribute(): ?string
    {
        $countries = [
            'vn' => 'Việt Nam',
            'jp' => 'Nhật Bản',
            'kr' => 'Hàn Quốc',
            'de' => 'Đức',
            'us' => 'Hoa Kỳ',
            'fr' => 'Pháp',
            'it' => 'Ý',
            'uk' => 'Anh',
            'cn' => 'Trung Quốc',
            'in' => 'Ấn Độ',
            'se' => 'Thụy Điển',
        ];

        return $countries[$this->country] ?? $this->country;
    }

    /**
     * Get the meta title or fallback to name.
     */
    public function getMetaTitleAttribute($value): string
    {
        return $value ?: $this->name;
    }

    /**
     * Get the meta description or fallback to description.
     */
    public function getMetaDescriptionAttribute($value): ?string
    {
        return $value ?: $this->description;
    }
    /**
     * Ví dụ: Một Brand có nhiều Car (nếu bạn có bảng cars)
     */
    public function cars()
    {
        return $this->hasMany(Car::class);
    }
}
