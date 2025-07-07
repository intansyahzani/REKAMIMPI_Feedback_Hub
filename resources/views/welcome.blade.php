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
            logo: ['Lobster', 'cursive'],
          }
        }
      }
    }
  </script>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Yellowtail&family=DM+Sans&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
</head>

<body class="bg-[#f8d1e4] min-h-screen flex items-center justify-center px-4">

  <!-- Admin Button -->
  <a href="{{ route('admin.login') }}"
     class="fixed top-5 right-5 w-12 h-12 flex items-center justify-center bg-white text-rekapink border-2 border-rekapink rounded-full shadow-md hover:bg-rekapink hover:text-white transition"
     title="Admin Login">
    <i class="fas fa-user-shield text-xl"></i>
  </a>

  <!-- Card -->
  <div class="flex max-w-4xl w-full rounded-[25px] shadow-xl overflow-hidden bg-pinklight flex-col md:flex-row">
   
    <!-- Left Panel -->
    <div class="flex flex-col items-center justify-center text-center text-white bg-rekapink p-10 md:p-16 w-full md:basis-3/5 md:rounded-l-[25px]">
      <span class="text-5xl font-logo mb-4">REKA MIMPI</span>
      <span class="text-2xl font-semibold">Feedback Hub</span>

      <div class="mt-10 w-full max-w-xs space-y-5">
        <!-- Rate Us Button -->
        <button onclick="window.location='{{ route('feedback.form') }}'"
          class="w-full bg-pinkbtn hover:bg-pinkhover text-black font-bold text-xl py-4 rounded-full shadow-lg transition hover:-translate-y-1">
          Rate Us
        </button>

        <!-- Feedback History Button -->
        <button onclick="window.location='{{ route('feedback.history') }}'"
          class="w-full bg-pinkbtn hover:bg-pinkhover text-black font-bold text-xl py-4 rounded-full shadow-lg transition hover:-translate-y-1">
          Review History
        </button>
      </div>

     <!-- Social Media Links with Text - Horizontal Version -->
      <div class="mt-10 flex flex-wrap justify-center gap-5 text-white text-sm">
      
        <!-- Facebook -->
        <a href="https://www.facebook.com/thesiblingsuprises/" target="_blank"
          class="flex items-center space-x-2 hover:text-pinkhover transition">
          <i class="fab fa-facebook-square text-2xl"></i>
        <span>Rekamimpi</span>
        </a>

      <!-- Instagram -->
      <a href="https://www.instagram.com/rekamimpi/" target="_blank"
        class="flex items-center space-x-2 hover:text-pinkhover transition">
        <i class="fab fa-instagram text-2xl"></i>
      <span>Rekamimpi</span>
      </a>

     <!-- TikTok -->
    <a href="https://www.tiktok.com/@rekamimpistudio" target="_blank"
      class="flex items-center space-x-2 hover:text-pinkhover transition">
      <i class="fab fa-tiktok text-2xl"></i>
      <span>Rekamimpi</span>
      </a>
      </div>
    </div>

    <!-- Right Panel -->
    <div class="flex items-center justify-center bg-pinklighter p-8 md:p-10 w-full md:basis-2/5 md:rounded-r-[25px]">
      <img src="{{ asset('img/REKAMIMPI-Logo.jpg') }}"
           alt="RekaMimpi Logo"
           class="w-full max-w-xs sm:max-w-sm md:max-w-[240px] h-auto rounded-2xl shadow-xl transition-transform hover:scale-105" />
    </div>
  </div>

</body>
</html>
