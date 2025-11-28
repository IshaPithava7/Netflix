<x-layouts.app title="Kids Home">

    @section('content')
    <div class="pt-24 px-10">
         <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach($videos as $video)
            <div class="bg-gray-800 rounded-lg overflow-hidden">
                <img src="{{ asset('storage/' . $video->poster) }}" alt="{{ $video->title }}" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-lg font-bold">{{ $video->title }}</h3>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endsection

</x-layouts.app>
