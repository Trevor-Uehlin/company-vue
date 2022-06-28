<template>

    <Head title="My Gallary" />

    <AppLayout>

        <div class="py-12">

            <div class="container bg-white mt-2 py-2">
                <h3 class="text-center">Your Gallary</h3>
                <p class="text-center">There are {{images.length}} image(s) in your gallary</p>
                <div v-for="image in images" :key="image.path" class="mt-1 border border-dark p-2">
                    <img :src="'/' + image.path" :alt="image.title">

                    <button class="btn btn-dark m-2" @click="deleteImage(image.id)">Delete Image</button>
                    <Link :href="route('profile.image', image.id)" :as="button" class="btn btn-dark m-2">Set as Default</Link>

                </div>
            </div>

        </div>
    
    </AppLayout>
</template>

<script>

import AppLayout from "@/Layouts/App.vue";
import {Head} from "@inertiajs/inertia-vue3";

export default {
    components:{
        AppLayout,
        Head
    },
    props:{
        images: Array
    },
    methods:{
        deleteImage(id) {
            if(confirm("Are you sure you want to delete this image?")){
                this.$inertia.delete(route("images.destroy", id));
            }
        }
    }
}
</script>