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

        <div v-for="project in projects" :key="project.id" class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4 bg-white border-b border-gray-200">
                        <div class="border p-2 rounded">
                            <p class="float-right">Published: {{project.created_at}}</p>
                            <p v-if="user.isAdmin" class="mb-0">Priority: {{project.priority}}</p>
                            <p class="h4"><strong><Link :href="project.url" style="color: blue;">{{project.title}}</Link></strong></p>
                            <p><strong>Organization: </strong>{{project.organization}}</p>
                            <p class="mb-0"><strong>Description</strong></p>
                            <p>{{project.description}}</p>
                        </div>

                        <div>
                            <carousel :items-to-show="1" :wrap-around="true">
                                <slide v-for="image in project.images" :key="image.path">
                                    <img :src="image.path" :alt="image.title">
                                </slide>

                                <template #addons>
                                    <navigation />
                                    <pagination />
                                </template>
                            </carousel>
                        </div>





                        <div v-if="user.isAdmin" class="row">

                            <button class="btn btn-dark mx-2" @click="editProject(project.id)">Edit Project</button>
                            <button class="btn btn-dark mx-2" @click="deleteProject(project.id)">Delete Project</button>
                            
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
import 'vue3-carousel/dist/carousel.css';
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel';

export default {
    components: {
        AppLayout,
        Head,
        Link,
        Carousel,
        Slide,
        Pagination,
        Navigation
    },
    props: {
        user: Object,
        projects: Array
    },
    setup() {},
    methods: {
        editProject(id) {
            this.$inertia.get(this.route('projects.show', id));
        },
        deleteProject(id) {
            if(confirm("Are you sure you want to delete this project?")) {
                this.$inertia.delete(this.route('projects.destroy', id));
            }
        },
        incrementIndex($index) {
            return $index +1;
        }
    },
}
</script>

<style scoped>
.carousel__item {
  min-height: 200px;
  width: 100%;
  background-color: var(--vc-clr-primary);
  color:  var(--vc-clr-white);
  font-size: 20px;
  border-radius: 8px;
  display: flex;
  justify-content: center;
  align-items: center;
}

.carousel__slide {
  padding: 10px;
}

.carousel__prev,
.carousel__next {
  box-sizing: content-box;
  border: 5px solid white;
}

img{
    width: 100%;
}
</style>
