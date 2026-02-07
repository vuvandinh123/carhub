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
                    'title' => 'Hãng xe',
                    'type' => 'brands', // Load from database
                    'items' => [] // Will be filled dynamically
                ],
                [
                    'title' => 'Xe tải KIA',
                    'type' => 'KIA', // Load from database
                    'items' => [] // Will be filled dynamically
                ],
                [
                    'title' => 'Xe tải THACO',
                    'type' => 'THACO', // Static items
                    'items' => [
                    ]
                ],
                [
                    'title' => 'Xe tải FUSO',
                    'type' => 'FUSO', // Static items
                    'items' => [
                    ]
                ],
                [
                    'title' => 'Xe tải VAN',
                    'type' => 'VAN', // Static items
                    'items' => [
                        
                    ]
                ],
                [
                    'title' => 'Xe tải LINKER',
                    'type' => 'LINKER', // Static items
                    'items' => [
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
