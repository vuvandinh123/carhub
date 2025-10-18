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
    <div class="container mx-auto my-12">
        <x-breadcrumb :items="[['label' => 'Cars', 'url' => route('cars.index')], ['label' => 'Car Details']]" />
    </div>
    <section class="container text-main mx-auto my-12">
        <div class="">
            <!-- Results and filters header -->
            @include('pages.cars.partials.filter-header')

            <div class="flex gap-8">
                <!-- Sidebar Filters -->
                @include('pages.cars.partials.filter-sidebar')

                <!-- Car Listings -->
                @include('pages.cars.partials.list-cars', ['cars' => $cars])
            </div>
        </div>
    </section>
@endsection
@section('scripts')
@endsection
