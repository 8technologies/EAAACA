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
                <inertia-link :href="route('dashboard.teams-groups')">
                    Teams & Groups
                </inertia-link>
            </li>
            <li class="breadcrumb-item">
                <inertia-link :href="route('dashboard.teams.index')">
                    Teams
                </inertia-link>
            </li>
        </template>

        <h3 class="">
            Create a Team
        </h3>

        <div class="">
            <form-create />
        </div>

    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import SeoMixin from '@/Mixins/SEO'
    import FormCreate from './_FormCreate'

    export default {
        mixins: [SeoMixin],
        components: {
            AppLayout,
            FormCreate,
        },
        data() {
            return {
                pageTitle: 'Create a Team',
            }
        }
    }
</script>
