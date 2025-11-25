@props(['video', 'type' => 'collection', 'myListIds' => []])

@if($type === 'collection')
    {{-- The existing collection card markup --}}
    @php
        $poster = $video->poster;
        if ($poster && !filter_var($poster, FILTER_VALIDATE_URL)) {
            $poster = asset('storage/' . $poster);
        }
    @endphp
    <div class="swiper-slide">
        <div class="group/card relative w-[230px] h-[130px]">
            <div class="thumbnail-card relative bg-gray-900 shadow-lg overflow-hidden w-[230px] h-[130px] rounded-md cursor-pointer">
                <img src="{{ $poster }}" alt="{{ $video->title }}" class="w-[230px] h-[130px] object-cover" loading="lazy">
            </div>
            <div class="hover-card absolute left-1/2 top-0 w-[320px] rounded-lg overflow-hidden shadow-2xl bg-[#181818]">
                <div class="relative">
                    @if($video->file_path)
                    <video class="w-full h-[180px] object-cover" preload="none" autoplay muted loop poster="{{ $poster }}">
                        <source src="{{ asset('storage/' . $video->file_path) }}" type="video/mp4">
                    </video>
                    @else
                    <img src="{{ $poster }}" alt="{{ $video->title }}" class="w-full h-[180px] object-cover" loading="lazy">
                    @endif
                    <div class="absolute inset-0 bg-linear-to-t from-[#181818] via-transparent to-transparent"></div>
                    @if($video->title_poster)
                    <img src="{{ asset('storage/' . $video->title_poster) }}" alt="{{ $video->title }}" loading="lazy" class="absolute bottom-3 left-4 w-auto h-10 object-contain drop-shadow-lg">
                    @endif
                </div>
                <div class="p-4 space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="flex space-x-2">
                            <button class="bg-white text-black rounded-full! w-9 h-9 flex items-center justify-center hover:bg-gray-300 transition shadow-md">
                                <i class="fa-solid fa-play text-sm"></i>
                            </button>
                            <button class="border-2 border-gray-500 text-white rounded-full! w-9 h-9 flex items-center justify-center hover:border-white hover:bg-gray-700 transition">
                                <i class="fa-solid fa-plus text-sm"></i>
                            </button>
                            <button class="border-2 border-gray-500 text-white rounded-full! w-9 h-9 flex items-center justify-center hover:border-white hover:bg-gray-700 transition">
                                <i class="fa-solid fa-thumbs-up text-sm"></i>
                            </button>
                        </div>
                        <button class="border-2 border-gray-500 text-white rounded-full! w-9 h-9 flex items-center justify-center hover:border-white hover:bg-gray-700 transition">
                            <i class="fa-solid fa-chevron-down text-sm"></i>
                        </button>
                    </div>
                    <h3 class="text-base font-semibold text-white line-clamp-1">{{ $video->title }}</h3>
                    <div class="flex items-center space-x-2 text-xs">
                        <span class="text-green-500 font-semibold">98% Match</span>
                        <span class="border border-gray-500 px-1 text-gray-400">U/A 13+</span>
                        <span class="text-gray-400">{{ $video->duration ?? '1h 52m' }}</span>
                        <span class="border border-gray-500 px-1 text-xs text-gray-400">HD</span>
                    </div>
                    <div class="flex items-center space-x-1 text-xs text-gray-400">
                        @if($video->types)
                            @foreach($video->types as $type)
                                <span>{{ $type->name }}</span>
                                @if(!$loop->last)<span>•</span>@endif
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    {{-- The new mylist card markup --}}
    @php
    $poster = $video->poster && !filter_var($video->poster, FILTER_VALIDATE_URL)
    ? asset('storage/' . $video->poster)
    : $video->poster;
    @endphp

    <div class="group relative z-0 hover:!z-[9999] transition-[z-index] duration-0 hover:delay-0 delay-300">
        <div class="relative bg-[#1a1a1a] rounded-xs overflow-hidden aspect-video shadow-lg transition-all duration-300 ease-in-out cursor-pointer">
            @if($video->file_path)
            <video class="w-full h-full object-cover" muted poster="{{ $poster }}">
                <source src="{{ asset('storage/' . $video->file_path) }}" type="video/mp4">
            </video>
            @elseif($poster)
            <img src="{{ $poster }}" alt="{{ $video->title }}" class="w-full h-full object-cover" loading="lazy">
            @endif
        </div>
        <div class="absolute top-[-40px] left-1/2 -translate-x-1/2 invisible opacity-0 group-hover:visible group-hover:opacity-100 transition-all duration-300 ease-in-out group-hover:delay-500 w-[300px] rounded-lg overflow-hidden shadow-2xl bg-[#181818] group-hover:scale-110 origin-top pointer-events-none group-hover:pointer-events-auto z-[9999]">
            <div class="relative aspect-video">
                @if($video->file_path)
                <video class="w-full h-full object-cover" autoplay muted loop poster="{{ $poster }}">
                    <source src="{{ asset('storage/' . $video->file_path) }}" type="video/mp4">
                </video>
                @elseif($poster)
                <img src="{{ $poster }}" alt="{{ $video->title }}" class="w-full h-full object-cover" loading="lazy">
                @endif
                <div class="absolute inset-0 bg-linear-to-t from-[#181818] via-transparent to-transparent"></div>
            </div>
            <div class="p-4 space-y-3">
                <div class="flex items-center justify-between gap-2">
                    <div class="flex gap-2">
                        <button class="bg-white text-black rounded-full w-8 h-8 flex items-center justify-center hover:bg-gray-300 transition">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z" /></svg>
                        </button>
                        <button class="toggle-mylist border-2 border-gray-500 text-white rounded-full w-8 h-8 flex items-center justify-center hover:border-white transition" data-video-id="{{ $video->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" id="mylist-icon-{{ $video->id }}">
                                @if(in_array($video->id, $myListIds))
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                @else
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                @endif
                            </svg>
                        </button>
                        <button class="border-2 border-gray-500 text-white rounded-full w-8 h-8 flex items-center justify-center hover:border-white transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" /></svg>
                        </button>
                    </div>
                </div>
                <h3 class="text-base font-semibold line-clamp-1">{{ $video->title }}</h3>
                <div class="flex items-center gap-2 text-xs text-gray-400">
                    <span class="text-green-500 font-semibold">98% Match</span>
                    <span>•</span>
                    <span class="px-1.5 py-0.5 border border-gray-500 rounded text-[10px]">U/A 13+</span>
                    <span>•</span>
                    <span class="px-1.5 py-0.5 border border-gray-500 rounded text-[10px]">HD</span>
                </div>
                <div class="flex items-center gap-2 text-xs text-gray-400">
                    <span>{{ $video->duration ?? '1h 52m' }}</span>
                    <span>•</span>
                    @if($video->types)
                        @foreach($video->types as $type)
                            <span>{{ $type->name }}</span>
                            @if(!$loop->last)<span>•</span>@endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif
