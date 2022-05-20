<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class WeatherController extends Controller {

    public function index() {

        $user_ip = $_SERVER["REMOTE_ADDR"] == "::1" ? "73.67.251.164" : $_SERVER["REMOTE_ADDR"];
        $ipapiKey = env("IPAPI_API_KEY");

        $locationUrl = "http://api.ipapi.com/$user_ip?access_key=$ipapiKey";
        $locationInfo = Http::get($locationUrl)->json();
        
        if(!empty($locationInfo['error'])) throw new \Exception("Location Error: " . $locationInfo["reason"]);

        $lat = $locationInfo["latitude"];
        $lon = $locationInfo["longitude"];
        $apiKey = env("OPEN_WEATHER_MAP_API_KEY");

        $weatherUrl = "https://api.openweathermap.org/data/2.5/onecall?lat=$lat&lon=$lon&exclude=minutely,hourly&appid=$apiKey&units=metric";
        $weatherInfo = Http::get($weatherUrl)->json();

        $weather = $this->parse($locationInfo, $weatherInfo);

        return view("playground.weather.index", compact("weather"));
    }


    public function parse($location, $weather) {

        $parsed = [];
        $parsed["city"] = $location["city"];
        $parsed["state"] = $location["region_code"];
        $parsed["today"]["mostly"] = $weather["current"]['weather'][0]['main'];
        $parsed["today"]["description"] = $weather["current"]['weather'][0]['description'];
        $parsed["today"]["icon"] = $weather["current"]['weather'][0]['icon'];
        $parsed["today"]["currentTemp"] = floor($this->toFarenheit($weather['current']['temp']));
        $parsed["today"]["feelsLike"] = floor($this->toFarenheit($weather['current']['feels_like']));
        $parsed["today"]["maxTemp"] = floor($this->toFarenheit($weather["daily"][0]["temp"]["max"]));
        $parsed["today"]["minTemp"] = floor($this->toFarenheit($weather["daily"][0]["temp"]["min"]));
        $parsed["today"]["pressure"] = $weather["current"]["pressure"];
        $parsed["today"]["humidity"] = $weather["current"]["humidity"];
        $parsed["today"]["visibility"] = substr($weather["current"]["visibility"], 0, 2);
        $parsed["today"]["windSpeed"] = $weather["current"]["wind_speed"];

        foreach($weather["daily"] as $daily) {

            $date = new Carbon($daily["dt"]);
            $day = $date->format("D");

            $parsed["forcast"][$day]["icon"] = $daily["weather"][0]["icon"];
            $parsed["forcast"][$day]["maxTemp"] = floor($this->toFarenheit($daily["temp"]["max"]));
            $parsed["forcast"][$day]["minTemp"] = floor($this->toFarenheit($daily["temp"]["min"]));

        }

        return $parsed;
    }


    public function toFarenheit($temp) {

        return ($temp * 9/5) + 32;
    }
}



