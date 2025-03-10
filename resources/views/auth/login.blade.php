<x-guest-layout>
    <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0 bg-gradient-to-br from-white to-emerald-50">
        <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white shadow-md overflow-hidden sm:rounded-2xl border border-emerald-100">
            <div class="mb-8 flex justify-center">
                <a href="/" class="flex items-center justify-center">
                    <span class="text-3xl font-bold bg-gradient-to-r from-emerald-600 to-emerald-500 bg-clip-text text-transparent">Money<span class="text-gray-800">Mind</span></span>
                </a>
            </div>

            <h2 class="text-2xl font-bold text-center text-gray-800 mb-8">
                Connexion à votre compte
            </h2>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div class="space-y-2">
                    <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-medium" />
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                        <x-text-input id="email" class="block mt-1 w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 transition" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="votre@email.com" />
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-rose-500" />
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-medium" />
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <x-text-input id="password" class="block mt-1 w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 transition" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-rose-500" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-emerald-600 shadow-sm focus:ring-emerald-500" name="remember">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                    
                    @if (Route::has('password.request'))
                        <a class="text-sm text-emerald-600 hover:text-emerald-500 transition" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>

                <div>
                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-white bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 font-medium transition transform hover:-translate-y-0.5">
                        {{ __('Log in') }}
                    </button>
                </div>

                <div class="text-center mt-4">
                    <p class="text-sm text-gray-600">
                        Vous n'avez pas encore de compte? 
                        <a href="{{ route('register') }}" class="font-medium text-emerald-600 hover:text-emerald-500 transition">
                            Inscrivez-vous
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <style>
        /* Add custom styling for the auth pages */
        .bg-gradient-to-br {
            background-size: 200% 200%;
            animation: gradient 15s ease infinite;
        }
        
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        .from-emerald-600 {
            --tw-gradient-from: #059669;
        }
        
        .to-emerald-500 {
            --tw-gradient-to: #10b981;
        }

        .hover\:from-emerald-600:hover {
            --tw-gradient-from: #059669;
        }
        
        .hover\:to-emerald-700:hover {
            --tw-gradient-to: #047857;
        }
        
        /* Add shine effect on button hover */
        button[type="submit"] {
            position: relative;
            overflow: hidden;
        }
        
        button[type="submit"]::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                to right,
                rgba(255, 255, 255, 0) 0%,
                rgba(255, 255, 255, 0.3) 50%,
                rgba(255, 255, 255, 0) 100%
            );
            transform: rotate(-45deg) translateY(-100%);
            transition: transform 0.65s cubic-bezier(0.25, 0.1, 0.25, 1);
            pointer-events: none;
            z-index: 10;
        }
        
        button[type="submit"]:hover::after {
            transform: rotate(-45deg) translateY(100%);
        }
    </style>
</x-guest-layout>
