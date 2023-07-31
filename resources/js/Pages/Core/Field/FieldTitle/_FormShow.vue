<template>
    <component :is="attributeElement" :class="attributeClass" :style="_styles">
        <template v-if="attributeUrl">
            <a 
                :href="attributeUrl" 
                :target="attributeUrlTarget" 
                :class="attributeUrlClass">
                {{ data.title }}
            </a>
        </template>
        <template v-else>
            {{ data.title }}
        </template>
    </component>
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
            attributeElement() {
                var value = this.getFieldKeyValue('attributes', 'element')
                return value ? value : 'h3'
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
