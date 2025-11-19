<x-layouts.app>


@section('content')
    <div class="container mx-auto p-6 min-h-screen">
        <h1 class="text-3xl font-bold mb-6 text-white ">All Users</h1>

        <div class="overflow-x-auto rounded-lg shadow-lg bg-gray-800">
            <table class="min-w-full text-left">
                <thead class="bg-gray-700 text-gray-200 uppercase text-sm">
                    <tr>
                        <th class="px-6 py-3">ID</th>
                        <th class="px-6 py-3">Name</th>
                        <th class="px-6 py-3">Email</th>
                        <th class="px-6 py-3">Admin?</th>
                    </tr>
                </thead>
                <tbody class="text-gray-300">
                    @foreach($users as $user)
                        <tr class="border-b border-gray-600 hover:bg-gray-700 transition">
                            <td class="px-6 py-4">{{ $user->id }}</td>
                            <td class="px-6 py-4">{{ $user->name }}</td>
                            <td class="px-6 py-4">{{ $user->email }}</td>
                            <td class="px-6 py-4">
                                <span class="{{ $user->is_admin ? 'text-green-400' : 'text-red-400' }}">
                                    {{ $user->is_admin ? 'Yes' : 'No' }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-6 flex justify-end">
            {{ $users->links() }}
        </div>
    </div>
@endsection

</x-layouts.app>