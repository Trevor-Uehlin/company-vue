
<template>

    <Head title="Edit User" />

    <AppLayout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit User
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent = submit>

                            <input type="hidden" name="id" id="" v-model="form.id">

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="block mt-1 w-full rounded" v-model="form.name"  required >
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="block mt-1 w-full rounded" v-model="form.email"  required>
                            </div>

                            <div class="form-group">
                                <label for="user_type">User Type</label>

                                <select name="role_id" class="block mt-1 w-full" v-model="form.role_id" >
                                    <option v-for="typeOption in typeOptions" :value="typeOption.value" :key="typeOption.value">
                                        {{typeOption.text}}
                                    </option>
                                </select>

                            </div>

                            <div class="row px-6">
                                <button type="submit" class="btn btn-dark">Update User</button>
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
        user: Object
    },
    setup(props) {
        const form = useForm({
            id: props.user.id,
            name: props.user.name,
            email: props.user.email,
            role_id: props.user.role_id
        });

        return { form };
    },
    data() {
        return {
            typeOptions: [
                {text: "Administrator", value: "1"},
                {text: "Subscriber", value: "2"}
            ]
        }
    },
    methods: {
        submit() {
            this.form.patch(route("users.update", this.form.id));
        },
        cancel() {
            this.$inertia.get(route("users.index"));
        }
    },
};
</script>

