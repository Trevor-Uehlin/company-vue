<script setup>

defineProps({
    users: Array
})

</script>

<template>

    <Head title="Users" />

    <AppLayout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Users
                <Link :href="route('users.create')" class="float-right"><i class="fa fa-plus" style="font-size:35px;color:blue;"></i></Link>
                <p class="text-sm mb-0">Showing {{users.length}} user(s)</p>
            </h2>
        </template>

        <div class="container">
            <div v-for="user in users" :key="user.id" class="py-2">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-4 bg-white border-b border-gray-200">

                            <p>Created: {{user.created}}</p>
                            <p class="h4 mb-0"><strong>{{user.name}}</strong></p>
                            <p class="mb-0"><strong>Email: </strong>{{user.email}}</p>
                            <p><strong>User Type: </strong>{{user.role}}</p>

                            <div class="row">

                                <button class="btn btn-dark mx-2" @click="editUser(user.id)">Edit User</button>
                                <button class="btn btn-dark mx-2" @click="deleteUser(user.id)">Delete User</button>
                                
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/App.vue';
import { Head, useForm, Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        AppLayout
    },
    setup() {},
    methods: {
        editUser(id) {
            this.$inertia.get(this.route('users.show', id));
        },
        deleteUser(id) {
            if(confirm("Are you sure you want to delete this user?")) {
                this.$inertia.delete(this.route('users.destroy', id));
            }
        }
    },
};
</script>