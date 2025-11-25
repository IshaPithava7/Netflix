<x-layouts.app>

    @section('content')
    <style>
        /* Allow overlap between slides */
        .swiper-slide {
            width: 230px !important;
            overflow: visible !important;
            z-index: auto !important;
        }

        /* Ensure hovered card shows above all swiper slides */
        .swiper-slide:hover {
            z-index: 1000 !important;
        }

        /* Force swiper to allow overflow */
        .swiper {
            overflow: visible !important;
            padding: 100px 0 100px 0 !important;
            margin: -100px 0 -100px 0 !important;
        }

        /* Hover card base state */
        .hover-card {
            display: block !important;
            left: 50%;
            opacity: 0;
            transform: translateX(-50%) scale(0.8) translateY(0);
            transition: all 0.3s ease-in-out;
            pointer-events: none;
            visibility: hidden;
        }

        /* Hover card active state */
        .group\/card:hover .hover-card {
            opacity: 1 !important;
            visibility: visible !important;
            transform: translateX(-50%) scale(1.1) translateY(-100px) !important;
            pointer-events: auto !important;
            z-index: 10000 !important;
        }

        /* Thumbnail scale on hover */
        .thumbnail-card {
            transition: transform 0.3s ease;
        }

        .group\/card:hover .thumbnail-card {
            transform: scale(1.05);
        }

        /* Ensure proper z-index stacking */
        .group\/card {
            position: relative;
            z-index: 1;
        }

        .group\/card:hover {
            z-index: 99999 !important;
        }

        /* Prevent section overflow cutting */
        section {
            overflow: visible !important;
        }

        /* Main container overflow */
        body,
        html,
        .container {
            overflow-x: hidden !important;
            overflow-y: visible !important;
        }

        main {
            overflow-x: hidden !important;
            overflow-y: hidden !important;
        }

        /* Adjust hover card position for edge cards */
        .swiper-slide:first-child .hover-card {
            left: 0 !important;
            transform: translateX(0) scale(0.8) translateY(0);
        }

        .swiper-slide:first-child .group\/card:hover .hover-card {
            transform: translateX(0) scale(1.1) translateY(-60px) !important;
        }

        .swiper-slide:last-child .hover-card {
            left: auto !important;
            right: 0 !important;
            transform: translateX(0) scale(0.8) translateY(0);
        }

        .swiper-slide:last-child .group\/card:hover .hover-card {
            transform: translateX(0) scale(1.1) translateY(-60px) !important;
        }

        /* Fix for slides that are not visible */
        .swiper-slide-next .hover-card,
        .swiper-slide-prev .hover-card {
            display: block !important;
        }

        /* ========== ARROWS POSITIONED ON HALF SLIDES ========== */

        /* Remove swiper horizontal padding */
        .swiper.mySwiper {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }

        .mySwiper {
            overflow: visible !important;
            /* allow half slide to show */
        }

        /* Arrow base styles - OVERRIDE ALL TAILWIND CLASSES */
        .swiper-button-prev,
        .swiper-button-next {
            position: absolute !important;
            top: 100px !important;
            height: 130px !important;
            width: 50px !important;
            color: white !important;
            background: rgba(0, 0, 0, 0.5) !important;
            backdrop-filter: blur(4px);
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            opacity: 0 !important;
            transition: opacity 0.3s ease, background 0.3s ease !important;
            z-index: 100 !important;
            cursor: pointer !important;
            pointer-events: auto !important;
            transform: none !important;
            border-radius: 0 !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        .swiper-button-prev:hover,
        .swiper-button-next:hover {
            background: rgba(0, 0, 0, 0.8) !important;
        }

        /* Left arrow - compensate for ml-[50px] + px-[40px] */
        .swiper-button-prev {
            left: -60px !important;
            border-radius: 0 4px 4px 0 !important;
            padding-left: 20px !important;
            justify-content: flex-start !important;
        }

        /* Right arrow - compensate for px-[40px] */
        .swiper-button-next {
            right: -60px !important;
            border-radius: 4px 0 0 4px !important;
            padding-right: 20px !important;
            justify-content: flex-end !important;
        }

        /* Show arrows on section hover */
        .group\/section:hover .swiper-button-prev:not(.pointer-events-none),
        .group\/section:hover .swiper-button-next:not(.pointer-events-none) {
            opacity: 1 !important;
        }

        /* Hide default swiper button content */
        .swiper-button-prev::after,
        .swiper-button-next::after {
            display: none !important;
        }

        /* Ensure arrows don't interfere when disabled */
        .pointer-events-none {
            pointer-events: none !important;
            opacity: 0 !important;
        }

        /* Arrow icons styling */
        .swiper-button-prev i,
        .swiper-button-next i {
            font-size: 25px !important;
            color: white !important;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.8) !important;
        }

        /* Gradient effect for better visibility */
        .swiper-button-prev::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 50px;
            height: 100%;
            background: linear-gradient(to right, rgba(0, 0, 0, 0.7), transparent);
            z-index: -1;
        }

        .swiper-button-next::before {
            content: '';
            position: absolute;
            right: 0;
            top: 0;
            width: 50px;
            height: 100%;
            background: linear-gradient(to left, rgba(0, 0, 0, 0.7), transparent);
            z-index: -1;
        }
    </style>
    <div class="px-10">

        <div class="top-0 mt-[70px] z-50 bg-[#141414] px-8 md:px-16 pb-4">
            <div class="flex flex-wrap items-center gap-6 text-white">
                <h1 class="text-3xl font-medium">Browse by Languages</h1>

                <!-- Main container for dropdowns -->
                <div class="flex items-center space-x-4">

                    <!-- Preferences Dropdown -->
                    <div class="relative" id="preferences-dropdown-wrapper">
                        <span class="text-sm text-gray-400 mr-2">Select Your Preferences</span>
                        <button id="preferences-button"
                            class="inline-flex items-center justify-between w-48 px-3 py-2 text-sm font-medium text-white bg-transparent border border-gray-500 rounded-md hover:border-white focus:outline-none">
                            <span>Original Language</span>
                            <svg class="w-4 h-4 ml-2 -mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div id="preferences-menu"
                            class="absolute left-0 z-10 w-48 mt-2 origin-top-right bg-black border border-gray-700 rounded-md shadow-lg opacity-0 invisible transition-all duration-200">
                            <div class="py-1">
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-white hover:bg-gray-800">Original
                                    Language</a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-white hover:bg-gray-800">Dubbing</a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-white hover:bg-gray-800">Subtitles</a>
                            </div>
                        </div>
                    </div>

                    <!-- Language Dropdown -->
                    <div class="relative" id="language-dropdown-wrapper">
                        <button id="language-button"
                            class="inline-flex items-center justify-between w-48 px-3 py-2 text-sm font-medium text-white bg-transparent border border-gray-500 rounded-md hover:border-white focus:outline-none">
                            <span>English</span>
                            <svg class="w-4 h-4 ml-2 -mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div id="language-menu"
                            class="absolute left-0 z-10 w-48 mt-2 origin-top-right bg-black border border-gray-700 rounded-md shadow-lg opacity-0 invisible transition-all duration-200 max-h-60 overflow-y-auto">
                            <div class="py-1">
                                <a href="#" class="block px-4 py-2 text-sm text-white hover:bg-gray-800">Indonesian</a>
                                <a href="#" class="block px-4 py-2 text-sm text-white hover:bg-gray-800">Malay</a>
                                <a href="#" class="block px-4 py-2 text-sm text-white hover:bg-gray-800">Turkish</a>
                                <a href="#" class="block px-4 py-2 text-sm text-white hover:bg-gray-800">English</a>
                                <a href="#" class="block px-4 py-2 text-sm text-white hover:bg-gray-800">Japanese</a>
                                <a href="#" class="block px-4 py-2 text-sm text-white hover:bg-gray-800">Spanish</a>
                                <a href="#" class="block px-4 py-2 text-sm text-white hover:bg-gray-800">French</a>
                                <a href="#" class="block px-4 py-2 text-sm text-white hover:bg-gray-800">Hindi</a>
                                <a href="#" class="block px-4 py-2 text-sm text-white hover:bg-gray-800">Korean</a>
                                <a href="#" class="block px-4 py-2 text-sm text-white hover:bg-gray-800">German</a>
                                <a href="#" class="block px-4 py-2 text-sm text-white hover:bg-gray-800">Mandarin</a>
                                <a href="#" class="block px-4 py-2 text-sm text-white hover:bg-gray-800">Italian</a>
                                <a href="#" class="block px-4 py-2 text-sm text-white hover:bg-gray-800">Portuguese</a>
                                <a href="#" class="block px-4 py-2 text-sm text-white hover:bg-gray-800">Cantonese</a>
                                <a href="#" class="block px-4 py-2 text-sm text-white hover:bg-gray-800">Dutch</a>
                                <a href="#" class="block px-4 py-2 text-sm text-white hover:bg-gray-800">Filipino</a>
                                <a href="#" class="block px-4 py-2 text-sm text-white hover:bg-gray-800">Polish</a>
                                <a href="#" class="block px-4 py-2 text-sm text-white hover:bg-gray-800">Swedish</a>
                                <a href="#" class="block px-4 py-2 text-sm text-white hover:bg-gray-800">Arabic</a>
                                <a href="#" class="block px-4 py-2 text-sm text-white hover:bg-gray-800">Tamil</a>
                                <a href="#" class="block px-4 py-2 text-sm text-white hover:bg-gray-800">Danish</a>
                            </div>
                        </div>
                    </div>

                    <!-- Sort By Dropdown -->
                    <div class="relative" id="sort-dropdown-wrapper">
                        <span class="text-sm text-gray-400 mr-2">Sort by</span>
                        <button id="sort-button"
                            class="inline-flex items-center justify-between w-48 px-3 py-2 text-sm font-medium text-white bg-transparent border border-gray-500 rounded-md hover:border-white focus:outline-none">
                            <span>Suggestions For You</span>
                            <svg class="w-4 h-4 ml-2 -mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                        </button>
                        <div id="sort-menu"
                            class="absolute right-0 z-10 w-48 mt-2 origin-top-right bg-black border border-gray-700 rounded-md shadow-lg opacity-0 invisible transition-all duration-200">
                            <div class="py-1">
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-white hover:bg-gray-800">Suggestions
                                    for you</a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-white hover:bg-gray-800">Year
                                    Released</a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-white hover:bg-gray-800">A-Z</a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-white hover:bg-gray-800">Z-A</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @foreach($collections as $collection)

        <section class="mb-12 px-10 relative group/section">

            <h2 class="text-2xl font-bold mb-4 text-white">
                {{ $collection->title }}
            </h2>

            <div class="swiper mySwiper">
                <div class="swiper-wrapper">

                    @foreach($collection->videos as $video)

                    @php
                    $poster = $video->poster;
                    if ($poster && !filter_var($poster, FILTER_VALIDATE_URL)) {
                    $poster = asset('storage/' . $poster);
                    }
                    @endphp

                    <div class="swiper-slide">

                        <!-- Inner group for each card -->
                        <div class="group/card relative w-[230px] h-[130px]">

                            {{-- Video Card (Thumbnail) - Always Visible --}}
                            <div
                                class="thumbnail-card relative bg-gray-900 shadow-lg overflow-hidden w-[230px] h-[130px] rounded-md cursor-pointer">
                                <img src="{{ $poster }}" alt="{{ $video->title }}"
                                    class="w-[230px] h-[130px] object-cover" loading="lazy">
                            </div>

                            {{-- Hover Card (Expanded View) - Appears on Hover --}}
                            <div
                                class="hover-card absolute left-1/2 top-0 w-[320px] rounded-lg overflow-hidden shadow-2xl bg-[#181818]">

                                {{-- Video/Image Section --}}
                                <div class="relative">
                                    @if($video->file_path)
                                    <video class="w-full h-[180px] object-cover" preload="none" autoplay muted loop
                                        poster="{{ $poster }}">
                                        <source src="{{ asset('storage/' . $video->file_path) }}" type="video/mp4">
                                    </video>
                                    @else
                                    <img src="{{ $poster }}" alt="{{ $video->title }}"
                                        class="w-full h-[180px] object-cover" loading="lazy">
                                    @endif

                                    {{-- Gradient Overlay --}}
                                    <div
                                        class="absolute inset-0 bg-linear-to-t from-[#181818] via-transparent to-transparent">
                                    </div>

                                    {{-- Title Logo --}}
                                    @if($video->title_poster)
                                    <img src="{{ asset('storage/' . $video->title_poster) }}" alt="{{ $video->title }}" loading="lazy"
                                        class="absolute bottom-3 left-4 w-auto h-10 object-contain drop-shadow-lg">
                                    @endif
                                </div>

                                {{-- Card Info Section --}}
                                <div class="p-4 space-y-3">

                                    {{-- Action Buttons --}}
                                    <div class="flex items-center justify-between">
                                        <div class="flex space-x-2">
                                            <button
                                                class="bg-white text-black rounded-full! w-9 h-9 flex items-center justify-center hover:bg-gray-300 transition shadow-md">
                                                <i class="fa-solid fa-play text-sm"></i>
                                            </button>
                                            <button
                                                class="border-2 border-gray-500 text-white rounded-full! w-9 h-9 flex items-center justify-center hover:border-white hover:bg-gray-700 transition">
                                                <i class="fa-solid fa-plus text-sm"></i>
                                            </button>
                                            <button
                                                class="border-2 border-gray-500 text-white rounded-full! w-9 h-9 flex items-center justify-center hover:border-white hover:bg-gray-700 transition">
                                                <i class="fa-solid fa-thumbs-up text-sm"></i>
                                            </button>
                                        </div>
                                        <button
                                            class="border-2 border-gray-500 text-white rounded-full! w-9 h-9 flex items-center justify-center hover:border-white hover:bg-gray-700 transition">
                                            <i class="fa-solid fa-chevron-down text-sm"></i>
                                        </button>
                                    </div>

                                    {{-- Video Title --}}
                                    <h3 class="text-base font-semibold text-white line-clamp-1">{{ $video->title }}</h3>

                                    {{-- Meta Information --}}
                                    <div class="flex items-center space-x-2 text-xs">
                                        <span class="text-green-500 font-semibold">98% Match</span>
                                        <span class="border border-gray-500 px-1 text-gray-400">U/A 13+</span>
                                        <span class="text-gray-400">{{ $video->duration ?? '1h 52m' }}</span>
                                        <span class="border border-gray-500 px-1 text-xs text-gray-400">HD</span>
                                    </div>

                                    {{-- Genres --}}
                                    <div class="flex items-center space-x-1 text-xs text-gray-400">
                                        <span>Thriller</span>
                                        <span>•</span>
                                        <span>Drama</span>
                                        <span>•</span>
                                        <span>Mystery</span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Navigation Arrows -->
            <div class="swiper-button-prev">
                <i class="fa-solid fa-chevron-left"></i>
            </div>

            <div class="swiper-button-next">
                <i class="fa-solid fa-chevron-right"></i>
            </div>
        </section>
        @endforeach
    </div>
    @endsection

</x-layouts.app>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
    // Handles toggling dropdown menus and closing them when clicking outside.
    function setupDropdown(buttonId, menuId) {
        const button = document.getElementById(buttonId);
        const menu = document.getElementById(menuId);

        if (button && menu) {
            // Add a common class to all dropdown menus for easier selection
            menu.classList.add('dropdown-menu');

            button.addEventListener('click', (event) => {
                event.stopPropagation();
                const isCurrentlyVisible = !menu.classList.contains('invisible');

                // First, hide all dropdown menus
                document.querySelectorAll('.dropdown-menu').forEach(m => {
                    m.classList.add('opacity-0', 'invisible');
                });

                // If the clicked menu was not already visible, show it
                if (!isCurrentlyVisible) {
                    menu.classList.remove('opacity-0', 'invisible');
                }
            });
        }
    }

    // Initializes all Swiper carousels on the page with Netflix-style navigation.
    function swiperInit() {
        $('.mySwiper').each(function() {
            const swiperEl = this;
            const $container = $(swiperEl).closest('.group\\/section');
            const slideCount = $(swiperEl).find('.swiper-slide').length;
            const enableLoop = slideCount > 6; // Loop if there are more slides than visible
            let loopActivated = false;
            let swiper;

            swiper = new Swiper(swiperEl, {
                slidesPerView: 6.5,
                spaceBetween: 6,
                slidesPerGroup: 6,
                speed: 600,
                loop: false, // Start without loop
                watchOverflow: true,
                navigation: {
                    nextEl: $container.find('.swiper-button-next')[0],
                    prevEl: $container.find('.swiper-button-prev')[0],
                },
                breakpoints: {
                    1440: {
                        slidesPerView: 6.5,
                        slidesPerGroup: 6
                    },
                    1280: {
                        slidesPerView: 5.5,
                        slidesPerGroup: 5
                    },
                    1024: {
                        slidesPerView: 4.5,
                        slidesPerGroup: 4
                    },
                    768: {
                        slidesPerView: 3.5,
                        slidesPerGroup: 3
                    },
                    640: {
                        slidesPerView: 2.5,
                        slidesPerGroup: 2
                    },
                },
                on: {
                    init: function() {
                        // Initially disable prev button
                        if (this.isBeginning) {
                            $(this.navigation.prevEl).addClass('pointer-events-none');
                        }
                    },
                    slideChange: function() {
                        // Disable/enable nav buttons if not looping
                        if (!this.params.loop) {
                            $(this.navigation.prevEl).toggleClass('pointer-events-none', this.isBeginning);
                            $(this.navigation.nextEl).toggleClass('pointer-events-none', this.isEnd);
                        }
                    },
                },
            });

            // Special logic to enable loop on first "next" click
            $container.find('.swiper-button-next').on('click.firstNext', function() {
                if (!loopActivated && enableLoop) {
                    loopActivated = true;
                    const currentIndex = swiper.activeIndex;
                    swiper.destroy(true, true);

                    // Re-initialize Swiper with loop enabled
                    swiper = new Swiper(swiperEl, {
                        slidesPerView: 6.5,
                        spaceBetween: 6,
                        slidesPerGroup: 6,
                        speed: 600,
                        loop: true,
                        initialSlide: currentIndex,
                        watchOverflow: true,
                        navigation: {
                            nextEl: $container.find('.swiper-button-next')[0],
                            prevEl: $container.find('.swiper-button-prev')[0],
                        },
                        breakpoints: {
                            1440: {
                                slidesPerView: 6.5,
                                slidesPerGroup: 6
                            },
                            1280: {
                                slidesPerView: 5.5,
                                slidesPerGroup: 5
                            },
                            1024: {
                                slidesPerView: 4.5,
                                slidesPerGroup: 4
                            },
                            768: {
                                slidesPerView: 3.5,
                                slidesPerGroup: 3
                            },
                            640: {
                                slidesPerView: 2.5,
                                slidesPerGroup: 2
                            },
                        },
                    });

                    // No longer need to manually manage button state
                    $(swiper.navigation.prevEl).removeClass('pointer-events-none');
                    $(swiper.navigation.nextEl).removeClass('pointer-events-none');
                    $(this).off('click.firstNext');
                }
            });
        });
    }

    // Set up dropdowns and global click listener when the page is ready
    document.addEventListener('DOMContentLoaded', () => {
        setupDropdown('preferences-button', 'preferences-menu');
        setupDropdown('language-button', 'language-menu');
        setupDropdown('sort-button', 'sort-menu');

        document.addEventListener('click', () => {
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                menu.classList.add('opacity-0', 'invisible');
            });
        });
    });

    // Initial call to set up the carousels
    swiperInit();
</script>