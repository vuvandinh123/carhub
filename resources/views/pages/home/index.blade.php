@extends('layouts.app')

@section('title', 'Home')

@section('meta')
    @include('partials.meta-tag', [
        'title' => 'Home',
        'meta_description' => 'Welcome to the home page',
        'meta_keywords' => 'home, welcome',
        'meta_author' => 'Your Name',
        'meta_image' => asset('default-image.jpg'),
        'meta_robots' => 'index, follow',
        'meta_googlebot' => 'index, follow',
        'meta_bingbot' => 'index, follow',
        'meta_yandex' => 'index, follow',
    ])
@endsection

@section('styles')
    <style>
        .car-silhouette {
            background: linear-gradient(45deg, #e5e7eb 0%, #f3f4f6 100%);
            clip-path: polygon(15% 85%, 20% 75%, 25% 70%, 35% 65%, 50% 60%,
                    65% 65%, 75% 70%, 85% 75%, 90% 85%, 85% 95%,
                    15% 95%);
        }
    </style>
@endsection

@section('content')
    @include('pages.home.partials.hero')
    @include('pages.home.partials.type-section',['brands' => $brands])
    @include('pages.home.partials.service-section')
    @include('pages.home.partials.featured-cars',['cars' => $cars, 'categoriesByVehicleType' => $categoriesByVehicleType])
    @include('pages.home.partials.choose-section')
    @include('pages.home.partials.product-category')
    @include('pages.home.partials.list-blog-section')
    @include('pages.home.partials.subscribe')
    @include('pages.home.partials.calculate-car-section')
    @include('pages.home.partials.my-need-section')
@endsection
@section('scripts')
    <script>
        function calculateLoan() {
            // Get input values
            const carPrice = parseFloat(document.getElementById('carPrice').value) || 0;
            const downPayment = parseFloat(document.getElementById('downPayment').value) || 0;
            const loanTerm = parseInt(document.getElementById('loanTerm').value) || 36;
            const interestRate = parseFloat(document.getElementById('interestRate').value) || 0;

            // Validate inputs
            if (carPrice <= 0) {
                alert('Please enter a valid car price');
                return;
            }

            if (downPayment >= carPrice) {
                alert('Down payment cannot be greater than or equal to car price');
                return;
            }

            // Calculate loan amount
            const loanAmount = carPrice - downPayment;

            // Calculate monthly interest rate
            const monthlyRate = interestRate / 100 / 12;

            // Calculate monthly payment using loan formula
            let monthlyPayment = 0;
            if (monthlyRate > 0) {
                monthlyPayment = loanAmount * (monthlyRate * Math.pow(1 + monthlyRate, loanTerm)) / (Math.pow(1 +
                    monthlyRate, loanTerm) - 1);
            } else {
                monthlyPayment = loanAmount / loanTerm;
            }

            // Calculate total payment and total interest
            const totalPayment = monthlyPayment * loanTerm;
            const totalInterest = totalPayment - loanAmount;

            // Update display
            document.getElementById('monthlyPayment').textContent =  + monthlyPayment.toFixed(2);
            document.getElementById('loanAmount').textContent =  + loanAmount.toLocaleString();
            document.getElementById('totalInterest').textContent =  + totalInterest.toFixed(2);
            document.getElementById('totalPayment').textContent =  + totalPayment.toFixed(2);
        }
        document.getElementById('calculateBtn').addEventListener('click', calculateLoan);
        // Auto-calculate when inputs change
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = ['carPrice', 'downPayment', 'loanTerm', 'interestRate'];
            inputs.forEach(id => {
                document.getElementById(id).addEventListener('blur', calculateLoan);
            });
        });
    </script>
@endsection
