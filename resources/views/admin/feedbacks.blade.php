@extends('layouts.admin')

@section('title', 'Feedback | Admin Panel')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-[#DE1975] flex items-center gap-2">
        All Feedback
    </h1>
    <p class="text-gray-600 text-sm mt-1">Stay informed with real-time feedback from your customers</p>
</div>

{{-- 🔍 Filter Form --}}
<form method="GET" action="{{ route('admin.feedbacks') }}" class="bg-white p-4 rounded-xl shadow mb-6 max-w-7xl mx-auto sticky top-6 z-30">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
        {{-- Customer Name --}}
        <div>
            <label for="customer_name" class="block text-sm font-medium text-gray-700 mb-1">Customer Name</label>
            <div class="relative">
                <input type="text" name="customer_name" id="customer_name" value="{{ request('customer_name') }}"
                    placeholder="e.g. Aisyah"
                    class="w-full border border-gray-300 pl-9 pr-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-[#DE1975] text-sm">
                <i class="fas fa-user absolute left-2 top-1/2 transform -translate-y-1/2 text-gray-400 text-sm"></i>
            </div>
        </div>

        {{-- Item Name --}}
        <div>
            <label for="item_name" class="block text-sm font-medium text-gray-700 mb-1">Item Name</label>
            <select name="item_name" id="item_name"
                class="w-full border border-gray-300 px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-[#DE1975] text-sm">
                <option value="">All Items</option>
                @foreach($items as $item)
                    <option value="{{ $item->item_name }}" {{ request('item_name') == $item->item_name ? 'selected' : '' }}>
                        {{ $item->item_name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Star Rating --}}
        <div>
            <label for="star_rating" class="block text-sm font-medium text-gray-700 mb-1">Star Rating</label>
            <select name="star_rating" id="star_rating"
                class="w-full border border-gray-300 px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-[#DE1975] text-sm">
                <option value="">All Ratings</option>
                @for ($i = 5; $i >= 1; $i--)
                    <option value="{{ $i }}" {{ request('star_rating') == $i ? 'selected' : '' }}>{{ $i }} Stars</option>
                @endfor
            </select>
        </div>

        {{-- Submission Date --}}
        <div>
            <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Submission Date</label>
            <input type="date" name="date" id="date" value="{{ request('date') }}"
                class="w-full border border-gray-300 px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-[#DE1975] text-sm">
        </div>

        {{-- Status --}}
        <div>
            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select name="status" id="status"
                class="w-full border border-gray-300 px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-[#DE1975] text-sm">
                <option value="">All Statuses</option>
                <option value="new" {{ request('status') == 'new' ? 'selected' : '' }}>New</option>
                <option value="responded" {{ request('status') == 'responded' ? 'selected' : '' }}>Responded</option>
            </select>
        </div>
    </div>

    <div class="mt-4 flex justify-end gap-2">
        <a href="{{ route('admin.feedbacks') }}"
            class="bg-gray-500 hover:bg-gray-600 text-white text-sm px-6 py-2 rounded shadow transition">
            Reset
        </a>
        <button type="submit"
            class="bg-[#DE1975] hover:bg-[#c51667] text-white px-6 py-2 rounded-md shadow text-sm transition">
            Filter Results
        </button>
    </div>
</form>

{{-- 📝 Feedback List --}}
@if($feedbacks->count())
    @foreach($feedbacks as $feedback)
        <div class="bg-white p-6 rounded-xl shadow-md mb-6 border border-gray-100 hover:shadow-lg transition">
            <div class="flex justify-between items-start mb-2">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">{{ $feedback->customer->customer_name ?? 'N/A' }}</h3>
                    <p class="text-sm text-gray-500">Item: {{ $feedback->item->item_name ?? 'N/A' }}</p>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($feedback->submission_date)->format('Y-m-d') }}</span>
                </div>
            </div>

            {{-- Star Rating --}}
            <div class="flex items-center mt-1 text-yellow-400 text-sm">
                @for ($i = 0; $i < $feedback->star_rating; $i++)
                    <i class="fas fa-star"></i>
                @endfor
                @for ($i = $feedback->star_rating; $i < 5; $i++)
                    <i class="far fa-star"></i>
                @endfor
            </div>

            {{-- Feedback Text --}}
            <div class="text-gray-700 mt-3 leading-relaxed">{{ $feedback->feedback_text ?? '-' }}</div>

            {{-- Uploaded Photo --}}
            @if ($feedback->photo_path)
                <div class="mt-4">
                    <p class="text-sm text-gray-500 mb-1">Uploaded Photo:</p>
                    <a href="{{ asset('storage/' . $feedback->photo_path) }}" target="_blank">
                        <img src="{{ asset('storage/' . $feedback->photo_path) }}"
                             alt="Feedback photo"
                             class="w-28 h-32 object-cover rounded-md border shadow hover:scale-105 transition" />
                    </a>
                </div>
            @endif

            {{-- Admin Response --}}
            @if($feedback->response)
                <div class="bg-gray-100 p-3 mt-4 rounded text-sm border-l-4 border-green-400">
                    <strong>Admin Response:</strong>
                    <p class="mt-1 text-gray-700">{{ $feedback->response }}</p>
                </div>
            @endif

            {{-- Actions --}}
            <div class="flex flex-col sm:flex-row sm:justify-end gap-3 mt-6">
                {{-- 💬 Response Form --}}
                <form action="{{ route('feedback.respond', $feedback->id) }}" method="POST" class="flex flex-col sm:flex-row gap-2 w-full sm:w-auto">
                    @csrf
                    <textarea name="response" rows="1" placeholder="Write a response..." required class="text-sm p-2 border rounded w-full sm:w-52 resize-none focus:ring-[#DE1975] focus:ring-2"></textarea>
                    <button type="submit"
                        class="flex items-center gap-2 bg-[#DE1975] hover:bg-[#c51667] text-white text-sm px-4 py-2 rounded shadow-sm transition">
                        <i class="fas fa-paper-plane text-xs"></i> Send
                    </button>
                </form>

                {{-- 🗑️ Delete --}}
                <form action="{{ route('feedback.delete', $feedback->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this feedback?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="flex items-center gap-2 bg-red-500 hover:bg-red-600 text-white text-sm px-4 py-2 rounded transition shadow-sm">
                        <i class="fas fa-trash-alt text-xs"></i> Delete
                    </button>
                </form>
            </div>
        </div>
    @endforeach

    {{-- 📄 Pagination --}}
    <div class="mt-6">
        {{ $feedbacks->withQueryString()->links() }}
    </div>
@else
    <p class="text-gray-500">No feedbacks found.</p>
@endif
@endsection
