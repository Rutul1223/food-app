<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    {{-- <button style="color: white; margin: 3px; padding: 5px 10px; cursor: pointer;" class="bg-black rounded-xl">
        <a href="/welcome" style="text-decoration: none; color: white;">&lt;- Back To Food</a>
    </button> --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Grid layout for Update Profile and Update Password side by side -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="p-4 sm:p-8 bg-slate-100 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-slate-100 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>

            <!-- Delete User section below -->
            <div class="p-4 sm:p-8 bg-slate-100 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
