$(document).ready(function () {
    // navbar search functionality
    const $searchContainer = $("#searchContainer");
    const $searchIcon = $("#searchIcon");
    const $searchInput = $("#searchInput");

    let isOpen = false;

    $searchIcon.on("click", function (e) {
        e.stopPropagation();

        if (!isOpen) {
            // Open search input
            $searchContainer
                .addClass("bg-black border-white")
                .removeClass("bg-transparent border-transparent");
            $searchInput.addClass("w-[200px] opacity-100").focus();
            isOpen = true;
        } else {
            // Close only if input is empty
            if ($searchInput.val() === "") {
                $searchContainer
                    .removeClass("bg-black border-white")
                    .addClass("bg-transparent border-transparent");
                $searchInput
                    .removeClass("w-[200px] opacity-100")
                    .addClass("w-0 opacity-0");
                isOpen = false;
            }
        }
    });

    // Close when clicking outside
    $(document).on("click", function (e) {
        if (
            isOpen &&
            !$searchContainer.is(e.target) &&
            $searchContainer.has(e.target).length === 0 &&
            $searchInput.val() === ""
        ) {
            $searchContainer
                .removeClass("bg-black border-white")
                .addClass("bg-transparent border-transparent");
            $searchInput
                .removeClass("w-[200px] opacity-100")
                .addClass("w-0 opacity-0")
                .val("");
            isOpen = false;
        }
    });

    $searchInput.on("click", function (e) {
        e.stopPropagation();
    });

    //navbar profile dropdown functionality
    const $wrapper = $("#profileWrapper");
    const $menu = $("#dropdownMenu");
    const $icon = $("#dropdownIcon");

    $wrapper.hover(
        function () {
            $menu.removeClass("hidden").stop(true, true).fadeIn(150);
            $icon.addClass("rotate-180");
        },
        function () {
            $menu.stop(true, true).fadeOut(150, function () {
                $menu.addClass("hidden");
            });
            $icon.removeClass("rotate-180");
        }
    );

    // navbar notification panel functionality
    const $notifWrapper = $("#notificationWrapper");
    const $notifPanel = $("#notificationPanel");

    $notifWrapper.hover(
        function () {
            $notifPanel
                .removeClass(
                    "opacity-0 translate-y-[-10px] pointer-events-none"
                )
                .addClass("opacity-100 translate-y-0");
        },
        function () {
            $notifPanel
                .removeClass("opacity-100 translate-y-0")
                .addClass("opacity-0 translate-y-[-10px] pointer-events-none");
        }
    );

    // navbar background change on scroll
    const $navbar = $("#navbar");

    $(window).on("scroll", function () {
        if ($(this).scrollTop() > 50) {
            $navbar.addClass("bg-[#141414]").removeClass("bg-transparent");
        } else {
            $navbar.addClass("bg-transparent").removeClass("bg-[#141414]");
        }
    });
});
