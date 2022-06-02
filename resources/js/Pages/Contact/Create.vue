
<template>

    <Head title="Contact Me" />

    <AppLayout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Feel free to reach out with any thoughts you may have about myself or my website.
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">

                        <form @submit.prevent="submit">
                            <!-- @csrf -->

                            <div class="form-group">
                                <label for="from">Your Email</label>
                                <input id="from" class="block mt-1 w-full rounded" type="email" name="from" v-model="form.from" required autofocus />
                            </div>

                            <div class="form-group">
                                <label for="from">Subject</label>
                                <input id="subject" class="block mt-1 w-full rounded" type="text" name="subject" v-model="form.subject" required autofocus />
                            </div>

                            <div class="form-group">
                                <label for="from">Message</label>
                                <textarea id="body" class="block mt-1 w-full rounded" name="body" row="11" v-model="form.body" required autofocus>This is the body</textarea>
                            </div>

                            <button class="btn btn-dark">Send Email</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/App.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';

export default {
    components: {
        AppLayout,
        Head
    },
    setup() {
        const form = useForm({
            from: null,
            subject: null,
            body: null,
        });

        return { form };
    },
    methods: {
        submit() {
            this.form.post(route("send"));
        },
    },
};
</script>
