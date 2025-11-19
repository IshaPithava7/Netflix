<x-layouts.app>

@section('content')
    <div class="flex bg-gray-900 text-white w-auto">
        {{-- Main Content --}}
        <main class="flex-1 p-6 overflow-y-auto">

            {{-- Header --}}
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold">Dashboard</h1>
                <span class="text-gray-400">{{ now()->format('F j, Y') }}</span>
            </div>

            {{-- Stats Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-gray-700 p-6 rounded shadow hover:scale-105 transform transition">
                    <h2 class="text-lg font-semibold mb-2">Total Users</h2>
                    <p class="text-3xl font-bold">{{ $totalUsers }}</p>
                </div>

                <div class="bg-gray-700 p-6 rounded shadow hover:scale-105 transform transition">
                    <h2 class="text-lg font-semibold mb-2">Total Videos</h2>
                    <p class="text-3xl font-bold">{{ $totalVideos }}</p>
                </div>
            </div>

            {{-- Watch History Chart --}}
            <div class="bg-gray-800 rounded-lg p-6 shadow mb-8">
                <h3 class="text-xl font-bold mb-4">Video Watch History (Daily)</h3>
                <canvas id="watchHistoryChart" class="w-full h-64"></canvas>
            </div>

            {{-- Top 5 Most Watched Videos --}}
            <div class="bg-gray-800 rounded-lg p-6 shadow mb-8">
                <h3 class="text-xl font-bold mb-4">Top 5 Most Watched Videos</h3>
                <canvas id="topVideosChart" class="w-full h-64"></canvas>
            </div>

            {{-- Chart JS Script --}}
            <script>
                const ctx1 = document.getElementById('watchHistoryChart').getContext('2d');
                new Chart(ctx1, {
                    type: 'line',
                    data: {
                        labels: {!! json_encode($chartLabels) !!},
                        datasets: [{
                            label: 'Video Views',
                            data: {!! json_encode($chartData) !!},
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 2,
                            tension: 0.3
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: { legend: { display: true } }
                    }
                });

                const ctx2 = document.getElementById('topVideosChart').getContext('2d');
                new Chart(ctx2, {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode($topVideoTitles->values()) !!},
                        datasets: [{
                            label: 'Views',
                            data: {!! json_encode($topVideoData) !!},
                            backgroundColor: 'rgba(54, 162, 235, 0.7)'
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: { legend: { display: false } },
                        scales: { y: { beginAtZero: true } }
                    }
                });
            </script>

            {{-- Latest Users & Videos --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">

                {{-- Latest Users --}}
                <div class="bg-gray-800 rounded-lg p-4 shadow">
                    <h3 class="text-xl font-bold mb-4">Latest Users</h3>
                    <table class="w-full text-left text-gray-300">
                        <thead>
                            <tr class="border-b border-gray-700">
                                <th class="py-2">Name</th>
                                <th class="py-2">Email</th>
                                <th class="py-2">Joined</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($latestUsers as $user)
                                <tr class="hover:bg-gray-700">
                                    <td class="py-2">{{ $user->name }}</td>
                                    <td class="py-2">{{ $user->email }}</td>
                                    <td class="py-2">{{ $user->created_at->format('M d, Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Latest Videos --}}
                <div class="bg-gray-800 rounded-lg p-4 shadow">
                    <h3 class="text-xl font-bold mb-4">Latest Videos</h3>
                    <table class="w-full text-left text-gray-300">
                        <thead>
                            <tr class="border-b border-gray-700">
                                <th class="py-2">Title</th>
                                <th class="py-2">Uploaded By</th>
                                <th class="py-2">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($latestVideos as $video)
                                <tr class="hover:bg-gray-700">
                                    <td class="py-2">{{ $video->title }}</td>
                                    <td class="py-2">{{ $video->uploader->name }}</td>
                                    <td class="py-2">{{ $video->created_at->format('M d, Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>



        </main>
    </div>
@endsection

</x-layouts.app>