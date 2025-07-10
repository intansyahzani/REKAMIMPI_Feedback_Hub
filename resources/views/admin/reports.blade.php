@extends('layouts.admin')

@section('title', 'Reports | Admin Panel')

@section('content')
<!-- 🔥 Page Title -->
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-3xl font-bold text-[#DE1975] flex items-center gap-2">
            Feedback Reports
        </h1>
        <p class="text-gray-600 text-sm mt-1">Overview of all customer feedback across items</p>
    </div>
    <a href="{{ route('admin.reports.export') }}"
       class="inline-flex items-center gap-2 bg-[#DE1975] hover:bg-[#c51667] text-white px-5 py-2 rounded-full shadow transition hover:scale-105">
        <i class="fas fa-file-export"></i> Export CSV
    </a>
</div>

<!-- 📋 Feedback Table -->
@if($feedbacks->count())
    <div class="overflow-auto rounded-xl shadow ring-1 ring-gray-200">
        <table class="min-w-full divide-y divide-gray-200 bg-white text-sm text-left">
            <thead class="bg-[#DE1975] text-white text-sm">
                <tr>
                    <th class="py-3 px-4 font-semibold w-[20%]">Customer</th>
                    <th class="py-3 px-4 font-semibold w-[20%]">Item</th>
                    <th class="py-3 px-4 font-semibold text-center w-[10%]">Rating</th>
                    <th class="py-3 px-4 font-semibold w-[35%]">Feedback</th>
                    <th class="py-3 px-4 font-semibold text-center w-[15%]">Date</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-gray-700">
                @foreach($feedbacks as $fb)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="py-3 px-4 whitespace-normal">{{ $fb->customer->customer_name ?? 'N/A' }}</td>
                        <td class="py-3 px-4">{{ $fb->item->item_name ?? 'N/A' }}</td>
                        <td class="py-3 px-4 text-center">
                            <div class="flex justify-center">
                                @for ($i = 0; $i < $fb->star_rating; $i++)
                                    <i class="fas fa-star text-yellow-400 text-xs mr-0.5"></i>
                                @endfor
                                @for ($i = $fb->star_rating; $i < 5; $i++)
                                    <i class="far fa-star text-gray-300 text-xs mr-0.5"></i>
                                @endfor
                            </div>
                        </td>
                        <td class="py-3 px-4 whitespace-normal break-words">{{ $fb->feedback_text }}</td>
                        <td class="py-3 px-4 text-center text-sm text-gray-600">
                            {{ \Carbon\Carbon::parse($fb->submission_date)->format('Y-m-d') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <!-- 💤 Empty State -->
    <div class="bg-white rounded-xl shadow p-8 text-center mt-12">
        <img src="{{ asset('img/empty-box.png') }}" alt="No Data" class="w-24 mx-auto mb-4 opacity-40">
        <p class="text-gray-500 text-lg">No feedback reports available.</p>
        <p class="text-sm text-gray-400">Once users start submitting feedback, you'll see them here.</p>
    </div>
@endif
@endsection
