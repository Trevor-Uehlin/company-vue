<script setup>
import { ref } from 'vue';
import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue';
import BreezeDropdown from '@/Components/Dropdown.vue';
import BreezeDropdownLink from '@/Components/DropdownLink.vue';
import BreezeNavLink from '@/Components/NavLink.vue';
import BreezeResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import NavigationLayout from '@/Layouts/Navigation.vue';
import FooterLayout from '@/Layouts/Footer.vue';
import { Link } from '@inertiajs/inertia-vue3';

const showingNavigationDropdown = ref(false);
</script>



<template>

    <div>
        <div class="min-h-screen bg-gray-100 page-container">
            
            <NavigationLayout />

            <!-- Page Heading -->
            <header class="bg-white shadow mx-auto w-75 mt-2 rounded text-center" v-if="$slots.header">
                <div class="max-w-7xl mx-auto p-2 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main class="content-wrap">
                <slot />
            </main>

            <FooterLayout />

        </div>
    </div>
</template>