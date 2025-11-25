$(document).ready(function () {
    const $form = $("#email-form");
    const $emailInput = $("#email-input");
    const $errorMessage = $("#error-message");

    $form.on("submit", function (e) {
        const emailValue = $.trim($emailInput.val());
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        // Clear previous error
        $errorMessage.addClass("hidden");
        $emailInput.removeClass("border-red-500");

        if (emailValue === "") {
            e.preventDefault();
            $errorMessage.text("Email is required.").removeClass("hidden");
            $emailInput.addClass("border-red-500");
        } else if (!emailPattern.test(emailValue)) {
            e.preventDefault();
            $errorMessage
                .text("Please enter a valid email address.")
                .removeClass("hidden");
            $emailInput.addClass("border-red-500");
        }
    });

    // Hide error on typing
    $emailInput.on("input", function () {
        $errorMessage.addClass("hidden");
        $emailInput.removeClass("border-red-500");
    });
});
