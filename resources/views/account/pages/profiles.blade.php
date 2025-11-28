@extends('account.account')

@section('content')
<section class="max-w-3xl mx-auto bg-white p-6">
    <p class="text-2xl font-semibold text-gray-900 mb-1">Profiles</p>
    <p class="text-gray-500 mb-6">Parental controls and permissions</p>

    <div class="divide-y divide-gray-200 border border-gray-200 rounded-lg overflow-hidden">
        <!-- Adjust parental controls -->
        <div class="flex items-center justify-between p-4 hover:bg-gray-50 cursor-pointer">
            <div class="flex items-start gap-3">
                <div class="p-2 bg-gray-100 rounded-md">
                    <svg viewBox="0 0 24 24" width="24" height="24" data-icon="HexagonExclamationPointMedium" data-icon-id=":r2p:" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" role="img">
                        <path fill="currentColor" fill-rule="evenodd" d="m2.76 12 4.62 8h9.24l4.62-8-4.62-8H7.38zm-2.02-.5a1 1 0 0 0 0 1l5.2 9c.18.3.5.5.86.5h10.4a1 1 0 0 0 .86-.5l5.2-9a1 1 0 0 0 0-1l-5.2-9a1 1 0 0 0-.86-.5H6.8a1 1 0 0 0-.86.5zm12.76 4a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-8.5h-3l.5 6h2z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-gray-900 font-medium">Adjust parental controls</p>
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
                    <svg viewBox="0 0 24 24" width="24" height="24" data-icon="ProfileArrowMedium" data-icon-id=":r34:" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" role="img">
                        <path fill="currentColor" fill-rule="evenodd" d="M6 1a4 4 0 0 0-4 4v12a4 4 0 0 0 4 4h3.59l-1.3 1.3 1.42 1.4 3-3a1 1 0 0 0 0-1.4l-3-3-1.42 1.4L9.6 19H6a2 2 0 0 1-2-2V5c0-1.1.9-2 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2h-3v2h3a4 4 0 0 0 4-4V5a4 4 0 0 0-4-4zm1.5 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3M18 8.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m-1.6 3.7a5 5 0 0 1-2.9.8 5 5 0 0 1-2.9-.8l-1.2 1.6a7 7 0 0 0 4.1 1.2c1.58 0 3.07-.43 4.1-1.2z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-gray-900 font-medium">Transfer a profile</p>
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

<section class="max-w-3xl mx-auto bg-white p-6 mt-6">
    <p class="text-2xl font-semibold text-gray-900 mb-1">Profile settings</p>
    <div class="divide-y divide-gray-200 border border-gray-200 rounded-lg overflow-hidden mt-6">
        @foreach ($profiles as $profile)
        <div class="flex items-center justify-between p-4 hover:bg-gray-50 cursor-pointer">
            <div class="flex items-center">
                <img class="w-12 h-12 rounded-md mr-4" src="{{ $profile->avatar ?? 'https://i.pravatar.cc/150' }}" alt="">
                <div>
                    <p class="font-bold pt-3">{{ $profile->name }}</p>
                </div>
            </div>
            @if (session('selected_profile_id') == $profile->id)
            <span class="text-sm ml-95 text-gray-500 bg-blue-100 px-2 py-1 rounded-md">Your Profile</span>
            @endif
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </div>
        @endforeach
    </div>
</section>
@endsection