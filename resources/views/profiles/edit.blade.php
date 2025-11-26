<x-layouts.app>

    @section('content')
    <div class="flex items-center justify-center min-h-screen">
        <div class="w-full max-w-md">
            <form action="{{ route('profiles.update', $profile) }}" method="POST" class="bg-gray-800 shadow-md rounded px-8 pt-6 pb-8 mb-4">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block text-white text-sm font-bold mb-2" for="name">
                        Profile Name
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" name="name" type="text" placeholder="Profile Name" value="{{ $profile->name }}">
                </div>

                <div class="mb-4">
                    <label class="block text-white text-sm font-bold mb-2">
                        Choose an avatar
                    </label>
                    <div class="flex space-x-4">
                        @foreach($avatars as $avatar)
                        <div class="cursor-pointer avatar-select" data-avatar="{{ $avatar }}">
                            <img src="{{ $avatar }}" alt="Avatar" class="w-16 h-16 rounded-full @if($profile->avatar === $avatar) border-4 border-red-600 @endif">
                        </div>
                        @endforeach
                    </div>
                    <input type="hidden" name="avatar" id="avatar" value="{{ $profile->avatar }}">
                </div>

                <div class="flex items-center justify-between">
                    <button class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Update Profile
                    </button>
                    <a class="inline-block align-baseline font-bold text-sm text-red-600 hover:text-red-800" href="{{ route('profiles.index') }}">
                        Cancel
                    </a>
                </div>
            </form>
            <form action="{{ route('profiles.destroy', $profile) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Delete Profile
                </button>
            </form>
        </div>
    </div>
    @endsection

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const avatarSelects = document.querySelectorAll('.avatar-select');
            const avatarInput = document.getElementById('avatar');

            avatarSelects.forEach(select => {
                select.addEventListener('click', function () {
                    // Set the value of the hidden input
                    avatarInput.value = this.dataset.avatar;

                    // Remove border from all avatars
                    avatarSelects.forEach(s => s.querySelector('img').classList.remove('border-4', 'border-red-600'));

                    // Add border to selected avatar
                    this.querySelector('img').classList.add('border-4', 'border-red-600');
                });
            });
        });
    </script>
    @endpush

</x-layouts.app>