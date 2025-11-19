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

    .swiper-wrapper {
        /* overflow: visible !important;
        justify-content: flex-start !important; */
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


@foreach($collections as $collection)
    <section class="mb-12 px-10 relative group/section">
        <div class="swiper-scrollbar"></div>

        <p class="text-2xl font-bold mb-4 text-white">{{ $collection->title }}</p>

        <!-- Outer group controls only the arrows -->
        <div class="relative group">
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
                                    <img src="{{ $poster }}" alt="{{ $video->title }}" class="w-[230px] h-[130px] object-cover"
                                        loading="lazy">
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
                                            <img src="{{ $poster }}" alt="{{ $video->title }}" class="w-full h-[180px] object-cover"
                                                loading="lazy">
                                        @endif

                                        {{-- Gradient Overlay --}}
                                        <div
                                            class="absolute inset-0 bg-gradient-to-t from-[#181818] via-transparent to-transparent">
                                        </div>

                                        {{-- Title Logo --}}
                                        @if($video->title_poster)
                                            <img src="{{ asset('storage/' . $video->title_poster) }}" alt="{{ $video->title }}"
                                                class="absolute bottom-3 left-4 w-auto h-10 object-contain drop-shadow-lg">
                                        @endif
                                    </div>

                                    {{-- Card Info Section --}}
                                    <div class="p-4 space-y-3">

                                        {{-- Action Buttons --}}
                                        <div class="flex items-center justify-between">
                                            <div class="flex space-x-2">
                                                <button
                                                    class="bg-white text-black !rounded-full w-9 h-9 flex items-center justify-center hover:bg-gray-300 transition shadow-md">
                                                    <i class="fa-solid fa-play text-sm"></i>
                                                </button>
                                                <button
                                                    class="border-2 border-gray-500 text-white !rounded-full w-9 h-9 flex items-center justify-center hover:border-white hover:bg-gray-700 transition">
                                                    <i class="fa-solid fa-plus text-sm"></i>
                                                </button>
                                                <button
                                                    class="border-2 border-gray-500 text-white !rounded-full w-9 h-9 flex items-center justify-center hover:border-white hover:bg-gray-700 transition">
                                                    <i class="fa-solid fa-thumbs-up text-sm"></i>
                                                </button>
                                            </div>
                                            <button
                                                class="border-2 border-gray-500 text-white !rounded-full w-9 h-9 flex items-center justify-center hover:border-white hover:bg-gray-700 transition">
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
        </div>
    </section>
@endforeach

<script>
    $(document).ready(function () {

        swiperInit();

        // swiper wiper
        function swiperInit() {
            $('.mySwiper').each(function () {

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

                    slidesOffsetBefore: 40,
                    slidesOffsetAfter: 60,

                    navigation: {
                        nextEl: $container.find('.swiper-button-next')[0],
                        prevEl: $container.find('.swiper-button-prev')[0],
                    },

                    breakpoints: {
                        1600: { slidesPerView: 6.5, slidesPerGroup: 6 },
                        1440: { slidesPerView: 6.5, slidesPerGroup: 6 },
                        1280: { slidesPerView: 5.5, slidesPerGroup: 5 },
                        1024: { slidesPerView: 4.5, slidesPerGroup: 4 },
                        768: { slidesPerView: 3.5, slidesPerGroup: 3 },
                        640: { slidesPerView: 2.5, slidesPerGroup: 2 },
                    },

                    on: {
                        init() {
                            const $prev = $container.find('.swiper-button-prev');
                            const $next = $container.find('.swiper-button-next');

                            $prev.addClass('pointer-events-none opacity-0');

                            // FIRST NEXT click → enable loop mode
                            $next.on('click.firstNext', function () {

                                if (!loopActivated && enableLoop) {
                                    loopActivated = true;

                                    const currentIndex = swiper.activeIndex;

                                    swiper.destroy(true, true);

                                    // --- SECOND SWIPER (loop enabled like Netflix) ---
                                    swiper = new Swiper(swiperEl, {
                                        slidesPerView: 6.5,
                                        spaceBetween: 6,
                                        slidesPerGroup: 6,
                                        speed: 600,
                                        loop: true,
                                        initialSlide: currentIndex,

                                        slidesOffsetBefore: 40,
                                        slidesOffsetAfter: 60,

                                        navigation: {
                                            nextEl: $container.find('.swiper-button-next')[0],
                                            prevEl: $container.find('.swiper-button-prev')[0],
                                        },

                                        breakpoints: {
                                            1600: { slidesPerView: 6.5, slidesPerGroup: 6 },
                                            1440: { slidesPerView: 6.5, slidesPerGroup: 6 },
                                            1280: { slidesPerView: 5.5, slidesPerGroup: 5 },
                                            1024: { slidesPerView: 4.5, slidesPerGroup: 4 },
                                            768: { slidesPerView: 3.5, slidesPerGroup: 3 },
                                            640: { slidesPerView: 2.5, slidesPerGroup: 2 },
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
























        const $modal = $('#sectionInfoModal');
        const $closeModalBtn = $('#sectionInfoModal #closeModal');
        const $modalVideo = $('#sectionModalVideo');
        const $modalPoster = $('#sectionModalPoster');
        const $modalTitleLogo = $('#sectionModalTitlePoster');
        const $modalTitle = $('#sectionModalTitle');
        const $modalDuration = $('#sectionModalDuration');
        const $modalGenres = $('#sectionModalGenres');
        const $modalDescription = $('#sectionModalDescription');

        // Handle modal open buttons
        $('.fa-chevron-down').on('click', function (e) {
            e.stopPropagation();

            const $card = $(this).closest('.group\\/card');
            const $img = $card.find('.thumbnail-card img');
            const $hoverTitleLogo = $card.find('.hover-card img[alt="' + $card.find('h3').text().trim() + '"]');

            const title = $card.find('h3').text().trim() || '';
            const duration = $card.find('.text-gray-400').first().text().trim() || '';
            const genres = $card.find('.text-xs.text-gray-400 span').map(function () {
                return $(this).text().trim();
            }).get().join(' • ');

            // ✅ Poster setup
            const posterSrc = $img.attr('src');
            $modalPoster.attr('src', posterSrc).removeClass('hidden');
            $modalVideo.addClass('hidden');

            // ✅ Title logo (if available)
            const titleLogoSrc = $hoverTitleLogo.attr('src');
            if (titleLogoSrc) {
                $modalTitleLogo.attr('src', titleLogoSrc).removeClass('hidden');
            } else {
                $modalTitleLogo.addClass('hidden');
            }

            // ✅ Text fields in modal
            $modalTitle.text(title);
            $modalDuration.text(duration || '2h 7m');
            $modalGenres.text(genres || 'Thriller • Drama • Mystery');
            $modalDescription.text('Lorem ipsum dolor sit amet, consectetur adipiscing elit.');

            // ✅ Example movie details (replace with your dynamic data later)
            $('#movieYear').text('2022');
            $('#movieDuration').text(duration || '2h 7m');
            $('#movieTags').text('gore, sexual content, violence');
            $('#movieCast').text('John Abraham, Arjun Kapoor, Disha Patani');
            $('#movieGenres').text(genres || 'Hindi-Language Movies, Bollywood Movies, Crime Movies');
            $('#movieMood').text('Dark');
            $('#movieDescription').text('When a singer goes missing amid a serial killing spree, a cabbie and a businessman’s son cross paths in a twisted tale where good and evil is blurred.');

            // ✅ Show modal
            $modal.removeClass('pointer-events-none opacity-0').addClass('opacity-100');
            $('body').addClass('!overflow-hidden'); // 🔒 stop page scroll
        });

        // Close modal
        $closeModalBtn.on('click', function () {
            $modal.addClass('opacity-0 pointer-events-none').removeClass('opacity-100');
            $modalVideo.trigger('pause');
            $('body').removeClass('!overflow-hidden'); // 🔓 allow scroll again
        });

        // Click outside to close
        $modal.on('click', function (e) {
            if ($(e.target).is($modal)) {
                $modal.addClass('opacity-0 pointer-events-none').removeClass('opacity-100');
                $modalVideo.trigger('pause');
                $('body').removeClass('overflow-hidden'); // 🔓 allow scroll again
            }
        });


        $('.hover-card').on('mouseenter', function () {
            const $card = $(this);
            const rect = this.getBoundingClientRect();
            const screenWidth = $(window).width();

            // Reset position first
            $card.css({
                left: '50%',
                right: 'auto',
                transform: 'translateX(-50%)'
            });

            // If too far left — shift it right
            if (rect.left < 0) {
                $card.css({
                    left: '160px', // adjust based on your thumbnail width
                    transform: 'none'
                });
            }

            // If too far right — shift it left
            if (rect.right > screenWidth) {
                $card.css({
                    right: '160px',
                    transform: 'none'
                });
            }
        });

    });
</script>