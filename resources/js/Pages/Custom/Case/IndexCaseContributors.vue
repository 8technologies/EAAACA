<template>
    <app-layout :data="data">
        <TableList 
            :createUrl="route('dashboard.case-contributors.create', {case_id: data.id})"
            :baseUrl="route('dashboard.cases.case-contributors', {id: data.id})"
            :url="route('dashboard.cases.case-contributors', {id: data.id})">
        </TableList>
    </app-layout>
</template>

<script>
    import AppLayout from './Layout'
    import SeoMixin from '@/Mixins/SEO'
    import TableList from '@/Pages/Custom/CaseContributor/_TableList'

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
                pageTitle: this.data.name + ' - Case Contributors',
            }
        },
    }
</script>