<template>
    <AppLayout>

        <Head title="Credit Cards" />

        <div class="container">

            <div class="text-center">
                <h3 v-if="paymentProfiles.length == 0" >You don't have any saved payment methods</h3>
                <h3 v-else>Your saved payment methods</h3>
                <Link :href="route('payments.create')" class="btn btn-dark btn-xsmall">New Card</Link>
            </div>

            <div class="row">
                <div v-for="profile in paymentProfiles" class="card m-2 w-25 p-2">
                    <div class="card-body p-0">
                        <p class="card-title m-0">
                            <strong>{{profile.firstName +" "+ profile.lastName}}</strong>
                            <font-awesome-icon :icon="profile.icon" class="float-right card-icon"/>
                        </p>
                        <p class="card-text m-0">ending in {{profile.cardNumber}}</p>
                        <p class="card-text m-0">expires on {{profile.exp_month +"-"+ profile.exp_year}}</p>
                        <p class="card-text mt-2 mb-0"><strong>Billing Information</strong></p>
                        <p class="card-text m-0">{{profile.address}}</p>
                        <p class="card-text m-0">{{profile.city +", "+ profile.state +" "+ profile.zip}}</p>
                        <p class="card-text">{{profile.phone}}</p>

                        <div class="row">
                            <button class="btn btn-dark btn-xsmall mx-2" @click="editCard(profile.id)">Edit Card</button>
                            <button class="btn btn-dark btn-xsmall mx-2" @click="deleteCard(profile.id)">Delete</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </AppLayout>
</template>

<script>
import {Head, Link} from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/App.vue';
import { library } from '@fortawesome/fontawesome-svg-core';
import { fas } from '@fortawesome/free-solid-svg-icons';
import { fab } from '@fortawesome/free-brands-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
library.add(fas);
library.add(fab);

export default {
    components:{
        AppLayout,
        Head,
        Link,
        FontAwesomeIcon
    },
    props:{
        paymentProfiles: Array
    },
    methods: {
        editCard(id) {
            this.$inertia.get(this.route('payments.show', id));
        },
        deleteCard(id) {
            if(confirm("Are you sure you want to delete this card?")) {
                this.$inertia.delete(this.route('payments.destroy', id));
            }
        }
    },
}
</script>

<style>
.card-icon{
    font-size: 40px;
}
    
</style>