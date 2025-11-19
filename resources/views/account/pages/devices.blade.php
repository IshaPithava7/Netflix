@extends('account.account')

@section('content')
    {{-- Devices Section --}}
    <div class="mb-12">
        <h2 class="text-2xl font-bold mb-4">Devices</h2>
        <p class="text-gray-600 mb-6">Account access</p>

        {{-- Access and Devices Card --}}
        <div class="bg-white border border-gray-200 rounded-lg mb-8">
            <div class="p-6">
                <button onclick="alert('Manage devices')" class="flex items-center justify-between w-full text-left group">
                    <div class="flex items-start gap-4 flex-1">
                        <svg class="w-6 h-6 text-gray-700 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <div class="flex-1">
                            <div class="font-semibold text-lg mb-1">Access and devices</div>
                            <div class="text-gray-600 text-sm">Manage signed-in devices</div>
                        </div>
                    </div>
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-black transition" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- Mobile Downloads Section --}}
        <p class="text-gray-600 mb-6">Mobile downloads</p>

        <div class="bg-white border border-gray-200 rounded-lg">
            <div class="p-6">
                <button onclick="alert('Manage download devices')"
                    class="flex items-center justify-between w-full text-left group">
                    <div class="flex items-start gap-4 flex-1">
                        <svg class="w-6 h-6 text-gray-700 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        <div class="flex-1">
                            <div class="font-semibold text-lg mb-1">Mobile download devices</div>
                            <div class="text-gray-600 text-sm">Using 3 of 6 download devices</div>
                        </div>
                    </div>
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-black transition" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
@endsection