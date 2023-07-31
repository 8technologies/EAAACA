<template>
    <layout :data="data">

        <TableList :data="data"></TableList>

    </layout>
</template>

<script>
    import Layout from './Layout'
    import EntityComponentsMixin from '@/Mixins/EntityComponents'
    import SeoMixin from '@/Mixins/SEO'
    import TableList from '../Member/_TableList'

    export default {
        props: [
            'data',
        ],
        mixins: [EntityComponentsMixin, SeoMixin],
        components: {
            Layout,
            TableList,
        },
        data() {
            return {
                pageTitle: this.data.name + ' - Members',
            }
        }

    }
</script>
