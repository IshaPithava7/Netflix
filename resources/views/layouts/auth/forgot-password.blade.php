<x-layouts.auth></x-layouts.auth>

<div class="flex justify-center items-center px-2 my-5">
    <div class="bg-black/80 p-10 rounded max-w-md w-full z-10">
        <p class="text-3xl font-bold mb-6 text-white text-center">Forgot Password</p>

        @if(session('status'))
            <div class="bg-green-600 p-2 mb-4 rounded text-sm text-center">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('password.email') }}" method="POST" class="flex flex-col gap-4 w-full">
            @csrf

            <!-- Email -->
            <input type="email" name="email" placeholder="Email address" required
                class="p-3 w-full rounded bg-[#222] text-white border border-gray-500 placeholder-gray-400 focus:border-red-600 focus:ring-1 focus:ring-red-600 outline-none">

            <!-- Submit Button -->
            <button type="submit" class="bg-red-600 p-2 rounded font-semibold hover:bg-red-700 transition">
                Send Reset Link
            </button>
        </form>

        <p class="text-gray-400 mt-4 text-sm text-center">
            Back to <a href="{{ route('loginPage') }}" class="text-white hover:underline">Sign In</a>
        </p>

    </div>
</div>