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
                <inertia-link :href="route('dashboard.system')">
                    System
                </inertia-link>
            </li>
            <li class="breadcrumb-item active"></li>
        </template>

        <h3 class="">
            User Activities
        </h3>

        <div class="">
            <TableList :data="data"></TableList>
        </div>

    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import SeoMixin from '@/Mixins/SEO'
    import TableList from './_TableList'

    export default {
        props: [
            'data',
        ],
        mixins: [SeoMixin],
        components: {
            AppLayout,
            TableList,
        },
        data() {
            return {
                pageTitle: 'User Activities',
            }
        },
    }

</script>

