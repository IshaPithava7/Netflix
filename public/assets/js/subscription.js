$(document).ready(function () {
    const $planCards = $(".plan-card");
    const $selectedPlanInput = $("#selected-plan");
    const $planNameInput = $("#selected-plan-name");

    $planCards.click(function () {
        const $clickedCard = $(this);

        // Remove selection from all cards
        $planCards.each(function () {
            $(this)
                .removeClass("border-blue-500 shadow-lg")
                .addClass("border-gray-300");
            $(this).find(".checkmark").addClass("hidden").removeClass("flex");
        });

        // Add selection to clicked card
        $clickedCard
            .removeClass("border-gray-300")
            .addClass("border-blue-500 shadow-lg");
        $clickedCard.find(".checkmark").removeClass("hidden").addClass("flex");

        // Set form values
        $selectedPlanInput.val($clickedCard.data("price-id"));
        $planNameInput.val($clickedCard.data("plan-name"));
    });

    $("#subscription-form").submit(function (e) {
        if (!$selectedPlanInput.val()) {
            e.preventDefault();
            alert("Please select a plan first!");
        }
    });
});
