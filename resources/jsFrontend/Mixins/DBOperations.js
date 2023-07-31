import Vue from 'vue'

export default {
    data() {
        return {
            errors: [],
            success: false,
            spinnerClasses: 'spinner-border spinner-border-sm',
            modalAttributes: {
                'uuid': this.setUUID(),
                'uuid_this': this.setUUIDThis(),
                'title': '#',
                'size': 'md',
                'header-bg-variant': 'dark',
            },
            showSpinner: false,
        }
    },

    methods: {
        setUUID: function() {
            var vueInstance = this
            for (var i = 0; i < 10; i++) {
                vueInstance = vueInstance.$parent
                if (typeof(vueInstance.$parent) == "undefined") {
                    i = 10
                }
            }
            return 'uuid-' + vueInstance._uid
        },
        setUUIDThis: function() {
            var vueInstance = this
            // console.log( this )
            for (var i = 0; i < 10; i++) {
                // console.log( typeof(vueInstance) !== 'undefined' )
                if ( typeof(vueInstance) !== 'undefined' && Object.keys(vueInstance.$options.components).includes("EntityEdit") ) {
                    i = 10
                }

                if (i < 10 && typeof(vueInstance.$parent) !== 'undefined' ) {
                    vueInstance = vueInstance.$parent
                }
            }
            this.targetInstance = vueInstance
            // console.log('$options._renderChildren', vueInstance._uid)
            return 'uuid-' + vueInstance._uid
        },
        // Update form values
        updateFormValues: function(formValues) {
            this.form = formValues
        },
        // 
        closeEntityModal: function () {
            this.$bvModal.hide("bs-modal")
            this.$bvModal.hide("entity-modal")
            this.$bvModal.hide(this.modalAttributes.uuid + '-modal')
            this.$bvModal.hide(this.modalAttributes.uuid_this + '-modal')
        },

        // Inertia CRUD operations

        // create a new item
        create: function (event) {
            event.preventDefault()
            event.srcElement.submit.firstChild.className += this.spinnerClasses
            this.showSpinner = true

            var URL = event.target.action

            this.$inertia.post(URL, this.form, {
                onProgress: (progress) => {
                    // Handle progress event
                },
                onSuccess: (page) => {
                    // Handle success event
                    // this.closeEntityModal()
                    this.showSuccessMessage(page.props.flash.success)
                    this.clearFormValues()
                },
                onError: (errors) => {
                    // Handle validation errors
                    this.errors = errors;
                    this.success = false;
                    this.showErrorMessages(this.errors)
                },
                onFinish: () => {
                    event.srcElement.submit.firstChild.className = ''
                }
            })
        },
        // create a new item
        createWithAjax: function (event) {
            event.preventDefault()
            event.srcElement.submit.firstChild.className += this.spinnerClasses
            this.showSpinner = true

            var URL = event.target.action

            axios.post(URL, this.form)
                .then(response => {
                    // Handle success event
                    this.closeEntityModal()
                    this.showSuccessMessage('Added Successful')
                })
                .catch(errors => {
                    // Handle validation errors
                    this.errors = errors;
                    this.success = false;
                    this.showErrorMessages(this.errors)
                })
            // remove spinning icon
            // this.showSpinner = false
            event.srcElement.submit.firstChild.className = ''
        },

    }
}

$('#bs-modal').modal( {
    focus: false
});
