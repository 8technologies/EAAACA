<template>
    <app-layout :data="data">
        <template #header>
            Add a Video
        </template>

        <div>
            <form-create :data="data"/>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from './Layout'
    import SeoMixin from '@/Mixins/SEO'
    import FormCreate from './_FormCreate'

    export default {
        mixins: [SeoMixin],
        props: ['data'],
        components: {
            AppLayout,
            FormCreate,
        },
        data() {
            return {
                pageTitle: 'Add a Video',
            }
        },
    }
</script>
