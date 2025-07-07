@extends('layouts.admin')

@section('title', 'Analytics | Admin Panel')

@section('content')
    <!-- 🌟 Page Heading with Icon -->
   <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-3 px-2 gap-2">
    <div>
        <h1 class="text-3xl font-bold text-[#DE1975] flex items-center gap-3">
            Feedback Analytics
        </h1>
        <p class="text-gray-600 text-sm mt-1">
            Visualize rating distribution and monitor feedback trends over time
        </p>
    </div>
</div>


    <!-- 📅 Stylish Date Range Filter -->
    <div class="flex justify-center mb-6 px-2">
        <form method="GET" action="{{ route('admin.analytics') }}"
              class="flex flex-col md:flex-row gap-4 items-center justify-center bg-white border border-[#DE1975] rounded-2xl p-6 shadow-lg w-full max-w-2xl transition hover:shadow-xl">
            <div class="w-full md:w-auto">
                <label for="start_date" class="text-sm font-medium text-gray-700 mb-1 block">Start Date</label>
                <input type="date" name="start_date" id="start_date" value="{{ $startDate }}"
                       class="w-full border border-gray-300 rounded-md px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#DE1975] shadow-sm">
            </div>
            <div class="w-full md:w-auto">
                <label for="end_date" class="text-sm font-medium text-gray-700 mb-1 block">End Date</label>
                <input type="date" name="end_date" id="end_date" value="{{ $endDate }}"
                       class="w-full border border-gray-300 rounded-md px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#DE1975] shadow-sm">
            </div>
            <div class="w-full md:w-auto">
                <label class="invisible md:visible block mb-1">Filter</label>
                <button type="submit"
                        class="w-full md:w-auto bg-[#DE1975] hover:bg-pink-600 text-white text-sm font-semibold px-6 py-2 rounded-md shadow-md transition duration-200">
                    <i class="fas fa-filter mr-2"></i> Filter
                </button>
            </div>
        </form>
    </div>

    <!-- 📊 Fancy Chart Section -->
    <div class="w-full px-2 mb-10">
        <div class="relative bg-gradient-to-br from-white via-pink-50 to-white border border-[#DE1975] rounded-2xl p-6 shadow-md max-w-full md:max-w-4xl mx-auto">
            <h2 class="text-center text-lg font-bold text-[#DE1975] mb-4 tracking-wide">
                📈 Star Ratings Distribution per Item
            </h2>
            <div class="h-[300px] md:h-[400px] relative">
                <canvas id="barChart" class="w-full h-full"></canvas>
            </div>
            <div class="absolute top-4 right-4 opacity-20">
                <i class="fas fa-chart-pie text-6xl text-[#DE1975]"></i>
            </div>
        </div>
    </div>

    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('barChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($labels),
                datasets: @json($datasets),
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            color: '#444',
                            font: {
                                size: 13,
                                weight: '600'
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            color: '#444',
                            font: { size: 12 }
                        },
                        grid: { color: '#e0e0e0' }
                    },
                    x: {
                        ticks: {
                            color: '#444',
                            font: { size: 12 }
                        },
                        grid: { display: false }
                    }
                }
            }
        });
    </script>
@endsection
