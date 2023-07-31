<template>
    <app-layout :data="data">
        <TableList 
            :baseUrl="route('dashboard.users.index', {organization_id: data.id})"
            :url="route('dashboard.users.index')"
            >
        </TableList>
    </app-layout>
</template>

<script>
    import AppLayout from './Layout'
    import SeoMixin from '@/Mixins/SEO'
    import TableList from '@/Pages/Core/User/_TableListContactPoint'

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
                pageTitle: this.data.name + ' - Contact Points',
            }
        },
    }
</script>