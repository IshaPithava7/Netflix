<!-- resources/views/auth/verify-email.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Isha Pithava" content="netflix-clone">
    <title>Verify Email • {{ config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-black text-white relative">

    <!-- Background overlays -->
    <div class="absolute w-full h-full bg-black/70 -z-10"></div>
    <div class="absolute w-full h-full bg-[url('https://assets.nflxext.com/ffe/siteui/vlv3/151f3e1e-b2c9-4626-afcd-6b39d0b2694f/web/IN-en-20241028-TRIFECTA-perspective_bce9a321-39cb-4cce-8ba6-02dab4c72e53_large.jpg')] bg-cover bg-center -z-20">
    </div>

    <!-- Top-right Sign In button -->
    <div class="absolute top-8 right-8 z-50 bg-white">
        <a href="{{ route('login') }}" class="bg-red-600  hover:bg-red-700 !no-underline text-white px-4 py-2 rounded font-semibold transition ">
            Sign In
        </a>
    </div>

    <div class="flex justify-center items-center h-screen px-4">
        <div class="bg-black/80 p-10 rounded max-w-md w-full z-10">

            <p class="text-3xl font-bold mb-4">Verify Your Email</p>

            <p class="text-gray-300 mb-6">
                We sent a verification link to your email address. Please check your inbox and click the link to verify
                your account.
            </p>

            @if (session('message'))
            <div class="bg-green-600 p-2 mb-4 rounded text-sm">
                {{ session('message') }}
            </div>
            @endif

            @if (session('status') === 'verification-link-sent')
            <div class="bg-green-600 p-2 mb-4 rounded text-sm">
                A fresh verification link has been sent to your email address.
            </div>
            @endif

            <!-- Display User Email for Admins -->
            @can('isAdmin')
            <div class="bg-[#333] p-3 rounded mb-4 text-gray-200">
                {{ auth()->user()->email }}
            </div>
            @endcan

            <!-- Resend Verification Email -->
            <form method="POST" action="{{ route('verification.send') }}" class="flex flex-col gap-3">
                @csrf
                <button type="submit" class="bg-red-600 p-2 rounded font-semibold hover:bg-red-700 transition">
                    Resend Verification Email
                </button>
            </form>

            <!-- Logout Button -->
            <form method="POST" action="{{ route('logout') }}" class="mt-3">
                @csrf
                <button type="submit" class="bg-gray-700 p-2 rounded font-semibold hover:bg-gray-600 transition w-full">
                    Sign Out
                </button>
            </form>

            <p class="text-gray-400 mt-4 text-sm text-center">
                Back to <a href="{{ route('dashboard') }}" class="text-white hover:underline">Dashboard</a>
            </p>
        </div>
    </div>
</body>

</html>