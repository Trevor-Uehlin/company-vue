<template>

    <Head title = "Edit Todo Item" />

    <AppLayout>
    
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent = submit>

                        <div class="form-group">
                                <label for="priority">Priority</label>
                                <input type="text" name="priority" class="block mt-1 w-full rounded" v-model="form.priority"  required >
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" name="description" class="block mt-1 w-full rounded" v-model="form.description"  required >
                            </div>

                            <div class="form-group">
                                <label for="url">URL</label>
                                <input type="text" name="url" class="block mt-1 w-full rounded" v-model="form.url"  required >
                            </div>

                            <div class="row mt-4 px-6">
                                <button type="submit" class="btn btn-dark">Create Task</button>
                                <button type="button" class="btn btn-dark ml-4" @click = cancel>Cancel</button>
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
import { Head, useForm } from "@inertiajs/inertia-vue3";


export default {
    components: {
        AppLayout,
        Head,
        useForm
    },
    props: {
        item: Array
    },
    setup(props) {

        const form = useForm({

            priority: props.item.priority,
            description: props.item.description,
            url: props.item.url
        });

        return {form};
    },
    methods: {
        submit() {
            this.form.post(route("toDo.store"));
        },
        cancel() {
            this.$inertia.get(route("toDo"));
        }
    },

}
</script>

