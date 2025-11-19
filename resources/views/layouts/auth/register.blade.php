<x-layouts.auth></x-layouts.auth>


    <div class="flex justify-center items-center px-4">
        <div class="bg-black/80 p-10 rounded max-w-md w-full z-10">
            <p class="text-3xl font-bold mb-6">Create Account</p>

            @if($errors->any())
                <div class="bg-red-600 p-2 mb-4 rounded text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST" class="flex flex-col gap-4">
                @csrf

                <!-- Name -->
                <div class="flex flex-col">
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="p-3 rounded bg-[#333] text-white placeholder-gray-400 focus:bg-[#222] focus:outline-none"
                        placeholder="Full name">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="flex flex-col">
                    <input type="email" name="email" value="{{ old('email', $email ?? '') }}"
                        class="p-3 rounded bg-[#333] text-white placeholder-gray-400 focus:bg-[#222] focus:outline-none"
                        placeholder="Email">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="flex flex-col">
                    <input type="password" name="password" placeholder="Password"
                        class="p-3 rounded bg-[#333] text-white placeholder-gray-400 focus:bg-[#222] focus:outline-none">
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="flex flex-col">
                    <input type="password" name="password_confirmation" placeholder="Confirm Password"
                        class="p-3 rounded bg-[#333] text-white placeholder-gray-400 focus:bg-[#222] focus:outline-none">
                </div>

                <!-- Submit Button -->
                <button type="submit" class="bg-red-600 p-2 rounded font-semibold hover:bg-red-700 transition mt-2">
                    Get Started
                </button>
            </form>

            <p class="text-gray-400 mt-4 text-sm">
                Already have an account?
                <a href="{{ route('loginPage') }}" class="text-white hover:underline">Sign in now.</a>
            </p>

        </div>
    </div>

