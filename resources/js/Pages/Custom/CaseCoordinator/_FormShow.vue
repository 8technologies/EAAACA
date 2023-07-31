<template>
    <div class="">
        <!-- <div v-if="data.description" is="div" v-html="data.description"></div> -->
    </div>
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
    }
</script>
