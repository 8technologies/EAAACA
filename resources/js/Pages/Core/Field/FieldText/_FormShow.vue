<template>
    <a v-if="attributeUrl"
        :href="attributeUrl" 
        :target="attributeUrlTarget" 
        :class="attributeUrlClass">
        <component :is="attributeElement" :class="attributeClass" v-html="data.body"></component>
    </a>
    <component v-else :is="attributeElement" :class="attributeClass" :style="_styles" v-html="data.body"></component>
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

            attributeUrl() {
                var url = this.getFieldKeyValue('attributes', 'url')
                if (url && (!url.includes('http') || !url.includes('https')) ) {
                    url = route('front') + url
                }
                return url
            },
            attributeUrlTarget() {
                return this.getFieldKeyValue('attributes', 'url_target')
            },
            attributeUrlClass() {
                if (this.attributeUrl && this.attributeUrlTarget != '_blank') {
                    return 'inertia-link'
                }
            },
            
            _styles() {
                return this.getFieldKeyValueObject('styles')
            }
        },

    }
</script>
