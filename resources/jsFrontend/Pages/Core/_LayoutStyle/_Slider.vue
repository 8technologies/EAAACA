<template>
    <div class="bd-example">
        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li v-for="(item, index) in data.data" v-bind:key="'item' + item.id" data-target="#carouselExampleCaptions" :data-slide-to="index" :class="index == 0 ? 'active' : ''"></li>
            </ol>
            <div class="carousel-inner">
                <div v-for="(item, index) in data.data" v-bind:key="'item' + item.id" :class="index == 0 ? 'carousel-item active vertical-height-75' : 'carousel-item vertical-height-75'">
                    <img :src="item.media_image['slider']" class="d-block w-100" alt="">
                    <div class="front-slider-caption h-100">
                        <div class="container h-100">
                        <div class="row h-100 align-items-center">
                            <div class="col-md-6">
                                <div class="">
                                    <h2 class="display-4 mb-4">{{ item.name }}</h2>
                                    <p class="font-size-x">{{ truncateText(item.body, 150, '...') }}</p>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="carousel-caption d-none d-md-block">
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</template>
<script>
    import FunctionsMixin from '@/Mixins/Functions'

    export default {
        mixins: [FunctionsMixin],
        props: ['data'],
        data() {
          return {

            }
        },
        components: {
        },
    }
</script>
