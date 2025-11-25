<x-layouts.auth></x-layouts.auth>

<div class="flex justify-center items-center px-4">

    <div class="bg-black/80 p-10 rounded max-w-md w-full z-10">
        <p class="text-3xl font-bold mb-6">Sign In</p>

        @if($errors->any())
        <div class="bg-red-600 p-2 mb-4 rounded text-sm">
            {{ $errors->first() }}
        </div>
        @endif

        <form class="flex flex-col gap-4 w-full max-w-md mx-auto login-form" action="{{ route('login') }}" method="POST">
            @csrf
            <!-- Email -->
            <input type="email" name="email" value="{{ old('email', $email)}}" placeholder="Email address" required class="p-3 w-full rounded bg-[#222] text-white border border-gray-500 placeholder-gray-400 focus:border-red-600 focus:ring-1 focus:ring-red-600 outline-none">
            <!-- Password -->
            <input type="password" name="password" placeholder="Password" required class="p-3 w-full rounded bg-[#222] text-white border border-gray-500 placeholder-gray-400 focus:border-red-600 focus:ring-1 focus:ring-red-600 outline-none">
            <button type="submit" class="bg-red-600 p-2 rounded font-semibold hover:bg-red-700 transition">
                Sign In
            </button>

            <!-- Forgot Password -->
            <div class="text-center">
                <p class="text-sm text-gray-400 hover:underline">
                    <a href="{{ route('password.request') }}" class="text-white no-underline">
                        Forgot Password?
                    </a>
                </p>
            </div>
        </form>

        <p class="text-gray-400 mt-4 text-sm">
            New to Netflix?
            <a href="{{ route('registerPage') }}" class="text-white hover:underline">Sign up now.</a>
        </p>

        <div class="flex justify-center gap-2">
            <!-- Google -->
            <button id="googleLoginBtn" class="bg-[#FFFFFF] hover:bg-[#dbd3d3] text-[#3C4043] font-medium rounded px-2 py-1 flex items-center gap-2">
                Continue with Google
            </button>
            <!-- Github -->
            <button id="githubLoginBtn" class="bg-[#24292E] hover:bg-[#14181b] text-[#FFFFFF]  font-medium rounded px-2 py-1 flex items-center gap-2">
                Continue with GitHub
            </button>
        </div>

        <div class="flex justify-center gap-2 mt-2">
            <!-- Slack -->
            <button id="slackLoginBtn" class="bg-[#4A154B] hover:bg-[#350d36] text-white font-medium px-2 py-1 rounded flex items-center gap-2">
                Continue with Slack
            </button>
            <!-- LinkedIn -->
            <button id="linkedinLoginBtn" class="bg-[#0A66C2] hover:bg-[#004182] text-white font-medium px-2 py-1 rounded flex items-center gap-2">
                Continue with LinkedIn
            </button>
        </div>

        <!-- <div class="text-center p-2">
            <a href="{{ route('auth.twitter') }}" class="btn btn-primary">
                Login With Twitter
            </a>
            <a href="{{ url('login/facebook') }}" class="btn btn-primary">
                Login with Facebook
            </a>
        </div> -->
    </div>
</div>


<script src="{{ asset('assets/js/login.js') }}"></script>