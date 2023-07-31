<template>
    <app-layout>
        <template #header>
            Add a Block Field
        </template>

        <div>
            <form-create :data="data"/>
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
