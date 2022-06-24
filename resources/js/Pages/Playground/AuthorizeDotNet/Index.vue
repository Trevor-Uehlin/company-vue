<template>
    <AppLayout>

        <Head title="Credit Cards" />

        <div class="container">
            <div class="row">
                <div v-for="profile in paymentProfiles" class="card m-2 w-25">
                    <div class="card-body p-0">
                        <p class="card-title m-0"><strong>{{profile.firstName +" "+ profile.lastName +"'s "+ profile.cardType}}</strong></p>
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

export default {
    components:{
        AppLayout,
        Head
    },
    props:{
        paymentProfiles: Array
    }
}
</script>