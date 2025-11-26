<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Isha Pithava" content="netflix-clone">

    <title>Subscription Plans</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- jQuery CDN -->
    <script src="{{ asset('cdn/js/jquery.min.js') }}"></script>

    <style>
        body {
            font-size: 14px;
        }
    </style>
</head>

<body class="bg-white text-gray-900">

    <div class="flex flex-col min-h-screen px-4 py-4">

        {{-- Header --}}
        <header class="flex justify-between  items-center py-3 max-w-6xl w-full mx-auto">
            {{-- Netflix Logo --}}
            <div class="flex items-center">
                <img src="{{ asset('storage/logo/Logonetflix.png') }}" alt="Netflix Logo" class="w-24 h-auto" loading="lazy">
            </div>

            {{-- Sign Out Button --}}
            <div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-gray-700  px-3 py-1.5 text-sm rounded font-medium hover:text-gray-900 transition border border-gray-300 hover:border-gray-400">
                        Sign Out
                    </button>
                </form>
            </div>
        </header>

        <hr class="border-gray-300 my-2">

        {{-- Main Content --}}
        <div class="flex justify-center items-center mt-5 flex-1">
            <div class="max-w-5xl w-full">

                {{-- Step Indicator --}}
                <div class="mb-1.5">
                    <p class="text-xs font-semibold text-gray-700">Step 3 of 4</p>
                </div>

                <h1 class="text-2xl font-bold mb-4 tracking-tight text-gray-900">
                    Choose the plan that's right for you
                </h1>

                {{-- Subscription Form --}}
                <form id="subscription-form" action="{{ route('select.plan.get') }}" method="GET" class="w-full">
                    <input type="hidden" name="price_id" id="selected-plan">
                    <input type="hidden" name="plan_name" id="selected-plan-name">

                    {{-- Plans Grid --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3 mb-3">
                        @foreach ($plans as $index => $plan)
                        <div class="plan-card cursor-pointer relative flex flex-col bg-white rounded-xl border-2 border-gray-300 overflow-hidden transition-all duration-200 hover:shadow-md" data-price-id="{{ $plan->stripe_price_id }}" data-plan-name="{{ $plan->name }}">

                            {{-- Popular Badge --}}
                            @if($index === 1 || strtolower($plan->name) === 'basic')
                            <div class="absolute top-0 left-0 right-0 flex justify-center z-10">
                                <span class="bg-linear-to-t from-purple-600 to-purple-500 text-white text-[10px] font-bold px-3 py-1 rounded-b-md">
                                    Most Popular
                                </span>
                            </div>
                            @endif

                            {{-- Card Header --}}
                            <div class="plan-header p-4 pb-10 text-white relative overflow-hidden" style="background: {{ $colors[$index] ?? $colors[3] }}">
                                <h2 class="text-base font-bold mb-0.5">{{ $plan->name }}</h2>
                                <p class="text-xs opacity-90">{{ $plan->resolution }}</p>

                                {{-- Checkmark for selected --}}
                                <div class="checkmark absolute top-3 right-3 w-5 h-5 bg-white rounded-full items-center justify-center hidden">
                                    <svg class="w-3 h-3 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>

                            {{-- Card Body --}}
                            <div class="plan-body flex-1 p-4 -mt-6 bg-white rounded-t-xl relative z-10">

                                {{-- Monthly Price --}}
                                <div class="mb-3  border-b border-gray-200">
                                    <p class="text-[10px] text-gray-600 mb-0.5">Daily price</p>
                                    <p class="text-base font-bold text-gray-900">₹{{ $plan->price }}</p>
                                </div>

                                {{-- Features List --}}
                                <div class="space-y-3 text-xs">
                                    @if($plan->quality)
                                    <div class=" border-b border-gray-200">
                                        <p class="text-[10px] text-gray-600 mb-0.5">Video and sound quality</p>
                                        <p class="font-medium text-gray-900">{{ $plan->quality }}</p>
                                    </div>
                                    @endif

                                    @if($plan->resolution)
                                    <div class=" border-b border-gray-200">
                                        <p class="text-[10px] text-gray-600 mb-0.5">Resolution</p>
                                        <p class="font-medium text-gray-900">{{ $plan->resolution }}</p>
                                    </div>
                                    @endif

                                    @if($plan->devices)
                                    <div class="border-b border-gray-200">
                                        <p class="text-[10px] text-gray-600 mb-0.5">Supported devices</p>
                                        <p class="font-medium text-gray-900">{{ $plan->devices }}</p>
                                    </div>
                                    @endif

                                    @if($plan->streams)
                                    <div class=" border-b border-gray-200">
                                        <p class="text-[10px] text-gray-600 mb-0.5 leading-tight">Devices your household
                                            can watch at the same time</p>
                                        <p class="font-medium text-gray-900">{{ $plan->streams }}</p>
                                    </div>
                                    @endif

                                    @if($plan->downloads)
                                    <div>
                                        <p class="text-[10px] text-gray-600 mb-0.5">Download devices</p>
                                        <p class="font-medium text-gray-900">{{ $plan->downloads }}</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    {{-- Netflix Notes --}}
                    <div class="text-gray-600 text-[11px] leading-relaxed space-y-1.5 mb-4">
                        <p>HD (720p), Full HD (1080p), Ultra HD (4K) and HDR availability subject to your internet
                            service and device capabilities. Not all content is available in all resolutions. See our <a href="#" class="text-blue-600 hover:underline">Terms of Use</a> for more details.</p>
                        <p>Only people who live with you may use your account. Watch on 4 different devices at the same
                            time with Premium, 2 with Standard, and 1 with Basic and Mobile.</p>
                        <p>Live events are included with any Netflix plan and contain ads.</p>
                    </div>

                    {{-- Next Button --}}
                    <div class="flex justify-center">
                        <button type="submit" class="bg-red-600 w-2xl text-white px-20 py-2.5 rounded text-base font-bold hover:bg-red-700 transition">
                            Next
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<!-- custom js -->
<script src="{{ asset('assets/js/subscription.js') }}"></script>