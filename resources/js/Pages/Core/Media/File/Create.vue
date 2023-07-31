<template>
    <app-layout>
        <template #header>
        </template>

        <template #breadcrumb>
            <li class="breadcrumb-item">
                <inertia-link :href="route('dashboard')">
                    Dashboard
                </inertia-link>
            </li>
            <li class="breadcrumb-item">
                <inertia-link :href="route('dashboard.media')">
                    Media
                </inertia-link>
            </li>
            <li class="breadcrumb-item">
                <inertia-link :href="route('dashboard.media.files.index')">
                    Files
                </inertia-link>
            </li>
        </template>

        <h3 class="">
            Files
        </h3>

        <div>
            <form-create :data="data"/>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import SeoMixin from '@/Mixins/SEO'
    import FormCreate from './_FormCreate'

    export default {
        props: ['data'],
        mixins: [SeoMixin],
        components: {
            AppLayout,
            FormCreate,
        },

        data() {
            return {
                pageTitle: 'Add a File',
            }
        },
    }
</script>
