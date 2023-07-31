<template>
    <layout :data="data">
        <div>
            <FormShow :data="data"></FormShow>
        </div>
    </layout>
</template>

<script>
    import Layout from './Layout'
    import EntityComponentsMixin from '@/Mixins/EntityComponents'
    import SeoMixin from '@/Mixins/SEO'
    import FormShow from './_FormShow'

    export default {
        props: ['data'],
        mixins: [EntityComponentsMixin, SeoMixin],
        components: {
            Layout,
            FormShow,
        },

        data() {
            return {
                pageTitle: this.data.name + ' - Internal Communication',
            }
        },
    }
</script>
