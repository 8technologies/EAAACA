<template>
    <app-layout>

        <template #header>
            Information restrictions
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
                pageTitle: 'Information restrictions',
            }
        },
    }

</script>

