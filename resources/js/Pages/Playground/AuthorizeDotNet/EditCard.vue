<template>
    <AppLayout>

        <Head title="Edit Card" />

        <div class="container px-5">

            <h2>Edit a Payment Method</h2>

            <form @submit.prevent="submit">

                <input type="hidden" name="id" v-model="form.id" />

                <div class="row">
                    <div class="col-md-8">
                        <div class="card p-3">

                            <h6 class="text-uppercase">Payment details</h6>

                            <div class="row mt-2">

                                <div class="col-md-6">
                                    <div class="inputbox mt-3 mr-2">
                                        <input type="text" name="firstName" class="form-control" v-model="form.firstName" required="required" />
                                        <span>First Name</span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="inputbox mt-3 mr-2">
                                        <input type="text" name="lastName" class="form-control" v-model="form.lastName" required="required" />
                                        <span>Last Name</span>
                                    </div>
                                </div>

                            </div>


                            <div class="row">

                                <div class="col-md-6">
                                    <div class="inputbox mt-3 mr-2 w-75">
                                        <input type="text" name="cardNumber" class="form-control" maxlength="16" minlength="16" v-model="form.cardNumber" required />
                                        <i class="fa fa-credit-card"></i>
                                        <span>Card Number</span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="d-flex flex-row">

                                    <div class="inputbox mt-3 mr-2 w-25">
                                            <input type="text" name="expMonth" class="form-control" v-model="form.expMonth" maxlength="2" minlength="2" placeholder="mm" required />
                                        <span>exp. month</span>
                                    </div>

                                    &nbsp;
                                    &nbsp;

                                    <div class="inputbox mt-3 mr-2 w-25">
                                            <input type="text" name="expYear" class="form-control" v-model="form.expYear" maxlength="4" minlength="4" placeholder="yyyy" required />
                                        <span>exp. year</span>
                                    </div>

                                    &nbsp;
                                    &nbsp;

                                    <div class="form-check mt-3 ml-2">
                                        <input class="form-check-input" type="checkbox" name="default" v-model="form.default" value="1" >
                                        <span>default</span>
                                    </div>

                                    </div>
                                </div>

                            </div>



                            <div class="mt-4 mb-4">

                                <h6 class="text-uppercase">Billing Information</h6>


                                <div class="row mt-3">

                                    <div class="col-md-6">
                                        <div class="inputbox mt-3 mr-2">
                                            <input type="text" name="address" class="form-control" v-model="form.address" required />
                                            <span>Street Address</span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="inputbox mt-3 mr-2">
                                            <input type="text" name="city" class="form-control" v-model="form.city" required />
                                            <span>City</span>
                                        </div>  
                                    </div>

                                </div>


                                <div class="row mt-2">

                                    <div class="col-md-6">
                                        <div class="inputbox mt-3 mr-2">
                                            <input type="text" name="state" class="form-control" v-model="form.state" required />
                                            <span>State/Province</span>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="inputbox mt-3 mr-2">
                                            <input type="text" name="zip" class="form-control" v-model="form.zip" required />
                                            <span>Zip code</span>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="inputbox mt-3 mr-2">
                                        <input type="tel" name="phone" class="form-control" v-model="form.phone" placeholder="555-555-5555" required />
                                        <span>Phone</span>
                                    </div>
                                </div>

                            </div>

                        </div>


                        <div class="row">
                            <div class="mt-4 mb-4">
                                <button class="btn btn-dark btn-xsmall px-3 mx-4" type="submit">Save Card</button>
                                <Link :href="route('payments')" class="btn btn-dark btn-xsmall px-3 mx-4">Cancel</Link>
                            </div>
                        </div>

                    </div>
                </div>
            </form>

        </div>
    </AppLayout>
</template>

<script>

import AppLayout from '@/Layouts/App.vue';
import {Head, Link, useForm} from '@inertiajs/inertia-vue3';

export default {
    components:{
        AppLayout,
        Head,
        Link,
        useForm
    },
    props:{
        profile: Array
    },
    setup(props) {
        const form = useForm({
            id : props.profile.id,
            firstName: props.profile.firstName,
            lastName: props.profile.lastName,
            cardNumber: props.profile.cardNumber,
            expMonth: props.profile.exp_month,
            expYear: props.profile.exp_year,
            default: props.profile.default,
            address: props.profile.address,
            city: props.profile.city,
            state: props.profile.state,
            zip: props.profile.zip,
            phone: props.profile.zip
        });

        return {form}
    },
    methods: {
        submit(){
            this.form.post(route("payments.store"));
        }
    },
}

</script>