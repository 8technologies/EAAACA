<template>
    <app-layout>
        <EntityShow :data="data"></EntityShow>
    </app-layout>
</template>
<script>
    import AppLayout from '@/Layouts/AppLayout'
    import SeoMixin from '@/Mixins/SEO'
    import EntityShow from './_FormShow'

    export default {
        mixins: [SeoMixin],
        props: [
            'data',
        ],
        components: {
            AppLayout,
            EntityShow
        },
        data() {
            return {
                pageTitle: this.data.name + ' - Video',
            }
        },
    }
</script>
