<template>

    <Head title="My Profile" />

    <AppLayout>


        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">

                        <div v-if="profile.profile_image != null" class="mb-4">
                            <p>Your Profile Image</p>
                            <img :src="'/' + profile.profile_image.path" :alt="profile.profile_image.title" class="profile-image rounded" />
                        </div>
    
                        <div>
                            <form @submit.prevent = submit>

                            <input type="hidden" name="id" v-model="form.id">

                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="tel" name="phone" class="block mt-1 w-full rounded" v-model="form.phone">
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="block mt-1 w-full rounded" v-model="form.email">
                            </div>

                            <div class="form-group">
                                <label for="about_info">Tell us a little about yourself...if you want to.</label>
                                <textarea rows="6" cols="" name="about_info" class="block mt-1 w-full rounded" v-model="form.about_info"></textarea>
                            </div>
                            
                            <div class="form-group">
                                <label for="file">Upload an image for your profile picture or your <Link :href="route('profile.gallery')">gallery</Link>.</label>
                                <input type="file" name="file" class="block mt-1 w-full rounded" v-on:change="handlefile">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-dark btn-small">Save Profile</button>
                            </div>


                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <div class="container bg-white mt-2 py-2">
                <h3 class="text-center">Your Gallary (view in <Link :href="route('profile.gallery')">gallery</Link>)</h3>
                <p class="text-center">There are {{profile.images.length}} image(s) in your <Link :href="route('profile.gallery')">gallery</Link></p>
                <div v-for="image in profile.images" :key="image.path" class="mt-1 border border-dark p-2">
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
import {Head, Link, useForm} from "@inertiajs/inertia-vue3";

export default {
    components:{
        AppLayout,
        Head,
        Link,
        useForm
    },
    props:{
        profile: Object
    },
    setup(props) {
        
        const form = useForm({
            id: props.profile.id,
            phone: props.profile.phone,
            email: props.profile.email,
            about_info: props.profile.about_info,
            file:null
        });

        return {form};
    },
    methods:{
        submit() {
            this.form.post(route("profile.store"));
        },
        handlefile(e){
            this.form.file = e.target.files[0];
        },
        deleteImage(id) {
            if(confirm("Are you sure you want to delete this image?")){
                this.$inertia.delete(route("images.destroy", id));
            }
        }
    }
}
</script>


<style scoped>

.profile-image {

    height: 10rem;
}
    
</style>