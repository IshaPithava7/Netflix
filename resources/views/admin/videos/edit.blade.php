<x-layouts.app>

    @section('content')
    <!-- Custom Dark Theme CSS -->
    <style>
        /* Default theme dark mode */
        .select2-container--default .select2-selection--multiple {
            background-color: #1f2937 !important;
            border: none !important;
            min-height: 44px !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #374151 !important;
            border: 1px solid #4b5563 !important;
            color: #ffffff !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: #9ca3af !important;
        }

        /* Search field placeholder white */
        .select2-search--inline .select2-search__field::placeholder {
            color: #d1d5dc !important;
        }


        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
            color: #ef4444 !important;
        }

        .select2-container--default .select2-search--inline .select2-search__field {
            color: #ffffff !important;
        }

        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border: 1px solid #4b5563 !important;
        }

        .select2-dropdown {
            background-color: #1f2937 !important;
            border: 1px solid #374151 !important;
        }

        .select2-search--dropdown .select2-search__field {
            background-color: #374151 !important;
            border: 1px solid #4b5563 !important;
            color: #ffffff !important;
        }

        .select2-results__option {
            background-color: #1f2937 !important;
            color: #ffffff !important;
        }

        .select2-results__option--highlighted[aria-selected] {
            background-color: #374151 !important;
        }

        .select2-results__option[aria-selected="true"] {
            background-color: #4b5563 !important;
        }
    </style>
    <div class="container mx-auto py-10 min-h-screen">
        <div class="max-w-2xl mx-auto bg-black text-white p-6 rounded-lg shadow-lg">
            <h1 class="text-2xl font-bold mb-6">Edit Video</h1>

            @if ($errors->any())
            <div class="bg-red-600 text-white p-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('admin.videos.update', $video) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium mb-1">Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $video->title) }}"
                        class="w-full bg-gray-800 border border-gray-700 rounded px-3 py-2 focus:outline-none focus:border-red-500">
                </div>

                <!-- For Kids -->
                <div class="flex items-center mb-4">
                    <input type="checkbox" name="for_kids" id="for_kids" value="1" class="rounded" @if($video->for_kids) checked @endif>
                    <label for="for_kids" class="ml-2 text-white">For Kids</label>
                </div>

                <!-- Video URL -->
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium mb-1">Description</label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full bg-gray-800 border border-gray-700 rounded px-3 py-2 focus:outline-none focus:border-red-500">{{ old('description', $video->description) }}</textarea>
                </div>

                <!-- Video Types Multi-Select -->
                <div class="mb-6">
                    <label for="types" class="block text-sm font-medium mb-1 text-white">Select Video Types</label>
                    <select name="types[]" id="types" multiple
                        class="w-full p-3 rounded bg-gray-800 text-white select2-dark">
                        @foreach($types as $type)
                        <option value="{{ $type->id }}" {{ in_array($type->id, $video->types->pluck('id')->toArray()) ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                        @endforeach
                    </select>
                    <p class="text-gray-400 text-xs mt-1">Hold Ctrl (Windows) / Cmd (Mac) to select multiple types</p>
                </div>

                <!-- ✅ Video Collections Multi-Select -->
                <div class="mb-6">
                    <label for="collections" class="block text-sm font-medium mb-1 text-white">
                        Select Collections
                    </label>
                    <select name="collections[]" id="collections" multiple
                        class="w-full p-3 rounded bg-gray-800 text-white select2-dark border border-gray-700">
                        @foreach($collections as $collection)
                        <option value="{{ $collection->id }}"
                            {{ isset($video) && $video->collections->pluck('id')->contains($collection->id) ? 'selected' : '' }}>
                            {{ $collection->title }}
                        </option>
                        @endforeach
                    </select>
                    <p class="text-gray-400 text-xs mt-1">
                        Hold Ctrl (Windows) / Cmd (Mac) to select multiple collections
                    </p>
                </div>

                <!-- Title Poster -->
                <div class="mb-6">
                    <label for="title_poster" class="block text-sm font-medium mb-1">Title Poster</label>
                    @if($video->title_poster)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $video->title_poster) }}" alt="Title Poster" loading="lazy"
                            class="w-40 h-24 object-cover rounded">
                    </div>
                    @endif
                    <input type="file" name="title_poster" id="title_poster"
                        class="w-full text-sm text-gray-300 border border-gray-700 rounded cursor-pointer bg-gray-800 focus:outline-none">
                    <p class="text-gray-400 text-xs mt-1">Leave empty if you don’t want to change the poster.</p>
                    <div id="title-poster-preview-container" class="mt-2 {{ $video->title_poster ? '' : 'hidden' }}">
                        <p class="text-white font-semibold mb-1">Title Poster Preview:</p>
                        <img id="title-poster-preview" class="w-40 h-24 object-cover rounded" loading="lazy"
                            src="{{ $video->title_poster ? asset('storage/' . $video->title_poster) : '' }}"
                            alt="Title Poster Preview">
                    </div>
                </div>

                <!-- Video URL -->
                <!-- Video URL -->
                <div class="mt-4">
                    <label for="video_url" class="block text-sm font-medium mb-1">Video URL</label>

                    <input id="video_url"
                        class="block mt-1 w-full text-white bg-gray-800 rounded p-2 border border-gray-700"
                        type="file"
                        name="video_url"
                        value="{{ old('video_url', $video->video_url) }}">

                    @error('video_url')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Poster -->
                <div class="mb-6">
                    <label for="poster" class="block text-sm font-medium mb-1">Poster</label>
                    @if($video->poster)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $video->poster) }}" alt="Poster" loading="lazy"
                            class="w-40 h-24 object-cover rounded">
                    </div>
                    @endif
                    <input type="file" name="poster" id="poster"
                        class="w-full text-sm text-gray-300 border border-gray-700 rounded cursor-pointer bg-gray-800 focus:outline-none">
                    <p class="text-gray-400 text-xs mt-1">Leave empty if you don’t want to change the poster.</p>
                    <div id="poster-preview-container" class="mt-2 {{ $video->poster ? '' : 'hidden' }}">
                        <p class="text-white font-semibold mb-1">Poster Preview:</p>
                        <img id="poster-preview" class="w-40 h-24 object-cover rounded" loading="lazy"
                            src="{{ $video->poster ? asset('storage/' . $video->poster) : '' }}" alt="Poster Preview">
                    </div>
                </div>

                <!-- Video File -->
                <div class="mb-6">
                    <label for="video" class="block text-sm font-medium mb-1">Video</label>
                    @if($video->file_path)
                    <div class="mb-2">
                        <video controls class="w-full max-h-64 rounded">
                            <source src="{{ asset('storage/' . $video->file_path) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                    @endif
                    <input type="file" name="video" id="video"
                        class="w-full text-sm text-gray-300 border border-gray-700 rounded cursor-pointer bg-gray-800 focus:outline-none">
                    <p class="text-gray-400 text-xs mt-1">Leave empty if you don’t want to change the video.</p>
                    <div id="video-preview-container" class="mt-2 {{ $video->file_path ? '' : 'hidden' }}">
                        <p class="text-white font-semibold mb-1">Video Preview:</p>
                        <video id="video-preview" class="w-full max-h-64 rounded" controls>
                            @if($video->file_path)
                            <source src="{{ asset('storage/' . $video->file_path) }}" type="video/mp4">
                            @endif
                            Your browser does not support the video tag.
                        </video>
                    </div>
                </div>

                <div class="flex justify-between items-center mt-6">
                    <a href="{{ route('admin.videos.index') }}"
                        class="bg-gray-700 hover:bg-gray-600 px-4 py-2 rounded">Cancel</a>
                    <button type="submit" class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded text-white">Update
                        Video</button>
                </div>
            </form>
        </div>
    </div>



    <!-- JS Preview & Select2 Init -->
    <script>
        $(document).ready(function() {
            // Select2 Dark
            $('#types').select2({
                placeholder: "Select video types",
                allowClear: true,
                width: '100%',

            });

            // Video preview
            $('#video').on('change', function() {
                const file = this.files[0];
                const $preview = $('#video-preview');
                const $container = $('#video-preview-container');
                if (file) {
                    $preview.attr('src', URL.createObjectURL(file));
                    $container.removeClass('hidden');
                }
            });

            // Poster preview
            $('#poster').on('change', function() {
                const file = this.files[0];
                const $preview = $('#poster-preview');
                const $container = $('#poster-preview-container');
                if (file) {
                    $preview.attr('src', URL.createObjectURL(file));
                    $container.removeClass('hidden');
                }
            });

            // Title poster preview
            $('#title_poster').on('change', function() {
                const file = this.files[0];
                const $preview = $('#title-poster-preview');
                const $container = $('#title-poster-preview-container');
                if (file) {
                    $preview.attr('src', URL.createObjectURL(file));
                    $container.removeClass('hidden');
                }
            });

            // AJAX form submission
            $('form').on('submit', function(e) {
                e.preventDefault();

                // Clear previous errors
                $('.error-message').remove();
                $('.border-red-500').removeClass('border-red-500');

                let form = $(this);
                let formData = new FormData(this);

                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Show success message
                        alert('Video updated successfully!');
                        // Redirect to the videos index page
                        window.location.href = "{{ route('admin.videos.index') }}";
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            // Handle validation errors
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                let element = $('#' + key);
                                element.addClass('border-red-500');
                                element.after('<p class="text-red-500 text-xs mt-1 error-message">' + value[0] + '</p>');
                            });
                        } else {
                            // Handle other errors
                            alert('An unexpected error occurred. Please try again.');
                        }
                    }
                });
            });
        });
    </script>
    @endsection

</x-layouts.app>