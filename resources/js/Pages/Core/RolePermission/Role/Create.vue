<template>
    <app-layout>
        <template #header>
            Add a Role
        </template>

        <div>
            <form-create :data="data"/>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import SeoMixin from '@/Mixins/SEO'
    import FormCreate from './_FormCreate'

    export default {
        props: ['data'],
        mixins: [SeoMixin],
        components: {
            AppLayout,
            FormCreate,
        },
        data() {
            return {
                pageTitle: 'Add a Role',
            }
        },
    }
</script>
