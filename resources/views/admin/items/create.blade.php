@extends('layouts.admin')

@section('title', 'Add Item')

@section('content')
<div class="flex justify-center pt-16"> {{-- 🟣 Add top padding here --}}
    <div class="w-full max-w-xl bg-white p-6 rounded-2xl shadow-md border border-gray-100">
        <h1 class="text-3xl font-bold text-[#DE1975] mb-6 text-center">Add New Item</h1>

        <form action="{{ route('admin.items.store') }}" method="POST">
            @csrf

            <div class="mb-5">
                <label class="block text-[#DE1975] font-semibold mb-2">
                    <i class="fas fa-tag mr-1"></i> Item Name
                </label>
                <input
                    type="text"
                    name="item_name"
                    required
                    placeholder="Enter item name..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#DE1975] outline-none transition"
                />
            </div>

            <div class="mb-5">
                <label class="block text-[#DE1975] font-semibold mb-2">
                    <i class="fas fa-align-left mr-1"></i> Description
                </label>
                <textarea
                    name="item_description"
                    rows="4"
                    placeholder="Enter item description (optional)"
                    class="w-full px-4 py-2 border border-gray-300 rounded-xl resize-none focus:ring-2 focus:ring-[#DE1975] outline-none transition"
                ></textarea>
            </div>

            <div class="flex justify-center">
                <button
                    type="submit"
                    class="bg-[#DE1975] hover:bg-pink-700 text-white px-6 py-2 rounded-xl shadow transition">
                    <i class="fas fa-plus-circle mr-1"></i> Add Item
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
