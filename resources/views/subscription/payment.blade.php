<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Payment</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://js.stripe.com/v3/"></script>
    <style>
        .loader {
            border: 3px solid #f3f3f3;
            border-top: 3px solid #E50914;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body class="bg-black text-white">

    {{-- Header --}}
    <header class="flex justify-between items-center py-4 max-w-6xl w-full mx-auto px-4">
        <img src="{{ asset('storage/logo/Logonetflix.png') }}" alt="Netflix Logo" class="w-32 h-auto ">

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="bg-red-600 px-4 py-2 rounded font-semibold hover:bg-red-700 transition">Sign
                Out</button>
        </form>
    </header>

    <div class="flex justify-center items-start min-h-screen px-4 ">
        <div class="bg-black/90 p-10 rounded-lg max-w-3xl w-full space-y-6">

            {{-- Step Indicator --}}
            <p class="text-gray-400 font-semibold">STEP 4 OF 4</p>
            <h1 class="text-3xl font-extrabold">Choose how to pay</h1>
            <p class="text-gray-400 text-sm">
                Your payment is encrypted and you can change your payment method at anytime.<br>
                Secure for peace of mind. Cancel easily online. End-to-end encrypted.
            </p>

            {{-- Error Message --}}
            <div id="error-message" class="hidden bg-red-600/20 border border-red-600 text-red-400 p-4 rounded"></div>

            {{-- Payment Tabs --}}
            <div class="flex border-b border-gray-700 mb-6">
                <button id="card-tab" class="px-6 py-2 border-b-2 border-red-600 font-semibold hover:border-gray-500">
                    Credit / Debit Card
                </button>
                <button id="upi-tab"
                    class="px-6 py-2 border-b-2 border-transparent font-semibold hover:border-gray-500">
                    UPI / App Payments
                </button>
            </div>


            {{-- Card Payment Form --}}
            <form id="payment-form" class="space-y-4">
                @csrf

                {{-- Name on Card --}}
                <div>
                    <label class="text-gray-300 font-semibold">Name on card</label>
                    <input id="card-name" type="text" placeholder="John Doe" required
                        class="w-full p-3 mt-2 rounded bg-[#1c1c1c] border border-gray-700" />
                </div>

                {{-- Card Number (Stripe cardNumber element) --}}
                <div>
                    <label class="text-gray-300 font-semibold">Card number</label>
                    <div id="card-number" class="p-3 mt-2 rounded bg-[#1c1c1c] border border-gray-700"></div>
                </div>

                {{-- Expiry & CVV (Stripe cardExpiry & cardCvc elements) --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-gray-300 font-semibold">Expiry</label>
                        <div id="card-expiry" class="p-3 mt-2 rounded bg-[#1c1c1c] border border-gray-700"></div>
                    </div>
                    <div>
                        <label class="text-gray-300 font-semibold">CVV</label>
                        <div id="card-cvc" class="p-3 mt-2 rounded bg-[#1c1c1c] border border-gray-700"></div>
                    </div>
                </div>

                {{-- Change Plan Info --}}
                <div class="flex justify-between items-center mt-4 px-4 pt-2 bg-[#1c1c1c] rounded border border-gray-700">
                    <div>
                        <p class="text-gray-300 font-semibold">{{ $plan_name ?? 'Selected Plan' }}</p>
                        <p class="text-gray-400 text-sm">₹{{ $amount ?? '0' }}/{{ $interval ?? 'daily' }}</p>
                    </div>
                    <div>
                        <a href="{{ route('subscription') }}"
                            class="text-red-600 font-semibold hover:underline text-sm">
                            Change
                        </a>
                    </div>
                </div>

                {{-- Info Note --}}
                <p class="text-gray-400 text-sm">
                    Any payment above ₹2000 will need additional authentication.
                </p>

                {{-- Agreement Checkbox --}}
                <div class="flex items-start space-x-3 mt-4">
                    <input type="checkbox" id="agree" required class="mt-1" />
                    <label for="agree" class="text-gray-400 text-sm  pl-2">
                        By ticking the box below, you agree to our <a href="#" class="underline">Terms of Use</a> and <a
                            href="#" class="underline">Privacy Statement</a> and confirm that you are over 18. Netflix
                        will automatically continue your membership and charge the membership fee (currently
                        ₹{{ $amount ?? '0' }}/{{ $interval ?? 'daily' }}) to your payment method until you cancel. You
                        may cancel at any time to avoid future charges.
                    </label>
                </div>

                {{-- Submit Button --}}
                <button type="submit" id="submit-button"
                    class="bg-red-600 w-full p-3 rounded font-bold hover:bg-red-700 transition mt-4 flex items-center justify-center">
                    <span id="button-text">Pay ₹{{ $amount ?? '0' }}/{{ $interval ?? 'daily' }}</span>
                    <div id="button-loader" class="loader hidden ml-2"></div>
                </button>
            </form>

            {{-- UPI / App Payment (placeholder) --}}
            <div id="upi-form" class="hidden flex flex-col gap-4">
                <p class="text-gray-400 font-semibold mb-2">Pay via UPI / Applications</p>
                <div class="grid grid-cols-2 gap-4">
                    <button class="bg-gray-800 p-4 rounded-lg hover:bg-gray-700 transition">BHIM</button>
                    <button class="bg-gray-800 p-4 rounded-lg hover:bg-gray-700 transition">Paytm</button>
                    <button class="bg-gray-800 p-4 rounded-lg hover:bg-gray-700 transition">PhonePe</button>
                    <button class="bg-gray-800 p-4 rounded-lg hover:bg-gray-700 transition">Amazon Pay</button>
                    <button class="bg-gray-800 p-4 rounded-lg hover:bg-gray-700 transition">Google Pay</button>
                </div>
                <p class="text-gray-400 text-sm mt-4">*This is a placeholder. Integrate your preferred UPI gateway for
                    real payments.*</p>
            </div>

        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function () {

            // Tabs
            const $cardTab = $('#card-tab');
            const $upiTab = $('#upi-tab');
            const $paymentForm = $('#payment-form');
            const $upiForm = $('#upi-form');

            $cardTab.on('click', function () {
                $cardTab
                    .addClass('border-red-600')
                    .removeClass('border-transparent');
                $upiTab
                    .addClass('border-transparent')
                    .removeClass('border-red-600');
                $paymentForm.removeClass('hidden');
                $upiForm.addClass('hidden');
            });

            $upiTab.on('click', function () {
                $upiTab
                    .addClass('border-red-600')
                    .removeClass('border-transparent');
                $cardTab
                    .addClass('border-transparent')
                    .removeClass('border-red-600');
                $upiForm.removeClass('hidden');
                $paymentForm.addClass('hidden');
            });
            // Stripe
            const stripeKey = @json(config('services.stripe.key'));
            if (!stripeKey) {
                console.error('Stripe key is missing!');
                showError('Payment configuration error. Please contact support.');
                return;
            }

            const stripe = Stripe(stripeKey);
            const elements = stripe.elements();

            const style = {
                base: { color: '#ffffff', fontSize: '16px', '::placeholder': { color: '#9ca3af' } },
                invalid: { color: '#ff6b6b' }
            };

            const cardNumber = elements.create('cardNumber', { style });
            const cardExpiry = elements.create('cardExpiry', { style });
            const cardCvc = elements.create('cardCvc', { style });

            cardNumber.mount('#card-number');
            cardExpiry.mount('#card-expiry');
            cardCvc.mount('#card-cvc');

            // Helper functions
            function showError(message) {
                const $errorDiv = $('#error-message');
                $errorDiv.text(message).removeClass('hidden');
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }

            function setLoading(isLoading) {
                const $button = $('#submit-button');
                const $buttonText = $('#button-text');
                const $loader = $('#button-loader');

                $button.prop('disabled', isLoading);
                if (isLoading) {
                    $buttonText.text('Processing...');
                    $loader.removeClass('hidden');
                } else {
                    $buttonText.text('Pay ₹{{ $amount ?? '0' }}/{{ $interval ?? 'daily' }}');
                    $loader.addClass('hidden');
                }
            }

            // Handle form submission
            $('#payment-form').on('submit', async function (e) {
                e.preventDefault();
                $('#error-message').addClass('hidden');

                const name = $('#card-name').val().trim();
                if (!name) {
                    showError('Please enter the name on card.');
                    return;
                }

                setLoading(true);

                try {
                    // Create Stripe payment method
                    const { paymentMethod, error } = await stripe.createPaymentMethod({
                        type: 'card',
                        card: cardNumber,
                        billing_details: { name }
                    });

                    if (error) {
                        showError(error.message);
                        setLoading(false);
                        return;
                    }

                    // Send to backend via AJAX
                    const response = await $.ajax({
                        url: '{{ route('subscription.subscribe') }}',
                        type: 'POST',
                        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                        contentType: 'application/json',
                        data: JSON.stringify({
                            payment_method: paymentMethod.id,
                            plan: '{{ $price_id }}'
                        })
                    });

                    if (response.error) {
                        showError(response.error);
                        setLoading(false);
                        return;
                    }

                    if (response.requires_action) {
                        const { error: confirmError } = await stripe.confirmCardPayment(
                            response.payment_intent_client_secret
                        );

                        if (confirmError) {
                            showError(confirmError.message);
                            setLoading(false);
                            return;
                        }
                    }

                    // Success: redirect
                    window.location.href = response.redirect || '{{ route('home') }}';

                } catch (err) {
                    console.error('Payment error:', err);
                    showError('An unexpected error occurred. Please try again.');
                    setLoading(false);
                }
            });
        });



    </script>

</body>

</html>