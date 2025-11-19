<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />

    <!-- jQuery CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- Swiper Styles & Script --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

    <!-- Alpine.js CDN -->
    <script src="//unpkg.com/alpinejs" defer></script>

    <!-- Font Awesome JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/js/all.min.js"
        integrity="sha512-6BTOlkauINO65nLhXhthZMtepgJSghyimIalb+crKRPhvhmsCdnIuGcVbR5/aQY2A+260iC1OPy1oCdB6pSSwQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- CryptoJS CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>


    <title>Netflix Clone</title>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-[#141414] font-sans">

    {{-- Header --}}
    <x-navbar />

    {{-- Admin vs Normal User Layout --}}
    @can('isAdmin')
        {{-- Admin Sidebar Layout --}}
        <div x-data="{ open: true }" x-cloak class="flex">

            {{-- Toggle Button --}}
            <button @click="open = !open"
                class="fixed top-4 left-4 z-50 bg-[#141414] text-white px-2 py-1 rounded-md focus:outline-none hover:bg-gray-700 transition">
                <span x-show="!open">☰</span>
                <span x-show="open">✕</span>
            </button>

            {{-- Sidebar --}}
            <nav x-show="open" x-transition x-cloak
                class="fixed left-0 h-screen pt-20 w-48 bg-[#141414] text-white p-6 flex flex-col z-40">
                <a href="{{ route('home') }}" class="mb-4 text-white font-semibold !no-underline">Home</a>
                <a href="{{ route('admin.dashboard') }}" class="mb-4 text-white font-semibold !no-underline">Dashboard</a>
                <a href="{{ route('admin.users') }}" class="mb-4 text-white font-semibold !no-underline">Users</a>
                <a href="{{ route('admin.main_dashboard') }}" class="mb-4 text-white font-semibold !no-underline">Main
                    Dashboard</a>
                <a href="{{ route('admin.videos.index') }}"
                    class="block py-2 px-4 rounded text-white font-semibold transition !no-underline">Videos</a>
                <a href="#" class="block py-2 px-4 rounded text-white font-semibold transition !no-underline">Import
                    TMDb</a>
                <a href="#" class="block py-2 px-4 rounded text-white font-semibold transition !no-underline">Reports</a>
                <a href="#" class="block py-2 px-4 rounded text-white font-semibold transition !no-underline">Settings</a>
            </nav>

            {{-- Main Content --}}
            <main :class="open ? 'ml-48' : 'ml-0'"
                class="pt-20 w-full min-h-screen bg-[#141414] transition-all duration-300">
                @yield('content')
            </main>
        </div>
    @else
        {{-- Normal User Layout --}}
        <main class=" w-full bg-[#141414] min-h-screen text-white">
            @yield('content')
        </main>
    @endcan

    {{-- Footer --}}
    <x-footer />


</body>

</html>