<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
    @yield('meta')
    @yield('styles')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
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
    
    <!-- Compare Floating Button -->
    <div id="compareFloatingBtn" class="fixed bottom-4 right-4 z-40 hidden">
        <button 
            onclick="openCompareModal()"
            class="bg-blue-600 text-white rounded-full px-3 py-2 shadow-2xl hover:shadow-blue-500/50 transition-all duration-300 flex items-center gap-3 hover:scale-105">
            <i data-lucide="git-compare" class="w-5 h-5"></i>
            <span class="font-semibold">So sánh (<span id="compareCount">0</span>)</span>
        </button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            console.log('DOM loaded - initializing mega menu');
            
            // Mega Menu Handler
            const megaMenuItem = document.getElementById('megaMenuItem');
            const megaMenuContent = document.getElementById('megaMenuContent');
            
            console.log('Mega menu elements:', { megaMenuItem, megaMenuContent });
            
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
    @vite('resources/js/app.js')
    @yield('scripts')

</body>

</html>
