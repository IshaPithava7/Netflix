<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-[#f3f3f3] text-black min-h-screen">

    {{-- Header --}}
    <header id="navbar" class="flex items-center justify-between h-16 w-full px-45 fixed top-0 
     z-50 transition-colors duration-700 border-b border-gray-300
          {{ request()->is('home') || request()->is('games*') ? 'bg-transparent' : 'bg-[#ffffff]' }}">
        {{-- Logo Section --}}
        <div class=" flex items-center flex-shrink-0">
            <a href="#">
                <img src="{{ asset('storage/logo/Logonetflix.png') }}" alt="Netflix Logo" class="w-26 h-auto">
            </a>
        </div>

        <div class=" flex items-center flex-shrink-0">
            <button id="profileBtn" class="flex items-center space-x-2 focus:outline-none group">
                <img src="{{ asset('storage/netflix-avatar/Netflix-avatar.png') }}" alt="Profile"
                    class="rounded w-8 h-8">
                <svg viewBox="0 0 16 16" width="16" height="16" data-icon="CaretDownSmall" data-icon-id=":rn:"
                    data-uia="account+header+menu+Icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" role="img">
                    <path fill="currentColor" fill-rule="evenodd"
                        d="M11.6 6.5c.15 0 .22.18.12.28l-3.48 3.48a.33.33 0 0 1-.48 0L4.28 6.78a.17.17 0 0 1 .12-.28z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>

            {{-- Dropdown Menu --}}
            <div id="dropdownMenu"
                class="hidden absolute top-full right-40 w-56 bg-white rounded-lg shadow-2xl border border-gray-200 overflow-hidden z-50"
                style="transform-origin: top right;">

                {{-- Back to Netflix --}}
                <a href="{{ route('home') }}"
                    class="flex items-center gap-3 px-3 py-3 hover:bg-gray-50 transition border-b border-gray-200 group !no-underline">
                    <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    <span class="font-medium text-gray-900">Back to Netflix</span>
                </a>

                {{-- Account --}}
                <a href="{{ route('overview') }}"
                    class="flex items-center gap-3 px-3 py-3 hover:bg-gray-50 transition group !no-underline">
                    <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span class="font-medium text-gray-900">Account</span>
                </a>

                {{-- Manage Profiles --}}
                <a href="{{ route('profiles') }}"
                    class="flex items-center gap-3 px-3 py-3 hover:bg-gray-50 transition group !no-underline">
                    <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                    <span class="font-medium text-gray-900">Manage Profiles</span>
                </a>

                {{-- Help Centre --}}
                <a href="#" target="_blank"
                    class="flex items-center justify-between gap-3 px-3 py-3 hover:bg-gray-50 transition border-b border-gray-200 group !no-underline">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="font-medium text-gray-900">Help Centre</span>
                    </div>
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                </a>

                {{-- Switch Profile --}}
                <a href="#"
                    class="flex items-center justify-between w-full px-3 py-3 hover:bg-gray-50 transition group !no-underline">
                    <span class="font-medium text-gray-900">Switch Profile</span>
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>

                {{-- Sign out --}}
                <form action="{{ route('logout') }}" method="POST" class="w-full">
                    @csrf
                    <button type="submit"
                        class="flex items-center w-full px-3 py-3 hover:bg-gray-50 transition text-left">
                        <span class="font-medium text-gray-900">Sign out</span>
                    </button>
                </form>

            </div>
        </div>

    </header>


    {{-- Main Content --}}
    <main class="max-w-7xl mx-auto px-10 pt-25">
        <div class="flex gap-8">
            {{-- Sidebar Navigation --}}
            <aside class="w-64 flex-shrink-0">
                <nav class="space-y-1">
                    {{-- Back Link --}}
                    <a href="{{ route('home') }}"
                        class="flex items-center gap-3 px-4 py-3 mb-4 text-black font-medium !no-underline">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to Netflix
                    </a>
                    <a href="{{ route('overview') }}" class="flex items-center gap-3 px-4 py-3 font-semibold hover:bg-gray-50 !no-underline text-black
                        {{ request()->routeIs('overview') ? 'text-black' : 'text-gray-600' }}">
                        <svg viewBox="0 0 24 24" width="24" height="24" data-icon="HomeMedium" data-icon-id=":r78:"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" role="img">
                            <path fill="currentColor" fill-rule="evenodd"
                                d="M11.49 2.14a1 1 0 0 1 1.02 0l10 6c.3.18.49.5.49.86v12a1 1 0 0 1-1 1h-7a1 1 0 0 1-1-1v-5h-4v5a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V9a1 1 0 0 1 .49-.86zM3 9.57V20h5v-6h8v6h5V9.57l-9-5.4z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Overview
                    </a>

                    <a href="{{ route('membership') }}" class="flex items-center gap-3 px-4 py-3 font-semibold hover:bg-gray-50  !no-underline text-black
                        {{ request()->routeIs('membership') ? 'text-black' : 'text-gray-600' }}">
                        <svg viewBox="0 0 24 24" width="24" height="24" data-icon="CreditCardFillMedium"
                            data-icon-id=":r79:" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            role="img">
                            <path fill="currentColor" fill-rule="evenodd"
                                d="M3 3a3 3 0 0 0-3 3v2h24V6a3 3 0 0 0-3-3zM0 18v-8h24v8a3 3 0 0 1-3 3H3a3 3 0 0 1-3-3m16-2h4v-2h-4z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Membership
                    </a>

                    <a href="{{ route('security') }}" class="flex items-center gap-3 px-4 py-3 font-semibold hover:bg-gray-50  !no-underline text-black
                         {{ request()->routeIs('security') ? 'text-black' : 'text-gray-600 ' }}">
                        <svg viewBox="0 0 24 24" width="24" height="24" data-icon="ShieldCheckmarkMedium"
                            data-icon-id=":r4v:" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            role="img">
                            <path fill="currentColor" fill-rule="evenodd"
                                d="M12.4 1.09a1 1 0 0 0-.8 0l-10 4.44a1 1 0 0 0-.6.95c.11 2.78.36 6.3 1.8 9.41 1.47 3.18 4.15 5.9 8.96 7.08a1 1 0 0 0 .48 0c4.8-1.19 7.5-3.9 8.96-7.08 1.44-3.11 1.69-6.63 1.8-9.4a1 1 0 0 0-.6-.96zM4.63 15.05c-1.16-2.5-1.46-5.37-1.6-7.97L12 3.1l8.97 4c-.13 2.6-.43 5.46-1.59 7.96-1.2 2.6-3.34 4.86-7.38 5.92-4.04-1.06-6.18-3.31-7.38-5.92m7.09.66 6-6-1.42-1.42L11 13.6l-2.3-2.3-1.4 1.42 3 3 .7.7z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Security
                    </a>

                    <a href="{{ route('devices') }}" class="flex items-center gap-3 px-4 py-3 font-semibold hover:bg-gray-50 !no-underline text-black 
                           {{ request()->routeIs('devices') ? 'text-black' : 'text-gray-600 ' }}">
                        <svg viewBox="0 0 24 24" width="24" height="24" data-icon="TvMobileMedium" data-icon-id=":r5c:"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" role="img">
                            <path fill="currentColor" fill-rule="evenodd"
                                d="M0 3.73C0 2.77.77 2 1.73 2h18.54c.96 0 1.73.77 1.73 1.73V7h-2V4H2v10h11v2H1.73C.77 16 0 15.23 0 14.27zM13 17.3a73 73 0 0 0-8.07.12l.14 2A70 70 0 0 1 13 19.3zm9-6.3h-5v9h5zm-5-2a2 2 0 0 0-2 2v9c0 1.1.9 2 2 2h5a2 2 0 0 0 2-2v-9a2 2 0 0 0-2-2zm2.5 9.5a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5"
                                clip-rule="evenodd"></path>
                        </svg>
                        Devices
                    </a>

                    <a href="{{ route('profiles') }}" class="flex items-center gap-3 px-4 py-3 font-semibold hover:bg-gray-50 !no-underline text-black
                           {{ request()->routeIs('profiles') ? 'text-black' : 'text-gray-600  ' }}">
                        <svg viewBox="0 0 24 24" width="24" height="24" data-icon="ProfilesMedium"
                            data-icon-id=":Rjald9lalal6:" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" role="img">
                            <path fill="currentColor" fill-rule="evenodd"
                                d="M5 3h10a2 2 0 0 1 2 2H9a4 4 0 0 0-4 4v8a2 2 0 0 1-2-2V5c0-1.1.9-2 2-2m18 6a4 4 0 0 0-4-4 4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v10a4 4 0 0 0 4 4 4 4 0 0 0 4 4h10a4 4 0 0 0 4-4zm-4-2H9a2 2 0 0 0-2 2v10c0 1.1.9 2 2 2h10a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2m-9.5 6a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3m9 0a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3m.75 2.34a1 1 0 0 1-.1 1.41A5.6 5.6 0 0 1 15.5 18a5.6 5.6 0 0 1-3.66-1.25 1 1 0 1 1 1.32-1.5c.48.42 1.32.75 2.34.75s1.86-.33 2.34-.75a1 1 0 0 1 1.41.1"
                                clip-rule="evenodd"></path>
                        </svg>
                        Profiles
                    </a>
                </nav>
            </aside>

            <main class=" w-full">
                @yield('content')
            </main>

        </div>
    </main>

    {{-- Footer --}}
    <footer class="bg-gray-100 border-t border-gray-200 mt-20">
        <div class="max-w-7xl mx-auto px-6 py-16">
            <div class="mb-8">
                <p class="text-gray-700">
                    Questions? <a href="#" class="underline text-black">Contact us</a>
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="space-y-4">
                    <a href="#" class="block  hover:underline text-sm text-black">Investor Relations</a>
                    <a href="#" class="block text-black hover:underline text-sm">Terms of Use</a>
                    <a href="#" class="block text-black hover:underline text-sm">Gift Cards</a>
                </div>

                <div class="space-y-4">
                    <a href="#" class="block text-black hover:underline text-sm">Media Centre</a>
                    <a href="#" class="block text-black hover:underline text-sm">Privacy Statement</a>
                </div>

                <div class="space-y-4">
                    <a href="#" class="block text-black hover:underline text-sm">Jobs</a>
                    <a href="#" class="block text-black hover:underline text-sm">Audio and Subtitles</a>
                </div>

                <div class="space-y-4">
                    <a href="#" class="block text-black hover:underline text-sm">Cookie Preferences</a>
                    <a href="#" class="block text-black hover:underline text-sm">Help Centre</a>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        const $profileBtn = $('#profileBtn');
        const $dropdownMenu = $('#dropdownMenu');
        const $caretIcon = $('#caretIcon');

        // Toggle dropdown on button click
        $profileBtn.on('click', function (e) {
            e.stopPropagation();
            const isHidden = $dropdownMenu.hasClass('hidden');

            if (isHidden) {
                // Show dropdown
                $dropdownMenu.removeClass('hidden');
                // Rotate caret up
                $caretIcon.css('transform', 'rotate(180deg)');
            } else {
                // Hide dropdown
                $dropdownMenu.addClass('hidden');
                // Rotate caret down
                $caretIcon.css('transform', 'rotate(0deg)');
            }
        });

        // Close dropdown when clicking outside
        $(document).on('click', function (e) {
            if (!$(e.target).closest($profileBtn).length && !$(e.target).closest($dropdownMenu).length) {
                $dropdownMenu.addClass('hidden');
                $caretIcon.css('transform', 'rotate(0deg)');
            }
        });

        // Prevent dropdown from closing when clicking inside it
        $dropdownMenu.on('click', function (e) {
            e.stopPropagation();
        });
    });
</script>