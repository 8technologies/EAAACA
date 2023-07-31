import Vue from 'vue'

export default {
    data() {
        return {
            errors: [],
            success: false,
            spinnerClasses: 'spinner-border spinner-border-sm',
            toastArray: {
                'title': 'Message',
                'message': 'This is a sample message',
                'variant': 'success'
            },
        }
    },

    methods: {

        showToast() {
            var title = this.toastArray.title
            var variant = this.toastArray.variant
            var message = this.toastArray.message
            var formattedMessage = null

            // Use a shorter name for this.$createElement
            const h = this.$createElement
            // Increment the toast count
            this.count++

            if (typeof message === 'object') {
                formattedMessage = Object.keys(message).map(function(key, item) {
                    return h('div', {
                        class: 'mr-2'
                    }, [
                        h('strong', { class: 'mr-2 text-capitalize' }, key + ':'),
                        h('span', { class: '' }, message[key])
                    ])
                })
            } else {
                formattedMessage = JSON.parse(message)
            }
            
            // Create the message
            const vNodesMsg = h(
                'p', 
                { class: ['text-left', 'mb-0']},
                formattedMessage
            )

            // const vNodesMsg = h('p', {
            //     class: ['text-left', 'mb-0']
            // }, [message])

            // Create the title
            title = h('div', {
                class: ['d-flex', 'flex-grow-1', 'align-items-baseline', 'mr-2']
            }, [
                h('strong', {
                    class: 'mr-2'
                }, title),
                // h('small', {
                //     class: 'ml-auto text-italics'
                // }, '5 minutes ago')
            ])
            // Pass the VNodes as an array for message and title
            this.$root.$bvToast.toast([vNodesMsg], {
                title: [title],
                variant: variant,
                solid: true,
                toaster: 'b-toaster-bottom-right',
            })
        },

        // Display success messages from the server
        showSuccessMessage: function(message) {
            this.toastArray.title = 'Success'
            this.toastArray.message = JSON.stringify(message)
            this.toastArray.variant = 'success'
            this.showToast()
        },

        // Display success messages from the server
        showErrorMessages: function(errors) {
            if (typeof errors.response !== 'undefined') {
                this.toastArray.title = 'Error ' + errors.response.status + ' - ' + errors.response.statusText
                this.toastArray.message = errors.response.data.message
                this.toastArray.variant = 'danger'
            } else {
                // console.log(errors)
                this.toastArray.title = 'Error'
                this.toastArray.message = errors
                this.toastArray.variant = 'danger'
            }

            this.showToast()
        },

    }
}

