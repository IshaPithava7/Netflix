<x-layouts.app>


@section('content')
    <style>
        /* Default theme dark mode */
        .select2-container--default .select2-selection--multiple {
            background-color: #1e2939 !important;
            min-height: 44px !important;
            border: none !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #374151 !important;

            color: #ffffff !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: #9ca3af !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
            color: #ef4444 !important;
        }

        .select2-container--default .select2-search--inline .select2-search__field {
            color: #ffffff !important;

        }

        .select2-container--default.select2-container--focus .select2-selection--multiple {}

        .select2-container--default .select2-selection--multiple .select2-selection__placeholder {
            color: #ffffff !important;
        }

        /* Search field placeholder white */
        .select2-search--inline .select2-search__field::placeholder {
            color: #ffffff !important;
        }

        .select2-dropdown {
            background-color: #1f2937 !important;
        }

        .select2-search--dropdown .select2-search__field {
            background-color: #1e2939 !important;
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
    <script>
        $(document).ready(function () {
            $('#types').select2({
                placeholder: "Select video types",
                allowClear: true,
                width: '100%',

            });

        });
    </script>

    <div class="container mx-auto py-10 min-h-screen max-w-2xl">
        <h1 class="text-3xl font-bold mb-6 text-white">Upload New Video</h1>

        @if ($errors->any())
            <div class="bg-red-600 text-white p-4 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.videos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Title -->
            <div>
                <label for="title" class="block text-white font-semibold mb-1">Title</label>
                <input type="text" name="title" id="title" class="w-full p-3 rounded bg-gray-800 text-white" required>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-white font-semibold mb-1">Description</label>
                <textarea name="description" id="description" class="w-full p-3 rounded bg-gray-800 text-white"
                    rows="4"></textarea>
            </div>

            <!-- Video Upload -->
            <div>
                <label for="video" class="block text-white font-semibold mb-1">Upload Video (MP4, MOV, AVI)</label>
                <input type="file" name="video" id="video" accept=".mp4,.mov,.avi"
                    class="w-full p-3 rounded bg-gray-800 text-white" required>
            </div>

            <!-- Video Preview -->
            <div id="video-preview-container" class="mt-4 hidden">
                <p class="text-white font-semibold mb-1">Video Preview:</p>
                <video id="video-preview" class="w-64 h-auto rounded bg-gray-800" controls></video>
            </div>

            <!-- ✅ Video Types -->
            <div>
                <label for="types" class="block text-white font-semibold mb-1">Select Video Types</label>
                <select name="types[]" id="types" multiple class="w-full p-3 rounded bg-gray-800 text-[#ffffff]">
                    @foreach($types as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- ✅ Video Collection -->
            <div class="mb-4">
                <label for="collections" class="block font-semibold mb-2 text-white">Collections (Optional)</label>
                <select name="collections[]" id="collections" multiple class="form-select w-full bg-[#131313]">
                    @foreach($collections as $collection)
                        <option value="{{ $collection->id }}" @if(isset($video) && $video->collections->contains($collection->id)) selected @endif>
                            {{ $collection->title }}
                        </option>
                    @endforeach
                </select>
                <small class="text-gray-500">Hold Ctrl (Windows) or ⌘ (Mac) to select multiple.</small>
            </div>


            <!-- ✅ Poster Upload -->
            <div>
                <label for="poster" class="block text-white font-semibold mb-1">Upload Poster (JPEG, PNG, JPG)</label>
                <input type="file" name="poster" id="poster" accept=".jpeg,.jpg,.png,.webp"
                    class="w-full p-3 rounded bg-gray-800 text-white">
                <p class="text-sm text-gray-400 mt-1">Optional — shown as thumbnail for your video</p>
            </div>

            <!-- Poster Preview -->
            <div id="poster-preview-container" class="mt-4 hidden">
                <p class="text-white font-semibold mb-1">Poster Preview:</p>
                <img id="poster-preview" class="w-64 h-auto rounded bg-gray-800" alt="Poster Preview">
            </div>

            <!-- ✅ Title_Poster Upload -->
            <div>
                <label for="title_poster" class="block text-white font-semibold mb-1">Upload Title_Poster (JPEG, PNG,
                    JPG)</label>
                <input type="file" name="title_poster" id="title_poster" accept=".jpeg,.jpg,.png,.webp"
                    class="w-full p-3 rounded bg-gray-800 text-white">
                <p class="text-sm text-gray-400 mt-1">Optional — shown as thumbnail for your video</p>
            </div>

            <!-- Title Poster Preview -->
            <div id="title-poster-preview-container" class="mt-4 hidden">
                <p class="text-white font-semibold mb-1">Title Poster Preview:</p>
                <img id="title-poster-preview" class="w-64 h-auto rounded bg-gray-800" alt="Title Poster Preview">
            </div>

            <!-- Submit -->
            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded font-bold">
                Upload Video
            </button>
        </form>
    </div>

    <script>
        $(document).ready(function () {
            // Video Preview
            $('#video').on('change', function () {
                const file = this.files[0];
                const $previewContainer = $('#video-preview-container');
                const $preview = $('#video-preview');

                if (file) {
                    const url = URL.createObjectURL(file);
                    $preview.attr('src', url);
                    $previewContainer.removeClass('hidden');
                } else {
                    $preview.attr('src', '');
                    $previewContainer.addClass('hidden');
                }
            });

            // Poster Preview
            $('#poster').on('change', function () {
                const file = this.files[0];
                const $previewContainer = $('#poster-preview-container');
                const $preview = $('#poster-preview');

                if (file) {
                    const url = URL.createObjectURL(file);
                    $preview.attr('src', url);
                    $previewContainer.removeClass('hidden');
                } else {
                    $preview.attr('src', '');
                    $previewContainer.addClass('hidden');
                }
            });

            // Title Poster Preview
            $('#title_poster').on('change', function () {
                const file = this.files[0];
                const $previewContainer = $('#title-poster-preview-container');
                const $preview = $('#title-poster-preview');

                if (file) {
                    const url = URL.createObjectURL(file);
                    $preview.attr('src', url);
                    $previewContainer.removeClass('hidden');
                } else {
                    $preview.attr('src', '');
                    $previewContainer.addClass('hidden');
                }
            });
        });
    </script>

@endsection

</x-layouts.app>