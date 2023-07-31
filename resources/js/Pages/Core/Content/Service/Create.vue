<template>
    <app-layout>
        <template #header>
            Create a Page
        </template>

        <template #breadcrumb>
            <li class="breadcrumb-item">
                <inertia-link :href="route('dashboard')" class="" :active="route().current('dashboard')">
                    Dashboard
                </inertia-link>
            </li>
            <li class="breadcrumb-item">
                <inertia-link :href="route('dashboard.content')" class="">
                    Content
                </inertia-link>
            </li>
            <li class="breadcrumb-item">
                <inertia-link :href="route('dashboard.services.index')" class="">
                    Services
                </inertia-link>
            </li>
            <li class="breadcrumb-item active"></li>
        </template>

        <div>
            <form-create :data="data"/>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import FormCreate from './_FormCreate'

    export default {
        props: ['data'],
        components: {
            AppLayout,
            FormCreate,
        },
    }
</script>
