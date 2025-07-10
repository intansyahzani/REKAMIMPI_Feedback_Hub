<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Review History | REKA MIMPI Feedback Hub</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans&family=Yellowtail&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'DM Sans', sans-serif;
        }
    </style>
</head>
<body class="bg-[#f8d1e4] text-[#222] min-h-screen flex flex-col items-center justify-start px-4 py-6">

    <div class="max-w-4xl mx-auto px-4 ">

        <!-- 🔙 Back to Home Button -->
     <a href="{{ route('welcome') }}"
     class="fixed top-3 right-3 md:top-6 md:right-6 z-50 bg-[#DE1975] text-white p-2 md:p-3 rounded-full shadow-lg 
            transition-all duration-300 ease-in-out hover:bg-pink-600 hover:scale-110"
     title="Go to Home Page" aria-label="Home">
     <i class="fas fa-home text-sm md:text-xl transition-transform duration-300"></i>
  </a>


        <!-- 🧠 Heading -->
        <h2 class="text-xl md:text-2xl font-bold text-center text-[#DE1975] mb-6">
            REKA MIMPI Review History
        </h2>

        <!-- ⭐ Star Filter Box (Separate) -->
<div class="border-2 border-[#DE1975] rounded-xl p-6 bg-white shadow-md max-w-4xl mx-auto mb-3">
    <h3 class="text-center text-[#DE1975] font-semibold text-lg mb-4">Filter by Star Rating</h3>
    
    <div class="flex flex-wrap justify-center gap-3">
        <!-- All Filter -->
        <a href="{{ route('feedback.history') }}"
           class="flex items-center gap-2 px-4 py-2 rounded-full border-2 border-[#DE1975] text-sm font-medium
                  transition-all duration-300
                  {{ request('star_rating') == '' 
                    ? 'bg-gradient-to-r from-[#DE1975] to-pink-500 text-white shadow-lg scale-105' 
                    : 'text-[#DE1975] hover:bg-[#DE1975] hover:text-white hover:shadow-md' }}">
            <i class="fas fa-list"></i> All
        </a>

        <!-- Star Filters -->
        @for ($i = 5; $i >= 1; $i--)
            <a href="{{ route('feedback.history', ['star_rating' => $i]) }}"
               class="flex items-center gap-1 px-4 py-2 rounded-full border-2 border-[#DE1975] text-sm font-medium
                      transition-all duration-300
                      {{ request('star_rating') == $i 
                        ? 'bg-gradient-to-r from-[#DE1975] to-pink-500 text-white shadow-lg scale-105' 
                        : 'text-[#DE1975] hover:bg-[#DE1975] hover:text-white hover:shadow-md' }}">
                @for ($s = 0; $s < $i; $s++)
                    <i class="fas fa-star text-yellow-400"></i>
                @endfor
                @for ($s = $i; $s < 5; $s++)
                    <i class="far fa-star text-yellow-400"></i>
                @endfor
            </a>
        @endfor
    </div>
</div>


        <!-- 🔲 Feedback Wrapper -->
        <div class="border-2 border-[#DE1975] rounded-xl p-6 bg-white shadow-md">

            @if($feedbacks->isEmpty())
                <p class="text-center text-gray-600">No feedback submitted yet.</p>
            @else
                @foreach($feedbacks as $feedback)
                    <div class="border border-gray-200 p-5 rounded-md mb-6 shadow-sm">
                        <div class="flex justify-between items-center mb-2">
                            <div>
                                <p class="font-semibold text-gray-800 text-sm md:text-base">
                                    {{ $feedback->customer->customer_name ?? 'Anonymous' }}
                                </p>
                                @if ($feedback->item)
                                    <p class="text-xs md:text-sm text-gray-500">Item: {{ $feedback->item->item_name }}</p>
                                @else
                                    <p class="text-xs md:text-sm text-gray-500">Item: N/A</p>
                                @endif
                            </div>
                            <p class="text-xs md:text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($feedback->submission_date)->format('Y-m-d') }}
                            </p>
                        </div>

                        <div class="mb-2 text-yellow-400">
                            @for ($i = 0; $i < $feedback->star_rating; $i++)
                                <i class="fas fa-star text-sm md:text-base"></i>
                            @endfor
                            @for ($i = $feedback->star_rating; $i < 5; $i++)
                                <i class="far fa-star text-sm md:text-base"></i>
                            @endfor
                        </div>

                        <p class="text-gray-700 text-sm md:text-base">{{ $feedback->feedback_text ?? '-' }}</p>
@if ($feedback->photo_path)
    <div class="mt-4">
        <p class="text-sm text-gray-500 mb-1">Uploaded Photo:</p>
        <a href="{{ $feedback->photo_path }}" target="_blank">
            <img src="{{ $feedback->photo_path }}"
                 alt="Feedback photo"
                 class="w-28 h-32 rounded-md border shadow hover:scale-105 transition" />
        </a>
    </div>
@endif





                        @if($feedback->response)
                            <div class="mt-4 p-3 bg-gray-100 rounded text-sm text-gray-700 italic">
                                <strong class="not-italic text-[#DE1975]">Admin Response:</strong> {{ $feedback->response }}
                            </div>
                        @endif
                    </div>
                @endforeach
            @endif

        </div>
    </div>

</body>
</html>
