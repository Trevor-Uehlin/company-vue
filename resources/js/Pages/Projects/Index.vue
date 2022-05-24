<template>

    <Head title= "Projects" />

    <AppLayout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                My Projects
                <Link v-if="user.isAdmin" :href="route('projects.create')" class="float-right"><i class="fa fa-plus" style="font-size:35px;color:blue;"></i></Link>
                <p class="text-sm mb-0">Showing {{projects.length}} projects(s)</p>
            </h2>
        </template>

        <div class="container">
            <div v-for="project in projects" :key="project.id" class="py-2">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-4 bg-white border-b border-gray-200">
                            <p>Priority: {{project.priority}}</p>
                            <p>Published: {{project.created_at}}</p>
                            <p class="h4"><strong><Link :href="project.url" style="color: blue;">{{project.title}}</Link></strong></p>
                            <p><strong>Organization: </strong>{{project.organization}}</p>
                            <p class="mb-0"><strong>Description</strong></p>
                            <p>{{project.description}}</p>




                            <div class="image-list-container">

                                <div class="image-container">
                                    <div :id="project.id" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">

                                            <div v-for="image in project.images" :key="image.id">
                                                {{image}}
                                            </div>
                        
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- <div class="row w-100 slide-controls">
                                    <div class="col text-center">
                                        <x-button data-bs-target="#{{project.id}}" data-bs-slide="prev">
                                            <
                                        </x-button>
                                        <x-button data-bs-target="#{{project.id}}" data-bs-slide="next">
                                            >
                                        </x-button>
                                    </div>
                                </div> -->

                            </div>





                            <div v-if="user.isAdmin" class="row">

                                <button class="btn btn-dark mx-2" @click="editProject(project.id)">Edit Project</button>
                                <button class="btn btn-dark mx-2" @click="deleteProject(project.id)">Delete Project</button>
                                
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
import { Head, Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        AppLayout,
        Head,
        Link
    },
    props: {
        user: Object,
        projects: Array
    },
    setup() {},
    data() {
        return {
            index: 0
        }
    },
    methods: {
        editProject(id) {
            this.$inertia.get(this.route('projects.show', id));
        },
        deleteProject(id) {
            if(confirm("Are you sure you want to delete this project?")) {
                this.$inertia.delete(this.route('projects.destroy', id));
            }
        }
    },
}
</script>
