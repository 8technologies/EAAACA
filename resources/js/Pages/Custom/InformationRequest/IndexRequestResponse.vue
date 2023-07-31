<template>
    <app-layout :data="data">
        <TableList 
            :createUrl="route('dashboard.request-responses.create', {information_request_id: data.id})"
            :baseUrl="route('dashboard.information-requests.responses', {id: data.id})"
            :url="route('dashboard.information-requests.responses', {id: data.id})">
        </TableList>
    </app-layout>
</template>

<script>
    import AppLayout from './Layout'
    import SeoMixin from '@/Mixins/SEO'
    import TableList from '@/Pages/Custom/RequestResponse/_TableList'

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
                pageTitle: this.data.name + ' - Request Responses',
            }
        },
    }
</script>