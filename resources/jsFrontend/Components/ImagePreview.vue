<template>
    <b-img v-if="getImageUrl()" 
        :src="getImageUrl()" 
        fluid 
        :class="imageClasses ? imageClasses : ''"
        alt="">
    </b-img>
</template>

<script>
    export default {
        props: {
            data: {},
            options: {
                default: null,
            }
        },
        data() {
            return {
                imgUrl: this.getImageUrl(),
                thumbnail: this.getImageThumbnailUrl(),
                imageClasses: this.getImageClasses()
            }
        },
        methods: {
            getImageUrl() {
                if (this.options && this.options.url) {
                    return this.options.url
                }

                if (this.options && this.options.thumbnail == true) {
                    return this.thumbnail
                }

                if (this.options && this.options.preset && this.data.media_image[this.options.preset]) {
                    return this.data.media_image[this.options.preset]
                }

                if (this.data.media_image && this.data.media_image.original) {
                    return this.data.media_image.original
                }

                return null
            },
            getImageThumbnailUrl() {
                if (!this.data.media_image || !this.data.media_image.original) {
                    return null
                }
                
                if (this.options && this.options.thumbnail == true && this.options.preset) {
                    if (this.data.media_image[this.options.preset]) {
                        return this.data.media_image[this.options.preset]
                    }
                    return this.data.media_image.original
                }
                return this.data.media_image.original
            },
            getImageClasses() {
                if (this.options && this.options.classes) {
                    return this.options.classes
                }

                return null
            },
        },
    }
</script>
