<x-layouts.app>

    @section('content')

    <div class="bg-[#141414] min-h-screen text-white overflow-hidden">
        {{-- Header --}}
        <div class="flex justify-between items-center mb-10 bg-[#141414] px-14 py-6 sticky top-16 z-40">
            <h2 class="text-3xl tracking-wide">My List</h2>
            <p class="text-gray-400 text-lg">{{ $videos->count() }} {{ $videos->count() === 1 ? 'title' : 'titles' }}</p>
        </div>

        @if($videos->count() > 0)
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-x-2 gap-y-15 mt-40 px-16 pb-20 overflow-visible">
            @foreach($videos as $video)
                <x-video-card :video="$video" type="mylist" :my-list-ids="$myListIds" />
            @endforeach
        </div>
        @else
        {{-- Empty State --}}
        <div class="flex flex-col items-center justify-center text-center text-gray-400 py-32 px-10">
            <svg class="w-24 h-24 mb-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
            <h3 class="text-2xl font-semibold text-white mb-2">Your list is empty</h3>
            <p class="text-lg mb-6">Titles you add to your list will appear here</p>
            <a href="{{ route('home') }}" class="bg-white text-black px-6 py-3 rounded-md font-semibold hover:bg-gray-300 transition">
                Explore Titles
            </a>
        </div>
        @endif
    </div>

    <!-- custom js -->
    <script src="{{ asset('assets/js/mylist.js') }}"></script>
    @endsection

</x-layouts.app>