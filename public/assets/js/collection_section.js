$(document).ready(function () {
    swiperInit();

    function swiperInit() {
        $(".mySwiper").each(function () {
            const swiperEl = this;
            const $container = $(swiperEl).closest(".relative");
            const slideCount = $(swiperEl).find(".swiper-slide").length;
            const enableLoop = slideCount >= 7;
            let loopActivated = false;

            let swiper = new Swiper(swiperEl, {
                slidesPerView: 6.5,
                spaceBetween: 6,
                slidesPerGroup: 6,
                speed: 600,
                loop: false,
                centeredSlides: false,
                slidesOffsetBefore: 40,
                slidesOffsetAfter: 60,
                navigation: {
                    nextEl: $container.find(".swiper-button-next")[0],
                    prevEl: $container.find(".swiper-button-prev")[0],
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
                    init: function () {
                        const $prev = $(this.navigation.prevEl);
                        $prev.addClass("pointer-events-none opacity-0");
                    },
                    slideChange: function () {
                        if (!loopActivated) {
                            const $prev = $(this.navigation.prevEl);
                            if (this.isBeginning) {
                                $prev.addClass("pointer-events-none opacity-0");
                            } else {
                                $prev.removeClass("pointer-events-none opacity-0");
                            }
                        }
                    },
                },
            });

            $container.find(".swiper-button-next").on("click.firstNext", function () {
                if (!loopActivated && enableLoop) {
                    loopActivated = true;
                    swiper.destroy(true, true);
                    swiper = new Swiper(swiperEl, {
                        slidesPerView: 6,
                        spaceBetween: 6,
                        slidesPerGroup: 6,
                        speed: 600,
                        loop: true,
                        centeredSlides: false,
                        slidesOffsetBefore: 40,
                        slidesOffsetAfter: 60,
                        navigation: {
                            nextEl: $container.find(".swiper-button-next")[0],
                            prevEl: $container.find(".swiper-button-prev")[0],
                        },
                        breakpoints: {
                            1600: { slidesPerView: 6, slidesPerGroup: 6 },
                            1440: { slidesPerView: 6, slidesPerGroup: 6 },
                            1280: { slidesPerView: 5, slidesPerGroup: 5 },
                            1024: { slidesPerView: 4, slidesPerGroup: 4 },
                            768: { slidesPerView: 3, slidesPerGroup: 3 },
                            640: { slidesPerView: 2, slidesPerGroup: 2 },
                        },
                    });
                    $(swiper.navigation.prevEl).removeClass("pointer-events-none opacity-0");
                    $(this).off("click.firstNext");
                }
            });
        });
    }

    // ======= MODAL LOGIC =======

    const $modal = $("#sectionInfoModal");
    const $closeModalBtn = $("#sectionInfoModal #closeModal");
    const $modalVideo = $("#sectionModalVideo");
    const $modalPoster = $("#sectionModalPoster");
    const $modalTitleLogo = $("#sectionModalTitlePoster");
    const $modalTitle = $("#sectionModalTitle");
    const $modalDuration = $("#sectionModalDuration");
    const $modalGenres = $("#sectionModalGenres");
    const $modalDescription = $("#sectionModalDescription");

    // Handle modal open buttons
    $(".fa-chevron-down").on("click", function (e) {
        e.stopPropagation();

        const $card = $(this).closest(".group\\/card");
        const $img = $card.find(".thumbnail-card img");
        const $hoverTitleLogo = $card.find(
            '.hover-card img[alt="' + $card.find("h3").text().trim() + '"]'
        );

        const title = $card.find("h3").text().trim() || "";
        const duration =
            $card.find(".text-gray-400").first().text().trim() || "";
        const genres = $card
            .find(".text-xs.text-gray-400 span")
            .map(function () {
                return $(this).text().trim();
            })
            .get()
            .join(" • ");

        //  Poster setup
        const posterSrc = $img.attr("src");
        $modalPoster.attr("src", posterSrc).removeClass("hidden");
        $modalVideo.addClass("hidden");

        //  Title logo (if available)
        const titleLogoSrc = $hoverTitleLogo.attr("src");
        if (titleLogoSrc) {
            $modalTitleLogo.attr("src", titleLogoSrc).removeClass("hidden");
        } else {
            $modalTitleLogo.addClass("hidden");
        }

        //  Text fields in modal
        $modalTitle.text(title);
        $modalDuration.text(duration || "2h 7m");
        $modalGenres.text(genres || "Thriller • Drama • Mystery");
        $modalDescription.text(
            "Lorem ipsum dolor sit amet, consectetur adipiscing elit."
        );

        //  Example movie details (replace with your dynamic data later)
        $("#movieYear").text("2022");
        $("#movieDuration").text(duration || "2h 7m");
        $("#movieTags").text("gore, sexual content, violence");
        $("#movieCast").text("John Abraham, Arjun Kapoor, Disha Patani");
        $("#movieGenres").text(
            genres || "Hindi-Language Movies, Bollywood Movies, Crime Movies"
        );
        $("#movieMood").text("Dark");
        $("#movieDescription").text(
            "When a singer goes missing amid a serial killing spree, a cabbie and a businessman’s son cross paths in a twisted tale where good and evil is blurred."
        );

        //  Show modal
        $modal
            .removeClass("pointer-events-none opacity-0")
            .addClass("opacity-100");
        $("body").addClass("!overflow-hidden"); // 🔒 stop page scroll
    });

    // Close modal
    $closeModalBtn.on("click", function () {
        $modal
            .addClass("opacity-0 pointer-events-none")
            .removeClass("opacity-100");
        $modalVideo.trigger("pause");
        $("body").removeClass("!overflow-hidden"); // 🔓 allow scroll again
    });

    // Click outside to close
    $modal.on("click", function (e) {
        if ($(e.target).is($modal)) {
            $modal
                .addClass("opacity-0 pointer-events-none")
                .removeClass("opacity-100");
            $modalVideo.trigger("pause");
            $("body").removeClass("overflow-hidden"); // 🔓 allow scroll again
        }
    });

    $(".hover-card").on("mouseenter", function () {
        const $card = $(this);
        const rect = this.getBoundingClientRect();
        const screenWidth = $(window).width();

        // Reset position first
        $card.css({
            left: "50%",
            right: "auto",
            transform: "translateX(-50%)",
        });

        // If too far left — shift it right
        if (rect.left < 0) {
            $card.css({
                left: "160px", // adjust based on your thumbnail width
                transform: "none",
            });
        }

        // If too far right — shift it left
        if (rect.right > screenWidth) {
            $card.css({
                right: "160px",
                transform: "none",
            });
        }
    });
});
