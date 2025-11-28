<x-layouts.app>

    @section('content')
    <div class="flex items-center justify-center min-h-screen">
        <div class="text-center">
            <h1 class="text-5xl text-white mb-8">Manage Profiles</h1>
            <div class="flex space-x-8">
                @foreach($profiles as $profile)
                <a href="{{ route('profiles.edit', $profile) }}" class="no-underline!">
                    <div class="text-center">
                        <div class="w-32 h-32 bg-gray-700 rounded-md mb-2 relative">
                            @if($profile->avatar)
                            <img src="{{ $profile->avatar }}" alt="{{ $profile->name }}" class="w-full h-full object-cover rounded-md">
                            @endif
                            <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.5L15.232 5.232z"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="text-gray-400">{{ $profile->name }}</p>
                    </div>
                </a>
                @endforeach
            </div>
            <div class="mt-8">
                <a href="{{ route('profiles.index') }}" class="text-white bg-red-600 px-4 py-2 rounded-md hover:bg-red-700 no-underline!">Done</a>
            </div>
        </div>
    </div>
    @endsection

</x-layouts.app>
