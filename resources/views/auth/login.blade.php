@include('layouts.navbar')

<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-gold-400" :status="session('status')" />

    <div class="max-w-md mx-auto mt-12 bg-dark-800 p-12 rounded-lg shadow-xl border border-dark-700">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-serif font-bold text-white mb-2">Welcome Back</h2>
            <p class="text-gray-400">Sign in to your account</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" class="block text-gray-300 mb-2 font-medium" />
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                        </svg>
                    </div>
                    <x-text-input id="email" class="w-full py-3 pl-10 pr-3 bg-dark-700 border border-dark-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gold-500 focus:border-transparent" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Enter your email" />
                </div>
                <div id="email-error" class="text-sm text-red-400 hidden mt-2"></div>
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" class="block text-gray-300 mb-2 font-medium" />
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <x-text-input id="password" class="w-full py-3 pl-10 pr-10 bg-dark-700 border border-dark-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gold-500 focus:border-transparent" type="password" name="password" required autocomplete="current-password" placeholder="Enter your password" />
                    <i id="togglePassword" class="fas fa-eye absolute right-4 top-1/2 transform -translate-y-1/2 cursor-pointer text-gray-500 hover:text-gold-400"></i>
                </div>
                <div id="password-error" class="text-sm text-red-400 hidden mt-2"></div>
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-dark-600 bg-dark-700 text-gold-500 shadow-sm focus:ring-gold-500" name="remember">
                    <span class="ms-2 text-sm text-gray-400">{{ __('Remember me') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm text-blue-400 hover:text-blue-300 transition-colors" href="{{ route('password.request') }}">
                        {{ __('Forgot password?') }}
                    </a>
                @endif
            </div>

            <!-- Login Button -->
            <div>
                <x-primary-button class="w-full py-3 px-4 bg-black hover:bg-gray-500 text-center text-dark-900 font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2 focus:ring-offset-dark-800">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>

            <!-- Divider -->
            <div class="relative">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-dark-600"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-dark-800 text-gray-400">Or continue with</span>
                </div>
            </div>

            <!-- Social Login -->
            <div class="grid grid-cols-2 gap-4">
                <a href="/register" class="flex items-center justify-center py-2.5 px-4 border border-dark-600 rounded-lg text-gray-300 hover:bg-dark-700 transition-colors">
                    <span>Sign Up</span>
                </a>
                <a href="{{ route('google.login') }}" class="flex items-center justify-center py-2.5 px-4 border border-dark-600 rounded-lg text-gray-300 hover:bg-dark-700 transition-colors">
                    <i class="fab fa-google text-red-400 mr-2"></i> Google
                </a>
            </div>
        </form>

        <div class="mt-8 text-center text-sm text-gray-500">
            Don't have an account? <a href="/register" class="text-white hover:text-gray-400 transition-colors">Sign up</a>
        </div>
    </div>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordField = document.getElementById('password');
            const type = passwordField.type === 'password' ? 'text' : 'password';
            passwordField.type = type;

            // Toggle the eye icon
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
            this.classList.toggle('text-gray-500');
            this.classList.toggle('text-white');
        });
    </script>
</x-guest-layout>
