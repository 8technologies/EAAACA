<template>
    <div class="row">
        <div class="col-md-6 mb-5"
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
                        {{ truncateText(item.body, 120) }}
                    </p>
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

