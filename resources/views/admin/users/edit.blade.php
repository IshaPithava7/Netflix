<x-layouts.app>

@section('content')
<div class="container mx-auto py-10 min-h-screen">
    <h1 class="text-3xl font-bold mb-6">Edit User</h1>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="bg-white p-6 rounded shadow max-w-lg">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block mb-2 font-bold">Name</label>
            <input type="text" name="name" value="{{ $user->name }}" class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label class="block mb-2 font-bold">Email</label>
            <input type="email" name="email" value="{{ $user->email }}" class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label class="block mb-2 font-bold">Admin Role</label>
            <input type="checkbox" name="is_admin" value="1" {{ $user->is_admin ? 'checked' : '' }}>
            <span>Is Admin</span>
        </div>

        <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Save Changes</button>
    </form>
</div>
@endsection

</x-layouts.app>