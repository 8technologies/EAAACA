<template>
    <app-layout :data="data">
        <template #header>
            Edit "{{ data.name }}"
        </template>

        <FormEdit :data="data"></FormEdit>
    </app-layout>
</template>

<script>
    import AppLayout from './Layout'
    import SeoMixin from '@/Mixins/SEO'
    import FormEdit from './_FormEdit'

    export default {
        props: ['data'],
        mixins: [SeoMixin],
        components: {
            AppLayout,
            FormEdit,
        },
        data() {
            return {
                pageTitle: this.data.name + ' - Provider/Edit',
            }
        },
    }
</script>