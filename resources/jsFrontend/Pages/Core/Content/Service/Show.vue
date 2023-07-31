<template>
    <EntityShow :data="data"></EntityShow>
</template>

<script>
    import EntityShow from './_FormShow'

    export default {
        props: [
            'data',
        ],
        components: {
            EntityShow,
        },
    }
</script>