<x-layouts.app title="Home Page">

    @section('content')
    <style>
        body {
            overflow-x: hidden;
        }

        .mySwiper {
            overflow: visible;
        }

        .mySwiper {
            position: relative;
            overflow: visible !important;
        }

        .swiper-slide {
            overflow: visible !important;
            position: relative;
            z-index: 1;
        }

        .swiper-slide .hover-card {
            position: absolute;
            top: -60px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 9999;
            visibility: hidden;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .swiper-slide:hover .hover-card {
            visibility: visible;
            opacity: 1;
            transform: translateX(-50%) scale(1.1);
        }

        .swiper,
        .swiper-wrapper {
            overflow: visible !important;
        }

        .swiper,
        .swiper-wrapper,
        .swiper-slide {
            overflow: visible !important;
        }

        .mySwiper {
            overflow: visible !important;
            position: relative;
            z-index: 1;
        }

        section {
            overflow: visible !important;
        }

        .swiper-slide .hover-card {
            bottom: auto;
            top: 100%;
            transform: translateX(-50%);
        }

        .swiper-slide {
            z-index: 1 !important;
            position: relative !important;
        }

        .group:hover {
            z-index: 9999 !important;
        }

        .swiper-button-next {
            right: 10px;
        }

        .toggle-mylist svg {
            transition: transform 0.2s ease, fill 0.2s ease;
        }

        .toggle-mylist:active svg {
            transform: scale(1.3);
        }

        .swiper-button-prev,
        .swiper-button-next {
            position: absolute;
            z-index: 10;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s ease;
            border: none;
            outline: none;
        }

        .swiper-button-prev {
            left: 0;
            border-radius: 0 4px 4px 0;
        }

        .swiper-button-next {
            right: 0;
            border-radius: 4px 0 0 4px;
        }

        .swiper-button-prev::after,
        .swiper-button-next::after {
            content: '';
            display: none;
        }

        .swiper-button-prev svg,
        .swiper-button-next svg {
            width: 32px;
            height: 32px;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.3));
        }

        .swiper-button-disabled {
            opacity: 0;
            pointer-events: none;
        }

        .swiper-navigation-icon {
            display: none;
        }
    </style>

    <div class="bg-[#141414] min-h-screen text-white mb-12">
        <main class="grow">

            {{-- hero banner --}}
            @if($heroCollection && $heroCollection->videos->isNotEmpty())
            @php
            $featured = $heroCollection->videos->first();
            $poster = $featured->poster;
            if ($poster && !filter_var($poster, FILTER_VALIDATE_URL)) {
            $poster = asset('storage/' . $poster);
            }

            $titlePoster = $featured->title_poster;
            if ($titlePoster && !filter_var($titlePoster, FILTER_VALIDATE_URL)) {
            $titlePoster = asset('storage/' . $titlePoster);
            }
            @endphp

            <section class="relative mb-12">
                <div id="moviesHeader"
                    class="sticky top-0 mt-[70px] z-10 bg-transparent px-8 md:px-16 transition-colors duration-300 py-2">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <h1 class="text-4xl md:text-5xl font-black text-white mr-10">
                                Movies
                            </h1>
                            <!-- Genres Dropdown (Real Netflix Style) -->
                            <div id="genres-dropdown" class="relative inline-block">
                                <button id="genres-button"
                                    class="flex items-center bg-black border border-gray-500 p-1 text-white font-medium hover:border-white transition">
                                    <span>Genres</span>
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                                <div id="genres-menu"
                                    class="absolute left-0 mt-2 w-[700px] bg-black bg-opacity-90 border border-gray-700 rounded-md shadow-2xl transition-all duration-300 z-50 opacity-0 invisible p-6">
                                    <div class="grid grid-cols-3 gap-x-8 gap-y-2">
                                        @foreach($collectionGenre as $column)
                                        <div class="flex flex-col space-y-2">
                                            @foreach($column as $genre)
                                            <a href="#"
                                                class="text-gray-300 hover:underline whitespace-nowrap">
                                                {{ $genre }}
                                            </a>
                                            @endforeach
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button class="p-1 border border-gray-500 rounded-sm">
                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                        d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </button>
                            <button class="p-1 border border-gray-500 rounded-sm">
                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                        d="M4 6h16M4 12h16M4 18h7"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="relative w-full h-[800px] overflow-hidden shadow-2xl">
                    <!-- Poster -->
                    <img id="heroPoster" src="{{ $poster }}" alt="{{ $featured->title }}"
                        class="w-full h-full object-cover absolute inset-0 transition-opacity duration-700 opacity-100"
                        fetchpriority="high">

                    <!-- Video -->
                    @if($featured->file_path)
                    <video id="heroVideo"
                        class="w-full h-full object-cover absolute inset-0 opacity-0 transition-opacity duration-700"
                        muted playsinline preload="auto" poster="{{ $poster }}">
                        <source src="{{ asset('storage/' . $featured->file_path) }}" type="video/mp4">
                    </video>
                    @endif

                    {{-- Overlay --}}
                    <div class="absolute inset-0 bg-linear-to-t from-black via-black/40 to-transparent"></div>

                    <div class="absolute inset-0 pointer-events-none">

                        <!-- Bottom blur/fade -->
                        <div
                            class="absolute bottom-0 left-0 w-full h-15 bg-linear-to-t from-[#181818] to-transparent ">
                        </div>
                    </div>

                    {{-- Text --}}
                    <div class="absolute bottom-75 left-15 z-10 transition-opacity duration-700 opacity-100">
                        <img src="{{ asset('storage/' . $featured->title_poster) }}" alt="{{ $featured->title }}"
                            id="titlePoster" class="mb-4 w-[500px] h-auto object-contain transition-all duration-700">
                        <p id="heroText" class="text-white font-medium max-w-lg mb-6 font-open-sans">
                            {{ $featured->description }}
                        </p>

                        <!-- Buttons -->
                        <div class="flex space-x-4">
                            <button
                                class="bg-[#FFFFFF] text-black font-bold w-[126px] h-[46px] rounded-md! justify-center hover:bg-[#C3C1C1] transition duration-300 flex items-center space-x-2">
                                <svg viewBox="0 0 24 24" width="24" height="24" fill="none">
                                    <path
                                        d="M5 2.69127C5 1.93067 5.81547 1.44851 6.48192 1.81506L23.4069 11.1238C24.0977 11.5037 24.0977 12.4963 23.4069 12.8762L6.48192 22.1849C5.81546 22.5515 5 22.0693 5 21.3087V2.69127Z"
                                        fill="currentColor"></path>
                                </svg>
                                <video id="heroVideo"
                                    class="w-full h-full object-cover absolute inset-0 opacity-0 transition-opacity duration-700"
                                    muted playsinline preload="auto" poster="{{ $poster }}">
                                    <source src="{{ asset('storage/' . $featured->file_path) }}" type="video/mp4">
                                </video>
                                <span>Play</span>
                            </button>

                            <!-- hero banner -->
                            <button id="moreInfoBtn"
                                class=" bg-[#6d6d6e] mr-0.5 text-[#ffffff]! opacity-[0.7] font-bold w-[172px] h-[46px] rounded-md! justify-center hover:bg-[#403A36] transition duration-300 flex items-center space-x-2"
                                data-video-id="{{ $featured->id }}" data-title="{{ $featured->title }}"
                                data-description="{{ $featured->description }}"
                                data-duration="{{ $featured->duration ?? '1h 52m' }}" data-poster="{{ $poster }}"
                                data-file="{{ $featured->file_path ? asset('storage/' . $featured->file_path) : '' }}"
                                data-title-poster="{{ $featured->title_poster ? asset('storage/' . $featured->title_poster) : '' }}"
                                data-genres="{{ $additionalSection['metadata']['genre'] ?? 'Drama • Action' }}">
                                <svg viewBox="0 0 24 24" width="24" height="24" data-icon="CircleIMedium"
                                    data-icon-id=":r25:" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" role="img">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2ZM0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12ZM13 10V18H11V10H13ZM12 8.5C12.8284 8.5 13.5 7.82843 13.5 7C13.5 6.17157 12.8284 5.5 12 5.5C11.1716 5.5 10.5 6.17157 10.5 7C10.5 7.82843 11.1716 8.5 12 8.5Z"
                                        fill="currentColor"></path>

                                </svg>
                                <span class="text-[#ffffff]!">More Info</span>
                            </button>
                        </div>
                    </div>
                </div>


                {{-- Top 10 Shows Section --}}
                @include('home.top_10.top_10_shows')
            </section>
            @endif

            {{-- Sections loop --}}
            <div id="collections-container" class="">
                {{-- collections  --}}
                @foreach($mainCollections->take(3) as $collection)
                @include('home.collections.collection_section', ['collections' => [$collection]])
                @endforeach
            </div>


            <!-- Skeleton Loader (6 Cards) -->
            <div id="loader" role="status" class="grid grid-cols-6 ml-20 animate-pulse">
                <!-- Card 1 -->
                <div class="flex flex-col space-y-2">
                    <div class="w-60 h-[150px] bg-gray-300 rounded-md dark:bg-[#101828]">
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="flex flex-col space-y-2">
                    <div class="w-60 h-[150px] bg-gray-300 rounded-md dark:bg-[#101828]"></div>
                </div>

                <!-- Card 3 -->
                <div class="flex flex-col space-y-2">
                    <div class="w-60 h-[150px] bg-gray-300 rounded-md dark:bg-[#101828]"></div>
                </div>

                <!-- Card 4 -->
                <div class="flex flex-col space-y-2">
                    <div class="w-60 h-[150px] bg-gray-300 rounded-md dark:bg-[#101828]"></div>
                </div>

                <!-- Card 5 -->
                <div class="flex flex-col space-y-2">
                    <div class="w-60 h-[150px] bg-gray-300 rounded-md dark:bg-[#101828]"></div>
                </div>
            </div>



        </main>
    </div>

    {{-- modals --}}
    @if(isset($featured) && $featured)
        @include('home.models.more_info_model', ['featured' => $featured, 'poster' => $featured->poster ? asset('storage/' . $featured->poster) : asset('defaults/poster.jpg')])
        @include('home.models.section_more_info_model')
    @endif


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {

            /* ===============================
                HERO ANIMATION
               =============================== */
            const $heroVideo = $("#heroVideo");
            const $heroPoster = $("#heroPoster");
            const $heroText = $("#heroText");
            const $titlePoster = $("#titlePoster");

            if ($heroVideo.length && $heroPoster.length && $heroText.length && $titlePoster.length) {
                setTimeout(() => {
                    $titlePoster.removeClass("w-[500px]").addClass("w-[300px] transition-all duration-700");
                    $heroPoster.addClass("opacity-0");
                    $heroText.hide();
                    $heroVideo.removeClass("opacity-0").get(0).play();
                }, 5000);

                $heroVideo.on("ended", function() {
                    $heroVideo.addClass("opacity-0");
                    $heroPoster.removeClass("opacity-0");
                    $titlePoster.removeClass("w-[300px]").addClass("w-[500px]");
                    $heroText.show();
                });
            }


            /* ===============================
                MODAL BEHAVIOR
               =============================== */
            const $modal = $("#movieModal");
            const $modalPoster = $("#modalPoster");
            const $modalVideo = $("#modalVideo");
            const $modalTitlePoster = $("#modalTitlePoster");
            const $closeModal = $("#closeModal");
            const $moreInfoBtn = $("#moreInfoBtn");

            if ($modal.length && $modalPoster.length && $modalVideo.length && $modalTitlePoster.length && $closeModal.length) {

                // Function to play modal video
                function playModalVideo() {
                    $modalPoster.removeClass("opacity-0");
                    $modalVideo.addClass("opacity-0");
                    $modalTitlePoster.addClass("w-[300px]").removeClass("w-[200px]");

                    setTimeout(() => {
                        $modalTitlePoster.removeClass("w-[300px]").addClass("w-[200px]");
                        $modalPoster.addClass("opacity-0");
                        $modalVideo.removeClass("opacity-0").get(0).play();
                    }, 3000);

                    $modalVideo.off("ended").on("ended", function() {
                        $modalVideo.addClass("opacity-0");
                        $modalPoster.removeClass("opacity-0");
                        $modalTitlePoster.removeClass("w-[200px]").addClass("w-[300px]");
                    });
                }

                // OPEN MODAL
                $moreInfoBtn.on("click", function() {
                    $modal.removeClass("opacity-0 pointer-events-none").addClass("opacity-100");
                    $('body').css('overflow', 'hidden');
                    if ($heroVideo.length) $heroVideo.get(0).pause();
                    playModalVideo();
                });

                // CLOSE MODAL
                $closeModal.on("click", function() {
                    $modal.addClass("opacity-0 pointer-events-none").removeClass("opacity-100");
                    $('body').css('overflow', 'auto');
                    $modalVideo.get(0).pause();
                    if ($heroVideo.length) $heroVideo.get(0).play();

                });

                // CLICK OUTSIDE MODAL TO CLOSE
                $modal.on("click", function(e) {
                    if (e.target === this) {
                        $modal.addClass("opacity-0 pointer-events-none").removeClass("opacity-100");
                        $('body').css('overflow', 'auto');
                        $modalVideo.get(0).pause();
                        if ($heroVideo.length) $heroVideo.get(0).play();
                    }
                });
            }


            /* ===============================
                HOVER CARD VIDEO PREVIEW
               =============================== */
            $('.hover-card').each(function() {
                const $card = $(this);
                const $video = $card.find('video');
                const videoEl = $video.get(0);

                // Start hidden (poster visible)
                $video.addClass('opacity-0');

                $card.hover(
                    function() { // Mouse enter
                        setTimeout(function() {
                            videoEl.currentTime = 0;
                            $video.removeClass('opacity-0');
                            videoEl.play();
                        }, 300);

                    },
                    function() { // Mouse leave
                        videoEl.pause();
                        videoEl.currentTime = 0;
                        $video.addClass('opacity-0');
                    }
                );

                $video.on('ended', function() {
                    $video.addClass('opacity-0');
                    videoEl.currentTime = 0;
                });
            });


            /* ===============================
                TOGGLE "MY LIST" LOGIC
               =============================== */
            $(document).on('click', '.toggle-mylist', function() {
                const $button = $(this);
                const videoId = $button.data('video-id');
                const $icons = $(`[id="mylist-icon-${videoId}"]`);
                const isInList = $icons.first().find('path[d*="M5 13l4 4L19 7"]').length > 0;

                // Optimistic UI Toggle
                if (isInList) {
                    $icons.html(`<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />`);
                } else {
                    $icons.html(`<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />`);
                }

                // Pop animation
                $icons.addClass('scale-125 transition-transform duration-150');
                setTimeout(() => $icons.removeClass('scale-125'), 150);

                // AJAX Request
                $.ajax({
                    url: "{{ route('mylist.toggle') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        video_id: videoId
                    },
                    success: function() {
                        showToast(isInList ? "Removed from My List ❌" : "Added to My List ✅");
                    },
                    error: function() {
                        // Revert UI on failure
                        if (isInList) {
                            $icons.html(`<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />`);
                        } else {
                            $icons.html(`<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />`);
                        }
                        showToast("Something went wrong ⚠️");
                    }
                });
            });


            /* ===============================
                TOAST NOTIFICATION HELPER
               =============================== */
            function showToast(message) {
                const $toast = $(`<div class="fixed bottom-8 left-1/2 -translate-x-1/2 bg-white text-black px-4 py-2 rounded-lg shadow-lg text-sm font-semibold z-[9999] opacity-0 transition-opacity duration-300">${message}</div>`);
                $('body').append($toast);
                setTimeout(() => $toast.css('opacity', '1'), 10);
                setTimeout(() => $toast.fadeOut(300, () => $toast.remove()), 1500);
            }



            // decrypt response
            function decryptResponse(encryptedHex) {
                try {
                    // Decode Base64 key and IV from Laravel’s config
                    const key = CryptoJS.enc.Base64.parse("{{ config('app.encryption_key') }}");
                    const iv = CryptoJS.enc.Base64.parse("{{ config('app.encryption_iv') }}");

                    // Convert the hex string (Laravel’s output) to bytes
                    const encrypted = CryptoJS.enc.Hex.parse(encryptedHex);

                    // Decrypt using AES-256-CBC
                    const decrypted = CryptoJS.AES.decrypt({
                            ciphertext: encrypted
                        },
                        key, {
                            iv: iv,
                            mode: CryptoJS.mode.CBC,
                            padding: CryptoJS.pad.Pkcs7
                        }
                    );

                    // Convert bytes back to UTF-8 text
                    return decrypted.toString(CryptoJS.enc.Utf8);

                } catch (e) {
                    console.error("❌ Decryption error:", e);
                    return null;
                }
            }

            let page = 2; // start from next page
            let loading = false;
            let done = false;

            // 👇 define globally so you can test it in console
            window.loadMoreCollections = function() {
                if (loading || done) {
                    // console.log("Skipping... loading:", loading, "done:", done);
                    return;
                }

                loading = true;
                // console.log("Loading page", page);

                $('#loader').removeClass('hidden');

                $.ajax({
                    url: '/collections/load-more',
                    type: 'GET',
                    data: {
                        page: page
                    },
                    dataType: 'text',
                    success: function(encryptedHex) {
                        try {
                            // 🔓 Step 1: Decrypt Laravel’s encrypted hex response
                            const decrypted = decryptResponse(encryptedHex);

                            if (!decrypted) {
                                console.error(" Decryption returned empty or failed");
                                return;
                            }

                            // 🔍 Step 2: Parse the decrypted JSON
                            const response = JSON.parse(decrypted);

                            console.log(" Decrypted response:", response);

                            //  Step 3: Use the JSON object normally
                            if (response.done) {
                                done = true;
                                $('#loader').text('No more collections to show.');
                                return;
                            }

                            $('#collections-container').append(response.html);
                            page++;

                            if (typeof window.initSwipers === 'function') window.initSwipers();
                            if (typeof swiperInit === 'function') swiperInit();

                        } catch (e) {
                            console.error(" Failed to decrypt or parse response:", e);
                            console.log("Raw encrypted response:", encryptedHex);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(" AJAX error:", status, error);
                        console.log("Response:", xhr.responseText);
                    },
                    complete: function() {
                        $('#loader').addClass('hidden');
                        loading = false;
                    }
                });

            };

            //  Scroll listener
            $(window).on('scroll', function() {
                if (done) return;

                if ($(window).scrollTop() + $(window).height() >= $(document).height() - 400) {
                    // console.log('Reached bottom → calling loadMoreCollections()');
                    loadMoreCollections();
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const genresButton = document.getElementById('genres-button');
            const genresMenu = document.getElementById('genres-menu');

            if (genresButton && genresMenu) {
                genresButton.addEventListener('click', function(event) {
                    event.stopPropagation();
                    genresMenu.classList.toggle('opacity-0');
                    genresMenu.classList.toggle('invisible');
                });

                document.addEventListener('click', function(event) {
                    if (!genresMenu.contains(event.target) && !genresButton.contains(event.target)) {
                        genresMenu.classList.add('opacity-0', 'invisible');
                    }
                });
            }
        });
    </script>

    <script>
        document.addEventListener("scroll", () => {
            const bar = document.getElementById("moviesHeader");
            if (window.scrollY > 50) {
                bar.classList.add("scroll-bg-active");
            } else {
                bar.classList.remove("scroll-bg-active");
            }
        });
    </script>


    @endsection

</x-layouts.app>