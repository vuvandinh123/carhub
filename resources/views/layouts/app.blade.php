<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('/images/thacothuduclogo.png') }}" type="image/x-icon">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
    @yield('meta')
    @yield('styles')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>

<body class="bg-main">
    @include('partials.topbar')
    @include('partials.header')
    <div class="pt">
        @yield('content')
    </div>
    @include('partials.footer')
    @include('partials.modals.index')
    @include('partials.compare-modal')

    @include('partials.floating-contacts')
    <!-- Compare Floating Button -->
    <div id="compareFloatingBtn" class="fixed bottom-4 right-4 z-40 hidden">
        <button onclick="openCompareModal()"
            class="bg-primary-800 cursor-pointer text-white rounded-full px-3 py-2 shadow-2xl hover:shadow-blue-500/50 transition-all duration-300 flex items-center gap-3 hover:scale-105">
            <i data-lucide="git-compare" class="w-5 h-5"></i>
            <span class="font-semibold">So sánh (<span class="compareCount" id="compareCount">0</span>)</span>
        </button>
    </div>

    <!-- Saved Cars Floating Button -->
    <div id="savedCarsFloatingBtn" class="fixed bottom-20 right-4 z-40">
        <a href="{{ route('cars.saved') }}"
            class="bg-primary-800 text-white rounded-full py-3 shadow-2xl hover:shadow-primary-500/50 transition-all duration-300 flex items-center w-10 h-10 justify-center hover:scale-105">
            <i data-lucide="bookmark" class="w-5 h-5"></i>
            <span class="font-semibold"><span
                    class="bookmark-count absolute -top-1 -right-1 bg-red-600 text-white rounded-full w-5 h-5 flex text-xs items-center justify-center">0</span></span>
        </a>
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"
        integrity="sha512-zlWWyZq71UMApAjih4WkaRpikgY9Bz1oXIW5G0fED4vk14JjGlQ1UmkGM392jEULP8jbNMiwLWdM8Z87Hu88Fw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            console.log('DOM loaded - initializing mega menu');

            // Mega Menu Handler
            const megaMenuItem = document.getElementById('megaMenuItem');
            const megaMenuContent = document.getElementById('megaMenuContent');

            console.log('Mega menu elements:', {
                megaMenuItem,
                megaMenuContent
            });

            if (megaMenuItem && megaMenuContent) {
                let hideTimeout;

                console.log('Mega menu initialized successfully');

                // Show mega menu on hover (desktop only)
                megaMenuItem.addEventListener('mouseenter', function() {
                    console.log('Mouse enter on menu item, window width:', window.innerWidth);
                    if (window.innerWidth >= 768) {
                        clearTimeout(hideTimeout);
                        megaMenuContent.classList.remove('hidden');
                        console.log('Mega menu shown');
                    }
                });

                // Hide mega menu when mouse leaves
                megaMenuItem.addEventListener('mouseleave', function() {
                    console.log('Mouse leave on menu item');
                    if (window.innerWidth >= 768) {
                        hideTimeout = setTimeout(() => {
                            megaMenuContent.classList.add('hidden');
                            console.log('Mega menu hidden');
                        }, 200);
                    }
                });

                // Keep menu open when hovering over the menu itself
                megaMenuContent.addEventListener('mouseenter', function() {
                    console.log('Mouse enter on mega menu content');
                    if (window.innerWidth >= 768) {
                        clearTimeout(hideTimeout);
                    }
                });

                megaMenuContent.addEventListener('mouseleave', function() {
                    console.log('Mouse leave on mega menu content');
                    if (window.innerWidth >= 768) {
                        hideTimeout = setTimeout(() => {
                            megaMenuContent.classList.add('hidden');
                            console.log('Mega menu hidden from content');
                        }, 200);
                    }
                });

                // Mobile: Click to toggle
                const menuLink = megaMenuItem.querySelector('a');
                if (menuLink) {
                    menuLink.addEventListener('click', function(e) {
                        console.log('Click on menu link, window width:', window.innerWidth);
                        if (window.innerWidth < 768) {
                            e.preventDefault();
                            megaMenuContent.classList.toggle('hidden');
                            console.log('Mega menu toggled on mobile');
                        }
                    });
                }

                // Click outside to close on mobile
                document.addEventListener('click', function(event) {
                    if (window.innerWidth < 768 && !megaMenuItem.contains(event.target)) {
                        megaMenuContent.classList.add('hidden');
                    }
                });
            } else {
                console.error('Mega menu elements not found!');
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>
    @vite('resources/js/app.js')
    <script src="{{ asset('js/main.js') }}"></script>
    @yield('scripts')
    @if (session('success'))
        <script>
            showToast('{{ session('success') }}', 'success');
        </script>
    @endif

    @if (session('error'))
        <script>
            showToast('{{ session('error') }}', 'error');
        </script>
    @endif
</body>

</html>
