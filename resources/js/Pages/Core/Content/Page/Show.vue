<template>
    <component :is="_previewMode" :data="data"></component>
</template>

<script>
    import EntityShow from './_FormShow'
    import PreviewLive from './_PreviewLive'

    export default {
        props: [
            'data',
        ],

        data() {
            return {
                localData: this.data,
            }
        },

        components: {
            EntityShow,
            PreviewLive,
        },

        computed: {
            _previewMode() {
                if (this.$page.props.user) {
                    return "PreviewLive"
                }
                return "EntityShow"
            }
        },
    }
</script>