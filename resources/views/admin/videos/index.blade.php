<x-layouts.app>

    @section('content')
        <div class="container mx-auto py-10 min-h-screen">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-white">Videos</h1>
                <a href="{{ route('admin.videos.create') }}"
                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded no-underline!">Upload New Video</a>
            </div>

            @if(session('success'))
                <div class="bg-green-500 text-white p-3 rounded mb-4">{{ session('success') }}</div>
            @endif

            <table class="min-w-full bg-black text-white rounded overflow-hidden">
                <thead>
                    <tr class="bg-gray-900">
                        <th class="py-2 px-4">No.</th>
                        <th class="py-2 px-4">Id</th>
                        <th class="py-2 px-4">Poster</th>
                        <th class="py-2 px-4">Video</th>
                        <th class="py-2 px-4">Title</th>
                        <th class="py-2 px-4">Title Poster</th>
                        <th class="py-2 px-4">Movie Type</th>
                        <th class="py-2 px-4">Collection</th>
                        <th class="py-2 px-4">Description</th>
                        <th class="py-2 px-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($localVideos as $video)
                        <tr class="border-b border-gray-700 items-center">
                            <td class="py-2 px-4">{{ $loop->iteration + ($localVideos->currentPage() - 1) * $localVideos->perPage() }}</td>
                            <td class="py-2 px-4">{{ $video->id }}</td>

                            {{-- Poster --}}
                            <td class="py-2 px-4">
                                @if($video->poster)
                                    <img src="{{ asset('storage/' . $video->poster) }}" alt="Poster" 
                                        class="w-40 h-12 object-cover rounded" loading="lazy">
                                @else
                                    <span class="text-gray-400">No Image</span>
                                @endif
                            </td>

                            {{-- Lazy video --}}
                            <td class="py-2 px-4 align-middle text-center">
                                @if($video->file_path)
                                    <div class="inline-block w-48 relative group">
                                        {{-- Thumbnail --}}
                                        <img src="{{ asset('storage/' . ($video->poster ?? 'defaults/poster.jpg')) }}" loading="lazy"
                                            alt="{{ $video->title }}" class="w-full rounded cursor-pointer lazy-thumb"
                                            data-src="{{ asset('storage/' . $video->file_path) }}" onclick="playVideo(this)"
                                            loading="lazy">

                                        {{-- Hidden video --}}
                                        <video class="hidden rounded w-full h-auto" muted controls preload="none">
                                            <source src="" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>
                                @else
                                    <span class="text-gray-400">No Video</span>
                                @endif
                            </td>

                            <td class="py-2 px-4">{{ $video->title }}</td>

                            {{-- Title poster --}}
                            <td class="py-2 px-4">
                                @if($video->title_poster)
                                    <img src="{{ asset('storage/' . $video->title_poster) }}" alt="Title Poster" loading="lazy"
                                        class="w-40 h-12 object-cover rounded" loading="lazy">
                                @else
                                    <span class="text-gray-400">No Image</span>
                                @endif
                            </td>

                            <!-- type -->
                            <td class="py-2 px-4">
                                @if($video->types->isNotEmpty())
                                    {{ $video->types->pluck('name')->join(', ') }}
                                @else
                                    <span class="text-gray-400">No Type</span>
                                @endif
                            </td>

                            <!-- Collection -->
                            <td class="py-2 px-4">
                                @if($video->collections->isNotEmpty())
                                    {{ $video->collections->pluck('title')->join(', ') }}
                                @else
                                    <span class="text-gray-400">No Collection</span>
                                @endif
                            </td>

                            <!-- description -->
                            <td class="py-2 px-4">{{ $video->description }}</td>

                            <!-- action -->
                            <td class="py-2 px-4 space-x-2">
                                <a href="{{ route('admin.videos.edit', $video) }}"
                                    class="bg-blue-600 hover:bg-blue-700 px-3 py-1 rounded text-white no-underline!">Update</a>

                                <form action="{{ route('admin.videos.destroy', $video) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 hover:bg-red-700 px-3 py-1 rounded">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-4 px-4 text-center text-gray-400">No videos found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-6 flex justify-end">
                {{ $localVideos->links() }}
            </div>
        </div>

        {{-- Lazy video loader --}}
        <script>
            function playVideo(imgElement) {
                const video = imgElement.nextElementSibling;
                const source = video.querySelector('source');
                source.src = imgElement.dataset.src;

                imgElement.classList.add('hidden');
                video.classList.remove('hidden');
                video.load();
                video.play();
            }
        </script>
    @endsection

</x-layouts.app>