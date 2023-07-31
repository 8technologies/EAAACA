import Vue from 'vue'

export default {

    computed: {
        dragOptions() {
            return {
                animation: 200,
                // group: "description",
                disabled: false,
                ghostClass: "ghost"
            }
        },
    },

    methods: {
        // updateSortPositions: function(url) {
        //     this.isProcessing = true

        //     this.localData.layout_rows.map((item, index) => {
        //         item.position = index + 1
        //     })
        //     var data = _.map(this.localData.layout_rows, function(item) {
        //         return _.pick(item, ['id', 'position'])
        //     })
        //     this.showUpdateSilently(data, url)
        // },
    }
}

