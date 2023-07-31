<template>
    <div class="slider-main-slider-wrapper">
        <VueSlickCarousel v-bind="settings">
            <div v-for="(item, index) in data.data" v-bind:key="_uid + 'item' + item.id">
                <div class="slider-main-slider vertical-height-75" :style="'background-image: url(\'' + item.media_image['slider'] + '\')'">

                    <div class="slider-overlay h-100">
                        <div class="container h-100">
                        <div class="row h-100 align-items-center">
                            <div class="col-md-8 col-lg-6">
                                <div class="slider-content" v-html="item.body">
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>

                </div>
            </div>
        </VueSlickCarousel>
    </div>
</template>
<script>
    import FunctionsMixin from '@/Mixins/Functions'

    export default {
        mixins: [FunctionsMixin],
        props: ['data'],
        data() {
            return {
                settings: {
                    "dots": false,
                    "infinite": true,
                    "dotsClass": "slick-dots custom-dot-class",
                    "edgeFriction": 0.35,
                    "speed": 800,
                    "slidesToShow": 1,
                    "slidesToScroll": 1,
                    "autoplay": true,
                    "autoplaySpeed": 8000,
                    
                    "pauseOnHover": false,
                    "draggable": false,
                    // "touchMove": false,
                    // "fade": true,
                },
            }
        },
        components: {
        },
    }
</script>
