<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-black text-white">

    <!-- Background -->
    <div class="absolute w-full h-full bg-black/70 -z-10"></div>
    <div
        class="absolute w-full h-full bg-[url('https://assets.nflxext.com/ffe/siteui/vlv3/151f3e1e-b2c9-4626-afcd-6b39d0b2694f/web/IN-en-20241028-TRIFECTA-perspective_bce9a321-39cb-4cce-8ba6-02dab4c72e53_large.jpg')] bg-cover bg-center -z-20">
    </div>

    <!-- Header -->
    <header
        class="flex justify-between items-center py-6 pl-15 md:px-12 bg-gradient-to-b from-black/70 to-transparent z-50">
        <img src="{{ asset('storage/logo/Logonetflix.png') }}" alt="Netflix Logo" class="w-38 h-auto">
    </header>

</body>

</html>