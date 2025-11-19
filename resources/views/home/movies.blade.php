<x-layouts.app>

@section('content')
 
    
    <!-- 🔝 Hero Section -->
    <section class="relative w-full h-[80vh] overflow-hidden">
        <video class="absolute inset-0 w-full h-full object-cover" autoplay muted loop playsinline>
            <source src="{{ asset('storage') }}" type="video/mp4">
        </video>

        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/70 to-transparent"></div>

        <div class="absolute bottom-32 left-12 text-white space-y-4">
            <h1 class="text-5xl font-bold">Movies You’ll Love</h1>
            <p class="max-w-xl text-gray-300">
                Explore top trending movies and hidden gems, hand-picked just for you.
            </p>

            <div class="flex items-center space-x-3">
                <a href="#" class="bg-white text-black px-6 py-2 font-semibold rounded hover:bg-gray-300 transition">
                    ▶ Play
                </a>
                <button class="bg-gray-700/70 hover:bg-gray-600 text-white px-6 py-2 font-semibold rounded transition">
                    More Info
                </button>
            </div>
        </div>
    </section>

    <!-- 🎞️ Movie Sections -->
    <div class="bg-[#141414] text-white px-6 py-10 space-y-10">

        <!-- Loop through movies -->
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
            @foreach ($movies as $movie)
                <div class="relative group">
                    <img src="{{ asset('storage/' . $movie->poster) }}" 
                         alt="{{ $movie->title }}"
                         class="w-full h-64 object-cover rounded-xl transition-transform duration-300 group-hover:scale-105">

                    <div class="absolute inset-0 bg-black/70 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-center items-center text-center p-3">
                        <h2 class="text-lg font-bold">{{ $movie->title }}</h2>
                        <p class="text-gray-400 text-sm mt-1">{{ Str::limit($movie->description, 60) }}</p>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection

</x-layouts.app>