<div id="sectionInfoModal"
    class="fixed inset-0 bg-black/30 backdrop-blur-[1px] flex items-start py-6 justify-center opacity-0 pointer-events-none transition-opacity duration-300 z-50 overflow-y-auto">

    <div class="bg-[#181818] w-[850px] max-w-4xl rounded-lg overflow-hidden relative shadow-2xl">

        <!-- Close Button -->
        <button id="closeModal"
            class="absolute top-4 right-4 flex items-center justify-center w-8 h-8 rounded-full bg-[#181818] text-white text-3xl font-light z-50">
            <svg viewBox="0 0 24 24" width="18" height="18" data-icon="XMedium" data-icon-id=":r2c:" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" fill="none" role="img">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M10.5858 12L2.29291 3.70706L3.70712 2.29285L12 10.5857L20.2929 2.29285L21.7071 3.70706L13.4142 12L21.7071 20.2928L20.2929 21.7071L12 13.4142L3.70712 21.7071L2.29291 20.2928L10.5858 12Z"
                    fill="currentColor"></path>
            </svg>
        </button>

        <!-- Video / Poster -->
        <div class="relative w-full max-w-[850px] h-[480px] bg-black overflow-hidden">
            <video id="sectionModalVideo" class="absolute inset-0 w-full h-full object-cover hidden" autoplay muted loop
                playsinline>
                <source src="" type="video/mp4">
            </video>

            <img id="sectionModalPoster" class="absolute inset-0 w-full h-full object-cover hidden" alt="Poster" />



            <!-- Bottom blur/fade -->
            <div class="absolute bottom-0 left-0 w-full h-15 bg-gradient-to-t from-[#181818] to-transparent ">
            </div>


            {{-- Title and Buttons --}}
            <div class="absolute bottom-20 left-15 z-10 transition-opacity duration-700 opacity-100">
                <img id="sectionModalTitlePoster"
                    class="mb-6 w-[300px] h-auto object-contain transition-all duration-700">

                <div class="flex items-center space-x-4 mt-4">
                    <button
                        class="flex items-center justify-center space-x-2 bg-white text-black font-bold w-[126px] h-[46px] !rounded-md hover:bg-gray-300 transition duration-300">
                        <svg viewBox="0 0 24 24" width="24" height="24" fill="none">
                            <path
                                d="M5 2.69127C5 1.93067 5.81547 1.44851 6.48192 1.81506L23.4069 11.1238C24.0977 11.5037 24.0977 12.4963 23.4069 12.8762L6.48192 22.1849C5.81546 22.5515 5 22.0693 5 21.3087V2.69127Z"
                                fill="currentColor"></path>
                        </svg>
                        <span>Play</span>
                    </button>

                    <!-- Add to List -->
                    <button
                        class="flex items-center justify-center w-[46px] h-[46px] !rounded-full bg-[#2a2a2a99] hover:bg-[Transparent] hover:border-[#ffffff] text-white transition duration-300 border-2 border-[#ffffff80]">
                        <svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M11 11V2H13V11H22V13H13V22H11V13H2V11H11Z" />
                        </svg>
                    </button>

                    <!-- Thumbs Up -->
                    <button
                        class="flex items-center justify-center w-[46px] h-[46px] !rounded-full bg-[#2a2a2a99] hover:bg-[Transparent] hover:border-[#ffffff] text-white transition duration-300 border-2 border-[#ffffff80]">
                        <svg viewBox="0 0 24 24" width="24" height="24" data-icon="ThumbsUpMedium" data-icon-id=":ra8:"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" role="img">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M10.696 8.7732C10.8947 8.45534 11 8.08804 11 7.7132V4H11.8377C12.7152 4 13.4285 4.55292 13.6073 5.31126C13.8233 6.22758 14 7.22716 14 8C14 8.58478 13.8976 9.1919 13.7536 9.75039L13.4315 11H14.7219H17.5C18.3284 11 19 11.6716 19 12.5C19 12.5929 18.9917 12.6831 18.976 12.7699L18.8955 13.2149L19.1764 13.5692C19.3794 13.8252 19.5 14.1471 19.5 14.5C19.5 14.8529 19.3794 15.1748 19.1764 15.4308L18.8955 15.7851L18.976 16.2301C18.9917 16.317 19 16.4071 19 16.5C19 16.9901 18.766 17.4253 18.3994 17.7006L18 18.0006L18 18.5001C17.9999 19.3285 17.3284 20 16.5 20H14H13H12.6228C11.6554 20 10.6944 19.844 9.77673 19.5382L8.28366 19.0405C7.22457 18.6874 6.11617 18.5051 5 18.5001V13.7543L7.03558 13.1727C7.74927 12.9688 8.36203 12.5076 8.75542 11.8781L10.696 8.7732ZM10.5 2C9.67157 2 9 2.67157 9 3.5V7.7132L7.05942 10.8181C6.92829 11.0279 6.72404 11.1817 6.48614 11.2497L4.45056 11.8313C3.59195 12.0766 3 12.8613 3 13.7543V18.5468C3 19.6255 3.87447 20.5 4.95319 20.5C5.87021 20.5 6.78124 20.6478 7.65121 20.9378L9.14427 21.4355C10.2659 21.8094 11.4405 22 12.6228 22H13H14H16.5C18.2692 22 19.7319 20.6873 19.967 18.9827C20.6039 18.3496 21 17.4709 21 16.5C21 16.4369 20.9983 16.3742 20.995 16.3118C21.3153 15.783 21.5 15.1622 21.5 14.5C21.5 13.8378 21.3153 13.217 20.995 12.6883C20.9983 12.6258 21 12.5631 21 12.5C21 10.567 19.433 9 17.5 9H15.9338C15.9752 8.6755 16 8.33974 16 8C16 6.98865 15.7788 5.80611 15.5539 4.85235C15.1401 3.09702 13.5428 2 11.8377 2H10.5Z"
                                fill="currentColor"></path>
                        </svg>
                    </button>


                </div>
            </div>
        </div>

        <!-- Movie Details -->
        <div id="movieDetails"
            class="pt-0 px-10 pb-10 bg-gradient-to-t from-[#181818] via-[#181818]/80 to-transparent  relative rounded-t-3xl">
            <div class="grid grid-cols-3 gap-8">
                <!-- Left Column -->
                <div class="col-span-2 ">
                    <!-- Meta Info -->
                    <div class="flex items-center gap-3 mb-4">
                        <span id="movieYear" class="text-[#bcbcbc] font-semibold text-sm">2022</span>
                        <span id="movieDuration" class="text-[#bcbcbc] text-sm">2h 7m</span>
                        <span class="border rounded border-[#ffffff66] text-gray-400 text-xs px-1.5 py-0.5">HD</span>
                    </div>

                    <!-- Rating -->
                    <div class="flex items-center gap-2 mb-5">
                        <span class="border rounded border-[#ffffff66] text-white text-xs px-2 py-1 font-semibold">U/A
                            16+</span>
                        <span id="movieTags" class="text-gray-400 text-sm">gore, sexual content, violence</span>
                    </div>

                    <!-- Description -->
                    <p id="movieDescription" class="text-white text-sm leading-relaxed">
                        When a singer goes missing amid a serial killing spree, a cabbie and a businessman's
                        son cross paths in a twisted tale where good and evil is blurred.
                    </p>
                </div>

                <!-- Right Column -->
                <div class="space-y-3 text-sm">
                    <!-- Cast -->
                    <div>
                        <p><span class="text-[#777]">Cast: </span> <span id="movieCast" class="text-white">John Abraham, Arjun Kapoor,
                                Disha
                                Patani</span>
                        </p>

                    </div>

                    <!-- Genres -->
                    <div>
                        <p><span class="text-gray-500">Genres:</span> <span id="movieGenres" class="text-white">Hindi-Language Movies,
                                Bollywood
                                Movies, Crime Movies</span></p>
                    </div>

                    <!-- Movie Type -->
                    <div>
                        <p><span class="text-gray-500">This Movie Is:</span> <span id="movieMood" class="text-white">Dark</span></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- More Like This Section -->
        @if($localVideos->count() > 0)
            <div class="px-10 pb-10 bg-[#181818]">
                <h3 class="text-white text-xl font-semibold mb-5">More Like This</h3>

                <div class="grid grid-cols-3  gap-4">
                    @foreach($localVideos as $video)

                        @if($loop->iteration > 12)
                            @break
                        @endif

                        @php
                            $poster = $video->poster && !filter_var($video->poster, FILTER_VALIDATE_URL)
                                ? asset('storage/' . $video->poster)
                                : $video->poster;
                        @endphp

                        <div
                            class="bg-[#2f2f2f] rounded overflow-hidden group relative hover:scale-[1.03] transition-transform duration-300">
                            <div class="relative">
                                @if($poster)
                                    <img src="{{ $poster }}" alt="{{ $video->title }}" class="w-full h-40 object-cover">
                                @else
                                    <div class="w-full h-40 bg-gray-700 flex items-center justify-center text-gray-400">
                                        No Image
                                    </div>
                                @endif
                                <div class="absolute top-2 right-2 text-white text-xs bg-black/60 px-1.5 py-0.5 rounded">
                                    {{ $video->duration ?? '1h 45m' }}
                                </div>
                            </div>

                            <div class="p-3">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center gap-2 text-[10px] md:text-xs">
                                        <span class="border border-gray-500 text-white px-1.5 py-0.5">U/A 13+</span>
                                        <span class="border border-gray-500 text-gray-400 px-1.5 py-0.5">HD</span>
                                        <span class="text-gray-400">{{ $video->year ?? '2024' }}</span>
                                    </div>

                                    {{-- Add / Remove My List --}}
                                    <button
                                        class="toggle-mylist flex items-center justify-center w-8 h-8 rounded-full border-2 border-gray-400 bg-black/50 hover:bg-white/20 text-white transition"
                                        data-video-id="{{ $video->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" id="mylist-icon-{{ $video->id }}">
                                           @if(Auth::check() && isset($myListIds[$video->id]))
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
                                </div>

                                <p class="text-white text-xs font-medium truncate">{{ $video->title }}</p>
                                <p class="text-gray-400 text-[11px] leading-tight line-clamp-2">
                                    {{ $video->description ?? 'No description available.' }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="text-gray-400 text-center py-10">
                No similar titles found.
            </div>
        @endif

        <!-- Divider with chevron -->
        <div class="flex justify-center py-2 bg-[#181818]">
            <button
                class="flex items-center justify-center w-10 h-10 rounded-full border-2 border-gray-600 bg-transparent hover:border-white text-white transition">
                <svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor">
                    <path d="M12 15.5L6.5 10L7.91 8.59L12 12.67L16.09 8.59L17.5 10L12 15.5Z"></path>
                </svg>
            </button>
        </div>

        <!-- Trailers & More Section -->
        <div class="px-10 pb-6 bg-[#181818]">
            <h3 class="text-white text-2xl font-semibold mb-6">Trailers & More</h3>

            <div class="mb-8">
                <div
                    class="relative rounded overflow-hidden cursor-pointer hover:scale-105 transition-transform duration-300 inline-block">
                    <img src="https://images.unsplash.com/photo-1536440136628-849c177e76a1?w=220&h=124&fit=crop"
                        alt="Trailer" class="w-56 h-32 object-cover">
                    <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
                        <div class="w-12 h-12 rounded-full border-2 border-white flex items-center justify-center">
                            <svg viewBox="0 0 24 24" width="20" height="20" fill="white" class="ml-1">
                                <path d="M8 5v14l11-7z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <p class="text-white text-sm mt-3 font-medium">Ek Villain 2: Trailer</p>
            </div>
        </div>

        <!-- About Section -->
        <div class="px-10 pb-10 bg-[#181818]">
            <h3 class="text-white text-2xl font-semibold mb-6">About Ek Villain Returns</h3>

            <div class="space-y-2 text-sm">
                <!-- Director -->
                <div>
                    <span class="text-[#777]">Director: </span>
                    <span class="text-white">Mohit Suri</span>
                </div>

                <!-- Cast -->
                <div>
                    <span class="text-[#777]">Cast: </span>
                    <span class="text-white">John Abraham, Arjun Kapoor, Disha Patani, Tara Sutaria, J.D.
                        Chakravarthi, Shaad Randhawa, Bharat Dabholkar, Ivan Rodrigues</span>
                </div>

                <!-- Writer -->
                <div>
                    <span class="text-[#777]">Writer: </span>
                    <span class="text-white">Mohit Suri, Aseem Arrora</span>
                </div>

                <!-- Genres -->
                <div>
                    <span class="text-[#777]">Genres: </span>
                    <span class="text-white">Hindi-Language Movies, Bollywood Movies, Crime Movies, Thriller
                        Movies</span>
                </div>

                <!-- This Movie Is -->
                <div>
                    <span class="text-[#777]">This Movie Is: </span>
                    <span class="text-white">Dark</span>
                </div>

                <!-- Maturity Rating -->
                <div>
                    <span class="text-[#777]">Maturity Rating: </span>
                    <span class="border border-gray-500 text-white text-xs px-2 py-1 font-semibold">U/A
                        16+</span>
                    <span class="text-white ml-2">gore, sexual content, violence Suitable for persons aged
                        16 and above and under parental guidance for people under age
                        of 16</span>
                </div>


            </div>
        </div>

    </div>
</div>