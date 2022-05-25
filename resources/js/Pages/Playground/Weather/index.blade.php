<x-app-layout>

    <link rel="stylesheet" href="{{asset('css/page-specific/weather.css')}}">

    <x-custom.sub-content-area>
        I am using openweathermap.org's api for the weather, and ipapi.com for the location.  I think they both may be a little off.
    </x-custom.sub-content-area>

    <div class="text-center">
        <h1>Showing the weather for {{$weather["city"] . ", " . $weather["state"]}}</h1>
    </div>

    <div class="weather-container m-4 p-6 h5 row">

        <div>

            <p class="h4">Currently</p>

            <div class="icon-container">
                <img src="http://openweathermap.org/img/wn/{{$weather["today"]["icon"]}}.png" alt="weather icon" class="fa-2x">
            </div>
    
            <p>Mostly: {{$weather["today"]["mostly"]}}.</p>
            <p>Description: {{$weather["today"]["description"]}}</p>
            <p>Current Temperature: {{$weather["today"]["currentTemp"]}}&#8457;</p>
            <p>Feels Like: {{$weather["today"]["feelsLike"]}}&#8457;</p>
            <p>Max Temp: {{$weather["today"]["maxTemp"]}}&#8457;</p>
            <p>Min Temp: {{$weather["today"]["minTemp"]}}&#8457;</p>
            <p>Pressure: {{$weather["today"]["pressure"]}}</p>
            <p>Humidity: {{$weather["today"]["humidity"]}}&#37;</p>
            <p>Wind Speed: {{$weather["today"]["windSpeed"]}} mph</p>
            <p>Visibility: {{$weather["today"]["visibility"]}} miles</p>
        </div>

        <div class="text-center ml-5 forcast">

            <p class="h4">7 Day Forcast</p>

            <div class="row ml-5 text-center">
    
                @foreach($weather["forcast"] as $day => $daily)
    
                <div class="m-4">
                    <p>{{$day}}</p>
                    <img src="http://openweathermap.org/img/wn/{{$daily["icon"]}}.png" alt="weather icon" class="icon">
                    <p>{{$daily["maxTemp"]}}&#176; / {{$daily["minTemp"]}}&#176;</p>
                </div>
    
                @endforeach
    
            </div>

        </div>

    </div>

</x-app-layout>