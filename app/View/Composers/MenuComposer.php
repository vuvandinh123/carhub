<?php

namespace App\View\Composers;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\View\View;

class MenuComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $menuItems = $this->getMenuItems();
        $view->with('menuItems', $menuItems);
    }

    /**
     * Get menu items with dynamic data
     */
    protected function getMenuItems(): array
    {
        $menuConfig = config('menu.main', []);
        
        return collect($menuConfig)->map(function($item) {
            // Generate URL từ route nếu không có URL
            if (empty($item['url']) && !empty($item['route'])) {
                $item['url'] = $this->generateUrl($item['route']);
            }
            
            // Load dynamic mega menu items
            if (isset($item['mega_menu']) && is_array($item['mega_menu'])) {
                $item['mega_menu'] = $this->processMegaMenu($item['mega_menu']);
            }
            
            return $item;
        })->toArray();
    }

    /**
     * Generate URL from route name
     */
    protected function generateUrl(string $route): string
    {
        $routeName = str_replace('.*', '.index', $route);
        
        try {
            return route($routeName);
        } catch (\Exception $e) {
            return '#';
        }
    }

    /**
     * Process mega menu columns
     */
    protected function processMegaMenu(array $columns): array
    {
        foreach ($columns as $index => $column) {
            if (isset($column['type']) && in_array($column['type'], ['brands', 'categories'])) {
                $columns[$index]['items'] = $this->loadDynamicItems($column['type']);
            }
        }
        
        return $columns;
    }

    /**
     * Load dynamic items based on type
     */
    protected function loadDynamicItems(string $type): array
    {
        switch ($type) {
            case 'brands':
                return $this->loadBrands();
            
            case 'categories':
                return $this->loadCategories();
            
            default:
                return [];
        }
    }

    /**
     * Load brands from database
     */
    protected function loadBrands(): array
    {
        return Brand::orderBy('name')
            ->take(8)
            ->get()
            ->map(fn($brand) => [
                'label' => $brand->name,
                'url' => route('cars.index', ['brand_id' => $brand->id])
            ])
            ->toArray();
    }

    /**
     * Load categories from database
     */
    protected function loadCategories(): array
    {
        return Category::orderBy('name')
            ->take(8)
            ->get()
            ->map(fn($category) => [
                'label' => $category->name,
                'url' => route('cars.index', ['categories' => [$category->id]])
            ])
            ->toArray();
    }
}
