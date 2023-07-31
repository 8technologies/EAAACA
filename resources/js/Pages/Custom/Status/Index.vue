<template>
    <app-layout>

        <template #header>
            Statuses
        </template>

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
                pageTitle: 'Statuses',
            }
        },
    }

</script>

