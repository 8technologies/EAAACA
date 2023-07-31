<template>
    <div class="">
        <div v-if="data.body" v-html="data.body"></div>
        <component v-if="data.block_data" :is="blockComponent" :data="data.block_data"></component>
        <component v-else-if="data.component_name" :is="blockComponent"></component>
    </div>
</template>

<script>
    import FunctionsMixin from '@/Mixins/Functions'

    import List from '@frontend/Pages/Core/_LayoutStyle/_List'
    import Grid from '@frontend/Pages/Core/_LayoutStyle/_Grid'
    import Slider from '@frontend/Pages/Core/_LayoutStyle/_Slider'
    import Carousel from '@frontend/Pages/Core/_LayoutStyle/_Carousel'

    import FrontSlider from '@frontend/Pages/Core/Block/CustomBlocks/FrontSlider'
    import ContactForm from '@frontend/Pages/Core/Block/CustomBlocks/ContactForm'
    import FrontServices from '@frontend/Pages/Core/Block/CustomBlocks/FrontServices'

    export default {
        mixins: [FunctionsMixin],
        props: [
            'data',
        ],
        data() {
            return {
                blockComponent: this.getBlockComponent(),
            }
        },
        components: {
            List,
            Grid,
            Slider,
            Carousel,

            FrontSlider,
            ContactForm,
            FrontServices,
        },
        methods: {
            getBlockComponent() {
                if (this.data.component_name) {
                    return this.data.component_name
                }

                return 'List'
            },
        },
    }
</script>
