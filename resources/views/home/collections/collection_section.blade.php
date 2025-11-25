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


@foreach($collections as $collection)
<section class="mb-12 px-10 relative group/section">
    <div class="swiper-scrollbar"></div>

    <p class="text-2xl font-bold mb-4 text-white">{{ $collection->title }}</p>

    <!-- Outer group controls only the arrows -->
    <div class="relative group">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">

                @foreach($collection->videos as $video)
                    <x-video-card :video="$video" />
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

<!-- custom js -->
<script src="{{ asset('assets/js/collection_section.js') }}"></script>
@endforeach