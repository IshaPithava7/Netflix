@extends('account.account')

@section('content')
<div class="bg-[#f3f3f3]">
    <div class="max-w-2xl mx-auto px-6 py-12">
        <h2 class="text-4xl font-bold mb-5">Change Password</h2>
        <p class="mb-8 text-gray-600 text-lg">
            Protect your account with a unique password at least 6 characters long.
        </p>

        @if (session('status'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('password.change') }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            {{-- Current Password --}}
            <div>
                <input 
                    type="password" 
                    name="current_password" 
                    placeholder="Current Password"
                    required
                    class="w-full px-4 py-4 border border-gray-300 rounded focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 text-base"
                >
                @error('current_password')
                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- New Password --}}
            <div>
                <input 
                    type="password" 
                    name="new_password" 
                    placeholder="New Password (6-60 characters)"
                    required 
                    minlength="6"
                    maxlength="60"
                    class="w-full px-4 py-4 border border-gray-300 rounded focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 text-base"
                >
                @error('new_password')
                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Confirm New Password --}}
            <div>
                <input 
                    type="password" 
                    name="new_password_confirmation" 
                    placeholder="Re-enter New Password"
                    required 
                    minlength="6"
                    maxlength="60"
                    class="w-full px-4 py-4 border border-gray-300 rounded focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 text-base"
                >
            </div>

            {{-- Submit Button --}}
            <div class="pt-4">
                <button 
                    type="submit"
                    class="w-full bg-black text-white py-4 rounded font-semibold hover:bg-gray-800 transition"
                >
                    Save
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
