<template>

    <Head title="Edit Project" />

    <AppLayout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit a project
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent = submit>

                            <input type="hidden" name="id" id="id">

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
                                <input type="text" name="description" class="block mt-1 w-full rounded" v-model="form.description"  required >
                            </div>

                            <div class="form-group">
                                <label for="file">Upload an Image</label>
                                <input type="file" name="file" class="block mt-1 w-full rounded" v-on:change="handleFile" >
                            </div>


                            <div class="row mt-4 px-6">
                                <button type="submit" class="btn btn-dark">Update Project</button>
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
    props: {
        project: Object
    },
    setup(props) {
        const form = useForm({
            id:props.project.id,
            priority: props.project.priority,
            title: props.project.title,
            organization: props.project.organization,
            url: props.project.url,
            description: props.project.description,
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