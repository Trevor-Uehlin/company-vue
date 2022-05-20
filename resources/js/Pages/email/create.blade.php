<x-app-layout>

    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Please feel free to reach out and share any thoughts you may have about myself or my website.') }}
        </h2>
    </x-slot> --}}

    <x-custom.sub-content-area>
        <p>
            {{ __('Feel free to reach out and share any thoughts you may have about myself or my website.') }}
        </p>
    </x-custom.sub-content-area>

    <br />

    <div class="container">

        <form method="POST" action="{{ route('send') }}">
            @csrf

            <div class="form-group">
                <x-label for="from" :value="__('Your Email Address')" />
                <x-input id="from" class="block mt-1 w-full" type="email" name="from" required autofocus />
            </div>

            <div class="form-group">
                <x-label for="subject" :value="__('Subject')" />
                <x-input id="subject" class="block mt-1 w-full" type="text" name="subject" required autofocus />
            </div>

            <div class="form-group">
                <x-label for="body" :value="__('Your Message')" />
                <x-textarea id="body" class="block mt-1 w-full" name="body" required autofocus />
            </div>

            <x-button>Send Email</x-button>

        </form>
    
    
        @if(count($errors) > 0)
            <div class="alert-danger alert">
                <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
                </ul>
            </div>
        @endif

    </div>

</x-app-layout>