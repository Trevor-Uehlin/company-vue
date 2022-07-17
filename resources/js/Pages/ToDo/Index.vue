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

        <div v-for="item in items" :key="item.id" class="mx-2 my-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4 bg-white border-b border-gray-200">
                        <div class="border p-2 rounded">
                            <p class="float-right">Priority: {{item.priority}}</p>
                            <Link :href="item.url">Go to page</Link>
                            <p>Desc: {{item.description}}</p>

                            <button class="btn btn-dark mx-2" @click="editItem(item.id)">Edit Item</button>
                            <button class="btn btn-dark mx-2" @click="deleteItem(item.id)">Delete Item</button>
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
        },
        methods: {
            editItem(id) {
                this.$inertia.get(this.route('toDo.show', id));
            },
            deleteItem(id) {
                if(confirm("Are you sure you want to delete this item?")) {
                    this.$inertia.delete(this.route('toDo.destroy', id));
                }
            }
        },
    }



</script>