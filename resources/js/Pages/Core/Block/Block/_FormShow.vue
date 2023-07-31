<template>
    <div class="">
        <div v-if="data.body" is="div" v-html="data.body"></div>
        <BlockContent :data="data"></BlockContent>
    </div>
</template>

<script>
    import FrontEndMixin from '@frontend/Mixins/FrontEnd'
    import BlockContent from '@/Pages/Core/Block/BlockContent'

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
            BlockContent,
        }
    }
</script>
