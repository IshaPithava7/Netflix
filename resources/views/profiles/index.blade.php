<x-layouts.app>

    @section('content')
    <div class="flex items-center justify-center min-h-screen">
        <div class="text-center">
            <h1 class="text-5xl text-white mb-8">Who's Watching?</h1>
            <div class="flex space-x-8">
                @foreach($profiles as $profile)
                <a href="{{ route('profiles.switch', $profile) }}">
                    <div class="text-center">
                        <div class="w-32 h-32 bg-gray-700 rounded-md mb-2 @if(session('selected_profile_id') == $profile->id) border-4 border-white @endif">
                            @if($profile->avatar)
                            <img src="{{ $profile->avatar }}" alt="{{ $profile->name }}" class="w-full h-full object-cover rounded-md">
                            @endif
                        </div>
                        <p class="text-gray-400">{{ $profile->name }}</p>
                    </div>
                </a>
                @endforeach
                <a href="{{ route('profiles.create') }}">
                    <div class="text-center">
                        <div class="w-32 h-32 bg-gray-700 rounded-md mb-2 flex items-center justify-center">
                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </div>
                        <p class="text-gray-400">Add Profile</p>
                    </div>
                </a>
            </div>
            <div class="mt-8">
                <a href="{{ route('profiles.manage') }}" class="text-gray-400 border border-gray-400 px-4 py-2 rounded-md hover:text-white hover:border-white">Manage Profiles</a>
            </div>
        </div>
    </div>
    @endsection

</x-layouts.app>
