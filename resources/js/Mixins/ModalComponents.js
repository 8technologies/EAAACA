import Vue from 'vue'

import BsModal from '@/Components/BsModal'
import BsModalDelete from '@/Components/BsModalDelete'

import MessagesMixin from '@/Mixins/Messages'
import DBOperationsMixin from '@/Mixins/DBOperations'
import FunctionsMixin from '@/Mixins/Functions'

export default {
    mixins: [
        MessagesMixin,
        DBOperationsMixin,
        FunctionsMixin,
    ],
    components: {
        BsModal,
        BsModalDelete,
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
                'title': '#',
                'size': 'md',
                'header-bg-variant': 'dark'
            },

        }
    },

    mounted() {
        // Register jQuery events

        $('body .bootstrap-table').on('click', 'a.add-item', (e) => {
            e.preventDefault()
            var el = $(e.currentTarget)
            var dataArray = {
                'url':  el.attr('href'),
            }
            this.showAddAsync(dataArray)
        });

        $('body .bootstrap-table').on('click', 'a.view-item', (e) => {
            e.preventDefault()
            var el = $(e.currentTarget)
            var dataArray = {
                'url':  el.attr('href'),
            }
            this.showView(dataArray)
        });

        $('body .bootstrap-table').on('click', 'a.edit-item', (e) => {
            e.preventDefault()
            var el = $(e.currentTarget)
            var dataArray = {
                'url':  el.attr('href'),
            }
            this.showEdit(dataArray)
        });

        $('body .bootstrap-table').on('click', 'a.delete-item', (e) => {
            e.preventDefault()
            var el = $(e.currentTarget)
            var dataArray = {
                'url':  el.attr('href'),
            }
            this.showDelete(dataArray)
        });

        // $('body').on('click', 'button.add-item', (e) => {
        //     e.preventDefault()
        //     // console.log(this)
        //     this.showAdd()
        // });

    },

    beforeDestroy () {
        $('body .bootstrap-table').off('click')
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
            this.$bvModal.show("bs-modal") 
        },
        showAdd: function() {
            this.clearComponent()
            this.modalComponent = 'FormCreate'
            this.modalComponentParams = ''
            this.modalAttributes.title = this.addModalTitle ? this.addModalTitle : '#Add New';
            this.$bvModal.show("bs-modal") 
        },
        showAddAsync: function(data) {
            // Use axios to edit in Modal, otherwise inertia will Redirect to a full page
            this.clearComponent()
            // this.$bvModal.show(this.modalAttributes.uuid + '-modal')
            this.$bvModal.show("bs-modal")
            this.modalAttributes.title = this.addModalTitle ? this.addModalTitle : '#Add New'
                // console.log(data.url)
            axios.get(data.url)
                .then(response => {
                    // console.log(response)
                    this.modalComponent = 'FormCreate'
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

        // inertiaVisit: function(data) {
        //     this.$inertia.get(data.url, [], [])
        //     // Inertia.visit(data.url, {method: 'get'})
        // },

        showView: function(data) {
            // Use axios to edit in Modal, otherwise inertia will Redirect to a full page
            this.clearComponent()
            this.$bvModal.show("bs-modal")
            this.modalAttributes.title = '#'

            axios.get(data.url)
                .then(response => {
                    // console.log(response)
                    this.modalComponent = 'FormShow'
                    this.modalComponentParams = response
                    // console.log( response )
                    this.modalAttributes.title = '#' + response.data.name;
                })
                .catch(error => {
                    this.$bvModal.hide("bs-modal")
                    // Handle validation errors
                    this.errors = error;
                    this.success = false;
                    this.showErrorMessages(this.errors)
                });
        },
        showEdit: function(data) {
            // Use axios to edit in Modal, otherwise inertia will Redirect to a full page
            this.clearComponent()
            this.$bvModal.show("bs-modal")
            this.modalAttributes.title = '#Edit - '

            axios.get(data.url)
                .then(response => {
                    // console.log(response)
                    this.modalComponent = 'FormEdit'
                    this.modalComponentParams = response
                    // console.log( response )
                    this.modalAttributes.title = '#Edit - ' + response.data.name;
                })
                .catch(error => {
                    this.$bvModal.hide("bs-modal")
                    // Handle validation errors
                    this.errors = error;
                    this.success = false;
                    this.showErrorMessages(this.errors)
                });
        },
        showDelete: function(data) {
            // Use axios to edit in Modal, otherwise inertia will not
            this.clearComponent()
            this.$bvModal.show("bs-modal-delete")
            this.modalAttributes.title = '#Delete - ';

            axios.get(data.url)
                .then(response => {
                    this.deleteComponent = 'FormDelete'
                    this.deleteComponentParams = response
                    // console.log( response )
                    this.modalAttributes.title = '#Delete - ' + response.data.name;
                })
                .catch(error => {
                    this.$bvModal.hide("bs-modal-delete")
                    // Handle validation errors
                    this.errors = error;
                    this.success = false;
                    this.showErrorMessages(this.errors)
                });
        },

    }
}

