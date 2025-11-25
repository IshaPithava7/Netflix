<x-layouts.app>

@section('content')
    <div class="container mx-auto py-10 min-h-screen">
        <h1 class="text-4xl font-bold mb-6 text-white">Admin Dashboard</h1>

        <div class="grid grid-cols-2 gap-6">
            <a href="{{ route('admin.videos.index') }}"
                class="bg-red-600 hover:bg-red-700 text-white p-6 rounded shadow text-center no-underline!">
                <h2 class="text-2xl font-bold">Manage Videos</h2>
                <p>Upload, edit, and delete videos</p>
            </a>

            <a href="{{ route('admin.users.index') }}"
                class="bg-gray-800 hover:bg-gray-700 text-white p-6 rounded shadow text-center no-underline!">
                <h2 class="text-2xl font-bold">Manage Users</h2>
                <p>View all users and assign admin roles</p>
            </a>
        </div>
    </div>
@endsection

</x-layouts.app>