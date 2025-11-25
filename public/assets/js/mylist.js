$(document).ready(function () {
    $(".toggle-mylist").click(function (e) {
        e.stopPropagation();
        const videoId = $(this).data("video-id");
        const card = $(this).closest(".group");
        const button = $(this);
        const icon = button.find("svg");

        // Show loading state (optional)
        button.prop("disabled", true);

        $.post("{{ route('mylist.toggle') }}", {
            _token: "{{ csrf_token() }}",
            video_id: videoId,
        })
            .done(function (data) {
                if (data.status === "added") {
                    // Change icon to check
                    icon.html(
                        '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>'
                    );
                } else if (data.status === "removed") {
                    // Change icon to plus
                    icon.html(
                        '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>'
                    );

                    // Remove card from list visually
                    card.fadeOut(300, function () {
                        $(this).remove();

                        // Update count
                        const countElement = $(".text-gray-400.text-lg");
                        const currentCount = parseInt(countElement.text());
                        const newCount = currentCount - 1;
                        countElement.text(
                            `${newCount} ${newCount === 1 ? "title" : "titles"}`
                        );

                        // Show empty state if no items left
                        if (newCount === 0) {
                            location.reload();
                        }
                    });
                }
            })
            .fail(function () {
                alert("Failed to update list. Please try again.");
            })
            .always(function () {
                button.prop("disabled", false);
            });
    });
});
