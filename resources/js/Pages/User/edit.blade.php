<x-app-layout>


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit user') }}
        </h2>
    </x-slot>

    <br />
    <br />

    <div class="container">
        <form method="POST" action="{{route("users.update", $user->id)}}">
            @method("PATCH")
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$user->name" required />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="$user->email" required />
            </div>

            <!-- User Type -->
            <div class="mt-4">
                <x-label for="user_type" :value="__('Select User Type')" />

                <select name="user_type" id="user_type" class="block mt-1 w-full">
                    <option value=2 @selected($user->isAdministrator())>Subscriber</option>
                    <option value=1 @selected($user->isAdministrator())>Administrator</option>
                </select>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">
                    {{ __('Submit Changes') }}
                </x-button>

                <x-button-link href="{{route('users.index')}}" class="ml-2">{{__('Cancel')}}</x-button-link>
            </div>
        </form>
    </div>



</x-app-layout>