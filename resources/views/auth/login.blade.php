@include('layouts.navbar')

<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="max-w-3xl mx-auto mt-8 bg-white p-10 rounded-xl shadow-lg border border-gray-200">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-6">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500 input-validation" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <!-- Error Message -->
                <div id="email-error" class="text-sm text-red-500 hidden mt-2"></div>
            </div>

            <!-- Password -->
            <div class="mb-6 relative">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500 input-validation" type="password" name="password" required autocomplete="current-password" />
                <i id="togglePassword" class="fas fa-eye absolute right-4 top-1/2 transform -translate-y-1/2 cursor-pointer text-gray-600"></i>
                <div id="password-error" class="text-sm text-red-500 hidden mt-2"></div>
            </div>

            <!-- Remember Me -->
            <div class="block mb-6">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-pink-300 shadow-sm focus:ring-pink-200" name="remember">
                    <span class="ms-2 text-sm">{{ __('Remember me') }}</span>
                </label>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-between mb-6">
                @if (Route::has('password.request'))
                    <a class="text-sm text-blue-500 hover:text-blue-700" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>

                @endif

                <x-primary-button class="bg-pink-600 text-white py-2 px-4 rounded-md shadow-sm hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-pink-500">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>

            <!-- Google Login Button -->
            <div class="flex items-center justify-center">
                <a href="/register" class="btn btn-sm btn-dark mr-3 rounded-md">Sign Up</a>
                <a href="{{ route('google.login') }}" class="btn btn-sm btn-danger rounded-md">
                    <i class="fab fa-google"></i> Log in with Google
                </a>
            </div>
        </form>
    </div>
    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordField = document.getElementById('password');
            const type = passwordField.type === 'password' ? 'text' : 'password';
            passwordField.type = type;

            // Toggle the eye icon (change to "eye-slash" when password is visible)
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</x-guest-layout>
