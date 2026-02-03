<?php

if (!function_exists('formatPrice')) {
    /**
     * Format price to Vietnamese currency format (triệu, tỷ)
     * 
     * @param float|int $price Price in VND
     * @param bool $showUnit Show unit (triệu, tỷ) or not
     * @return string Formatted price
     */
    function formatPrice($price, $showUnit = true)
    {
        if (empty($price) || $price <= 0) {
            return 'Liên hệ';
        }

        // Convert to billion (tỷ) if >= 1 billion
        if ($price >= 1000000000) {
            $value = $price / 1000000000;
            $formatted = number_format($value, $value == floor($value) ? 0 : 1, ',', '.');
            return $showUnit ? $formatted . ' tỷ' : $formatted;
        }
        
        // Convert to million (triệu) if >= 1 million
        if ($price >= 1000000) {
            $value = $price / 1000000;
            $formatted = number_format($value, $value == floor($value) ? 0 : 0, ',', '.');
            return $showUnit ? $formatted . ' triệu' : $formatted;
        }

        // Less than 1 million, show as thousand (nghìn)
        $value = $price / 1000;
        $formatted = number_format($value, 0, ',', '.');
        return $showUnit ? $formatted . ' nghìn' : $formatted;
    }
}

if (!function_exists('formatPriceShort')) {
    /**
     * Format price to short Vietnamese currency format
     * 
     * @param float|int $price Price in VND
     * @return string Short formatted price
     */
    function formatPriceShort($price)
    {
        if (empty($price) || $price <= 0) {
            return 'Liên hệ';
        }

        if ($price >= 1000000000) {
            $value = $price / 1000000000;
            return number_format($value, 1, ',', '.') . 'tỷ';
        }
        
        if ($price >= 1000000) {
            $value = $price / 1000000;
            return number_format($value, 0, ',', '.') . 'tr';
        }

        return number_format($price, 0, ',', '.') . 'đ';
    }
}

if (!function_exists('formatPriceRange')) {
    /**
     * Format price range
     * 
     * @param float|int $minPrice Minimum price
     * @param float|int $maxPrice Maximum price
     * @return string Formatted price range
     */
    function formatPriceRange($minPrice, $maxPrice)
    {
        if (empty($minPrice) && empty($maxPrice)) {
            return 'Liên hệ';
        }

        if (empty($minPrice)) {
            return 'Dưới ' . formatPrice($maxPrice);
        }

        if (empty($maxPrice)) {
            return 'Trên ' . formatPrice($minPrice);
        }

        return formatPrice($minPrice) . ' - ' . formatPrice($maxPrice);
    }
}
