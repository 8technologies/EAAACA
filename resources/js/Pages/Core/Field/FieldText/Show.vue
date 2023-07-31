<template>
    <app-layout :data="data">
        <EntityShow :data="data"></EntityShow>
    </app-layout>
</template>

<script>
    import AppLayout from './Layout'
    import SeoMixin from '@/Mixins/SEO'
    import EntityShow from './_FormShow'

    export default {
        mixins: [SeoMixin],
        props: [
            'data',
        ],
        components: {
            AppLayout,
            EntityShow,
        },
        data() {
            return {
                pageTitle: this.data.name + ' - FieldText',
            }
        },
    }
</script>