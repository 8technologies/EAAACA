<template>
    <div class="row gutter-sm">
        <div class="col-lg-4 mb-4"
            v-for="item in data.data"
            v-bind:key="item.uuid">
            <div class="">
                <ImagePreview :data="item" :options="{thumbnail: true, preset: 'thumbnail-landscape'}"></ImagePreview>
                <div class="">
                    <h4 class="card-title mt-0 mb-1">
                        <inertia-link class="" :href="item.entity_links.url">
                            {{ item.name }}
                        </inertia-link>
                    </h4>
                    <p class="pt-2 mb-0">
                        {{ truncateText(item.body) }}
                    </p>
                    <span class="pt-1 mt-3 font-weight-500 d-block border-top">
                        {{ formatDate(item.created_at) }}
                    </span>
                </div>
            </div>
        </div>
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

