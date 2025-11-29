<x-layouts.app>
    @section('content')
    <div class="container mx-auto py-20">
        <h1 class="text-3xl font-bold mb-6">Shows</h1>
        
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @forelse($shows as $show)
                <div class="bg-gray-800 rounded-lg overflow-hidden">
                    <a href="#">
                        <img src="{{ $show->poster ? asset('storage/' . $show->poster) : asset('defaults/poster.jpg') }}" alt="{{ $show->title }}" class="w-full h-auto">
                    </a>
                    <div class="p-4">
                        <h3 class="font-bold text-lg">{{ $show->title }}</h3>
                    </div>
                </div>
            @empty
                <p class="text-gray-300">No shows available for kids at the moment.</p>
            @endforelse
        </div>
    </div>
    @endsection
</x-layouts.app>
