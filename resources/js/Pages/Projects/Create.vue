<template>

    <Head title="New Project" />

    <AppLayout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create a new project
            </h2>
        </template>

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
                                <label for="title">Title</label>
                                <input type="text" name="title" class="block mt-1 w-full rounded" v-model="form.title"  required >
                            </div>

                            <div class="form-group">
                                <label for="organization">Organization</label>
                                <input type="text" name="organization" class="block mt-1 w-full rounded" v-model="form.organization"  required >
                            </div>

                            <div class="form-group">
                                <label for="url">URL</label>
                                <input type="text" name="url" class="block mt-1 w-full rounded" v-model="form.url"  required >
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea type="text" rows="10" name="description" class="block mt-1 w-full rounded h-100" v-model="form.description"  required ></textarea>
                            </div>

                            <div class="form-group">
                                <label for="file">Upload an Image</label>
                                <input type="file" name="file" class="block mt-1 w-full rounded" v-on:change="handleFile" required >
                            </div>


                            <div class="row mt-4 px-6">
                                <button type="submit" class="btn btn-dark">Create Project</button>
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
import { useForm, Head } from '@inertiajs/inertia-vue3';

export default {
    components: {
        AppLayout,
        Head
    },
    setup() {
        const form = useForm({
            priority: null,
            title: null,
            organization: null,
            url: null,
            description: null,
            file: null
        });

        return { form };
    },
    data() {
        return {}
    },
    methods: {
        submit() {
            this.form.post(route("projects.store"));
        },
        cancel() {
            this.$inertia.get(route("projects"));
        },
        handleFile(e) {
            this.form.file = e.target.files[0];
        }
    },
};
</script>