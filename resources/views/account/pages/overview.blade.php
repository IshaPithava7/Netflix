@extends('account.account')

@section('content')
<style>
    .no-underline {
        text-decoration: none;
    }
</style>

{{-- Main Content Area --}}
<div class="flex-1">
    <h1 class="text-4xl font-bold mb-2">Account</h1>

    <div class="border-b border-gray-300 pb-8 mb-8">
        <h2 class="text-gray-600 text-lg mb-6">Membership details</h2>

        <div class="bg-white border border-gray-200 rounded-lg p-6">
            @php
            $subscription = auth()->user()
            ->CustomeSubscription()
            ->where('stripe_status', 'active')
            ->latest()
            ->first();

            $planName = 'No plan';
            $startsAt = null;
            $endsAt = null;

            if ($subscription) {
            $plan = \App\Models\Plan::find($subscription->plan_id);
            $planName = $plan->name ?? 'Unknown Plan';
            $startsAt = $subscription->created_at;
            $endsAt = $subscription->expires_at ?? null;
            }
            @endphp


            <div class="flex items-center gap-2 mb-4">
                <span class="bg-linear-to-r from-purple-600 to-red-600 text-white text-sm font-semibold px-4 py-1 rounded-full">
                    Member since {{ optional($startsAt)->format('F Y') ?? 'August 2025' }}
                </span>
            </div>

            @if($subscription)
            <div class="space-y-3">
                <div>
                    <h3 class="text-xl font-semibold mb-1">{{ $planName }}</h3>
                    <p class="text-gray-600">
                        Next payment: {{ optional($endsAt)->format('d F Y') ?? '18 October 2025' }}
                    </p>
                </div>

                <div class="flex items-center gap-2 text-sm text-gray-600">
                    <svg class="w-5 h-5" viewBox="0 0 48 48" fill="none">
                        <path d="M24 4C12.95 4 4 12.95 4 24s8.95 20 20 20 20-8.95 20-20S35.05 4 24 4z" fill="#4285F4" />
                        <path d="M34 24c0 5.52-4.48 10-10 10s-10-4.48-10-10 4.48-10 10-10 10 4.48 10 10z" fill="#34A853" />
                        <path d="M24 14c-2.76 0-5 2.24-5 5h10c0-2.76-2.24-5-5-5z" fill="#FBBC04" />
                        <path d="M24 29c-2.76 0-5 2.24-5 5h10c0-2.76-2.24-5-5-5z" fill="#EA4335" />
                    </svg>
                    {{ auth()->user()->email }}
                </div>
            </div>

            <div class="mt-6 pt-6 border-t border-gray-200">
                <button onclick="window.location.href='#'" class="flex items-center justify-between w-full text-left hover:underline group">
                    <span class="text-blue-600 font-medium">Manage membership</span>
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>

            {{-- Additional Actions --}}
            <div class="mt-6 space-y-3">
                @if(!auth()->user()->hasVerifiedEmail())
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
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
            </div>
            @else
            <div class="text-center py-8">
                <p class="text-gray-600 mb-4">No active subscription.</p>
                <a href="{{ route('subscription') }}" class="inline-block bg-red-600 text-white px-6 py-3 rounded font-semibold hover:bg-red-700 transition no-underline">
                    Subscribe Now
                </a>
            </div>
            @endif
        </div>
    </div>

    {{-- Quick Links Section --}}
    <div class="mb-8">
        <h2 class="text-gray-600 text-lg mb-6">Quick links</h2>

        <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
            {{-- Change Plan --}}
            <a href="{{ route('subscription.index') }}" class="flex items-center justify-between px-6 py-4 hover:bg-gray-50 transition border-b border-gray-200 group no-underline">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 flex items-center justify-center">
                        <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                        </svg>
                    </div>
                    <span class="font-medium text-gray-900 ">Change plan</span>
                </div>
                <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>

            {{-- Manage Payment Method --}}
            <a href="#" class="flex items-center justify-between px-6 py-4 hover:bg-gray-50 transition border-b border-gray-200 group no-underline">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 flex items-center justify-center">
                        <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                    </div>
                    <span class="font-medium text-gray-900">Manage payment method</span>
                </div>
                <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>

            {{-- Manage Access and Devices --}}
            <a href="#" class="flex items-center justify-between px-6 py-4 hover:bg-gray-50 transition border-b border-gray-200 group no-underline">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 flex items-center justify-center">
                        <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <span class="font-medium text-gray-900">Manage access and devices</span>
                </div>
                <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>

            {{-- Update Password --}}
            <a href="#" class="flex items-center justify-between px-6 py-4 hover:bg-gray-50 transition border-b border-gray-200 group no-underline">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 flex items-center justify-center">
                        <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <span class="font-medium text-gray-900">Update password</span>
                </div>
                <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>

            {{-- Transfer a Profile --}}
            <a href="#" class="flex items-center justify-between px-6 py-4 hover:bg-gray-50 transition border-b border-gray-200 group no-underline">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 flex items-center justify-center">
                        <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                        </svg>
                    </div>
                    <span class="font-medium text-gray-900">Transfer a profile</span>
                </div>
                <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>

            {{-- Adjust Parental Controls --}}
            <a href="#" class="flex items-center justify-between px-6 py-4 hover:bg-gray-50 transition border-b border-gray-200 group no-underline">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 flex items-center justify-center">
                        <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <span class="font-medium text-gray-900">Adjust parental controls</span>
                </div>
                <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>

            {{-- Edit Settings --}}
            <a href="#" class="flex items-center justify-between px-6 py-4 hover:bg-gray-50 transition group no-underline">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 flex items-center justify-center">
                        <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div>
                        <div class="font-medium text-gray-900">Edit settings</div>
                        <div class="text-sm text-gray-500">Languages, subtitles, autoplay, notifications, privacy and
                            more</div>
                    </div>
                </div>
                <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </div>

    {{-- Manage Profiles Section --}}
    <div class="mb-8">
        <h2 class="text-gray-600 text-lg mb-6">Manage profiles</h2>

        <div class="bg-white border border-gray-200 rounded-lg">
            <a href="#" class="flex items-center justify-between px-6 py-4 hover:bg-gray-50 transition group no-underline">
                <div class="flex items-center gap-3">
                    <span class="text-gray-900">5 profiles</span>
                    <div class="flex -space-x-2">
                        <img src="https://i.pravatar.cc/150?img=1" alt="Profile 1" loading="lazy" class="w-8 h-8 rounded-full border-2 border-white">
                        <img src="https://i.pravatar.cc/150?img=2" alt="Profile 2" loading="lazy" class="w-8 h-8 rounded-full border-2 border-white">
                        <img src="https://i.pravatar.cc/150?img=3" alt="Profile 3" loading="lazy" class="w-8 h-8 rounded-full border-2 border-white">
                        <img src="https://i.pravatar.cc/150?img=4" alt="Profile 4" loading="lazy" class="w-8 h-8 rounded-full border-2 border-white">
                        <div class="w-8 h-8 rounded-full border-2 border-white bg-red-500 flex items-center justify-center text-white text-xs font-bold">
                            K
                        </div>
                    </div>
                </div>
                <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </div>

</div>

@endsection