<template>
    <app-layout :data="data">
        <TableList 
            :createUrl="route('dashboard.case-coordinators.create', {case_id: data.id})"
            :baseUrl="route('dashboard.cases.case-coordinators', {id: data.id})"
            :url="route('dashboard.cases.case-coordinators', {id: data.id})">
        </TableList>
    </app-layout>
</template>

<script>
    import AppLayout from './Layout'
    import SeoMixin from '@/Mixins/SEO'
    import TableList from '@/Pages/Custom/CaseCoordinator/_TableList'

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
                pageTitle: this.data.name + ' - Case coordinators',
            }
        },
    }
</script>