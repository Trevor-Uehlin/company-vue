<script setup>
import AppLayout from '@/Layouts/App.vue';
import { Head } from '@inertiajs/inertia-vue3';
</script>

<template>
    <Head title="Home" />

    <AppLayout>
        <!-- <template #header>

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Home Page
            </h2>

        </template> -->

        <div class="home-page">
            <div class="home-message">
                <p>Hi, I'm Trevor and this is my website!</p>
                <p>It was built using Laravel.  It is a place for me to practice development, and share some of the projects that I have worked on.</p>
            </div>
        </div>
        
    </AppLayout>

</template>
