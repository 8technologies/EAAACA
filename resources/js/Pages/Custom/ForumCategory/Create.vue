<template>
    <app-layout>
        <template #header>
            Add a Forum Category
        </template>

        <div>
            <FormCreate :data="data"></FormCreate>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import FormCreate from './_FormCreate'

    export default {
        props: ['data'],
        components: {
            AppLayout,
            FormCreate,
        },
    }
</script>
