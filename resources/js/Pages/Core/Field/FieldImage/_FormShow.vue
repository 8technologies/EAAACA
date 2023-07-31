<template>
        <a v-if="attributeUrl"
            :href="attributeUrl" 
            :target="attributeUrlTarget" 
            :class="attributeUrlClass + ' d-block'">
                <b-img :src="data.image_url" :class="attributeClass" class="img-fluid" :style="_styles"></b-img>
        </a>
        <b-img v-else :src="data.image_url" :class="attributeClass" class="img-fluid" :style="_styles"></b-img>
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
