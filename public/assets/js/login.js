$("#googleLoginBtn").on("click", function (e) {
    e.preventDefault();

    window.open(
        "/auth/google",
        "googleLogin",
        "width=500,height=600,left=400,top=100"
    );
});

$("#githubLoginBtn").on("click", function (e) {
    e.preventDefault();

    window.open(
        "/auth/github",
        "githubLogin",
        "width=600,height=700,left=450,top=100"
    );
});

$("#slackLoginBtn").on("click", function (e) {
    e.preventDefault();
    const slackLoginUrl = "{{ route('login.slack') }}";

    window.open(
        slackLoginUrl,
        "Slack Login",
        "width=600,height=700,left=450,top=100"
    );
});

$("#linkedinLoginBtn").on("click", function (e) {
    e.preventDefault();
    const linkedinLoginUrl = "{{ route('login.linkedin') }}";

    window.open(
        linkedinLoginUrl,
        "LinkedIn Login",
        "width=600,height=700,left=450,top=100"
    );
});
