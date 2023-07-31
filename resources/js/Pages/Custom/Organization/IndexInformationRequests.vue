<template>
    <app-layout :data="data">
        <TableList 
            :createUrl="route('dashboard.information-requests.create', {organization_id: data.id})"
            :baseUrl="route('dashboard.organizations.information-requests', {id: data.id})"
            :url="route('dashboard.organizations.information-requests', {id: data.id})">
        </TableList>
    </app-layout>
</template>

<script>
    import AppLayout from './Layout'
    import SeoMixin from '@/Mixins/SEO'
    import TableList from '@/Pages/Custom/InformationRequest/_TableList'

    export default {
        mixins: [SeoMixin],
        props: [
            'data',
        ],
        components: {
            AppLayout,
            TableList,
        },
        data() {
            return {
                pageTitle: this.data.name + ' - Information Requests',
            }
        },
    }
</script>