@extends('account.account')

@section('content')
    <section class="max-w-3xl mx-auto bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h2 class="text-2xl font-semibold text-gray-900 mb-1">Profiles</h2>
        <p class="text-gray-500 mb-6">Parental controls and permissions</p>

        <div class="divide-y divide-gray-200 border border-gray-200 rounded-lg overflow-hidden">
            <!-- Adjust parental controls -->
            <div class="flex items-center justify-between p-4 hover:bg-gray-50 cursor-pointer">
                <div class="flex items-start gap-3">
                    <div class="p-2 bg-gray-100 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-700" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01M5.07 19h13.86a2 2 0 001.9-2.58l-6.94-14a2 2 0 00-3.84 0l-6.94 14A2 2 0 005.07 19z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-gray-900 font-medium">Adjust parental controls</h3>
                        <p class="text-gray-500 text-sm">Set maturity ratings, block titles</p>
                    </div>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </div>

            <!-- Transfer a profile -->
            <div class="flex items-center justify-between p-4 hover:bg-gray-50 cursor-pointer">
                <div class="flex items-start gap-3">
                    <div class="p-2 bg-gray-100 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-700" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 17l5-5m0 0l-5-5m5 5H9m4 5a9 9 0 110-18 9 9 0 010 18z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-gray-900 font-medium">Transfer a profile</h3>
                        <p class="text-gray-500 text-sm">Copy a profile to another account</p>
                    </div>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </div>
        </div>
    </section>


@endsection