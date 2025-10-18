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
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const menuItems = document.querySelectorAll(".has-mega");

            menuItems.forEach(item => {
                const trigger = item.querySelector("a");
                const megaMenu = item.querySelector(".mega-menu");

                trigger.addEventListener("click", function(e) {
                    if (window.innerWidth < 768) { // chỉ áp dụng cho mobile
                        e.preventDefault();

                        // toggle class ẩn/hiện
                        megaMenu.classList.toggle("hidden");
                    }
                });

                // click ra ngoài thì đóng
                document.addEventListener("click", function(event) {
                    if (!item.contains(event.target) && window.innerWidth < 768) {
                        megaMenu.classList.add("hidden");
                    }
                });
            });
        });
    </script>
    @vite('resources/js/app.js')
    @yield('scripts')

</body>

</html>
