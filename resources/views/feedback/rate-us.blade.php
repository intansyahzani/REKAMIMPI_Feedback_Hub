<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Rate Us | REKA MIMIPI Feedback Hub</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Fonts & Icons -->
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans&family=Yellowtail&display=swap" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />

  <style>
    body {
      font-family: 'DM Sans', sans-serif;
    }
    .star-rating input[type="radio"] {
      display: none;
    }
    .star-rating label::before {
      content: "\f005";
      font-family: "Font Awesome 6 Free";
      font-weight: 900;
    }
    .star-rating label {
      font-size: 2rem;
      color: #ccc;
      cursor: pointer;
      transition: color 0.3s;
    }
    .star-rating input:checked ~ label::before,
    .star-rating label:hover ~ label::before,
    .star-rating label:hover::before {
      color: #FFD700;
    }
  </style>
</head>
<body class="bg-[#f8d1e4] text-[#222] min-h-screen flex flex-col items-center justify-start px-4 py-6">

  <!-- 🔙 Back to Home Button -->
  <a href="{{ route('welcome') }}"
     class="fixed top-3 right-3 md:top-6 md:right-6 z-50 bg-[#DE1975] text-white p-2 md:p-3 rounded-full shadow-lg 
            transition-all duration-300 ease-in-out hover:bg-pink-600 hover:scale-110"
     title="Go to Home Page" aria-label="Home">
     <i class="fas fa-home text-sm md:text-xl transition-transform duration-300"></i>
  </a>

  <!-- 🧠 Heading -->
  <h2 class="text-xl md:text-2xl font-bold text-center text-[#DE1975] mb-6">
    REKA MIMPI Review Form
  </h2>

  <!-- 💬 Feedback Invite -->
  <div class="max-w-3xl w-full mb-6 bg-pink-50 border-l-4 border-[#DE1975] text-[#800045] text-base italic rounded-lg shadow-sm px-5 py-4 text-center">
  <span class="w-full">Your voice matters. Share your thoughts and help us make REKA MIMPI even better!</span>
</div>


  <!-- 📋 Feedback Form -->
  <form id="feedbackForm" method="POST" action="{{ route('feedback.submit') }}" enctype="multipart/form-data" class="w-full max-w-3xl bg-white p-8 rounded-xl shadow-md border-2 border-[#DE1975]">
    @csrf

    <!-- Name -->
    <div class="mb-4">
      <label for="name" class="block text-sm font-semibold mb-1">Your Name</label>
      <input type="text" id="name" name="name" placeholder="e.g. Aisyah"
             class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#DE1975] text-sm"
             required>
    </div>

    <!-- Item Selection -->
    <div class="mb-4">
      <label for="item" class="block text-sm font-semibold mb-1">Item</label>
      <select id="item" name="item_id" required
              class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white text-sm focus:outline-none focus:ring-2 focus:ring-[#DE1975]">
        <option value="" disabled selected>Select an option</option>
        @foreach($items as $item)
          <option value="{{ $item->id }}" {{ old('item_id') == $item->id ? 'selected' : '' }}>
            {{ $item->item_name }}
          </option>
        @endforeach
      </select>
    </div>

    <!-- Star Rating -->
    <div class="star-rating flex flex-row-reverse justify-center gap-2 my-6">
      <input type="radio" id="star5" name="star_rating" value="5" required />
      <label for="star5" title="5 stars"></label>

      <input type="radio" id="star4" name="star_rating" value="4" />
      <label for="star4" title="4 stars"></label>

      <input type="radio" id="star3" name="star_rating" value="3" />
      <label for="star3" title="3 stars"></label>

      <input type="radio" id="star2" name="star_rating" value="2" />
      <label for="star2" title="2 stars"></label>

      <input type="radio" id="star1" name="star_rating" value="1" />
      <label for="star1" title="1 star"></label>
    </div>

    <!-- Comments -->
    <div class="mb-6">
      <label for="remarks" class="block text-sm font-semibold mb-1">Comments</label>
      <textarea id="remarks" name="remarks" placeholder="Let us know your thoughts..." required
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#DE1975] text-sm min-h-[120px] resize-y"></textarea>
    </div>

    <!-- Submit Button -->
    <div class="text-center">
      <button type="submit"
              class="bg-[#DE1975] text-white font-semibold px-6 py-3 rounded-full shadow-md hover:bg-[#c31462] transition">
        Submit
      </button>
    </div>
  </form>

  <!-- 🎉 Popup -->
  @if(session('show_popup'))
    <div id="popup-overlay" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-white p-6 rounded-xl max-w-sm text-center shadow-lg">
        <h2 class="text-2xl text-[#DE1975] font-bold font-yellowtail mb-3">Thank you!</h2>
        <p class="mb-2">{{ session('success') }}</p>
        <p class="mb-4">Please click OK to continue.</p>
        <button id="popup-ok-btn"
                class="bg-[#DE1975] text-white px-5 py-2 rounded-full font-semibold hover:bg-[#c31462] transition">
          OK
        </button>
      </div>
    </div>

    <script>
      document.getElementById('popup-ok-btn').addEventListener('click', function () {
        window.location.href = "{{ route('feedback.history') }}";
      });
    </script>
  @endif

</body>
</html>
