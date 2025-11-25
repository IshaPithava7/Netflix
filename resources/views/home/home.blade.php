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
        <main class="grow ">

            {{-- hero banner --}}
            @if($heroCollection && $heroCollection->videos->isNotEmpty())
            @php
            $featured = $heroCollection->videos->first();
            $poster = $featured->poster ? (filter_var($featured->poster, FILTER_VALIDATE_URL) ? $featured->poster : asset('storage/' . $featured->poster)) : '';
            $titlePoster = $featured->title_poster ? asset('storage/' . $featured->title_poster) : '';
            @endphp

            <section class="relative h-[56.25vw] min-h-[400px] max-h-[800px] mb-12">
                @if($featured->file_path)
                <video id="heroVideo" poster="{{ $poster }}" class="absolute top-0 left-0 w-full h-full object-cover" autoplay muted loop>
                    <source src="{{ asset('storage/' . $featured->file_path) }}" type="video/mp4">
                </video>
                @else
                <img id="heroPoster" src="{{ $poster }}" alt="{{ $featured->title }}" class="absolute top-0 left-0 w-full h-full object-cover">
                @endif

                <div class="absolute inset-0 bg-linear-to-t from-[#141414] via-transparent to-transparent"></div>

                <div class="absolute bottom-[40%] left-[4%] z-10">
                    @if($titlePoster)
                    <img src="{{ $titlePoster }}" alt="{{ $featured->title }}" class="w-[40%] max-w-[500px] h-auto mb-6 transform transition-transform duration-500 ease-in-out scale-100 hover:scale-105">
                    @else
                    <h1 class="text-6xl font-bebas text-white mb-6">{{ $featured->title }}</h1>
                    @endif

                    <p class="text-white text-lg max-w-lg mb-6 shadow-lg">{{ $featured->description }}</p>

                    <div class="flex space-x-4">
                        <a href="#" class="flex items-center justify-center bg-white text-black font-bold px-8 py-3 rounded hover:bg-gray-200 transition-colors duration-300">
                            <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z" />
                            </svg>
                            <span>Play</span>
                        </a>
                        <button id="moreInfoBtn" class="flex items-center justify-center bg-gray-500 bg-opacity-70 text-white font-bold px-8 py-3 rounded hover:bg-gray-600 transition-colors duration-300"
                            data-video-id="{{ $featured->id }}">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>More Info</span>
                        </button>
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
    @include('home.models.more_info_model')
    @include('home.models.section_more_info_model')


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
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
                    if ($("#heroVideo").length) $("#heroVideo").get(0).pause();
                    playModalVideo();
                });

                // CLOSE MODAL
                $closeModal.on("click", function() {
                    $modal.addClass("opacity-0 pointer-events-none").removeClass("opacity-100");
                    $('body').css('overflow', 'auto');
                    $modalVideo.get(0).pause();
                    if ($("#heroVideo").length) $("#heroVideo").get(0).play();
                });

                // CLICK OUTSIDE MODAL TO CLOSE
                $modal.on("click", function(e) {
                    if (e.target === this) {
                        $modal.addClass("opacity-0 pointer-events-none").removeClass("opacity-100");
                        $('body').css('overflow', 'auto');
                        $modalVideo.get(0).pause();
                        if ($("#heroVideo").length) $("#heroVideo").get(0).play();
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
    </script>
    @endsection

</x-layouts.app>