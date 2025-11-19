<x-layouts.app>

@section('content')

    <div class="bg-[#141414] min-h-screen text-white overflow-hidden">
        {{-- Header --}}
        <div class="flex justify-between items-center mb-10 bg-[#141414] px-14 py-6 sticky top-16 z-40">
            <h2 class="text-3xl tracking-wide">My List</h2>
            <p class="text-gray-400 text-lg">{{ $videos->count() }} {{ $videos->count() === 1 ? 'title' : 'titles' }}</p>
        </div>


        @if($videos->count() > 0)
            <div
                class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-x-2 gap-y-15 mt-40 px-16 pb-20 overflow-visible">
                @foreach($videos as $video)
                    @php
                        $poster = $video->poster && !filter_var($video->poster, FILTER_VALIDATE_URL)
                            ? asset('storage/' . $video->poster)
                            : $video->poster;
                    @endphp

                    <div class="group relative z-0 hover:!z-[9999] transition-[z-index] duration-0 hover:delay-0 delay-300">
                        {{-- Base Card --}}
                        <div
                            class="relative bg-[#1a1a1a] rounded-xs overflow-hidden aspect-video shadow-lg transition-all duration-300 ease-in-out  cursor-pointer">
                            @if($video->file_path)
                                <video class="w-full h-full object-cover" muted poster="{{ $poster }}">
                                    <source src="{{ asset('storage/' . $video->file_path) }}" type="video/mp4">
                                </video>
                            @elseif($poster)
                                <img src="{{ $poster }}" alt="{{ $video->title }}" class="w-full h-full object-cover">
                            @endif

                        </div>

                        {{-- Hover Expansion Card --}}
                        <div
                            class="absolute top-[-40px] left-1/2  -translate-x-1/2 invisible opacity-0 group-hover:visible group-hover:opacity-100 transition-all duration-300 ease-in-out group-hover:delay-500 w-[300px] rounded-lg overflow-hidden shadow-2xl bg-[#181818] group-hover:scale-110 origin-top pointer-events-none group-hover:pointer-events-auto z-[9999]">

                            {{-- Video Preview --}}
                            <div class="relative aspect-video">
                                @if($video->file_path)
                                    <video class="w-full h-full object-cover" autoplay muted loop poster="{{ $poster }}">
                                        <source src="{{ asset('storage/' . $video->file_path) }}" type="video/mp4">
                                    </video>
                                @elseif($poster)
                                    <img src="{{ $poster }}" alt="{{ $video->title }}" class="w-full h-full object-cover">
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-[#181818] via-transparent to-transparent"></div>
                            </div>

                            {{-- Card Content --}}
                            <div class="p-4 space-y-3">
                                {{-- Action Buttons Row --}}
                                <div class="flex items-center justify-between gap-2">
                                    <div class="flex gap-2">
                                        <button
                                            class="bg-white text-black rounded-full w-8 h-8 flex items-center justify-center hover:bg-gray-300 transition">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M8 5v14l11-7z" />
                                            </svg>
                                        </button>

                                        <button
                                            class="toggle-mylist border-2 border-gray-500 text-white rounded-full w-8 h-8 flex items-center justify-center hover:border-white transition"
                                            data-video-id="{{ $video->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" id="mylist-icon-{{ $video->id }}">
                                                @if(in_array($video->id, $myListIds))

                                                    <!-- Already in My List: show check -->
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5 13l4 4L19 7" />
                                                @else
                                                    <!-- Not in My List: show plus -->
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                @endif
                                            </svg>
                                        </button>



                                        <button
                                            class="border-2 border-gray-500 text-white rounded-full w-8 h-8 flex items-center justify-center hover:border-white transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                            </svg>
                                        </button>
                                    </div>


                                </div>

                                {{-- Title --}}
                                <h3 class="text-base font-semibold line-clamp-1">{{ $video->title }}</h3>

                                {{-- Metadata --}}
                                <div class="flex items-center gap-2 text-xs text-gray-400">
                                    <span class="text-green-500 font-semibold">98% Match</span>
                                    <span>•</span>
                                    <span class="px-1.5 py-0.5 border border-gray-500 rounded text-[10px]">U/A 13+</span>
                                    <span>•</span>
                                    <span class="px-1.5 py-0.5 border border-gray-500 rounded text-[10px]">HD</span>
                                </div>

                                {{-- Duration & Genres --}}
                                <div class="flex items-center gap-2 text-xs text-gray-400">
                                    <span>{{ $video->duration ?? '1h 52m' }}</span>
                                    <span>•</span>
                                    <span>Action • Drama • Thriller</span>
                                </div>

                                {{-- Description --}}
                                @if($video->description)
                                    <p class="text-xs text-gray-400 line-clamp-3 leading-relaxed">
                                        {{ $video->description }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            {{-- Empty State --}}
            <div class="flex flex-col items-center justify-center text-center text-gray-400 py-32 px-10">
                <svg class="w-24 h-24 mb-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                <h3 class="text-2xl font-semibold text-white mb-2">Your list is empty</h3>
                <p class="text-lg mb-6">Titles you add to your list will appear here</p>
                <a href="{{ route('home') }}"
                    class="bg-white text-black px-6 py-3 rounded-md font-semibold hover:bg-gray-300 transition">
                    Explore Titles
                </a>
            </div>
        @endif
    </div>

    {{-- jQuery remove script --}}
    <script>
        $(document).ready(function () {
            $('.toggle-mylist').click(function (e) {
                e.stopPropagation();
                const videoId = $(this).data('video-id');
                const card = $(this).closest('.group');
                const button = $(this);
                const icon = button.find('svg');

                // Show loading state (optional)
                button.prop('disabled', true);

                $.post("{{ route('mylist.toggle') }}", {
                    _token: "{{ csrf_token() }}",
                    video_id: videoId
                })
                    .done(function (data) {
                        if (data.status === 'added') {
                            // Change icon to check
                            icon.html('<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>');
                        } else if (data.status === 'removed') {
                            // Change icon to plus
                            icon.html('<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>');

                            // Remove card from list visually
                            card.fadeOut(300, function () {
                                $(this).remove();

                                // Update count
                                const countElement = $('.text-gray-400.text-lg');
                                const currentCount = parseInt(countElement.text());
                                const newCount = currentCount - 1;
                                countElement.text(`${newCount} ${newCount === 1 ? 'title' : 'titles'}`);

                                // Show empty state if no items left
                                if (newCount === 0) {
                                    location.reload();
                                }
                            });
                        }
                    })
                    .fail(function () {
                        alert('Failed to update list. Please try again.');
                    })
                    .always(function () {
                        button.prop('disabled', false);
                    });
            });
        });
    </script>


@endsection

</x-layouts.app>