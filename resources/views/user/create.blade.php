<style>
    /* Bootstrap Success Alert */
    .alert-success {
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
    }
    /* Bootstrap Success Alert - Links */
    .alert-success a {
        color: #0c802c;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                    @if (session('status'))
                        <div class="alert alert-success" style="margin: 10px 0px; padding: 15px;border-radius: 10px">
                            {{ session('status') }}
                        </div>
                    @endif
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Create New User') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Ensure your account is using a long, random password to stay secure.') }}
                            </p>
                        </header>

                        <form method="post" action="{{ route('add-invited-user') }}" class="mt-6 space-y-6">
                            @csrf
                            {{-- @method('put') --}}
                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"  />
                                <x-input-error :messages="$errors->updatePassword->get('email')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" name="email" type="text" class="mt-1 block w-full"  />
                                <x-input-error :messages="$errors->updatePassword->get('email')" class="mt-2" />
                            </div>
                            <div class="mt-4">
                                <x-input-label for="dropdown" :value="__('Select an User Type')" />
                                @if(Auth::user()->type == 'admin')
                                <select id="dropdown" name="dropdown" class="block w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                    <option value="reseller">Reseller</option>
                                    <option value="customer">Customer</option>
                                    <option value="normal">Normal</option>
                                </select>
                                @endif
                                @if(Auth::user()->type == 'reseller')
                                <select id="dropdown" name="dropdown" class="block w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                    <option value="customer">Customer</option>
                                    <option value="normal">Normal</option>
                                </select>
                                @endif
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>
                                <a href="{{ route('user.list') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" style="font-size: 13px;">{{ __('CANCLE') }}</a>

                                {{-- @if (session('status') === 'password-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">{{ __('Saved.') }}</p>
                                @endif --}}
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
</x-app-layout>
