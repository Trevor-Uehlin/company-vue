<template>

    <Head title="My Profile" />

    <AppLayout>


        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
    
                        <form>

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
                                <label for="file">Upload an image for your profile</label>
                                <input type="file" name="file" class="block mt-1 w-full rounded" value="">
                            </div>

                            <div class="form-group">
                                <button onclick="submit" class="btn btn-dark btn-small">Save</button>
                            </div>


                        </form>

                    </div>
                </div>
            </div>
        </div>
    
    </AppLayout>
</template>

<script>

import AppLayout from "@/Layouts/App.vue";
import {Head, useForm} from "@inertiajs/inertia-vue3";

export default {
    components:{
        AppLayout,
        Head,
        useForm
    },
    props:{
        profile: Object
    },
    setup(props) {

        console.log(props.profile.phone)

        const form = useForm({
            phone: props.profile.phone,
            email: props.profile.email,
            about_info: props.profile.about_info
        });

        return {form};
    }
}
</script>