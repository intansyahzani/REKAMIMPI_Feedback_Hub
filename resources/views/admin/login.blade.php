<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login | REKA MIMPI Feedback Hub</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <style>
        body {
            font-family: 'DM Sans', sans-serif;
        }
    </style>
</head>
<body class="bg-[#f8d1e4] min-h-screen flex items-center justify-center px-4">

    <div class="relative w-full max-w-md bg-pink-100 p-10 rounded-2xl shadow-xl text-center">
        <!-- Back Button -->
        <a href="{{ route('welcome') }}" title="Home Page" aria-label="Back to Home"
           class="absolute top-5 left-5 bg-[#DE1975] text-white w-10 h-10 flex items-center justify-center rounded-full hover:bg-[#c31462] transition">
            <i class="fas fa-home text-lg"></i>
        </a>

        <!-- Logo -->
        <img src="{{ asset('img/REKAMIMPI-Logo.jpg') }}" alt="Logo" class="w-24 mx-auto mb-4">

        <!-- Title -->
        <div class="text-2xl font-bold text-[#DE1975] mb-8" style="font-family: 'Lato', sans-serif;">Admin Login</div>

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="bg-red-300 text-[#cb1313] p-4 rounded-md mb-4 text-left text-sm">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <!-- Form -->
        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf

            <div class="mb-5 text-left">
                <label for="email" class="block mb-2 font-semibold text-gray-700">Email</label>
                <input type="email" name="email" id="email" required placeholder="admin@example.com"
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-[#DE1975] focus:ring-2 focus:ring-pink-200">
            </div>

            <div class="mb-6 text-left">
                <label for="password" class="block mb-2 font-semibold text-gray-700">Password</label>
                <input type="password" name="password" id="password" required placeholder="Enter password"
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-[#DE1975] focus:ring-2 focus:ring-pink-200">
            </div>

            <button type="submit"
                    class="w-full bg-[#DE1975] text-white py-3 rounded-full font-medium text-lg hover:bg-[#c31462] transition">
                Login
            </button>
        </form>
    </div>

</body>
</html>
