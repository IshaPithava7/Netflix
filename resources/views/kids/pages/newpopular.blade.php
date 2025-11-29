<x-layouts.app>
    @section('content')
    <div class="container mx-auto py-20">
        <h1 class="text-3xl font-bold mb-6">New & Popular</h1>
        
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @forelse($newAndPopular as $video)
                <div class="bg-gray-800 rounded-lg overflow-hidden">
                    <a href="#">
                        <img src="{{ $video->poster ? asset('storage/' . $video->poster) : asset('defaults/poster.jpg') }}" alt="{{ $video->title }}" class="w-full h-auto">
                    </a>
                    <div class="p-4">
                        <h3 class="font-bold text-lg">{{ $video->title }}</h3>
                    </div>
                </div>
            @empty
                <p class="text-gray-300">No new or popular videos available for kids at the moment.</p>
            @endforelse
        </div>
    </div>
    @endsection
</x-layouts.app>
