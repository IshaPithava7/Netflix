<x-layouts.app>

    @section('content')
        <div class="container mx-auto py-10 min-h-screen">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-white">Manage Users</h1>
                <a href="{{ route('admin.users.create') }}" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded no-underline!">Create New User</a>
            </div>

            @if (session('success'))
                <div class="bg-green-500 text-white p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <table class="min-w-full bg-black text-white rounded overflow-hidden">
                <thead>
                    <tr class="bg-gray-900">
                        <th class="py-2 px-4 text-left">No.</th>
                        <th class="py-2 px-4 text-left">ID</th>
                        <th class="py-2 px-4 text-left">Name</th>
                        <th class="py-2 px-4 text-left">Email</th>
                        <th class="py-2 px-4 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="border-b border-gray-700">
                            <td class="py-2 px-4">{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                            <td class="py-2 px-4">{{ $user->id }}</td>
                            <td class="py-2 px-4">{{ $user->name }}</td>
                            <td class="py-2 px-4">{{ $user->email }}</td>
                            <td class="py-2 px-4">
                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded">Edit</a>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-6 flex justify-end">
                {{ $users->links() }}
            </div>

        </div>

        <script>
            $(document).ready(function() {
                $('.delete-form').on('submit', function(e) {
                    e.preventDefault();

                    if (confirm('Are you sure you want to delete this user?')) {
                        var form = $(this);
                        var url = form.attr('action');

                        $.ajax({
                            type: 'POST',
                            url: url,
                            data: form.serialize(),
                            success: function(response) {
                                form.closest('tr').remove();
                            },
                            error: function(xhr) {
                                alert('An error occurred while deleting the user.');
                            }
                        });
                    }
                });
            });
        </script>
    @endsection

</x-layouts.app>