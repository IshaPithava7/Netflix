<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Netflix India - Watch TV Shows Online, Watch Movies Online</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="p-0 m-0 box-border font-sans bg-black text-white overflow-x-hidden">
    <div class="hero-section relative h-screen flex flex-col">
        <div class="hero-background absolute inset-0 w-full h-full bg-cover bg-center z-0"
            style="background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.7) 0%, rgba(0, 0, 0, 0.4) 50%, rgba(0, 0, 0, 0.95) 100%), url('https://assets.nflxext.com/ffe/siteui/vlv3/151f3e1e-b2c9-4626-afcd-6b39d0b2694f/web/IN-en-20241028-TRIFECTA-perspective_bce9a321-39cb-4cce-8ba6-02dab4c72e53_large.jpg');">
            <div class="absolute inset-0 opacity-40" style="background: linear-gradient(45deg, transparent 30%, rgba(20, 20, 20, 0.8) 100%), 
                    repeating-linear-gradient(90deg, rgba(229, 9, 20, 0.03) 0px, transparent 2px, transparent 40px), 
                    repeating-linear-gradient(0deg, rgba(229, 9, 20, 0.03) 0px, transparent 2px, transparent 40px);">
            </div>
        </div>
        <header
            class="flex justify-between items-center py-6 px-10 md:px-12 bg-gradient-to-b from-black/70 to-transparent z-50">
            <img src="{{ asset('storage/logo/Logonetflix.png') }}" alt="Netflix Logo" class="w-38 h-auto">


            <div class="flex items-center space-x-5">
                <div class="language-selector relative inline-block">
                    <select class="language-select bg-transparent border border-white/40 text-white py-1.5 pl-10 pr-6 rounded-md text-base cursor-pointer 
                            appearance-none transition hover:border-white/70 focus:outline-none" style="
                            /* Custom arrow image for select */
                            background-image: url('data:image/svg+xml,%3Csvg width=\'10\' height=\'6\' viewBox=\'0 0 10 6\' fill=\'none\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cpath d=\'M1 1L5 5L9 1\' stroke=\'white\' stroke-width=\'1.5\' stroke-linecap=\'round\' stroke-linejoin=\'round\'/%3E%3C/svg%3E'); 
                            background-repeat: no-repeat; 
                            background-position: right 0.8rem center;
                        ">
                        <option value="en" class="bg-black text-white">English</option>
                        <option value="hi" class="bg-black text-white">हिन्दी</option>
                    </select>
                    <span class="absolute left-2.5 top-1/2 -translate-y-1/2 text-base pointer-events-none">🌐</span>
                </div>
                <form action="{{ route('login') }}">
                    <button class="sign-in-btn bg-[#E50914] text-white py-2 px-4 rounded-lg text-base font-medium cursor-pointer transition 
                            hover:bg-[#f40612] focus:outline-none">
                        Sign In
                    </button>
                </form>
            </div>
        </header>

        <div
            class="hero-content flex flex-1 flex-col justify-center items-center text-center p-8 max-w-[800px] mx-auto z-10">
            <p class="text-4xl md:text-[3.125rem] font-black  leading-tight mb-4 md:mb-6 max-w-[800px] 
                sm:text-5xl lg:text-6xl">
                Unlimited movies, shows, and more
            </p>
            <p class="subtitle text-lg md:text-2xl font-normal mb-6">
                Starts at ₹149. Cancel at any time.
            </p>
            <p class="ready-text text-base  font-normal mb-3">
                Ready to watch? Enter your email to create or restart your membership.
            </p>

            <form id="email-form" class="email-form flex flex-col md:flex-row gap-4 w-full max-w-3xl md:max-w-[600px]"
                method="POST" action="{{ route('checkEmail') }}">
                @csrf

                <div class="flex flex-col flex-1 w-full relative">
                    <input type="text " name="email" id="email-input"
                        class="email-input bg-black/70 border border-gray-500/70 rounded-md text-white py-3 px-2 text-base
                            placeholder-white/50 focus:border-white focus:bg-black/90 focus:outline-none transition w-full" placeholder="Email address"
                        value="{{ old('email') }}">

                    <!-- Error message absolutely positioned -->
                    <p id="error-message" class="text-red-500 text-sm absolute left-0 bottom-[-2.5rem] hidden">
                        Please enter a valid email address.
                    </p>

                    @error('email')
                        <p class="text-red-500 text-sm mt-1 text-center md:text-left">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="get-started-btn bg-[#E50914] text-white py-2 px-3 border-red rounded-md text-xl  font-medium cursor-pointer
        flex items-center justify-center whitespace-nowrap transition hover:bg-[#f40612] focus:outline-none ">
                    Get Started
                    <span class="ml-1 text-3xl leading-none"><svg viewBox="0 0 24 24" width="24" height="24"
                            data-icon="ChevronRightMedium" data-icon-id=":r3:" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" role="img">
                            <path fill="currentColor" fill-rule="evenodd"
                                d="m15.59 12-7.3 7.3 1.42 1.4 8-8a1 1 0 0 0 0-1.4l-8-8-1.42 1.4z" clip-rule="evenodd">
                            </path>
                        </svg></span>
                </button>
            </form>


        </div>
    </div>
</body>

</html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function () {
        const $form = $('#email-form');
        const $emailInput = $('#email-input');
        const $errorMessage = $('#error-message');

        $form.on('submit', function (e) {
            const emailValue = $.trim($emailInput.val());
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            // Clear previous error
            $errorMessage.addClass('hidden');
            $emailInput.removeClass('border-red-500');

            if (emailValue === '') {
                e.preventDefault();
                $errorMessage.text('Email is required.').removeClass('hidden');
                $emailInput.addClass('border-red-500');
            } else if (!emailPattern.test(emailValue)) {
                e.preventDefault();
                $errorMessage.text('Please enter a valid email address.').removeClass('hidden');
                $emailInput.addClass('border-red-500');
            }
        });

        // Hide error on typing
        $emailInput.on('input', function () {
            $errorMessage.addClass('hidden');
            $emailInput.removeClass('border-red-500');
        });
    });

</script>