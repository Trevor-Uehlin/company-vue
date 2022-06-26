<template>
    <AppLayout>

        <Head title="Credit Cards" />

        <div class="container">
            <div class="row">
                <div v-for="profile in paymentProfiles" class="card m-2 w-25">
                    <div class="card-body p-0">
                        <p class="card-title m-0"><strong>{{profile.firstName +" "+ profile.lastName +"'s "+ profile.cardType}}</strong></p>
                        <font-awesome-icon :icon="profile.icon" class="float-right"/>
                        <p class="card-text m-0">ending in {{profile.cardNumber}}</p>
                        <p class="card-text m-0">expires on {{profile.expirationDate}}</p>
                        <p class="card-text mt-2 mb-0"><strong>Billing Information</strong></p>
                        <p class="card-text m-0">{{profile.address}}</p>
                        <p class="card-text m-0">{{profile.city +", "+ profile.state +" "+ profile.zip}}</p>
                        <p class="card-text m-0">{{profile.phone}}</p>
                    </div>
                </div>
            </div>
        </div>

    </AppLayout>
</template>

<script>
import {Head} from '@inertiajs/inertia-vue3';
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
        FontAwesomeIcon
    },
    props:{
        paymentProfiles: Array
    }
}
</script>