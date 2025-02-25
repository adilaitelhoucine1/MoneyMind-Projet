<x-guest-layout>
    <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0 bg-gradient-to-br from-white to-emerald-50">
        <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white shadow-md overflow-hidden sm:rounded-2xl border border-emerald-100">
            <div class="mb-6 flex justify-center">
                <a href="/" class="flex items-center justify-center">
                    <span class="text-3xl font-bold bg-gradient-to-r from-emerald-600 to-emerald-500 bg-clip-text text-transparent">Money<span class="text-gray-800">Mind</span></span>
                </a>
            </div>

            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">
                Créer un compte
            </h2>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <!-- Name -->
                <div class="space-y-2">
                    <x-input-label for="name" :value="__('Name')" class="text-gray-700 font-medium" />
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user text-gray-400"></i>
                        </div>
                        <x-text-input id="name" class="block mt-1 w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 transition" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Votre nom" />
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="mt-1 text-rose-500 text-sm" />
                </div>

                <!-- Email Address -->
                <div class="space-y-2">
                    <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-medium" />
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                        <x-text-input id="email" class="block mt-1 w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 transition" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="votre@email.com" />
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-rose-500 text-sm" />
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-medium" />
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <x-text-input id="password" class="block mt-1 w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 transition" type="password" name="password" required autocomplete="new-password" placeholder="Minimum 8 caractères" />
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-rose-500 text-sm" />
                </div>

                <!-- Confirm Password -->
                <div class="space-y-2">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-700 font-medium" />
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-shield-alt text-gray-400"></i>
                        </div>
                        <x-text-input id="password_confirmation" class="block mt-1 w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 transition" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirmez votre mot de passe" />
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-rose-500 text-sm" />
                </div>

                <div class="flex items-center justify-end pt-3">
                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-white bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 font-medium transition transform hover:-translate-y-0.5">
                        <i class="fas fa-user-plus mr-2"></i>
                        {{ __('Register') }}
                    </button>
                </div>

                <div class="text-center mt-4">
                    <p class="text-sm text-gray-600">
                        Vous avez déjà un compte? 
                        <a href="{{ route('login') }}" class="font-medium text-emerald-600 hover:text-emerald-500 transition">
                            Connectez-vous
                        </a>
                    </p>
                </div>
            </form>
        </div>

        <!-- Trust indicators -->
        <div class="mt-8 w-full sm:max-w-md px-6">
            <div class="flex items-center justify-center space-x-6 text-gray-500 text-sm">
                <div class="flex items-center">
                    <i class="fas fa-shield-alt mr-2 text-emerald-500"></i>
                    Données sécurisées
                </div>
                <div class="flex items-center">
                    <i class="fas fa-lock mr-2 text-emerald-500"></i>
                    Connexion SSL
                </div>
                <div class="flex items-center">
                    <i class="fas fa-user-secret mr-2 text-emerald-500"></i>
                    Confidentialité
                </div>
            </div>
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
