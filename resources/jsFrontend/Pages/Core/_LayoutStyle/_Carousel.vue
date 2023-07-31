<template>
    <VueSlickCarousel v-bind="settings">
        <div v-for="(item, index) in data.data" v-bind:key="'item' + item.id">
            <div class="">
                <h5 class="mb-2">{{ item.name }}</h5>
                <div class="mb-2">{{ item.company_name }}</div>
                <p class="font-size-x">{{ truncateText(item.testimony, 150, '...') }}</p>
            </div>
        </div>
    </VueSlickCarousel>
</template>
<script>
    import FunctionsMixin from '@/Mixins/Functions'

    export default {
        mixins: [FunctionsMixin],
        props: ['data'],
        data() {
            return {
                settings: {
                    "dots": true,
                    "infinite": true,
                    "dotsClass": "slick-dots custom-dot-class",
                    "edgeFriction": 0.35,
                    "speed": 500,
                    "slidesToShow": 1,
                    "slidesToScroll": 1
                },
            }
        },
        components: {
        },
    }
</script>
