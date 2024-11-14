<section>
    <header>
        <h2 class="text-lg font-medium text-black">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Current Password')" class="text-black" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full input-validation" autocomplete="current-password" />
            <div id="update_password_current_password-error" class="text-sm text-red-500 hidden mt-2"></div>
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('New Password')" class="text-black" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full input-validation" autocomplete="new-password" />
            <div id="password-error" class="text-sm text-red-500 hidden mt-2"></div>
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" class="text-black" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full input-validation" autocomplete="new-password" />
            <div id="password_confirmation-error" class="text-sm text-red-500 hidden mt-2"></div>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
