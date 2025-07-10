<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>REKA MIMPI Feedback Hub</title>

  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Custom Tailwind Colors -->
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            rekapink: '#DE1975',
            pinklight: '#FFF1F7',
            pinklighter: '#FFEAF2',
            pinkbtn: '#FFBCDB',
            pinkhover: '#ffcfe4',
          },
          fontFamily: {
            sans: ['DM Sans', 'sans-serif'],
            logo: ['Courgette', 'cursive'],
          }
        }
      }
    }
  </script>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Yellowtail&family=DM+Sans&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Courgette&display=swap" rel="stylesheet">


  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
</head>

<body class="bg-[#f8d1e4] min-h-screen flex items-center justify-center px-4 py-8">

  <!-- Admin Button -->
  <a href="{{ route('admin.login') }}"
     class="fixed top-5 right-5 w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center bg-white text-rekapink border-2 border-rekapink rounded-full shadow-md hover:bg-rekapink hover:text-white transition"
     title="Admin Login">
    <i class="fas fa-user-shield text-base sm:text-xl"></i>
  </a>

  <!-- Main Card -->
  <div class="flex flex-col md:flex-row w-full max-w-md sm:max-w-xl md:max-w-4xl rounded-[25px] shadow-xl overflow-hidden bg-pinklight">

    <!-- Logo on Top (Mobile/Tablet) -->
    <div class="order-1 md:order-2 flex items-center justify-center bg-pinklighter px-4 py-4 sm:px-5 sm:py-6 md:p-8 w-full md:w-2/5 rounded-t-[25px] md:rounded-t-none md:rounded-r-[25px]">
  <img src="{{ asset('img/REKAMIMPI-Logo.jpg') }}"
       alt="RekaMimpi Logo"
       class="w-full max-w-[130px] sm:max-w-[170px] md:max-w-[210px] h-auto rounded-2xl shadow-xl transition-transform hover:scale-105" />
</div>


    <!-- Buttons & Info Panel -->
    <div class="order-2 md:order-1 flex flex-col items-center justify-center text-center text-white bg-rekapink px-4 py-6 sm:px-6 sm:py-10 md:p-16 w-full md:w-3/5 rounded-b-[25px] md:rounded-b-none md:rounded-l-[25px]">

      <!-- Title and Subtitle -->
      <span class="text-4xl sm:text-5xl md:text-6xl font-logo mb-3 leading-tight">REKA MIMPI</span>
      <span class="text-lg sm:text-xl md:text-2xl font-semibold">Feedback Hub</span>

      <div class="mt-6 sm:mt-8 w-full flex flex-col items-center gap-3 sm:gap-4">
        <!-- Rate Us Button -->
        <button onclick="window.location='{{ route('feedback.form') }}'"
          class="w-full max-w-[240px] mx-auto bg-pinkbtn hover:bg-pinkhover text-black font-semibold text-base sm:text-lg py-2 sm:py-2.5 md:py-3 rounded-full shadow-lg transition hover:-translate-y-1">
          Rate Us
        </button>

        <!-- Feedback History Button -->
        <button onclick="window.location='{{ route('feedback.history') }}'"
    class="w-full max-w-[240px] mx-auto bg-pinkbtn hover:bg-pinkhover text-black font-semibold text-base sm:text-lg py-2 sm:py-2.5 md:py-3 rounded-full shadow-lg transition hover:-translate-y-1">
    Review History
  </button>
</div>

      <!-- Social Media Links -->
      <div class="mt-8 sm:mt-12 flex flex-wrap justify-center gap-4 text-white text-sm sm:text-base">
        <a href="https://www.facebook.com/thesiblingsuprises/" target="_blank"
          class="flex items-center space-x-2 hover:text-pinkhover transition">
          <i class="fab fa-facebook-square text-lg sm:text-xl"></i>
          <span>Rekamimpi</span>
        </a>

        <a href="https://www.instagram.com/rekamimpi/" target="_blank"
          class="flex items-center space-x-2 hover:text-pinkhover transition">
          <i class="fab fa-instagram text-lg sm:text-xl"></i>
          <span>Rekamimpi</span>
        </a>

        <a href="https://www.tiktok.com/@rekamimpistudio" target="_blank"
          class="flex items-center space-x-2 hover:text-pinkhover transition">
          <i class="fab fa-tiktok text-lg sm:text-xl"></i>
          <span>Rekamimpi</span>
        </a>
      </div>
    </div>
  </div>

</body>
</html>
