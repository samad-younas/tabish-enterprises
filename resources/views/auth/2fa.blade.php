<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Google Authenticator') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="card-body" style="text-align: center;">
                        <div>
                            {!! $QR_Image !!}
                        </div>
                        <p>You must set up your Google Authenticator app before continuing. You will be unable to login otherwise</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
