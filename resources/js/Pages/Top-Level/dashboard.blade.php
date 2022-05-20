<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your Dashboard') }}
        </h2>
    </x-slot>

    <x-custom.sub-content-area>
        {{__('You are logged in...thank you for registering!')}}
    </x-custom.sub-content-area>


    @if(auth()->user()->isAdministrator())

        <x-custom.sub-content-area>
            {{__("Administrative Dashboard")}}

            <br />
            <br />
            <i class="fa fa-plus" style="font-size:20px;color:blue;"></i><a href="{{route("projects.create")}}"> Create a New Project</a>
            <br />
            <br />
            <i class="fa fa-plus" style="font-size:20px;color:blue;"></i><a href="{{route("users.create")}}"> Create a New User</a>
            <br />
            <br />
            <i class="fa fa-user" style="font-size:20px;color:blue;"></i><a href="{{route("users.index")}}"> Manage Users</a>
        </x-custom.sub-content-area>

    @endif

    

</x-app-layout>
