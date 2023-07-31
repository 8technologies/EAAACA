<template>
    <div class="">
        <b-media left-align vertical-align="center" 
            class="py-4 border-bottom"
            v-for="item in data.data"
            v-bind:key="item.uuid">
            <template v-if="item.media_image && item.media_image.original" #aside>
                <inertia-link :href="item.entity_links.url">
                    <ImagePreview :data="item" :options="{thumbnail: true, preset: 'thumbnail'}"></ImagePreview>
                </inertia-link>
            </template>
            <h5 class="mt-0 mb-1">
                <inertia-link :href="item.entity_links.url">{{ item.name }}</inertia-link>
            </h5>
            <span class="py-1 font-weight-500 d-block">
                {{ formatDate(item.created_at) }}
            </span>
            <p class="mb-0">
                {{ truncateText(item.body) }}
            </p>
        </b-media>
    </div>
</template>

<script>
    import FunctionsMixin from '@/Mixins/Functions'

    export default {
        props: ['data'],
        mixins: [FunctionsMixin],
        data() {
            return {

            }
        },
    }

</script>
