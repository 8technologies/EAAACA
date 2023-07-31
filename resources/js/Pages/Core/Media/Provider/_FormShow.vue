<template>
    <component is="div" v-html="data.body"></component>
</template>

<script>
    import FrontEndMixin from '@frontend/Mixins/FrontEnd'

    export default {
        mixins: [FrontEndMixin],
        props: [
            'data',
        ],

        data() {
            return {

            }
        },

        methods: {

        },

    }
</script>
