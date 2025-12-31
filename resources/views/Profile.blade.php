<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Cairo', sans-serif; } </style>
</head>
<body class="bg-gray-100">

    <div class="max-w-4xl mx-auto py-10 px-4">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Account Settings</h1>
            <a href="{{ route('home') }}" class="text-sm text-blue-600 hover:underline">← Back to Home</a>
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg shadow-sm font-bold">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl shadow-sm border overflow-hidden">
            @csrf
            @method('PUT')

            <div class="p-8 border-b bg-gray-50 flex flex-col items-center sm:flex-row sm:space-x-8" x-data="{ photoPreview: null }">
                <div class="relative">
                    <img :src="photoPreview ? photoPreview : '{{ $user->profile_picture ? asset('storage/'.$user->profile_picture) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=404553&color=fff' }}'" 
                         class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-md">
                    
                    <label class="absolute bottom-0 right-0 bg-white p-2 rounded-full shadow-lg border cursor-pointer hover:bg-gray-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <input type="file" name="profile_picture" class="hidden" @change="const file = $event.target.files[0]; if (file) { const reader = new FileReader(); reader.onload = (e) => { photoPreview = e.target.result; }; reader.readAsDataURL(file); }">
                    </label>
                </div>
                <div class="mt-4 sm:mt-0 text-center sm:text-left">
                    <h2 class="text-xl font-bold text-gray-800">{{ $user->name }}</h2>
                    <p class="text-gray-500 text-sm">Update your photo and personal details.</p>
                </div>
            </div>

            <!-- Fields Section -->
            <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Full Name</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border rounded-lg p-3 outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Email Address</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border rounded-lg p-3 outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <!-- Phone -->
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Phone Number</label>
                    <input type="text" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" placeholder=" -- --- ----" class="w-full border rounded-lg p-3 outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <!-- Address -->
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Street Address</label>
                    <input type="text" name="address" value="{{ old('address', $user->address) }}" class="w-full border rounded-lg p-3 outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <!-- City -->
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">City</label>
                    <input type="text" name="city" value="{{ old('city', $user->city) }}" class="w-full border rounded-lg p-3 outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <!-- Country -->
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Country</label>
                    <select name="country" class="w-full border rounded-lg p-3 outline-none focus:ring-2 focus:ring-blue-400">
                        <option value="UAE" {{ $user->country == 'UAE' ? 'selected' : '' }}>United Arab Emirates</option>
                        <option value="Saudi Arabia" {{ $user->country == 'Saudi Arabia' ? 'selected' : '' }}>Saudi Arabia</option>
                        <option value="Egypt" {{ $user->country == 'Egypt' ? 'selected' : '' }}>Egypt</option>
                        <option value="USA" {{ $user->country == 'USA' ? 'selected' : '' }}>USA</option>
                    </select>
                </div>
            </div>

            <!-- Footer / Save Button -->
            <div class="px-8 py-4 bg-gray-50 border-t flex justify-end">
                <button type="submit" class="bg-[#404553] text-white px-8 py-3 rounded-lg font-bold hover:opacity-90 transition shadow-lg">
                    SAVE CHANGES
                </button>
            </div>
        </form>
    </div>

</body>
</html>