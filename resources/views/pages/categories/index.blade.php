@extends('layouts.app')

@section('title', 'Cars')

@section('meta')
    @include('partials.meta-tag', [
        'title' => 'Cars',
        'meta_description' => 'Explore our collection of cars',
        'meta_keywords' => 'cars, vehicles, automotive',
        'meta_author' => 'Your Name',
        'meta_image' => asset('default-image.jpg'),
        'meta_robots' => 'index, follow',
        'meta_googlebot' => 'index, follow',
        'meta_bingbot' => 'index, follow',
        'meta_yandex' => 'index, follow',
    ])
@endsection

@section('styles')
@endsection

@section('content')
    
@endsection
@section('scripts')
@endsection
