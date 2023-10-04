<template>
    <app-layout>

        <template #header>
            Information Requests - Awaiting Feedback 
        </template>

        <template #breadcrumb>
            <li class="breadcrumb-item">
                <inertia-link :href="route('dashboard')" class="" :active="route().current('dashboard')">
                    Dashboard
                </inertia-link>
            </li>
            <li class="breadcrumb-item">
                <inertia-link :href="route('dashboard.information-requests.index')" class="">
                    Information Requests
                </inertia-link>
            </li>
            <li class="breadcrumb-item active"></li>
        </template>

        <IndexNav :data="data"></IndexNav>

        <TableList 
            :createUrl="route('dashboard.information-requests.create')"
            :baseUrl="route('dashboard.information-requests.index', {entity_status: 'AWAITING FEEDBACK'})"
            :url="route('dashboard.information-requests.index')">
        </TableList>

    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import SeoMixin from '@/Mixins/SEO'
    import TableList from './_TableList'

    import IndexNav from './_IndexNav'

    export default {
        props: ['data'],
        mixins: [SeoMixin],
        components: {
            AppLayout,
            TableList,
            IndexNav,
        },
        
        data() {
            return {
                pageTitle: 'Information Requests - Awaiting Feedback',
            }
        },
    }

</script>

