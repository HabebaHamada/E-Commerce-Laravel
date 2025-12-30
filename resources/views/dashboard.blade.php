<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.75">
    <title>E-COMMERCE Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }

        .noon-yellow {
            background-color: #feee00;
        }

        .noon-navy {
            background-color: #404553;
        }
    </style>
</head>

<body class="bg-gray-100">
    <!-- Background Content Mockup (The text behind the modal) -->
    <div class="p-10 grid grid-cols-4 gap-4 opacity-50 grayscale">
        @for ($i = 0; $i < 12; $i++)
            <div class="h-20 bg-gray-200 rounded"></div>
        @endfor
    </div>

    <!-- MAIN MODAL OVERLAY -->
    <div x-data="{
        step: 1,
        mode: 'login',
        email: '',
        password: '',
        confirm_password: ''
    }"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm">

        <div x-init="@if($errors->any()) step = 2; mode = '{{ old('auth_mode', 'login') }}'; email = '{{ old('email') }}' @endif"></div>
        <!-- Modal Card -->
        <div
            class="relative bg-white w-full max-w-lg rounded-2xl shadow-2xl overflow-hidden animate-in fade-in zoom-in duration-300">

            <!-- Close Button -->
            <button class="absolute top-8 right-4 z-50 bg-white rounded-full p-1 shadow hover:bg-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <div class="relative h-64 bg-white overflow-hidden">
                <img src="https://png.pngtree.com/thumb_back/fh260/background/20230613/pngtree-ecommerce-website-with-shopping-cart-with-the-shopping-cart-on-a-image_2975658.jpg"
                    class="absolute inset-0 w-full h-full object-cover object-center" alt="Dashboard Background">
                <div class="absolute inset-0 bg-gradient-to-t from-noon-navy via-noon-navy to-transparent opacity-90">
                </div>
            </div>

            <!-- Auth Form Content -->
            <div class="px-10 pb-10">
                <h2 class="text-3xl font-extrabold text-center text-gray-800 mb-6">Let's get started</h2>

                <!-- Toggle Login/Signup -->
                <div class="flex noon-navy p-1 rounded-lg mb-8">
                    <button @click="mode = 'login'; step = 1"
                        :class="mode === 'login' ? 'bg-gray-500 text-white' : 'bg-transparent text-white'"
                        class="flex-1 py-3 text-sm font-bold rounded transition-all">Log in</button>
                    <button @click="mode = 'signup'; step = 1"
                        :class="mode === 'signup' ? 'bg-gray-500 text-white' : 'bg-transparent text-white'"
                        class="flex-1 py-3 text-sm font-bold rounded transition-all">Sign up</button>
                </div>

                <form autocomplete="off" method="POST" action="{{ route('auth.handle') }}">
                    @csrf
                    @if ($errors->any())
                        <div
                            class="mb-4 p-3 bg-red-100 border-l-4 border-red-500 text-red-700 text-sm rounded shadow-sm">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <input type="hidden" name="auth_mode" :value="mode">
                    <!-- STEP 1: Email & Social -->
                    <div x-show="step === 1">
                        <div
                            class="relative border rounded-lg px-4 py-3 focus-within:ring-2 focus-within:ring-blue-400">
                            <label
                                class="absolute -top-2.5 left-3 bg-white px-1 text-xs text-gray-500 font-semibold">Email
                                address*</label>
                            <input autocomplete="off" type="email" name="email" x-model="email" value="{{ old('email') }}"
                                placeholder="Please enter email address"
                                class="w-full outline-none text-gray-700 bg-transparent">
                        </div>

                        <button type="button" @click="if(email) step = 2"
                            class="w-full mt-6 bg-gray-100 py-4 text-gray-500 font-bold rounded-lg hover:bg-gray-300 transition-colors uppercase tracking-widest">
                            Continue
                        </button>

                        <div class="relative my-8 border-t border-gray-100">
                            <span
                                class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-white px-4 text-gray-400 text-xs uppercase">OR</span>
                        </div>

                        <!-- Social Buttons -->
                        <div class="space-y-3">
                            <a href="/auth/google/redirect"
                                class="flex items-center justify-center w-full border border-gray-300 py-3 rounded-lg hover:bg-gray-50 font-semibold text-gray-600">
                                <img src="https://img.icons8.com/color/24/google-logo.png" class="mr-3"> Sign in with
                                Google
                            </a>
                            <a href="/auth/facebook/redirect"
                                class="flex items-center justify-center w-full border border-gray-300 py-3 rounded-lg hover:bg-gray-50 font-semibold text-gray-600">
                                <img src="https://img.icons8.com/color/24/facebook-new.png" class="mr-3"> Sign in with
                                Facebook
                            </a>
                        </div>
                    </div>

                    <!-- STEP 2: Passwords -->
                    <div x-show="step === 2" x-cloak>
                        <p class="text-sm text-gray-500 mb-4">Entering <span x-text="mode"></span> info for: <span
                                class="font-bold text-gray-800" x-text="email"></span></p>

                        <div
                            class="relative border rounded-lg px-4 py-3 mb-4 focus-within:ring-2 focus-within:ring-blue-400">
                            <label
                                class="absolute -top-2.5 left-3 bg-white px-1 text-xs text-gray-500 font-semibold">Password*</label>
                            <input type="password" x-model="password" name="password"
                                class="w-full outline-none text-gray-700">
                        </div>

                        <template x-if="mode === 'signup'">
                            <div
                                class="relative border rounded-lg px-4 py-3 mb-4 focus-within:ring-2 focus-within:ring-blue-400">
                                <label
                                    class="absolute -top-2.5 left-3 bg-white px-1 text-xs text-gray-500 font-semibold">Confirm
                                    Password*</label>
                                <input type="password" x-model="confirm_password" name="password_confirmation"
                                    class="w-full outline-none text-gray-700">
                            </div>
                        </template>

                        <button type="submit"
                            class="w-full mt-2 noon-navy text-white py-4 font-bold rounded-lg hover:opacity-90 transition-opacity uppercase">
                            <span x-text="mode === 'login' ? 'Login' : 'Create Account'"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
