{{-- create meta tag optimize seo --}}
@props([
    'title' => 'Default Title',
    'meta_description' => 'Default description',
    'meta_keywords' => 'default, keywords',
    'meta_author' => 'VŨ VĂN ĐỊNH',
    'meta_image' => asset('default-image.jpg'),
    'meta_robots' => 'index, follow',
    'meta_googlebot' => 'index, follow',
    'meta_bingbot' => 'index, follow',
    'meta_yandex' => 'index, follow',
])
<meta name="description" content="{{ $meta_description }}">
<meta name="keywords" content="{{ $meta_keywords }}">
<meta name="author" content="{{ $meta_author }}">
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $meta_description }}">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:image" content="{{ $meta_image }}">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ $meta_description }}">
<meta name="twitter:image" content="{{ $meta_image }}">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="robots" content="{{ $meta_robots }}">
<meta name="googlebot" content="{{ $meta_googlebot }}">
<meta name="bingbot" content="{{ $meta_bingbot }}">
<meta name="yandex" content="{{ $meta_yandex }}">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="format-detection" content="telephone=no">