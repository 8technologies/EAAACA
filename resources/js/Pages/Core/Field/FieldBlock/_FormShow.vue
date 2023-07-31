<template>
    <div :class="attributeClass" :style="_styles">
        <entityBlock :key="data.block.uuid" :data="data.block">
        </entityBlock>
    </div>
</template>

<script>
    import FrontEndMixin from '@frontend/Mixins/FrontEnd'
    import entityBlock from '@frontend/Pages/Core/Block/Block/_FormShow'

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
            entityBlock,
        },
        methods: {

        },
        computed: {
            attributeClass() {
                return this.getFieldKeyValue('attributes', 'class')
            },
            _styles() {
                return this.getFieldKeyValueObject('styles')
            }
        },
        // created() {
        //     if (this.data) {
        //         console.log( this.data.dynamic_data )
        //     }
        // }
    }
</script>
