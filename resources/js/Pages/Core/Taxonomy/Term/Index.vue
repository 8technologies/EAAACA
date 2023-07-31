<template>
    <app-layout>

        <template #header>
            Taxonomy terms 
        </template>

        <template #breadcrumb>
            <li class="breadcrumb-item">
                <inertia-link :href="route('dashboard')" class="" :active="route().current('dashboard')">
                    Dashboard
                </inertia-link>
            </li>
            <li class="breadcrumb-item">
                <inertia-link :href="route('dashboard.taxonomy')" class="">
                    Taxonomy
                </inertia-link>
            </li>
            <li class="breadcrumb-item active"></li>
        </template>

        <TableList></TableList>

    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import SeoMixin from '@/Mixins/SEO'
    import TableList from './_TableList'

    export default {
        props: ['data'],
        mixins: [SeoMixin],
        components: {
            AppLayout,
            TableList,
        },
        
        data() {
            return {
                pageTitle: 'Taxonomy terms',
            }
        },
    }

</script>

