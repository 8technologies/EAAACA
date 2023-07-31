<template>
    <div class="">
        <video v-if="data.provider_id == 1" :id="'video' + _uid" :poster="data.image_url" autoplay="false" controls width="100%">
            <source :src="route('stream', data.video_id)" type="video/mp4">
        </video>

        <iframe v-if="data.provider_id == 2" frameborder="0" type="text/html" width="100%" height="420"
            :src="'http://www.youtube.com/embed/' + videoId + '?enablejsapi=1'">
        </iframe>

        <iframe v-if="data.provider_id == 3" width="100%" height="420" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen
            :src="'https://player.vimeo.com/video' + videoId">
        </iframe>
    </div>
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
                videoId: this.getVideoId()
            }
        },
        methods: {
            getVideoId() {
                var url = new URL(this.data.provider_url)

                if (this.data.provider_id == 2) {
                    return url.searchParams.get("v")
                }
                if (this.data.provider_id == 3) {
                    return url.pathname
                }
            },
        },
    }
</script>
