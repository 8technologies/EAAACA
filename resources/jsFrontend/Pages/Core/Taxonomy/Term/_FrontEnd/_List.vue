<template>

    <div class="">

        <div class="">
        <b-media left-align vertical-align="center" class="py-3"
            v-for="item in localData.data"
            v-bind:key="'news-' + item.id">
            <template #aside>
                <inertia-link :href="item.entity_links.url">
                    <b-img :src="item.thumbnail" blank-color="#ccc" width="150" height="150" alt="placeholder"></b-img>
                </inertia-link>
            </template>
            <h5 class="mt-0 mb-1">
                <inertia-link :href="item.entity_links.url">{{ item.title }}</inertia-link>
            </h5>
            <p class="mb-0">
                {{ truncateText(item.body) }}
            </p>
        </b-media>
        </div>

    </div>

</template>

<script>
    import FrontEndMixin from '@frontend/Mixins/FrontEnd'


    export default {
        props: ['data'],
        mixins: [FrontEndMixin],
        components: {

        },

        data() {
            return {
                localData: this.data,
            }
        },

        // created() {
        //     console.log( this.data.data )
        // }

    }

</script>

