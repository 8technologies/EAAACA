<template>
    <layout :data="data">
        <div>
            <form-edit :data="data"/>
        </div>
    </layout>
</template>

<script>
    import Layout from './Layout'
    import EntityComponentsMixin from '@/Mixins/EntityComponents'
    import SeoMixin from '@/Mixins/SEO'
    import FormEdit from './_FormEdit'

    export default {
        props: ['data'],
        mixins: [EntityComponentsMixin, SeoMixin],
        components: {
            Layout,
            FormEdit,
        },

        data() {
            return {
                pageTitle: this.data.name + ' - Email/Edit',
            }
        },
    }
</script>
