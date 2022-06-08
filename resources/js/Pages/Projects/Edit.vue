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
                                <label class="mb-0" for="priority">Priority</label>
                                <input type="text" name="priority" class="block mt-1 w-full rounded" v-model="form.priority"  required >
                            </div>

                            <div class="form-group">
                                <label class="mb-0" for="title">Title</label>
                                <input type="text" name="title" class="block mt-1 w-full rounded" v-model="form.title"  required >
                            </div>

                            <div class="form-group">
                                <label class="mb-0" for="organization">Organization</label>
                                <input type="text" name="organization" class="block mt-1 w-full rounded" v-model="form.organization"  required >
                            </div>

                            <div class="form-group">
                                <label class="mb-0" for="url">URL</label>
                                <input type="text" name="url" class="block mt-1 w-full rounded" v-model="form.url"  required >
                            </div>

                            <div class="form-group">
                                <label class="mb-0" for="description">Description</label>
                                <textarea type="text" rows="10" name="description" class="block mt-1 w-full rounded h-100" v-model="form.description"  required ></textarea>
                            </div>

                            <div class="form-group">
                                <label class="mb-0" for="file">Add an Image</label>
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

            <div class="container bg-white mt-2 py-2">
                <h3 class="text-center">Current Project Images</h3>
                <p class="text-center">Currently showing {{project.images.length}} image(s)</p>
                <div v-for="image in project.images" :key="image.path" class="mt-1 border border-dark p-2">
                    <img :src="'/' + image.path" :alt="image.title">

                    <button class="btn btn-dark m-2" @click="deleteImage(image.id)">Delete Image</button>
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
        },
        deleteImage(id) {
            if(confirm("Are you sure you want to delete this image?")){
                this.$inertia.delete(route("images.destroy", id));
            }
        }
    },
};
</script>

<style scoped>

</style>