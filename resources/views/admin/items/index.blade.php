@extends('layouts.admin')

@section('title', 'Manage Items')

@section('content')
<!-- 🔥 Header -->
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-3xl font-bold text-[#DE1975] flex items-center gap-2">
             Manage Items
        </h1>
        <p class="text-gray-600 text-sm mt-1">List of all product/service items in your system</p>
    </div>
    <a href="{{ route('admin.items.create') }}"
       class="inline-flex items-center gap-2 bg-[#DE1975] hover:bg-pink-700 text-white px-5 py-2 rounded-full shadow transition hover:scale-105">
       <i class="fas fa-plus"></i> Add New Item
    </a>
</div>

<!-- ✅ Success Message -->
@if(session('success'))
    <div id="success-message" class="bg-green-100 text-green-800 px-4 py-3 rounded mb-6 shadow text-sm flex items-center gap-2">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
@endif

<!-- 📦 Item Cards -->
@if($items->count())
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($items as $item)
            <div class="bg-white border border-gray-200 hover:border-[#DE1975] rounded-xl p-5 shadow hover:shadow-lg transition group">
                <h2 class="text-xl font-semibold text-[#DE1975] group-hover:underline mb-1">
                    {{ $item->item_name }}
                </h2>
                <p class="text-sm text-gray-600 mb-4">
                    {{ $item->item_description ?? 'No description provided.' }}
                </p>
                <div class="flex justify-end gap-2 text-sm">
                    <!-- ✏️ Edit -->
                    <a href="{{ route('admin.items.edit', $item->id) }}"
                       class="inline-flex items-center gap-1 bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">
                        <i class="fas fa-pen"></i> Edit
                    </a>

                    <!-- 🗑️ Delete -->
                    <form action="{{ route('admin.items.destroy', $item->id) }}" method="POST"
                          onsubmit="return confirm('Are you sure you want to delete this item?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="inline-flex items-center gap-1 bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                            <i class="fas fa-trash-alt"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@else
    <!-- 💤 Empty State -->
    <div class="bg-white rounded-xl shadow p-8 text-center mt-12">
        <img src="{{ asset('img/empty-box.png') }}" alt="No Items" class="w-24 mx-auto mb-4 opacity-40">
        <p class="text-gray-500 text-lg">No items added yet.</p>
        <p class="text-sm text-gray-400">Click "Add New Item" to get started.</p>
    </div>
@endif

<!-- 🕒 Fade-out Success -->
<script>
    setTimeout(() => {
        const msg = document.getElementById('success-message');
        if (msg) {
            msg.style.transition = 'opacity 0.5s ease';
            msg.style.opacity = '0';
            setTimeout(() => msg.remove(), 500);
        }
    }, 3000);
</script>
@endsection
