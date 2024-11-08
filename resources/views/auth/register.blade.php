@include('layouts.navbar')

<x-guest-layout>
    <div class="max-w-3xl mx-auto mt-8 bg-white p-10 rounded-xl shadow-lg border border-gray-200">
        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <!-- Profile Image -->
            <div class="mb-6">
                <x-input-label for="image" :value="__('Profile Image')" />
                <div class="mt-2">
                    <input id="image" class="w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500" type="file" name="image" />
                    <x-input-error :messages="$errors->get('image')" class="mt-2 text-sm text-red-500" />
                </div>
            </div>

            <!-- Name -->
            <div class="mb-6">
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-red-500" />
            </div>

            <!-- Email Address -->
            <div class="mb-6">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-500" />
            </div>

            <!-- Password -->
            <div class="mb-6">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-500" />
            </div>

            <!-- Confirm Password -->
            <div class="mb-6">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-red-500" />
            </div>

            <!-- Address -->
            <div class="mb-6">
                <x-input-label for="address" :value="__('Address')" />
                <x-text-input id="address" class="w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500" type="text" name="address" :value="old('address')" autocomplete="address" />
                <x-input-error :messages="$errors->get('address')" class="mt-2 text-sm text-red-500" />
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-between">
                <a class="text-sm text-blue-500 hover:text-blue-700" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="bg-pink-600 text-white py-2 px-4 rounded-md shadow-sm hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-pink-500">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
