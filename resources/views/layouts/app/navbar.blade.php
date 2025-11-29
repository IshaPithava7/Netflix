@if(session('kids_mode'))
<header id="navbar" class="flex items-center justify-between h-16 w-full px-14 fixed top-0 z-50 transition-colors duration-700 bg-transparent">
    {{-- Logo Section --}}
    <div class="flex items-center shrink-0">
        <a href="{{ route('pages.home') }}">
            <img src="{{ asset('storage/logo/Logonetflix.png') }}" alt="Netflix Logo" loading="lazy" class="w-[100px] h-auto">
        </a>
    </div>

    {{-- Navigation Menu --}}
    <nav class="flex items-center flex-1 ml-[15px] pt-3">
        <ul class="flex items-center space-x-5 text-sm">
            <li class="{{ request()->routeIs('pages.home') ? 'font-bold' : '' }} text-white hover:text-gray-300 cursor-pointer transition-colors duration-200">
                <a href="{{ route('pages.home') }}" class="no-underline! text-white">Home</a>
            </li>
            <li class="{{ request()->routeIs('pages.characters') ? 'font-bold' : '' }} text-white hover:text-gray-300 cursor-pointer transition-colors duration-200">
                <a href="{{ route('pages.characters') }}" class="no-underline! text-white">Characters</a>
            </li>
            <li class="{{ request()->routeIs('pages.shows') ? 'font-bold' : '' }} text-white hover:text-gray-300 cursor-pointer transition-colors duration-200">
                <a href="{{ route('pages.shows') }}" class="no-underline! text-white">Shows</a>
            </li>
            <li class="{{ request()->routeIs('pages.movies') ? 'font-bold' : '' }} text-white hover:text-gray-300 cursor-pointer transition-colors duration-200">
                <a href="{{ route('pages.movies') }}" class="no-underline! text-white">Movies</a>
            </li>
             <li class="{{ request()->routeIs('pages.newpopular') ? 'font-bold' : '' }} text-white hover:text-gray-300 cursor-pointer transition-colors duration-200">
                <a href="{{ route('pages.newpopular') }}" class="no-underline! text-white">New &amp; Popular</a>
            </li>
             <li class="{{ request()->routeIs('pages.mylist') ? 'font-bold' : '' }} text-white hover:text-gray-300 cursor-pointer transition-colors duration-200">
                <a href="{{ route('pages.mylist') }}" class="no-underline! text-white">My List</a>
            </li>
             <li class="{{ request()->routeIs('pages.browse_languages') ? 'font-bold' : '' }} text-white hover:text-gray-300 cursor-pointer transition-colors duration-200">
                <a href="{{ route('pages.browse_languages') }}" class="no-underline! text-white">Browse By Languages</a>
            </li>
        </ul>
    </nav>

    {{-- Right Side Icons --}}
    <div class="flex items-center content-around space-x-4 ml-auto pt-[15px]">
        {{-- Search Icon --}}
        <div class="flex justify-end">
            <!-- Search Container -->
            <div id="searchContainer" class="flex items-center overflow-hidden transition-all duration-300 bg-transparent">
                <!-- Search Icon -->
                <button id="searchIcon" class="cursor-pointer p-2 text-white hover:text-gray-300 transition-colors duration-200 shrink-0">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10ZM15.6177 17.0319C14.078 18.2635 12.125 19 10 19C5.02944 19 1 14.9706 1 10C1 5.02944 5.02944 1 10 1C14.9706 1 19 5.02944 19 10C19 12.125 18.2635 14.078 17.0319 15.6177L22.7071 21.2929L21.2929 22.7071L15.6177 17.0319Z" fill="currentColor"></path>
                    </svg>
                </button>
                <!-- Search Input -->
                <input type="text" id="searchInput" placeholder="Titles, people, genres" class="flex-0 w-0 opacity-0 bg-black text-white text-sm  py-2 placeholder-gray-400 transition-all duration-300 focus:outline-none" />
            </div>
        </div>

        {{-- Kids Profile Icon --}}
        <div class="text-white text-sm hover:text-gray-300 transition-colors duration-200 no-underline!">
            <img src="{{ asset('storage/kids/navbar_kids.png') }}" alt="Kids Profile" class="w-8 h-8 rounded">
        </div>

        {{-- Exit Kids Button --}}
        <a href="{{ route('kids.exit') }}" class="text-white text-sm hover:text-gray-300 transition-colors duration-200 no-underline! px-4 py-2 bg-red-600 rounded">
            Exit Children
        </a>
    </div>
</header>
@else
<header id="navbar" class="flex items-center justify-between h-16 w-full px-14 fixed top-0 z-50 transition-colors duration-700">
    {{-- Logo Section --}}
    <div class="flex items-center shrink-0">
        <a href="#">
            <img src="{{ asset('storage/logo/Logonetflix.png') }}" alt="Netflix Logo" loading="lazy" class="w-[100px] h-auto">
        </a>
    </div>

    {{-- Navigation Menu --}}
    <nav class="flex items-center flex-1 ml-[15px] pt-3">
        <ul class="flex items-center space-x-5 text-sm">
            <li class="{{ request()->routeIs('home') ? 'font-bold' : '' }} text-white hover:text-gray-300 cursor-pointer transition-colors duration-200">
                <a href="{{ route('home') }}" class="no-underline! text-white">Home</a>
            </li>
            <li class="{{ request()->routeIs('shows') ? 'font-bold' : '' }} text-white hover:text-gray-300 cursor-pointer transition-colors duration-200">
                <a href="{{ route('shows') }}" class="no-underline! text-white">Shows</a>
            </li>
            <li class="{{ request()->routeIs('movies') ? 'font-bold' : '' }} text-white hover:text-gray-300 cursor-pointer transition-colors duration-200">
                <a href="{{ route('movies') }}" class="no-underline! text-white">Movies</a>
            </li>
            <li class="{{ request()->routeIs('games') ? 'font-bold' : '' }} text-white hover:text-gray-300 cursor-pointer transition-colors duration-200">
                <a href="{{ route('games') }}" class="no-underline! text-white">Games</a>
            </li>
            <li class="{{ request()->routeIs('newpopular') ? 'font-bold' : '' }} text-white hover:text-gray-300 cursor-pointer transition-colors duration-200">
                <a href="{{ route('newpopular') }}" class="no-underline! text-white">New &amp; Popular</a>
            </li>
            <li class="{{ request()->routeIs('mylist.index') ? 'font-bold' : '' }} text-white hover:text-gray-300 cursor-pointer transition-colors duration-200">
                <a href="{{ route('mylist.index') }}" class="no-underline! text-white">My List</a>
            </li>
            <li class="{{ request()->routeIs('browse.languages') ? 'font-bold ' : '' }} text-white hover:text-gray-300 cursor-pointer transition-colors duration-200">
                <a href="{{ route('browse.languages') }}" class="no-underline! text-white">Browse by Languages</a>
            </li>
        </ul>
    </nav>

    {{-- Right Side Icons --}}
    <div class="flex items-center content-around space-x-4 ml-auto pt-[15px]">

        {{-- Search Icon --}}
        <div class="flex justify-end">
            <!-- Search Container -->
            <div id="searchContainer" class="flex items-center overflow-hidden transition-all duration-300 bg-transparent">

                <!-- Search Icon -->
                <button id="searchIcon" class="cursor-pointer p-2 text-white hover:text-gray-300 transition-colors duration-200 shrink-0">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10ZM15.6177 17.0319C14.078 18.2635 12.125 19 10 19C5.02944 19 1 14.9706 1 10C1 5.02944 5.02944 1 10 1C14.9706 1 19 5.02944 19 10C19 12.125 18.2635 14.078 17.0319 15.6177L22.7071 21.2929L21.2929 22.7071L15.6177 17.0319Z" fill="currentColor"></path>
                    </svg>
                </button>

                <!-- Search Input -->
                <input type="text" id="searchInput" placeholder="Titles, people, genres" class="flex-0 w-0 opacity-0 bg-black text-white text-sm  py-2 placeholder-gray-400 transition-all duration-300 focus:outline-none" />
            </div>
        </div>

        {{-- Children Link --}}
        <a href="{{ route('pages.home') }}" class="text-white text-sm hover:text-gray-300 transition-colors duration-200 no-underline!">
            Children
        </a>

        {{-- Notifications Icon --}}
        <div id="notificationWrapper" class="relative inline-block notification-container">
            <button class="text-white pt-2 hover:text-gray-300 transition-colors duration-200 relative">
                <svg viewBox="0 0 24 24" width="24" height="24" data-icon="BellMedium" data-icon-id=":r1:" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" role="img">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M13.0002 4.07092C16.3924 4.55624 19 7.4736 19 11V15.2538C20.0489 15.3307 21.0851 15.4245 22.1072 15.5347L21.8928 17.5232C18.7222 17.1813 15.4092 17 12 17C8.59081 17 5.27788 17.1813 2.10723 17.5232L1.89282 15.5347C2.91498 15.4245 3.95119 15.3307 5.00003 15.2538V11C5.00003 7.47345 7.60784 4.55599 11.0002 4.07086V2H13.0002V4.07092ZM17 15.1287V11C17 8.23858 14.7614 6 12 6C9.2386 6 7.00003 8.23858 7.00003 11V15.1287C8.64066 15.0437 10.3091 15 12 15C13.691 15 15.3594 15.0437 17 15.1287ZM8.62593 19.3712C8.66235 20.5173 10.1512 22 11.9996 22C13.848 22 15.3368 20.5173 15.3732 19.3712C15.3803 19.1489 15.1758 19 14.9533 19H9.0458C8.82333 19 8.61886 19.1489 8.62593 19.3712Z" fill="currentColor"></path>
                </svg>
            </button>

            <!-- Notification Dropdown Panel -->
            <div id="notificationPanel" class="absolute right-0  w-96 bg-black border border-gray-700 rounded-sm shadow-2xl overflow-hidden z-50
                    opacity-0 -translate-y-2.5 pointer-events-none transition-all duration-300">
                <!-- Netflix Lookahead -->
                <div class="notification-item flex items-start gap-3 p-2 border-b border-gray-800 cursor-pointer
                        transition-colors duration-200 hover:bg-white/5">
                    <div class="shrink-0 w-28 h-16 bg-black rounded border border-gray-700 flex items-center justify-center relative">
                        <svg class="w-6 h-6 text-red-600 absolute" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z" />
                        </svg>
                        <svg class="w-8 h-8 text-gray-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14z" />
                            <path d="M9 8h2v8H9zm4 0h2v8h-2z" />
                        </svg>
                        <span class="absolute top-1 left-1 text-red-600 text-xs font-bold">N</span>
                        <span class="absolute top-1 right-1 text-red-600 text-xl">+</span>
                        <span class="absolute bottom-1 right-1 text-red-600 text-xl">+</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-white font-medium text-sm mb-1">Netflix Lookahead</p>
                        <p class="text-gray-400 text-xs mb-2">Explore what's coming soon.</p>
                        <span class="text-gray-500 text-xs">1 day ago</span>
                    </div>
                </div>

                <!-- The Game -->
                <div class="notification-item flex items-start gap-3 p-2 border-b border-gray-800 cursor-pointer">
                    <div class="shrink-0 w-28 h-16 bg-blue-900 rounded overflow-hidden">
                        <div class="w-full h-full flex items-center justify-center text-white font-bold text-lg" style="background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);">
                            THE GAME
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-white font-medium text-sm mb-1">Suggestions for what to watch</p>
                        <p class="text-gray-400 text-xs mb-2">Browse your recommendations.</p>
                        <span class="text-gray-500 text-xs">2 days ago</span>
                    </div>
                </div>

                <!-- Top 10 Films India -->
                <div class="notification-item flex items-start gap-3 p-2 border-b border-gray-800 cursor-pointer">
                    <div class="shrink-0 w-28 h-16 bg-linear-to-br from-orange-500 to-pink-500 rounded overflow-hidden flex items-center justify-center">
                        <span class="text-white font-bold text-4xl">2</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-white font-medium text-sm mb-1">Top 10 films: India</p>
                        <p class="text-gray-400 text-xs mb-2">See what's popular.</p>
                        <span class="text-gray-500 text-xs">5 days ago</span>
                    </div>
                </div>

                <!-- WWE RAW -->
                <div class="notification-item flex items-start gap-3 p-2 cursor-pointer">
                    <div class="shrink-0 w-28 h-16 bg-red-700 rounded overflow-hidden flex items-center justify-center">
                        <div class="text-white font-black text-2xl tracking-wider">RAW</div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-white font-medium text-sm mb-1">Now available</p>
                        <p class="text-gray-400 text-xs mb-2">Live episode</p>
                        <span class="text-gray-500 text-xs">6 days ago</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Profile Menu --}}
        <div id="profileWrapper" class="relative inline-block">

            <button id="profileBtn" class="flex items-center space-x-2 focus:outline-none group">
                @if($selectedProfile && $selectedProfile->avatar)
                <img src="{{ $selectedProfile->avatar }}" alt="Profile" loading="lazy" class="rounded w-8 h-8">
                @else
                <img src="{{ asset('storage/netflix-avatar/Netflix-avatar.png') }}" alt="Profile" loading="lazy" class="rounded w-8 h-8">
                @endif
                <svg id="dropdownIcon" class="w-4 h-4 text-white transition-transform group-hover:rotate-180 duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            {{-- Dropdown Menu --}}
            <div id="dropdownMenu" class="absolute right-0 mt-2 w-[200px] bg-black/70  shadow-2xl hidden border border-gray-800">

                {{-- Profile List --}}
                <div class="py-2 border-b border-gray-800">
                    @if(isset($profiles))
                        @foreach($profiles as $profile)
                        <a href="{{ route('profiles.switch', $profile) }}" class="flex items-center px-2 py-1 hover:bg-white/10 transition no-underline!">
                            <img src="{{ $profile->avatar ?? asset('storage/netflix-avatar/Netflix-avatar.png') }}" alt="profile" loading="lazy" class="w-8 h-8 rounded mr-3">
                            <span class="text-white text-sm">{{ $profile->name }}</span>
                        </a>
                        @endforeach
                    @endif
                </div>

                {{-- Management Options --}}
                <div class="py-2 border-b border-gray-800">
                    {{-- Manage Profiles --}}
                    <a href="{{ route('profiles') }}" class="flex items-center px-2 py-1 hover:bg-white/10 transition no-underline!">
                        <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                        <span class="text-white text-sm">Manage Profiles</span>
                    </a>

                    {{-- Transfer Profile --}}
                    <a href="#" class="flex items-center px-2 py-1 hover:bg-white/10 transition no-underline!">
                        <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                        </svg>
                        <span class="text-white text-sm">Transfer Profile</span>
                    </a>

                    {{-- Account --}}
                    <a href="{{ route('accountSettings') }}" class="flex items-center px-2 py-1 hover:bg-white/10 transition no-underline!">
                        <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span class="text-white text-sm">Account</span>
                    </a>

                    {{-- Help Centre --}}
                    <a href="#" class="flex items-center px-2 py-1 hover:bg-white/10 transition no-underline!">
                        <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-white text-sm">Help Centre</span>
                    </a>
                </div>

                {{-- Sign Out --}}
                <div class="py-2">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full text-center px-2 py-1 hover:bg-white/10 transition text-white text-sm">
                            Sign out of Netflix
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</header>

<script src="{{ asset('assets/js/navbar.js') }} "></script>
@endif