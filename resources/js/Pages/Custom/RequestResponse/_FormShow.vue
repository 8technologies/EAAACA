<template>
    <div class="">
        <PreviewSummary :data="data"></PreviewSummary>
    </div>
</template>

<script>
    import FrontEndMixin from '@frontend/Mixins/FrontEnd'
    import PreviewSummary from './_PreviewSummary.vue'

    export default {
        mixins: [FrontEndMixin],
        props: [
            'data',
        ],
        data() {
            return {

            }
        },
        components: {
            PreviewSummary,
        },
    }
</script>
