@include('layouts.navbar')

<x-guest-layout>
    <div class="max-w-md mx-auto mt-12 bg-dark-800 p-12 rounded-lg shadow-xl border border-dark-700">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-serif font-bold text-white mb-2">Create Account</h2>
            <p class="text-gray-400">Join our culinary community</p>
        </div>

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Profile Image -->
            <div>
                <x-input-label for="image" :value="__('Profile Image')" class="block text-gray-300 mb-2 font-medium" />
                <div class="flex items-center justify-center w-full">
                    <label for="image" class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-dark-600 rounded-lg cursor-pointer bg-dark-700 hover:bg-dark-600 transition-colors">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                            </svg>
                            <p class="mb-2 text-sm text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                            <p class="text-xs text-gray-500">PNG, JPG (MAX. 2MB)</p>
                        </div>
                        <input id="image" type="file" name="image" class="hidden" />
                    </label>
                </div>
                <x-input-error :messages="$errors->get('image')" class="mt-2 text-sm text-red-400" />
            </div>

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Full Name')" class="block text-gray-300 mb-2 font-medium" />
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <x-text-input id="name" class="w-full py-3 pl-10 pr-3 bg-dark-700 border border-dark-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gold-500 focus:border-transparent" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Your full name" />
                </div>
                <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-red-400" />
            </div>

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
                    <x-text-input id="email" class="w-full py-3 pl-10 pr-3 bg-dark-700 border border-dark-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gold-500 focus:border-transparent" type="email" name="email" :value="old('email')" required autocomplete="email" placeholder="your@email.com" />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-400" />
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
                    <x-text-input id="password" class="w-full py-3 pl-10 pr-10 bg-dark-700 border border-dark-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gold-500 focus:border-transparent" type="password" name="password" required autocomplete="new-password" placeholder="Create password" />
                    <i id="togglePassword" class="fas fa-eye absolute right-4 top-1/2 transform -translate-y-1/2 cursor-pointer text-gray-500 hover:text-gold-400"></i>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-400" />
            </div>

            <!-- Confirm Password -->
            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="block text-gray-300 mb-2 font-medium" />
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <x-text-input id="password_confirmation" class="w-full py-3 pl-10 pr-10 bg-dark-700 border border-dark-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gold-500 focus:border-transparent" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm password" />
                    <i id="toggleConfirmPassword" class="fas fa-eye absolute right-4 top-1/2 transform -translate-y-1/2 cursor-pointer text-gray-500 hover:text-gold-400"></i>
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-red-400" />
            </div>

            <!-- Address -->
            <div>
                <x-input-label for="address" :value="__('Address')" class="block text-gray-300 mb-2 font-medium" />
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <x-text-input id="address" class="w-full py-3 pl-10 pr-3 bg-dark-700 border border-dark-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gold-500 focus:border-transparent" type="text" name="address" :value="old('address')" autocomplete="address" placeholder="Your address" />
                </div>
                <x-input-error :messages="$errors->get('address')" class="mt-2 text-sm text-red-400" />
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-between">
                <a class="text-sm text-white hover:text-gray-300 transition-colors" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="py-3 px-6 bg-black hover:bg-gray-500 text-dark-900 font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-gold-500 focus:ring-offset-2 focus:ring-offset-dark-800">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>

        <div class="mt-8 text-center text-sm text-gray-500">
            By registering, you agree to our <a href="#" class="text-white hover:text-gray-300 transition-colors">Terms of Service</a> and <a href="#" class="text-white hover:text-gray-300 transition-colors">Privacy Policy</a>
        </div>
    </div>

    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordField = document.getElementById('password');
            const type = passwordField.type === 'password' ? 'text' : 'password';
            passwordField.type = type;
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
            this.classList.toggle('text-gray-500');
            this.classList.toggle('text-white');
        });

        // Toggle confirm password visibility
        document.getElementById('toggleConfirmPassword').addEventListener('click', function () {
            const passwordField = document.getElementById('password_confirmation');
            const type = passwordField.type === 'password' ? 'text' : 'password';
            passwordField.type = type;
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
            this.classList.toggle('text-gray-500');
            this.classList.toggle('text-white');
        });

        // Update file input display
        document.getElementById('image').addEventListener('change', function(e) {
            const fileName = e.target.files[0]?.name || 'No file chosen';
            const label = this.closest('label');
            const uploadText = label.querySelector('p:first-of-type');
            if (uploadText) {
                uploadText.textContent = fileName;
                uploadText.classList.add('text-white');
            }
        });
    </script>
</x-guest-layout>
