<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <!-- <br>
        <div>
            <x-input-label for="google2faSecret" :value="__('OTP')" />
            <x-text-input id="google2faSecret" class="block mt-1 w-full" type="text" name="google2faSecret" :value="old('google2faSecret')" required autofocus/>
            <x-input-error :messages="$errors->get('google2faSecret')" class="mt-2" />
        </div> -->

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <!-- OTP -->
        <!-- <div class="mt-4">
            <x-input-label for="otp" :value="__('OTP')" />

            <x-text-input id="otp" class="block mt-1 w-full"
                            type="otp"
                            name="google2faSecret"
                            required autocomplete="current-otp" />

            <x-input-error :messages="$errors->get('google2faSecret')" class="mt-2" />
        </div> -->

        <!-- Remember Me -->
        <!-- <div class="block mt-4">
        <x-nav-link :href="route('authenticationQr')" :active="request()->routeIs('authenticationQr')">
                        {{ __('Google Authenticator') }}
                    </x-nav-link>
        </div> -->
        <!-- <div class="flex items-center justify-end mt-4">
            <a href="{{ url('auth/google') }}">
                <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png" style="margin-left: 3em;">
            </a>
        </div> -->
        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ml-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
