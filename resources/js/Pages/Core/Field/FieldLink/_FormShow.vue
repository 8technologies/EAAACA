<template>
    <a v-if="data.link_text" :href="data.link" v-html="data.link_text" :class="attributeClass" :style="_styles">
        {{ data.link_text ? data.link_text : data.link }}
    </a>
    <a v-else :href="data.link" :class="attributeClass" :style="_styles">
        {{ data.link }}
    </a>
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
        computed: {
            attributeClass() {
                return this.getFieldKeyValue('attributes', 'class')
            },

            _styles() {
                return this.getFieldKeyValueObject('styles')
            }
        },

    }
</script>
