<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>@yield('title', 'Admin Panel')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans&family=Yellowtail&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'DM Sans', sans-serif;
        }

        /* Glassmorphism + soft shadow */
        #sidebar {
            backdrop-filter: blur(10px);
            background-color: rgba(222, 25, 117, 0.9);
            box-shadow: 4px 0 20px rgba(222, 25, 117, 0.25);
        }
    </style>
</head>
<body class="bg-[#f8d1e4]">

<div class="flex">

    <!-- ✅ Sidebar -->
    <aside id="sidebar" class="w-64 h-screen fixed z-50 top-0 left-0 transform -translate-x-full md:translate-x-0 transition-transform duration-300 flex flex-col justify-between text-white p-6">
        <div>
            <!-- Logo & Title -->
            <div class="flex items-center gap-4 mb-6">
                <img src="{{ asset('img/REKAMIMPI-Logo.jpg') }}" alt="Logo" class="h-14 rounded-md">
                <span class="text-xl font-bold">REKA MIMPI</span>
            </div>

            <!-- Admin Greeting -->
            <div class="mb-6">
                <div class="flex items-center gap-3">
                    <img src="https://ui-avatars.com/api/?name=Admin&background=fff&color=DE1975"
                         alt="Admin Avatar" class="w-10 h-10 rounded-full border">
                    <div>
                        <p class="text-sm">Welcome,</p>
                        <p class="font-semibold">Admin</p>
                    </div>
                </div>
            </div>

            <!-- Menu -->
            <h2 class="text-white uppercase text-xs font-semibold mb-2 tracking-wider flex items-center gap-2">
                <i class="fas fa-cogs text-xs"></i> Admin Panel
            </h2>
            <ul class="space-y-2">
                <!-- Dashboard -->
                <li>
                    <a href="{{ route('admin.dashboard') }}"
                       class="flex items-center gap-2 px-2 py-2 rounded transition duration-200 transform hover:translate-x-1 hover:bg-white hover:text-[#DE1975]
                              {{ request()->routeIs('admin.dashboard') ? 'bg-white text-[#DE1975] font-semibold' : 'text-white' }}">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                </li>

                <!-- Feedback -->
                <li>
                    <a href="{{ route('admin.feedbacks') }}"
                       class="flex items-center gap-2 px-2 py-2 rounded transition duration-200 transform hover:translate-x-1 hover:bg-white hover:text-[#DE1975]
                              {{ request()->routeIs('admin.feedbacks') ? 'bg-white text-[#DE1975] font-semibold' : 'text-white' }}">
                        <i class="fas fa-comments"></i> Feedback
                    </a>
                </li>

                <!-- Analytics -->
                <li>
                    <a href="{{ route('admin.analytics') }}"
                       class="flex items-center gap-2 px-2 py-2 rounded transition duration-200 transform hover:translate-x-1 hover:bg-white hover:text-[#DE1975]
                              {{ request()->routeIs('admin.analytics') ? 'bg-white text-[#DE1975] font-semibold' : 'text-white' }}">
                        <i class="fas fa-chart-bar"></i> Analytics
                    </a>
                </li>

                <!-- Manage Items -->
                <li>
                    <a href="{{ route('admin.items.index') }}"
                       class="flex items-center gap-2 px-2 py-2 rounded transition duration-200 transform hover:translate-x-1 hover:bg-white hover:text-[#DE1975]
                              {{ request()->routeIs('admin.items.index') ? 'bg-white text-[#DE1975] font-semibold' : 'text-white' }}">
                        <i class="fas fa-box"></i> Manage Items
                    </a>
                </li>

                <!-- Reports -->
                <li>
                    <a href="{{ route('admin.reports') }}"
                       class="flex items-center gap-2 px-2 py-2 rounded transition duration-200 transform hover:translate-x-1 hover:bg-white hover:text-[#DE1975]
                              {{ request()->routeIs('admin.reports') ? 'bg-white text-[#DE1975] font-semibold' : 'text-white' }}">
                        <i class="fas fa-file-alt"></i> Reports
                    </a>
                </li>
            </ul>
        </div>

        <!-- Logout -->
        <form method="POST" action="{{ route('admin.logout') }}" onsubmit="return confirm('Are you sure you want to log out?')">
            @csrf
            <button type="submit"
                    class="flex items-center gap-2 px-2 py-2 rounded hover:bg-white hover:text-[#DE1975] transition duration-200 transform hover:translate-x-1">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
    </aside>

    <!-- ✅ Backdrop (Mobile) -->
    <div id="backdrop" class="fixed inset-0 bg-black opacity-50 hidden md:hidden z-40"></div>

    <!-- ✅ Main Content -->
    <main class="ml-0 md:ml-64 flex-1 pt-6 px-4 sm:px-8 pb-6 overflow-y-auto min-h-screen">

        <!-- Mobile Toggle -->
        <div class="md:hidden flex justify-between items-center mb-4">
            <button id="toggleSidebar" class="text-[#DE1975] text-2xl focus:outline-none">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        @yield('content')
    </main>
</div>

<!-- ✅ Script -->
<script>
    const toggleBtn = document.getElementById('toggleSidebar');
    const sidebar = document.getElementById('sidebar');
    const backdrop = document.getElementById('backdrop');

    toggleBtn?.addEventListener('click', () => {
        sidebar.classList.toggle('-translate-x-full');
        backdrop.classList.toggle('hidden');
    });

    backdrop?.addEventListener('click', () => {
        sidebar.classList.add('-translate-x-full');
        backdrop.classList.add('hidden');
    });
</script>

</body>
</html>
