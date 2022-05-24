
<template>
    <Head title="Dashboard" />

    <AppLayout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Your Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        You're logged in!
                    </div>
                </div>
            </div>
        </div>

        <div v-if="user.isAdmin" class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <i class="fa fa-plus" style="font-size:20px;color:blue;"></i><Link :href="route('projects.create')"> Create a New Project</Link>
                        <br />
                        <i class="fa fa-plus mb-2" style="font-size:20px;color:blue;"></i><Link :href="route('users.create')"> Create a New User</Link>
                        <br />
                        <i class="fa fa-user" style="font-size:20px;color:blue;"></i><Link :href="route('users.index')"> Manage Users</Link>
                    </div>
                </div>
            </div>
        </div>

    </AppLayout>
    
</template>

<script>
import AppLayout from '@/Layouts/App.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        AppLayout,
        Head,
        Link
    },
    props: {
        user: Object
    },
    setup(props) {
        //console.log(props.user.isAdmin);
    }
}
</script>
