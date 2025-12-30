<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - My Website</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Cairo', sans-serif; }
        .noon-navy { background-color: #404553; }
    </style>
</head>
<body class="bg-gray-50">

    <!-- Navigation Bar -->
    <nav class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">

                <!-- Logo Section -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-extrabold text-gray-800 tracking-tighter">
                        MY<span class="text-yellow-400">E-COMMERCE</span>
                    </a>
                </div>

                <!-- Right Side: Profile & Logout -->
                <div class="flex items-center space-x-6">

                    <!-- Profile Icon Link -->
                    <a href="{{ route('profile') }}" class="flex items-center text-gray-700 hover:text-blue-600 transition group">
                        <div class="p-2 bg-gray-100 rounded-full group-hover:bg-blue-50">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <span class="ml-2 text-sm font-bold hidden md:block">Profile</span>
                    </a>

                    <!-- Logout Button -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm font-bold text-red-500 hover:text-red-700 uppercase tracking-wider">
                            Logout
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto py-12 px-4">
        <div class="bg-white rounded-xl shadow-sm p-8 border">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">
                Welcome back, {{ Auth::user()->name }}!
            </h1>
            <p class="text-gray-600">
                You have successfully logged into your dashboard. This is your home page content.
            </p>

            <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="h-32 bg-gray-100 rounded-lg border-2 border-dashed border-gray-200 flex items-center justify-center text-gray-400">Your Orders</div>
                <div class="h-32 bg-gray-100 rounded-lg border-2 border-dashed border-gray-200 flex items-center justify-center text-gray-400">Wishlist</div>
                <div class="h-32 bg-gray-100 rounded-lg border-2 border-dashed border-gray-200 flex items-center justify-center text-gray-400">Settings</div>
            </div>
        </div>
    </main>

</body>
</html>
