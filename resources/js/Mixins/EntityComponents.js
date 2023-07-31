import Vue from 'vue'

import MessagesMixin from '@/Mixins/Messages'
import DBOperationsMixin from '@/Mixins/DBOperations'
import FunctionsMixin from '@/Mixins/Functions'

import EntityModal from '@/Components/EntityModal'
import EntityModalDelete from '@/Components/EntityModalDelete'

export default {
    mixins: [
        MessagesMixin,
        DBOperationsMixin,
        FunctionsMixin,
    ],
    components: {
        EntityModal,
        EntityModalDelete,
    },

    data() {
        return {
            modalComponent: '',
            modalComponentParams: {},

            deleteComponent: '',
            deleteComponentParams: {},

            errors: [],
            success: false,

            modalTitle: '#',
            modalAttributes: {
                'uuid': 'uuid-' + this._uid,
                'title': '#',
                'size': 'md',
                'header-bg-variant': 'dark'
            },
        }
    },
    watch: { 
        data: function(newVal, oldVal) {
            this.localData = newVal
        },
    },

    methods: {
        // modal Components
        clearComponent: function() {
            this.modalComponent = ''
            this.modalComponentParams = {}

            this.deleteComponent = ''
            this.deleteComponentParams = {}
        },
        showComponent: function(ComponentName) {
            this.clearComponent()
            this.modalComponent = ComponentName
            this.modalComponentParams = {
                    'data': this.data,
                }
                // console.log(this.data)
            this.modalAttributes.title = this.addModalTitle ? this.addModalTitle : '#Add New';
            this.$bvModal.show("entity-modal")
        },
        showAdd: function() {
            this.clearComponent()
            this.modalComponent = 'EntityCreate'
            this.modalComponentParams = ''
            this.modalAttributes.title = this.addModalTitle ? this.addModalTitle : '#Add New';
            // this.$bvModal.show("entity-modal")
            this.$bvModal.show(this.modalAttributes.uuid + '-modal')
        },
        showAddCustomEntity: function(data) {
            // Use axios to edit in Modal, otherwise inertia will Redirect to a full page
            this.clearComponent()
            // this.$bvModal.show("entity-modal")
            this.$bvModal.show(this.modalAttributes.uuid + '-modal')
            this.modalAttributes.title = data.modalTitle
                // console.log(data.url)
            axios.get(data.url)
                .then(response => {
                    // console.log(response)
                    this.modalComponent = data.component
                    this.modalComponentParams = response
                })
                .catch(error => {
                    // this.$bvModal.hide("entity-modal")
                    this.$bvModal.hide(this.modalAttributes.uuid + '-modal')
                    // Handle validation errors
                    // console.log(response)
                    this.errors = error;
                    this.success = false;
                    this.showErrorMessages(this.errors)
                });
        },
        showAddEntityAsync: function(data) {
            // Use axios to edit in Modal, otherwise inertia will Redirect to a full page
            this.clearComponent()
            // this.$bvModal.show("entity-modal")
            this.$bvModal.show(this.modalAttributes.uuid + '-modal')
            this.modalAttributes.title = this.addModalTitle ? this.addModalTitle : '#Add New'
                // console.log(data.url)
            axios.get(data.url)
                .then(response => {
                    // console.log(response)
                    this.modalComponent = 'EntityCreate'
                    this.modalComponentParams = response
                })
                .catch(error => {
                    // this.$bvModal.hide("entity-modal")
                    this.$bvModal.hide(this.modalAttributes.uuid + '-modal')
                    // Handle validation errors
                    // console.log(response)
                    this.errors = error;
                    this.success = false;
                    this.showErrorMessages(this.errors)
                });
        },

        // create a new item
        showAddSilently: function (event) {
            event.preventDefault()

            var URL = event.currentTarget.href
            var originalClass = event.currentTarget.firstChild.className
            event.currentTarget.firstChild.className = this.spinnerClasses

            if (this.returnJson__) {
                axios.post(URL, [])
                    .then(response => {
                        // Handle success event
                        // this.showSuccessMessage('Update Successful')
                        this.updateLocalData(response.data)
                        event.target.firstChild.className = originalClass
                        this.isProcessing = false
                    })
                    .catch(errors => {
                        // Handle validation errors
                        this.errors = errors;
                        this.success = false;
                        this.showErrorMessages(this.errors)
                        event.target.firstChild.className = originalClass
                        this.isProcessing = false
                    })
            } else {
                this.$inertia.post(URL, [], {
                    onProgress: (progress) => {
                        // Handle progress event
                    },
                    onSuccess: (page) => {
                        // Handle success event
                        this.showSuccessMessage(page.props.flash.success)
                    },
                    onError: (errors) => {
                        // Handle validation errors
                        this.errors = errors;
                        this.success = false;
                        this.showErrorMessages(this.errors)
                    },
                    onFinish: () => {
                        // console.log(event.target.firstChild.className)
                        event.target.firstChild.className = originalClass
                    }
                })
            }
        },

        // Update item / tems
        showUpdateSilently: function (data, url) {
            // var URL = data.url
            if (this.returnJson) {
                axios.post(url, data)
                    .then(response => {
                        // Handle success event
                        // this.showSuccessMessage('Update Successful')
                        this.updateLocalData(response.data)
                        this.isProcessing = false
                    })
                    .catch(errors => {
                        // Handle validation errors
                        this.errors = errors;
                        this.success = false;
                        this.showErrorMessages(this.errors)
                        this.isProcessing = false
                    })
            } else {
                this.$inertia.post(url, data, {
                    onProgress: (progress) => {
                        // Handle progress event
                    },
                    onSuccess: (page) => {
                        // Handle success event
                        this.showSuccessMessage(page.props.flash.success)
                    },
                    onError: (errors) => {
                        // Handle validation errors
                        this.errors = errors;
                        this.success = false;
                        this.showErrorMessages(this.errors)
                    },
                    onFinish: () => {
                        // console.log(event.target.firstChild.className)
                        // event.target.firstChild.className = originalClass
                    }
                })
            }
        },




        showView: function(data) {
            // Use axios to edit in Modal, otherwise inertia will Redirect to a full page
            this.clearComponent()
            // this.$bvModal.show("entity-modal")
            this.$bvModal.show(this.modalAttributes.uuid + '-modal')
            this.modalAttributes.title = '#'

            axios.get(data.url)
                .then(response => {
                    // console.log(response)
                    this.modalComponent = 'EntityShow'
                    this.modalComponentParams = response
                        // console.log( response )
                    this.modalAttributes.title = '#' + response.data.name;
                })
                .catch(error => {
                    // this.$bvModal.hide("entity-modal")
                    this.$bvModal.hide(this.modalAttributes.uuid + '-modal')
                    // console.log(this)
                    // Handle validation errors
                    this.errors = error;
                    this.success = false;
                    this.showErrorMessages(this.errors)
                });
        },

        showEntity: function(event) {
            event.preventDefault()
            var data = {
                'url': event.currentTarget.href,
            }
            // Use axios to edit in Modal, otherwise inertia will Redirect to a full page
            this.clearComponent()
            // this.$bvModal.show("entity-modal")
            this.$bvModal.show(this.modalAttributes.uuid + '-modal')
            this.modalAttributes.title = '#'

            axios.get(data.url)
                .then(response => {
                    // console.log(response)
                    this.modalComponent = 'EntityShow'
                    this.modalComponentParams = response
                        // console.log( response )
                    this.modalAttributes.title = '#' + response.data.name;
                })
                .catch(error => {
                    // this.$bvModal.hide("entity-modal")
                    this.$bvModal.hide(this.modalAttributes.uuid + '-modal')
                    // console.log(this)
                    // Handle validation errors
                    this.errors = error;
                    this.success = false;
                    this.showErrorMessages(this.errors)
                });
        },
        showEntityEdit: function(event) {
            event.preventDefault()
            var data = {
                'url': event.currentTarget.href,
            }
            this.showEdit(data)
        },
        showEdit: function(data) {
            // Use axios to edit in Modal, otherwise inertia will Redirect to a full page
            this.clearComponent()
            // this.$bvModal.show("entity-modal")
            this.$bvModal.show(this.modalAttributes.uuid + '-modal')
            this.modalAttributes.title = '#Edit - '

            axios.get(data.url)
                .then(response => {
                    // console.log(response)
                    this.modalComponent = 'EntityEdit'
                    this.modalComponentParams = response
                        // console.log( response )
                    this.modalAttributes.title = '#Edit - ' + response.data.name;
                })
                .catch(error => {
                    // this.$bvModal.hide("entity-modal")
                    this.$bvModal.hide(this.modalAttributes.uuid + '-modal')
                    // console.log(this)
                    // Handle validation errors
                    this.errors = error;
                    this.success = false;
                    this.showErrorMessages(this.errors)
                });
        },
        showEntityDelete: function(event) {
            event.preventDefault()
            var data = {
                'url': event.currentTarget.href,
            }
            this.showDelete(data)
        },
        showDelete: function(data) {
            // Use axios to edit in Modal, otherwise inertia will not
            this.clearComponent()
            this.$bvModal.show(this.modalAttributes.uuid + '-modal-delete')
            // this.$bvModal.show("entity-modal-delete")
            this.modalAttributes.title = '#Delete - ';

            axios.get(data.url)
                .then(response => {
                    this.deleteComponent = 'EntityDelete'
                    this.deleteComponentParams = response
                        // console.log( response )
                    this.modalAttributes.title = '#Delete - ' + response.data.name;
                })
                .catch(error => {
                    // this.$bvModal.hide("entity-modal-delete")
                    this.$bvModal.hide(this.modalAttributes.uuid + '-modal-delete')
                    // Handle validation errors
                    this.errors = error;
                    this.success = false;
                    this.showErrorMessages(this.errors)
                });
        },

    }
}