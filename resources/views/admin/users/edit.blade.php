<x-layouts.app>

@section('content')
<div class="container mx-auto py-10 min-h-screen">
    <div class="max-w-2xl mx-auto text-white p-6 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold mb-6">Edit User</h1>

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium mb-1">Name</label>
                <input type="text" name="name" id="name" value="{{ $user->name }}" class="w-full bg-gray-800 border border-gray-700 rounded px-3 py-2 focus:outline-none focus:border-red-500">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium mb-1">Email</label>
                <input type="email" name="email" id="email" value="{{ $user->email }}" class="w-full bg-gray-800 border border-gray-700 rounded px-3 py-2 focus:outline-none focus:border-red-500">
            </div>

            <div class="flex justify-between items-center mt-6">
                <a href="{{ route('admin.users.index') }}" class="bg-gray-700 hover:bg-gray-600 px-4 py-2 rounded">Cancel</a>
                <button type="submit" class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded text-white">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('form').on('submit', function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            var form = $(this);

            // Clear previous errors
            $('.error-message').remove();
            $('.is-invalid').removeClass('is-invalid');

            $.ajax({
                url: form.attr('action'),
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    alert('User updated successfully!'); 
                    window.location.href = "{{ route('admin.users.index') }}";
                },
                error: function(xhr) {
                    if (xhr.status === 422) { // Validation error
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            var input = $('#' + key);
                            input.addClass('is-invalid');
                            input.after('<div class="text-red-500 text-sm mt-1 error-message">' + value[0] + '</div>');
                        });
                    } else {
                        alert('An error occurred. Please try again.');
                    }
                }
            });
        });
    });
</script>
@endsection

</x-layouts.app>