import Vue from 'vue'

export default {
    computed: {
        _previewMode() {
            if (this.$page.props.user) {
                return "PreviewLive"
            }
            return "EntityShow"
        }
    },
}

