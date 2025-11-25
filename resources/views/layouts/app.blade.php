<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Isha Pithava" content="netflix-clone">
    <title>@yield('title', 'Netflix Clone')</title>
    <meta name="description" content="@yield('description', 'A clone of the popular streaming service Netflix, built with Laravel.')">

    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])        
 
    <!-- Chart.js CDN -->
    <script src="{{ asset('cdn/js/chart.js') }}"></script>

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="{{ asset('cdn/css/all.min.css') }}" />

    <!-- jQuery CDN -->
    <script src="{{ asset('cdn/js/jquery.min.js') }}"></script>

    {{-- Swiper Styles & Script --}}
    <link rel="stylesheet" href="{{ asset('cdn/css/swiper-bundle.min.css') }}" />
    <script src="{{asset('cdn/js/swiper-bundle.min.js')}}"></script>

    <!-- Alpine.js CDN -->
    <script src="{{asset('cdn/js/cdn.min.js')}}" defer></script>

    <!-- Font Awesome JS -->
    <script src="{{ asset('cdn/js/all.min.js') }}"></script>

    <!-- Select2 CSS -->
    <link href="{{asset('cdn/css/select2.min.css')}}" rel="stylesheet" />

    <!-- Select2 JS -->
    <script src="{{asset('cdn/js/select2.min.js')}}"></script>

    <!-- CryptoJS CDN -->
    <script src="{{asset('cdn/js/crypto-js.min.js')}}"></script>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-[#141414] font-sans text-white">

    {{-- Header --}}
    <x-navbar />

    {{-- Admin vs Normal User Layout --}}
    @can('isAdmin')
    {{-- Admin Sidebar Layout --}}
    <div x-data="{ open: true }" x-cloak class="flex">

        {{-- Toggle Button --}}
        <button @click="open = !open" class="fixed top-4 left-4 z-50 bg-[#141414] text-white px-2 py-1 rounded-md focus:outline-none hover:bg-gray-700 transition">
            <span x-show="!open">☰</span>
            <span x-show="open">✕</span>
        </button>

        {{-- Sidebar --}}
        <nav x-show="open" x-transition x-cloak class="fixed left-0 h-screen pt-20 w-48 bg-[#141414] text-white p-6 flex flex-col z-40">
            <a href="{{ route('home') }}" class="mb-4 text-white font-semibold no-underline!">Home</a>
            <a href="{{ route('admin.dashboard') }}" class="mb-4 text-white font-semibold no-underline!">Dashboard</a>
            <a href="{{ route('admin.users') }}" class="mb-4 text-white font-semibold no-underline!">Users</a>
            <a href="{{ route('admin.main_dashboard') }}" class="mb-4 text-white font-semibold no-underline!">Main
                Dashboard</a>
            <a href="{{ route('admin.videos') }}" class="block py-2 px-4 rounded text-white font-semibold transition no-underline!">Videos</a>
            <a href="#" class="block py-2 px-4 rounded text-white font-semibold transition no-underline!">Import
                from TMDB</a>
            <a href="#" class="block py-2 px-4 rounded text-white font-semibold transition no-underline!">Settings</a>
        </nav>

        {{-- Main Content --}}
        <main :class="open ? 'ml-48' : 'ml-0'" class="pt-20 w-full min-h-screen bg-[#141414] transition-all duration-300">
            @yield('content')
        </main>
    </div>
    @else
    {{-- Normal User Layout --}}
    <main class="w-full bg-[#141414] min-h-screen text-white">
        @yield('content')
    </main>
    @endcan

    {{-- Footer --}}
    <x-footer />
</body>

</html>