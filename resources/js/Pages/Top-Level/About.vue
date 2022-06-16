<script setup>
import AppLayout from '@/Layouts/App.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
</script>


<template>
    <Head title="About" />

    <AppLayout>
        <template #header>

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                This page will have information about my skills and professional goals.
            </h2>
            <p>This page is static for now.  The lists are still a work in progress.</p>

        </template>

            <div class="container bg-white mt-2 p-2">
                <h2 class="text-center">Professional Goals</h2>
                <p class="text-center">Obtain long-term employment in a challenging software development position, with a company that values my skills and diligent work ethic, while allowing me to continue to grow as a developer.</p>
            </div>

            <div class="mb-2">
                <div class="container bg-white mt-2 p-2">
                <h2 class="text-center">Education and Certifications</h2>

                <h5>Degree</h5>
                <ul>
                    <li>&bull;&nbsp;Associate of Applied Science - Computer Programming</li>
                    <li>&nbsp;&nbsp;&nbsp;Lane Community College - Eugene, OR</li>
                    <li>&nbsp;&nbsp;&nbsp;Graduated on 06/2019</li>
                </ul>

                <h5>Lane Community College Degree Certifications</h5>
                <ul>
                    <li>&bull;&nbsp;Front-End Web Development</li>
                    <li>&bull;&nbsp;Mobile Application Development</li>
                    <li>&bull;&nbsp;Database Development</li>
                </ul>
            </div>

            <div class="container bg-white mt-2 p-2">
                <h2 class="text-center">Skills</h2>

                <ul>
                    <li>&bull;&nbsp;MediaWiki - Skins, Extensions, Adiministration</li>
                    <li>&bull;&nbsp;WordPress - Themes, Plugins, Adiministration</li>
                    <li>&bull;&nbsp;Laravel - Version 7-9</li>
                    <li>&bull;&nbsp;Component Based JavaScript Frameworks - Vue 3, React</li>
                    <li>&bull;&nbsp;Salesforce - Apex, DX CLI, VisualForce(pages, components), Adiministration</li>
                    <li>&bull;&nbsp;Linux, Apache, PHP, MySQL, JavaScript, HTML, CSS</li>
                    <li>&bull;&nbsp;Version Control - GIT, GitHub, Packagist, Composer</li>
                    <li>&bull;&nbsp;Integrated Development Environments - VS Code, Visual Studio, Salesforce Development Console</li>
                    <li>&bull;&nbsp;Online Payment Integration - Authorize.net, Cybersource</li>
                    <li>&bull;&nbsp;Asp.Net Core with C#</li>
                    <li>&bull;&nbsp;REST/SOAP API Integration and Development</li>
                    <li>&bull;&nbsp;Amazon Web Services - ec2 Setup and Deployment</li>
                    <li>&bull;&nbsp;Development in a WAMP Environment</li>
                </ul>
            </div>

            <div class="container bg-white mt-2 p-2">
                <h2 class="text-center">Projects...The Quick List</h2>
                <p class="text-center">See <Link :href="route('projects')">my projects</Link> for screenshots and details.)</p>

                <h5>Oregon Criminal Defense Lawyers Association (OCDLA)</h5>
                <ul>
                    <li>&bull;&nbsp;<a href="https://ocdla.org/" target="_blank">OCDLA - Home</a></li>
                    <li>&bull;&nbsp;<a href="https://lod.ocdla.org/" target="_blank">OCDLA - Library of Defense</a></li>
                    <li>&bull;&nbsp;<a href="https://ocdla.app/car/list" target="_blank">OCDLA - Appellate Case Reviews</a></li>
                    <li>&bull;&nbsp;<a href="https://ocdla.app/directory/members" target="_blank">OCDLA - Member/Expert Witness Directory</a></li>
                    <li>&bull;&nbsp;<a href="https://ocdla.app/jobs" target="_blank">OCDLA - Job Board</a></li>
                </ul>

                <h5>Freelance and Personal </h5>
                <ul>
                    <li>&bull;&nbsp;<a href="https://redcedarcourt.com/" target="_blank">Red Cedar Court HOA - Member Only Site</a></li>
                    <li>&bull;&nbsp;<a href="https://fullbloomfitness.com/" target="_blank">Full Bloom Fitness - Home</a></li>
                </ul>
            </div>

        </div>
        
    </AppLayout>

</template>
