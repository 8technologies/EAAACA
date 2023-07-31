<template>
    <div class="row gutter-sm">
        <div class="col-lg-4 mb-3"
            v-for="item in results.data"
            v-bind:key="'news-' + item.id">
            <inertia-link :class="'rounded h-100 d-block border grid-card-shadow'" :href="item.entity_links.url">
                <b-img v-if="item.media_image && item.media_image.thumbnail" 
                    :src="item.media_image['thumbnail-landscape']" 
                    fluid 
                    class="rounded-top"
                    alt="placeholder">
                </b-img>
                <div class="p-4">
                    <h4 class="card-title mt-0 mb-1">
                        {{ item.title }}
                    </h4>
                    <p v-if="!item.media_image.thumbnail" class="pt-2 mb-0">
                        {{ truncateText(item.body) }}
                    </p>
                    <span class="pt-3 font-weight-500 d-block">
                        {{ formatDate(item.created_at) }}
                    </span>
                </div>
            </inertia-link>
        </div>

        <div class="col-lg-12 pt-3">
            <Pagination :data="results"></Pagination>
        </div>
    </div>
</template>

<script>
    import FrontEndMixin from '@frontend/Mixins/FrontEnd'

    export default {
        props: ['data'],
        mixins: [FrontEndMixin],
        data() {
            return {
                results: this.data,
            }
        },
        // created() {
        //     console.log( this.results.data )
        // }
    }

</script>

