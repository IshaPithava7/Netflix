@extends('account.account')

@section('content')
    {{-- Main Content Area --}}
    <div class="flex-1">

        {{-- Security Section --}}
        <div class="mb-12">
            <h1 class="text-2xl font-bold mb-4">Security</h1>
            <p class="text-gray-600 mb-6">Account details</p>

            {{-- Account Details Card --}}
            <div class="bg-white border border-gray-200 rounded-lg mb-4">
                {{-- Password --}}
                <div class="p-6 border-b border-gray-200">
                    <a href="{{ route('password.edit') }}" class="flex items-center justify-between w-full text-left group !no-underline">
                        <div class="flex items-center gap-4">
                            <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            <span class="font-semibold  text-black">Password</span>
                        </div>
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-black transition" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>

                </div>

                {{-- Email --}}
                <div class="p-6 border-b border-gray-200">
                    <button onclick="alert('Change email')"
                        class="flex items-center justify-between w-full text-left group">
                        <div class="flex items-start gap-4 flex-1">
                            <svg class="w-5 h-5 text-gray-700 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <div class="flex-1">
                                <div class="font-semibold mb-1">Email</div>
                                <div class="text-gray-600 text-sm">{{ auth()->user()->email }}</div>
                                @if(auth()->user()->hasVerifiedEmail())
                                    <div class="flex items-center gap-1 text-green-600 text-sm mt-1">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span>Verified</span>
                                    </div>
                                @else
                                    <div class="text-red-600 text-sm mt-1">
                                        <span>⚠ Needs verification</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-black transition" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>

                {{-- Mobile Phone --}}
                <div class="p-6">
                    <button onclick="alert('Add phone')" class="flex items-center justify-between w-full text-left group">
                        <div class="flex items-start gap-4 flex-1">
                            <svg class="w-5 h-5 text-gray-700 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                            <div class="flex-1">
                                <div class="font-semibold mb-1">Mobile phone</div>
                                <div class="text-gray-600 text-sm">+270 438 18645</div>
                                <div class="text-red-600 text-sm mt-1">
                                    <span>⚠ Needs verification</span>
                                </div>
                            </div>
                        </div>
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-black transition" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Access and Privacy --}}
            <p class="text-gray-600 mb-6 mt-8">Access and privacy</p>
            <div class="bg-white border border-gray-200 rounded-lg mb-4">
                <div class="p-6 border-b border-gray-200">
                    <button onclick="alert('Manage devices')"
                        class="flex items-center justify-between w-full text-left group">
                        <div class="flex items-start gap-4 flex-1">
                            <svg class="w-5 h-5 text-gray-700 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <div class="flex-1">
                                <div class="font-semibold mb-1">Access and devices</div>
                                <div class="text-gray-600 text-sm">Manage signed-in devices</div>
                            </div>
                        </div>
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-black transition" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>

                <div class="p-6 border-b border-gray-200">
                    <button onclick="alert('Transfer profile')"
                        class="flex items-center justify-between w-full text-left group">
                        <div class="flex items-start gap-4 flex-1">
                            <svg class="w-5 h-5 text-gray-700 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                            </svg>
                            <div class="flex-1">
                                <div class="font-semibold mb-1 flex items-center gap-2">
                                    Profile transfer
                                    <span
                                        class="bg-blue-100 text-blue-700 text-xs font-semibold px-2 py-0.5 rounded">New</span>
                                </div>
                                <div class="text-gray-600 text-sm">On</div>
                            </div>
                        </div>
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-black transition" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>

                <div class="p-6 border-b border-gray-200">
                    <button onclick="alert('Request personal info')"
                        class="flex items-center justify-between w-full text-left group">
                        <div class="flex items-start gap-4 flex-1">
                            <svg class="w-5 h-5 text-gray-700 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <div class="flex-1">
                                <div class="font-semibold mb-1">Personal info access</div>
                                <div class="text-gray-600 text-sm">Request a copy of your personal info</div>
                            </div>
                        </div>
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-black transition" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>

                <div class="p-6">
                    <button onclick="alert('Feature testing')"
                        class="flex items-center justify-between w-full text-left group">
                        <div class="flex items-start gap-4 flex-1">
                            <svg class="w-5 h-5 text-gray-700 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                            </svg>
                            <div class="flex-1">
                                <div class="font-semibold mb-1">Feature testing</div>
                                <div class="text-gray-600 text-sm">On</div>
                            </div>
                        </div>
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-black transition" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Email Verification Notice --}}
            @if(!auth()->user()->hasVerifiedEmail())
                <div class="mt-6 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                    <p class="text-yellow-800 text-sm mb-2">Your email needs verification</p>
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

        {{-- Delete Account Button --}}
        <form action="{{ route('account.delete') }}" method="POST"
            onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.')">
            @csrf
            @method('DELETE')
            <button type="submit"
                class="w-full bg-white border border-gray-200 rounded-lg p-6 text-red-600 font-medium hover:bg-gray-50 transition">
                Delete account
            </button>
        </form>
    </div>
@endsection