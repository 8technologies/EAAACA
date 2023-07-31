<template>
    <app-layout>
        <template #header>
        </template>

        <template #breadcrumb>
            <li class="breadcrumb-item">
                <inertia-link :href="route('dashboard')" class="" :active="route().current('dashboard')">
                    Dashboard
                </inertia-link>
            </li>
            <li class="breadcrumb-item">
                <inertia-link :href="route('dashboard.emails.index')" class="">
                    Emails
                </inertia-link>
            </li>
            <li class="breadcrumb-item active"></li>
        </template>

        <div class="row">
            <div class="col-md-12">
                <h3 class="">
                    Add an Email
                </h3>
            </div>
        </div>

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
                pageTitle: 'Add an Email',
            }
        },
    }
</script>
