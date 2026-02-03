<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Navigation Menu Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains the configuration for the main navigation menu.
    | You can easily add, remove, or modify menu items here.
    |
    */

    'main' => [
        [
            'label' => 'Trang chủ',
            'route' => 'home',
            'url' => '/',
            'icon' => null,
        ],
        [
            'label' => 'Giới thiệu',
            'route' => 'about',
            'url' => null, // Will be generated from route
            'icon' => null,
        ],
        [
            'label' => 'Sản phẩm',
            'route' => 'cars.*',
            'url' => null,
            'icon' => 'chevron-down',
            'has_mega' => true,
            'mega_menu' => [
                [
                    'title' => 'Hãng xe phổ biến',
                    'type' => 'brands', // Load from database
                    'items' => [] // Will be filled dynamically
                ],
                [
                    'title' => 'Phân khúc',
                    'type' => 'categories', // Load from database
                    'items' => [] // Will be filled dynamically
                ],
                [
                    'title' => 'Khoảng giá',
                    'type' => 'static', // Static items
                    'items' => [
                        ['label' => 'Dưới 500 triệu', 'url' => '/cars?price_max=500'],
                        ['label' => '500 triệu - 1 tỷ', 'url' => '/cars?price_min=500&price_max=1000'],
                        ['label' => '1 - 2 tỷ', 'url' => '/cars?price_min=1000&price_max=2000'],
                        ['label' => 'Trên 2 tỷ', 'url' => '/cars?price_min=2000'],
                    ]
                ],
                [
                    'title' => 'Nhiên liệu',
                    'type' => 'static', // Static items
                    'items' => [
                        ['label' => 'Xăng', 'url' => '/cars?fuel_type=gasoline'],
                        ['label' => 'Dầu diesel', 'url' => '/cars?fuel_type=diesel'],
                        ['label' => 'Điện', 'url' => '/cars?fuel_type=electric'],
                        ['label' => 'Hybrid', 'url' => '/cars?fuel_type=hybrid'],
                    ]
                ],
                [
                    'title' => 'Số ghế',
                    'type' => 'static', // Static items
                    'items' => [
                        ['label' => '2 chỗ', 'url' => '/cars?seat_count=2'],
                        ['label' => '4 chỗ', 'url' => '/cars?seat_count=4'],
                        ['label' => '5 chỗ', 'url' => '/cars?seat_count=5'],
                        ['label' => '7 chỗ', 'url' => '/cars?seat_count=7'],
                    ]
                ],
            ]
        ],
        [
            'label' => 'Tin tức',
            'route' => 'posts.*',
            'url' => null,
            'icon' => null,
        ],
        [
            'label' => 'Tính vay',
            'route' => 'loan.calculator',
            'url' => null,
            'icon' => null,
        ],
        [
            'label' => 'Liên hệ',
            'route' => 'contact',
            'url' => null,
            'icon' => null,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Footer Menu Configuration
    |--------------------------------------------------------------------------
    |
    | You can also configure footer menu or other menus here
    |
    */

    'footer' => [
        // Add footer menu items if needed
    ],
];
