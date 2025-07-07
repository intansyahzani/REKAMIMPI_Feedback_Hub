@extends('layouts.admin')

@section('title', 'Dashboard | Admin Panel')

@section('content')

{{-- ✅ 🎉 Welcome Popup --}}
@if(session('success'))
    <div id="popup-overlay" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-xl max-w-sm text-center shadow-lg">
            <h2 class="text-2xl text-[#DE1975] font-bold font-yellowtail mb-3">Welcome, Admin!</h2>
            <p class="mb-2">{{ session('success') }}</p>
            <p class="text-sm text-gray-500">Redirecting in a moment...</p>
        </div>
    </div>

    <script>
        setTimeout(() => {
            document.getElementById('popup-overlay')?.remove();
            window.location.href = "{{ route('admin.dashboard') }}";
        }, 2500);
    </script>
@endif

{{-- ✅ Welcome Section --}}
<div class="bg-white p-6 rounded-xl shadow mb-8 flex justify-between items-center">
    <div>
        <h1 class="text-3xl font-bold text-[#DE1975] mb-2">Welcome Admin!</h1>
        <p class="text-lg text-gray-800">You're now logged into the <strong>REKA MIMPI</strong> Feedback Hub.</p>
        @if($newFeedbackCount > 0)
            <p class="mt-2 text-green-600 font-semibold">
                📬 You have {{ $newFeedbackCount }} new feedback{{ $newFeedbackCount > 1 ? 's' : '' }}!
            </p>
        @else
            <p class="mt-2 text-gray-500">No new feedback at the moment.</p>
        @endif
    </div>
    <img src="{{ asset('img/REKAMIMPI-Logo.jpg') }}" alt="Welcome Image" class="h-24 rounded-xl hidden md:block">
</div>

{{-- 📊 Feedback Summary Chart --}}
<div class="bg-white p-6 rounded-xl shadow mb-8">
    <h2 class="text-xl font-semibold text-[#DE1975] mb-4">Feedback Rating Overview</h2>
    <div class="h-64 md:h-48">
        <canvas id="ratingChart" class="w-full h-full"></canvas>
    </div>
</div>

{{-- 📝 Recent Feedbacks --}}
<h2 class="text-2xl font-bold text-[#DE1975] mb-4">Recent New Feedback</h2>

@forelse ($newFeedbacks as $feedback)
    <div class="bg-white p-5 rounded-xl shadow mb-4">
        <div class="flex justify-between items-center">
            <div>
                <p class="font-semibold text-gray-700">
                    {{ $feedback->customer->customer_name ?? 'Unknown' }}
                    <span class="text-sm text-gray-500">| {{ $feedback->item->item_name ?? 'Item N/A' }}</span>
                </p>
                <p class="text-sm text-gray-500">
                    Submitted on {{ \Carbon\Carbon::parse($feedback->submission_date)->format('Y-m-d') }}
                </p>
            </div>
            <div class="text-yellow-400 text-sm">
                @for ($i = 0; $i < $feedback->star_rating; $i++)
                    <i class="fas fa-star"></i>
                @endfor
            </div>
        </div>
        <p class="mt-3 text-gray-700">{{ $feedback->feedback_text }}</p>

        @if ($feedback->photo_path)
            <div class="mt-3">
                <a href="{{ asset('storage/' . $feedback->photo_path) }}" target="_blank">
                    <img src="{{ asset('storage/' . $feedback->photo_path) }}" alt="Photo"
                        class="w-28 h-28 object-cover rounded-md border" />
                </a>
            </div>
        @endif

        <div class="mt-4 text-right">
            <a href="{{ route('admin.feedbacks') }}" class="text-[#DE1975] font-medium hover:underline">
                View All Feedback →
            </a>
        </div>
    </div>
@empty
    <p class="text-gray-500">No new feedback at the moment.</p>
@endforelse

{{-- 📊 Chart JS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('ratingChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['1 Star', '2 Stars', '3 Stars', '4 Stars', '5 Stars'],
            datasets: [{
                label: 'Total Feedbacks',
                data: [
                    {{ $starCounts['1'] }},
                    {{ $starCounts['2'] }},
                    {{ $starCounts['3'] }},
                    {{ $starCounts['4'] }},
                    {{ $starCounts['5'] }}
                ],
                backgroundColor: '#DE1975',
                borderRadius: 8,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
</script>

@endsection
