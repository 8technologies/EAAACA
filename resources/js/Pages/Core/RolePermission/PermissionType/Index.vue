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
                <inertia-link :href="route('dashboard.roles-permissions')">
                    Roles & Permissions
                </inertia-link>
            </li>
        </template>

        <h3 class="">
            Permission Types 
        </h3>

        <TableList></TableList>

    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import SeoMixin from '@/Mixins/SEO'
    import TableList from './_TableList'

    export default {
        mixins: [SeoMixin],
        components: {
            AppLayout,
            TableList,
        },
        data() {
            return {
                pageTitle: 'Permission Types',
            }
        },
    }

</script>

