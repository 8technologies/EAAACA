<template>
    <FormShow :data="data"></FormShow>
</template>

<script>
    import FormShow from '@frontend/Pages/Core/Content/Page/_FormShow'

    export default {
        props: [
            'data',
        ],
        components: {
            FormShow,
        },
    }
</script>
