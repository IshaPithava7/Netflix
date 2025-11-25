
@extends('account.account')


@section('content')

    {{-- Main Content Area --}}
    <div class="flex-1">

        {{-- Membership Section --}}
        <div class="mb-12">
            <h1 class="text-2xl font-bold mb-4">Membership</h1>
            <p class="text-gray-600 mb-6">Plan Details</p>


            @if($subscription && $subscription->active())
                {{-- Plan Details Card --}}
                <div class="bg-white border border-gray-200 rounded-lg mb-4">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="font-semibold text-lg mb-2">{{ $planName }}</h3>
                        <p class="text-gray-600 text-sm"> {{ $subscription ? '4K video resolution with spatial audio, ad-free watching and more.' : 'No active plan.' }}</p>
                    </div>

                    <div class="p-6">
                        <button onclick="window.location.href=''"
                            class="flex items-center justify-between w-full text-left group">
                            <span class="font-medium">Change plan</span>
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-black transition" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Payment Info Section --}}
                <div class="mb-6">
                    <p class="text-gray-600 mb-4">Payment info</p>

                    <div class="bg-white border border-gray-200 rounded-lg">
                        {{-- Next Payment --}}
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="font-semibold text-lg mb-2">Next payment</h3>
                            <p class="text-gray-600 mb-3">{{ optional($endsAt)->format('d F Y') ?? '18 October 2025' }}</p>
                            <div class="flex items-center gap-2 text-sm text-gray-600">
                                <svg class="w-5 h-5" viewBox="0 0 48 48" fill="none">
                                    <path d="M24 4C12.95 4 4 12.95 4 24s8.95 20 20 20 20-8.95 20-20S35.05 4 24 4z"
                                        fill="#4285F4" />
                                    <path d="M34 24c0 5.52-4.48 10-10 10s-10-4.48-10-10 4.48-10 10-10 10 4.48 10 10z"
                                        fill="#34A853" />
                                    <path d="M24 14c-2.76 0-5 2.24-5 5h10c0-2.76-2.24-5-5-5z" fill="#FBBC04" />
                                    <path d="M24 29c-2.76 0-5 2.24-5 5h10c0-2.76-2.24-5-5-5z" fill="#EA4335" />
                                </svg>
                                <span>••••@okaxis</span>
                            </div>
                        </div>

                        {{-- Manage Payment Method --}}
                        <div class="p-6 border-b border-gray-200">
                            <button onclick="alert('Payment method management')"
                                class="flex items-center justify-between w-full text-left group">
                                <span class="font-medium">Manage payment method</span>
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-black transition" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>

                        {{-- Redeem Gift or Promo Code --}}
                        <div class="p-6 border-b border-gray-200">
                            <button onclick="alert('Redeem code')"
                                class="flex items-center justify-between w-full text-left group">
                                <span class="font-medium">Redeem gift or promo code</span>
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-black transition" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>

                        {{-- View Payment History --}}
                        <div class="p-6">
                            <button onclick="alert('Payment history')"
                                class="flex items-center justify-between w-full text-left group">
                                <span class="font-medium">View payment history</span>
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-black transition" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Cancel Membership Button --}}
                <form action="{{ route('subscription.cancel') }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to cancel your subscription?');">
                    @csrf
                    @method('PATCH')
                    <button type="submit"
                        class="w-full bg-white border border-gray-200 rounded-lg p-6 text-red-600 font-medium hover:bg-gray-50 transition">
                        Cancel Membership
                    </button>
                </form>

                {{-- Email Verification Notice --}}
                @if(!auth()->user()->hasVerifiedEmail())
                    <div class="mt-6 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                        <p class="text-yellow-800 text-sm mb-2">✖ Email not verified</p>
                        <form action="{{ route('verification.send') }}" method="POST" class="inline-block">
                            @csrf
                            <button type="submit" class="text-blue-600 hover:underline text-sm font-semibold">
                                Send Verification Email
                            </button>
                        </form>

                        @if (session('status') == 'verification-link-sent')
                            <p class="text-green-600 text-sm mt-2">
                                ✅ A new verification link has been sent to your email address.
                            </p>
                        @endif
                    </div>
                @endif
            @else
                <div class="text-center py-8 bg-white border border-gray-200 rounded-lg">
                    <p class="text-gray-600 mb-4">No active subscription.</p>
                    <a href="{{ route('subscription') }}"
                        class="inline-block bg-red-600 text-white px-6 py-3 rounded font-semibold hover:bg-red-700 transition no-underline!">
                        Subscribe Now
                    </a>
                </div>
            @endif
        </div>


    </div>



@endsection