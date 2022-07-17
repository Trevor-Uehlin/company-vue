<template>
    
    <Head title="To Do List" />

    <AppLayout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Site To Do Items
                <Link :href="route('toDo.create')" class="float-right"><i class="fa fa-plus" style="font-size:35px;color:blue;"></i></Link>
                <p class="text-sm mb-0">Showing {{items.length}} to do item(s)</p>
            </h2>
        </template>

        <div v-for="item in items" :key="item.id" class="row">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4 bg-white border-b border-gray-200">
                        <div class="border p-2 rounded">

                            <p class="col">Priority: {{item.priority}}</p>
                            <p class="col">Desc: {{item.description}}</p>
                            <p class="col">URL: {{item.url}}</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </AppLayout>
</template>

<script>

    import AppLayout from '@/Layouts/App.vue';
    import {Head, Link} from '@inertiajs/inertia-vue3';

    export default {
        components:{
            AppLayout,
            Head,
            Link
        },
        props:{
            items: Array
        },
        setup(props){
            console.log(props.items);
        }
    }



</script>