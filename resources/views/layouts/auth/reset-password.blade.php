<x-layouts.auth></x-layouts.auth>

  
  <div class="flex justify-center items-center px-4 my-4">
        <div class="bg-black/80 p-10 rounded max-w-md w-full z-10">
            <h1 class="text-3xl font-bold mb-6">Reset Password</h1>

            @if(session('status'))
                <div class="bg-green-600 p-2 mb-4 rounded text-sm">
                    {{ session('status') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-600 p-2 mb-4 rounded text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('password.update') }}" method="POST" class="flex flex-col gap-4 w-full">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <!-- Email -->
                <input type="email" name="email" value="{{ old('email') ?? '' }}" placeholder="Email address" required
                    class="p-3 w-full rounded bg-[#222] text-white border border-gray-500 placeholder-gray-400 focus:border-red-600 focus:ring-1 focus:ring-red-600 outline-none">

                <!-- New Password -->
                <input type="password" name="password" placeholder="New password" required
                    class="p-3 w-full rounded bg-[#222] text-white border border-gray-500 placeholder-gray-400 focus:border-red-600 focus:ring-1 focus:ring-red-600 outline-none">

                <!-- Confirm Password -->
                <input type="password" name="password_confirmation" placeholder="Confirm new password" required
                    class="p-3 w-full rounded bg-[#222] text-white border border-gray-500 placeholder-gray-400 focus:border-red-600 focus:ring-1 focus:ring-red-600 outline-none">

                <button type="submit" class="bg-red-600 p-3 rounded font-semibold hover:bg-red-700 transition">
                    Reset Password
                </button>
            </form>

            <p class="text-gray-400 mt-4 text-sm text-center">
                Back to <a href="{{ route('loginPage') }}" class="text-white hover:underline">Sign In</a>
            </p>
        </div>
    </div>

