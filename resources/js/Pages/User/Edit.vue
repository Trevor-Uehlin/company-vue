
<template>

    <Head title="New User" />

    <AppLayout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create a new user
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent = submit>

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="block mt-1 w-full rounded" v-model="form.name"  required >
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="block mt-1 w-full rounded" v-model="form.email"  required>
                            </div>

                            <div class="form-group">
                                <label for="user_type">User Type</label>

                                <select name="role_id" class="block mt-1 w-full" v-model="form.role_id" >
                                    <option selected="selected" value="2">Subscriber</option>
                                    <option value="1">Administrator</option>
                                </select>
                            </div>

                            <div class="row px-6">
                                <button type="submit" class="btn btn-dark">Create User</button>
                                <button type="button" class="btn btn-dark ml-4">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </AppLayout>
</template>


<script>
import AppLayout from '@/Layouts/App.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';

export default {
    components: {
        AppLayout
    },
    setup() {
        const form = useForm({
            name: null,
            email: null,
            role_id: null,
        });

        return { form };
    },
    methods: {
        submit() {
            this.form.post(route("users.store"));
        },
    },
};
</script>

