<template>
    <AppLayout>

        <Head title="Weather" />

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Showing the weather for {{weather.city + ", " + weather.state}}
            </h2>
        </template>

        <div class="weather-container m-4 p-6 h5 row">

            <div>
                <p class="h4">Currently</p>

                <div class="icon-container">
                    <img :src="weather.today.imageUrl" alt="weather icon" class="fa-2x">
                </div>
        
                <p>Mostly: {{weather.today.mostly}}.</p>
                <p>Description: {{weather.today.description}}</p>
                <p>Current Temperature: {{weather.today.currentTemp}}&#8457;</p>
                <p>Feels Like: {{weather.today.feelsLike}}&#8457;</p>
                <p>Max Temp: {{weather.today.maxTemp}}&#8457;</p>
                <p>Min Temp: {{weather.today.minTemp}}&#8457;</p>
                <p>Pressure: {{weather.today.pressure}}</p>
                <p>Humidity: {{weather.today.humidity}}&#37;</p>
                <p>Wind Speed: {{weather.today.windSpeed}} mph</p>
                <p>Visibility: {{weather.today.visibility}} miles</p>
            </div>

            <div class="text-center ml-5 forcast">

                <p class="h4">7 Day Forcast</p>

                <div class="row ml-5 text-center">
        
                    <div v-for="daily in weather.forcast" :key="daily" class="m-4">
                        <p>{{daily.day}}</p>
                        <img :src="daily.imageUrl" alt="weather icon" class="icon">
                        <p>{{daily.maxTemp}}&#176; / {{daily.minTemp}}&#176;</p>
                    </div>
        
                </div>

        </div>

        </div>

    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/App.vue';
import { Head } from '@inertiajs/inertia-vue3';

export default {
    components: {
        AppLayout,
        Head
    },
    props:{
        weather: Object
    },
    setup(props){

    }
}
</script>


<style scoped>
.weather-container{
    background-color: blue;
    color:white;
}

.icon{
    height: 5rem;
}


@media screen and (max-width:750px) {

    .forcast{
        margin-top:40px;
    }
    .ml-5, .text-center{
        margin-left:unset !important;
    }
    
}
</style>