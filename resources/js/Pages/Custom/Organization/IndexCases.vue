<template>
    <app-layout :data="data">
        <TableList 
            :createUrl="route('dashboard.cases.create', {organization_id: data.id})"
            :baseUrl="route('dashboard.organizations.cases', {id: data.id})"
            :url="route('dashboard.organizations.cases', {id: data.id})">
        </TableList>
    </app-layout>
</template>

<script>
    import AppLayout from './Layout'
    import SeoMixin from '@/Mixins/SEO'
    import TableList from '@/Pages/Custom/Case/_TableList'

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
                pageTitle: this.data.name + ' - Cases',
            }
        },
    }
</script>