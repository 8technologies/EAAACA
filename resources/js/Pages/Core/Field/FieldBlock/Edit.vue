<template>
    <app-layout>
        <template #header>
            Edit "{{ data.name }}"
        </template>

        <div>
            <form-edit :data="data"/>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import FormEdit from './_FormEdit'

    export default {
        props: ['data'],
        components: {
            AppLayout,
            FormEdit,
        },
    }
</script>
