<template>
    <app-layout :data="data">
        <template #header>
            Edit "{{ data.name }}"
        </template>

        <div>
            <form-edit :data="data"/>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from './Layout'
    import SeoMixin from '@/Mixins/SEO'
    import FormEdit from './_FormEdit'

    export default {
        mixins: [SeoMixin],
        props: ['data'],
        components: {
            AppLayout,
            FormEdit,
        },
        data() {
            return {
                pageTitle: this.data.name + ' - Video/Edit',
            }
        },
    }
</script>
