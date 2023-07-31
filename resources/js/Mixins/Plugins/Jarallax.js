import Vue from 'vue'

export default {
    data() {
        return {
            dataJarallaxVideoAttribute: {
                'data-jarallax-video': this.getJarallaxVideoAttribute()
            },
        }
    },
    methods: {
        getJarallaxVideoAttribute: function() {
            if (this.data.media_videos && this.data.media_videos[0]) {
                return 'mp4:' + route('stream', this.data.media_videos[0]['video_id'])
            } else {
                return null
            }
        },

    }
}

