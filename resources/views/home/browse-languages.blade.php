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

        <div class="top-0 mt-[70px] z-50  bg-[#141414] px-8 md:px-16 pb-4 ">
            <div class="flex flex-wrap items-center gap-6 text-white">
                <!-- Browse by Languages Label (not clickable) -->
                <p class="text-3xl font-medium opacity-90">
                    Browse by Languages
                </p>

                <!-- 1. Original Language Dropdown -->
                <div class="relative group inline-block">
                    <button
                        class="flex items-center gap-2 bg-black border border-gray-500 px-4 py-2 text-white font-medium rounded hover:border-white transition">
                        <span>Original Language</span>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <div
                        class="absolute left-0 mt-2 w-56 bg-black border border-gray-700 rounded-md shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                        <div class="py-2 max-h-80 overflow-y-auto">
                            <a href="#" class="block px-4 py-2 text-gray-300 hover:bg-gray-900 hover:text-white">All
                                Languages</a>
                            <a href="#"
                                class="block px-4 py-2 text-gray-300 hover:bg-gray-900 hover:text-white">English</a>
                            <a href="#"
                                class="block px-4 py-2 text-gray-300 hover:bg-gray-900 hover:text-white">Hindi</a>
                            <a href="#"
                                class="block px-4 py-2 text-gray-300 hover:bg-gray-900 hover:text-white">Spanish</a>
                            <a href="#"
                                class="block px-4 py-2 text-gray-300 hover:bg-gray-900 hover:text-white">Korean</a>
                            <!-- Add more languages as needed -->
                        </div>
                    </div>
                </div>

                <!-- 2. Audio & Subtitles Dropdown (English selected) -->
                <div class="relative group inline-block">
                    <button
                        class="flex items-center gap-2 bg-black border border-gray-500 px-4 py-2 text-white font-medium rounded hover:border-white transition">
                        <span>English</span>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <div
                        class="absolute left-0 mt-2 w-56 bg-black border border-gray-700 rounded-md shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                        <div class="py-2 max-h-80 overflow-y-auto">
                            <a href="#"
                                class="block px-4 py-2 text-gray-300 hover:bg-gray-900 hover:text-white">English</a>
                            <a href="#"
                                class="block px-4 py-2 text-gray-300 hover:bg-gray-900 hover:text-white">Spanish</a>
                            <a href="#"
                                class="block px-4 py-2 text-gray-300 hover:bg-gray-900 hover:text-white">French</a>
                            <a href="#"
                                class="block px-4 py-2 text-gray-300 hover:bg-gray-900 hover:text-white">German</a>
                            <!-- Add more -->
                        </div>
                    </div>
                </div>

                <!-- 3. Sort by Dropdown -->
                <div class="relative group inline-block">
                    <button
                        class="flex items-center gap-2 bg-black border border-gray-500 px-4 py-2 text-white font-medium rounded hover:border-white transition">
                        <span>Sort by</span>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <div
                        class="absolute left-0 mt-2 w-64 bg-black border border-gray-700 rounded-md shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                        <div class="py-2">
                            <a href="#"
                                class="block px-4 py-2 text-gray-300 hover:bg-gray-900 hover:text-white">Suggestions For
                                You</a>
                            <a href="#" class="block px-4 py-2 text-gray-300 hover:bg-gray-900 hover:text-white">Year
                                Released</a>
                            <a href="#" class="block px-4 py-2 text-gray-300 hover:bg-gray-900 hover:text-white">A-Z</a>
                            <a href="#" class="block px-4 py-2 text-gray-300 hover:bg-gray-900 hover:text-white">Z-A</a>
                        </div>
                    </div>
                </div>

                <!-- 4. Suggestions For You Dropdown (optional – can be merged with Sort by) -->
                <div class="relative group inline-block">
                    <button
                        class="flex items-center gap-2 bg-black border border-gray-500 px-4 py-2 text-white font-medium rounded hover:border-white transition">
                        <span>Suggestions For You</span>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <div
                        class="absolute left-0 mt-2 w-64 bg-black border border-gray-700 rounded-md shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                        <div class="py-2">
                            <a href="#"
                                class="block px-4 py-2 text-gray-300 hover:bg-gray-900 hover:text-white">Suggestions For
                                You</a>
                            <a href="#"
                                class="block px-4 py-2 text-gray-300 hover:bg-gray-900 hover:text-white">Trending
                                Now</a>
                            <a href="#" class="block px-4 py-2 text-gray-300 hover:bg-gray-900 hover:text-white">New
                                Releases</a>
                            <a href="#" class="block px-4 py-2 text-gray-300 hover:bg-gray-900 hover:text-white">Top
                                10</a>
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
    swiperInit();

    // swiper wiper
    function swiperInit() {
        $('.mySwiper').each(function() {

            const swiperEl = this;
            const $container = $(swiperEl).closest('.relative');
            const slideCount = $(swiperEl).find('.swiper-slide').length;

            const enableLoop = slideCount >= 7;
            let loopActivated = false;
            let swiper;


            // --- FIRST SWIPER (no loop, first slide Netflix style) ---
            swiper = new Swiper(swiperEl, {
                slidesPerView: 6.5,
                spaceBetween: 6,
                slidesPerGroup: 6,
                speed: 600,
                loop: false,
                centeredSlides: false,

                // ⭐ Fix slide width calculations
                watchOverflow: true,
                resizeObserver: true,
                observer: true,
                observeParents: true,

                navigation: {
                    nextEl: $container.find('.swiper-button-next')[0],
                    prevEl: $container.find('.swiper-button-prev')[0],
                },

                breakpoints: {
                    1600: {
                        slidesPerView: 6.5,
                        slidesPerGroup: 6
                    },
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
                    init() {
                        const $prev = $container.find('.swiper-button-prev');
                        const $next = $container.find('.swiper-button-next');

                        $prev.addClass('pointer-events-none opacity-0');

                        $next.on('click.firstNext', function() {
                            if (!loopActivated && enableLoop) {
                                loopActivated = true;
                                const currentIndex = swiper.activeIndex;

                                swiper.destroy(true, true);

                                swiper = new Swiper(swiperEl, {
                                    slidesPerView: 6.5,
                                    spaceBetween: 6,
                                    slidesPerGroup: 6,
                                    speed: 600,
                                    loop: true,
                                    initialSlide: currentIndex,

                                    // ⭐ Apply the same fixes to the loop version
                                    watchOverflow: true,
                                    resizeObserver: true,
                                    observer: true,
                                    observeParents: true,

                                    navigation: {
                                        nextEl: $container.find('.swiper-button-next')[0],
                                        prevEl: $container.find('.swiper-button-prev')[0],
                                    },

                                    breakpoints: {
                                        1600: {
                                            slidesPerView: 6.5,
                                            slidesPerGroup: 6
                                        },
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
                                    }
                                });

                                $prev.removeClass('pointer-events-none opacity-0');
                                $next.off('click.firstNext');
                            }
                        });
                    }
                }
            });

        });
    }
</script>