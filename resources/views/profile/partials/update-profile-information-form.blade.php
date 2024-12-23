<section>
    <header>
        <h2 class="text-lg font-medium text-black">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')


        <div>
            <x-input-label for="name" :value="__('Name')" class="text-black" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-black" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full input-validation" :value="old('email', $user->email)" required autocomplete="username" />
            <div id="email-error" class="text-sm text-red-500 hidden mt-2"></div>

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>
        <!-- Address Field -->
        <div>
            <x-input-label for="address" :value="__('Address')" class="text-black" />
            <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address', $user->address)" autocomplete="address" />
            <x-input-error class="mt-2" :messages="$errors->get('address')" />
        </div>

        <!-- Profile Image Field -->
        <div>
            <x-input-label for="image" :value="__('Profile Image')" class="text-black" />
            <input id="image" name="image" type="file" class="mt-1 block w-full" />
            <x-input-error class="mt-2" :messages="$errors->get('image')" />

            <!-- Display current profile image -->
            @if ($user->image)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $user->image) }}" alt="Current Profile Image" class="w-16 h-16 rounded-full">
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
            <script>
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: 'Profile updated successfully',
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                });
            </script>
        @endif
        </div>
    </form>
</section>
