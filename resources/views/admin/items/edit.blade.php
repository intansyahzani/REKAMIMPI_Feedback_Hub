@extends('layouts.admin')

@section('title', 'Edit Item')

@section('content')
<div class="flex justify-center pt-16"> {{-- 🟣 Top padding added here --}}
    <div class="w-full max-w-xl bg-white p-6 rounded-2xl shadow-md border border-gray-100">
        <h1 class="text-3xl font-bold text-[#DE1975] mb-6 text-center">Edit Item</h1>

        <form action="{{ route('admin.items.update', $item->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-5">
                <label class="block text-[#DE1975] font-semibold mb-2">
                    <i class="fas fa-tag mr-1"></i> Item Name
                </label>
                <input
                    type="text"
                    name="item_name"
                    value="{{ $item->item_name }}"
                    required
                    placeholder="Update item name..."
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
                    placeholder="Update item description (optional)"
                    class="w-full px-4 py-2 border border-gray-300 rounded-xl resize-none focus:ring-2 focus:ring-[#DE1975] outline-none transition"
                >{{ $item->item_description }}</textarea>
            </div>

            <div class="flex justify-center">
                <button
                    type="submit"
                    class="bg-[#DE1975] hover:bg-pink-700 text-white px-6 py-2 rounded-xl shadow transition">
                    <i class="fas fa-save mr-1"></i> Update Item
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
