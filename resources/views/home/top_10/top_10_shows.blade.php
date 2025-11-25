<style>
    .top10-swiper .swiper,
    .top10-swiper .swiper-wrapper,
    .top10-swiper .swiper-slide {
        overflow: visible !important;
    }

    .top10-swiper .swiper {
        padding: 120px 0 80px 0 !important;
        margin: -120px 0 -80px 0 !important;
    }

    .top10-hover-card {
        display: block !important;
        opacity: 0;
        visibility: hidden;
        transform: translateX(-50%) scale(0.8) translateY(0);
        transition: all 0.3s ease-in-out;
        pointer-events: none;
    }

    .top10-slide-group:hover .top10-hover-card {
        opacity: 1 !important;
        visibility: visible !important;
        transform: translateX(-50%) scale(1.1) translateY(-80px) !important;
        pointer-events: auto !important;
        z-index: 99999 !important;
    }

    .top10-rank-number {
        position: absolute;
        left: 0;
        bottom: 0;
        z-index: 10;
        pointer-events: none;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 200px;
        opacity: 0.8;
    }

    .top10-rank-number svg {
        width: 100%;
        height: 100%;
    }

    .top10-swiper .swiper-button-prev,
    .top10-swiper .swiper-button-next {
        width: 40px;
        height: 40px;
        background: rgba(0, 0, 0, 0.7);
        border-radius: 50%;
        transition: all 0.3s ease;
        opacity: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .top10-swiper:hover .swiper-button-prev,
    .top10-swiper:hover .swiper-button-next {
        opacity: 1;
    }

    .top10-swiper .swiper-button-prev:hover,
    .top10-swiper .swiper-button-next:hover {
        background: rgba(0, 0, 0, 0.9);
        transform: scale(1.1);
    }

    .top10-swiper .swiper-button-prev.swiper-button-disabled,
    .top10-swiper .swiper-button-next.swiper-button-disabled {
        opacity: 0 !important;
        pointer-events: none;
    }

    .top10-swiper .swiper-button-prev {
        left: 10px;
    }

    .top10-swiper .swiper-button-next {
        right: 10px;
    }

    .top10-video-card {
        position: relative;
        z-index: 20;
        background-color: #1a1a1a;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
        margin-left: 80px;
        overflow: hidden;
        width: 140px;
        height: 200px;
        border-radius: 4px;
        transition: all 0.3s ease-in-out;
    }

    .top10-slide-group:hover .top10-video-card {
        transform: scale(1.05);
    }
</style>

<section class="absolute bottom-0 left-0 w-full pl-5 z-10 bg-transparent top10-swiper">
    <h2 class="text-2xl font-bold mb-4 text-white pl-10">Top 10 Shows in India Today</h2>
    <div class="swiper top10Swiper overflow-visible!">
        <div class="swiper-wrapper overflow-visible!">
            @if($top10Collection && $top10Collection->videos->isNotEmpty())
                @foreach($top10Collection->videos->take(10) as $video)
                    @php
                        $poster = $video->poster;
                        if ($poster && !filter_var($poster, FILTER_VALIDATE_URL)) {
                            $poster = asset('storage/' . $poster);
                        }
                        $rankNumber = $loop->iteration;
                    @endphp
                    <div
                        class="swiper-slide relative flex items-end top10-slide-group z-50 hover:z-99999 transition-all duration-200 ease-in-out">
                        {{-- Rank Number --}}
                        <div class="top10-rank-number">
                            <svg viewBox='0 0 180 280'>
                                <text x="0" y="240" font-family="Arial, sans-serif" font-size="280" font-weight="900"
                                    fill="#000000" stroke="#595959" stroke-width="15" style="paint-order: stroke fill;">
                                    {{ $rankNumber }}
                                </text>
                            </svg>
                        </div>

                        {{-- Video Card --}}
                        <div class="top10-video-card">
                            @if($video->file_path)
                                <video class="w-full h-full object-cover" muted poster="{{ $poster }}">
                                    <source src="{{ asset('storage/' . $video->file_path) }}" type="video/mp4">
                                </video>
                            @elseif($poster)
                                <img src="{{ $poster }}" alt="{{ $video->title }}" loading="lazy" class="w-full h-full object-cover">
                            @endif
                        </div>

                        {{-- Hover Card --}}
                        <div
                            class="top10-hover-card absolute left-1/2 top-0 w-[300px] rounded-lg overflow-hidden shadow-2xl bg-[#181818]">
                            <div class="relative">
                                @if($video->file_path)
                                    <video id="top10-video-{{ $video->id }}" class="w-full h-[180px] object-cover rounded-t-lg"
                                        autoplay muted loop poster="{{ $poster }}">
                                        <source src="{{ asset('storage/' . $video->file_path) }}" type="video/mp4">
                                    </video>
                                @elseif($poster)
                                    <img src="{{ $poster }}" alt="{{ $video->title }}" loading="lazy"
                                        class="w-full h-[180px] object-cover rounded-t-lg">
                                @endif

                                {{-- Gradient Overlay --}}
                                <div class="absolute inset-0 bg-linear-to-t from-[#181818] via-transparent to-transparent">
                                </div>

                                {{-- Title poster in bottom-left --}}
                                @if($video->title_poster)
                                    <img src="{{ asset('storage/' . $video->title_poster) }}" alt="{{ $video->title }}" loading="lazy"
                                        class="absolute bottom-2 left-5 w-auto h-12 object-contain rounded-md shadow-md drop-shadow-lg">
                                @endif
                            </div>

                            <div class="p-3 space-y-2 text-white">
                                <h3 class="text-sm font-semibold">{{ $video->title }}</h3>

                                <div class="flex items-center space-x-2 text-xs text-gray-400">
                                    <span>U/A 13+</span>
                                    <span>•</span>
                                    <span>HD</span>
                                    <span>•</span>
                                    <span>{{ $video->duration ?? '1h 52m' }}</span>
                                </div>

                                <div class="flex space-x-2 mt-2">
                                    {{-- Play --}}
                                    <button class="bg-white text-black rounded-full p-2 hover:bg-gray-300 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>

                                    {{-- My List --}}
                                    <button
                                        class="toggle-mylist border border-gray-500 text-white rounded-full p-2 hover:bg-gray-700 transition"
                                        data-video-id="{{ $video->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" id="mylist-icon-{{ $video->id }}">
                                            @if(isset($myListIds[$video->id]))
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            @else
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                            @endif
                                        </svg>
                                    </button>

                                    <button
                                        class="top10-chevron-down border-2 border-gray-500 text-white rounded-full! w-9 h-9 flex items-center justify-center hover:border-white hover:bg-gray-700 transition">
                                        <i class="fa-solid fa-chevron-down text-sm"></i>
                                    </button>
                                </div>

                                <div class="text-xs text-gray-400 mt-2">
                                    <span class="text-green-500 font-semibold">98% Match</span> •
                                    <span>Quirky • Feel-Good • Dramedy</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <!-- Navigation Arrows -->
        <div class="swiper-button-prev top10-nav-prev">
            <i class="fa-solid fa-chevron-left text-white text-2xl"></i>
        </div>

        <div class="swiper-button-next top10-nav-next">
            <i class="fa-solid fa-chevron-right text-white text-2xl"></i>
        </div>
    </div>
</section>


<script>
    $(document).ready(function () {
        const $modal = $('#sectionInfoModal');
        const $closeModalBtn = $('#sectionInfoModal #closeModal');
        const $modalVideo = $('#sectionModalVideo');
        const $modalPoster = $('#sectionModalPoster');
        const $modalTitleLogo = $('#sectionModalTitlePoster');
        const $modalTitle = $('#sectionModalTitle');
        const $modalDuration = $('#sectionModalDuration');
        const $modalGenres = $('#sectionModalGenres');
        const $modalDescription = $('#sectionModalDescription');

        //  Top 10 Swiper
        const top10Swiper = new Swiper('.top10Swiper', {
            slidesPerView: 6,
            spaceBetween: 10,
            slidesPerGroup: 5,
            loop: true,
            navigation: {
                nextEl: '.top10-nav-next',
                prevEl: '.top10-nav-prev',
            },
            breakpoints: {
                320: {
                    slidesPerView: 2,
                    spaceBetween: 10
                },
                640: {
                    slidesPerView: 3,
                    spaceBetween: 10
                },
                768: {
                    slidesPerView: 4,
                    spaceBetween: 10
                },
                1024: {
                    slidesPerView: 5,
                    spaceBetween: 10
                },
                1280: {
                    slidesPerView: 6,
                    spaceBetween: 10
                }
            },
            on: {
                init: function () {
                    if (this.isBeginning) {
                        $('.top10-nav-prev').css('opacity', '0');
                    }
                },
                slideChange: function () {
                    if (this.isBeginning) {
                        $('.top10-nav-prev').css('opacity', '0');
                    } else {
                        $('.top10-nav-prev').css('opacity', '1');
                    }
                }
            }
        });

        $(document).on('click', '.top10-chevron-down', function (e) {
            e.stopPropagation();

            const $card = $(this).closest('.top10-slide-group');

            let posterSrc = '';
            const $video = $card.find('video').first();
            const $posterImg = $card.find('img').not('[alt$="svg"]').first();

            if ($video.length) {
                posterSrc = $video.attr('poster') || '';
            } else if ($posterImg.length) {
                posterSrc = $posterImg.attr('src');
            }

            const $hoverTitleLogo = $card.find('.top10-hover-card img[alt]').last();

            const title = $card.find('h3').text().trim() || '';
            const duration = $card.find('.text-gray-400').first().text().trim() || '';
            const genres = $card.find('.text-xs.text-gray-400 span').map(function () {
                return $(this).text().trim();
            }).get().join(' • ');

            if ($video.length) {
                const videoSrc = $video.find('source').attr('src');
                if (videoSrc) {
                    $modalVideo.find('source').attr('src', videoSrc);
                    $modalVideo.attr('poster', posterSrc || '');
                    $modalVideo[0].load();
                    $modalVideo.removeClass('hidden').trigger('play');
                    $modalPoster.addClass('hidden');
                }
            } else if (posterSrc) {
                $modalPoster.attr('src', posterSrc).removeClass('hidden');
                $modalVideo.addClass('hidden').trigger('pause');
            }

            const titleLogoSrc = $hoverTitleLogo.attr('src');
            if (titleLogoSrc) {
                $modalTitleLogo.attr('src', titleLogoSrc).removeClass('hidden');
            } else {
                $modalTitleLogo.addClass('hidden');
            }

            $modalTitle.text(title);
            $modalDuration.text(duration || '2h 7m');
            $modalGenres.text(genres || 'Thriller • Drama • Mystery');
            $modalDescription.text('Lorem ipsum dolor sit amet, consectetur adipiscing elit.');

            $('#movieYear').text('2022');
            $('#movieDuration').text(duration || '2h 7m');
            $('#movieTags').text('gore, sexual content, violence');
            $('#movieCast').text('John Abraham, Arjun Kapoor, Disha Patani');
            $('#movieGenres').text(genres || 'Hindi-Language Movies, Bollywood Movies, Crime Movies');
            $('#movieMood').text('Dark');
            $('#movieDescription').text('When a singer goes missing amid a serial killing spree, a cabbie and a businessman\'s son cross paths in a twisted tale where good and evil is blurred.');

            $modal.removeClass('pointer-events-none opacity-0').addClass('opacity-100');
        });

        $closeModalBtn.on('click', function () {
            $modal.addClass('opacity-0 pointer-events-none').removeClass('opacity-100');
            $modalVideo.trigger('pause');
        });

        $modal.on('click', function (e) {
            if ($(e.target).is($modal)) {
                $modal.addClass('opacity-0 pointer-events-none').removeClass('opacity-100');
                $modalVideo.trigger('pause');
            }
        });
    });
</script>