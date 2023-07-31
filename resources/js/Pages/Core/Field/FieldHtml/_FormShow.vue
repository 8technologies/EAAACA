<template>
    <component :is="attributeElement" :class="attributeClass" v-html="data.body"></component>
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

        computed: {
            attributeElement: function () {
                return this.getAttributeElement()
            },
            attributeClass() {
                return this.getFieldKeyValue('attributes', 'class')
            },
            _styles() {
                return this.getFieldKeyValueObject('styles')
            }
        },

    }
</script>
