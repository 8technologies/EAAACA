import Vue from 'vue'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import FunctionsMixin from '@/Mixins/Functions'

export default {
    mixins: [FunctionsMixin],
    data() {
        return {
            errors: [],
            success: false,
            spinnerClasses: 'spinner-border spinner-border-sm',
            showSpinner: false,
            modalAttributes: {
                'uuid': this.setUUID(),
                'uuid_this': this.setUUIDThis(),
                'uuid_entity_create': this.setUuidEntityCreate(),
                'title': '#',
                'size': 'md',
                'header-bg-variant': 'dark',
            },
            editor: ClassicEditor,
            editorConfig: {
                toolbar: {
                    // items: [ 'bold', 'italic', '|', 'undo', 'redo', '-', 'numberedList', 'bulletedList' ],
                    // viewportTopOffset: 300,
                },
            },

            headingOptions: [
                { value: null, text: ' - Please select an option - ' },
                { value: 'h1', text: 'h1' },
                { value: 'h2', text: 'h2' },
                { value: 'h3', text: 'h3' },
                { value: 'h4', text: 'h4' },
                { value: 'h5', text: 'h5' },
                { value: 'h6', text: 'h6' },
            ],
            urlTargetOptions: [
                { value: null, text: ' - Please select an option - ' },
                { value: '_self', text: '_self' },
                { value: '_blank', text: '_blank' },
                { value: '_parent', text: '_parent' },
                { value: '_top', text: '_top' },
            ],
        }
    },

    watch: {
        errors: function (val) {
            if (this.$refs.entityForm) {
                this.$refs.entityForm.setErrors(val)
            }
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

        setUuidEntityCreate: function() {
            var vueInstance = this
            // console.log( this )
            for (var i = 0; i < 10; i++) {
                // console.log( typeof(vueInstance) !== 'undefined' )
                if ( typeof(vueInstance) !== 'undefined' && Object.keys(vueInstance.$options.components).includes("EntityCreate") ) {
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

        // getParentWithFormField: function(formField) {
        //     var vueInstance = this
        //     for (var i = 0; i < 10; i++) {
        //         if ( typeof(vueInstance) !== 'undefined' && Object.keys(vueInstance._data).includes('form') && Object.keys(vueInstance._data.form).includes(formField) ) {
        //             i = 10
        //         }

        //         if (i < 10 && typeof(vueInstance.$parent) !== 'undefined' ) {
        //             vueInstance = vueInstance.$parent
        //         }
        //     }
        //     return vueInstance
        // },

        // getParentWithForm: function() {
        //     var vueInstance = this
        //     for (var i = 0; i < 10; i++) {
        //         if ( typeof(vueInstance) !== 'undefined' && Object.keys(vueInstance._data).includes('form') ) {
        //             i = 10
        //         }

        //         if (i < 10 && typeof(vueInstance.$parent) !== 'undefined' ) {
        //             vueInstance = vueInstance.$parent
        //         }
        //     }
        //     return vueInstance
        // },

        setErrors: function(values) {
            this.errors = values
        },

        getFieldKeyIndex: function(field, keyValue) {
            const value = keyValue
            var index = -1

            if (this.form[field] == null) {
                this.form[field] = [{
                    'key': value,
                    'value': "",
                }]
            }

            index = this.form[field].findIndex(item => item['key'] === keyValue)
            if (index === -1) {
                var newIndex = this.form[field].length
                this.form[field][newIndex] = {
                    'key': value,
                    'value': "",
                }
                index = newIndex
            }

            return index
        },
        // Handle events

        // Update form values
        updateFormValues: function(formValues) {
            this.form = formValues
        },

        updateLocalData: function(data) {
            var vueInstance = this
            // console.log( 'this', this )
            
            for (var i = 0; i < 20; i++) {
                // Object.keys(this.$parent.$parent.$parent.$parent._data).includes('requestOptions') 
                if ( typeof(vueInstance) !== 'undefined' && typeof(vueInstance._data) !== 'undefined' && Object.keys(vueInstance._data).includes("localData") && Object.keys(vueInstance._data).includes("updatablePreview") ) {
                    // vueInstance.$emit('updateLocalDataInstance', data)
                    // console.log( 'vueInstance found', vueInstance._uid )
                    vueInstance.localData = data
                    i = 20
                    this.showSpinner = false
                    return vueInstance
                }

                if (i < 20 && typeof(vueInstance.$parent) !== 'undefined' ) {
                    // console.log( 'vueInstance', vueInstance._uid )
                    vueInstance = vueInstance.$parent
                    // vueInstance._data.localData = data
                    // console.log( vueInstance )
                }
            }
            this.showSpinner = false
            return null
        },

        updateParentLocalData: function(data) {
            var vueInstance = this
            // console.log( this )
            for (var i = 0; i < 20; i++) {
                // Object.keys(this.$parent.$parent.$parent.$parent._data).includes('requestOptions') 
                if ( typeof(vueInstance) !== 'undefined' && typeof(vueInstance._data) !== 'undefined' && Object.keys(vueInstance._data).includes("localData") && Object.keys(vueInstance._data).includes("updatablePreview") ) {
                    // vueInstance.$parent.$parent.$emit('updateLocalDataInstance', data)
                    vueInstance.$parent.$parent.localData = data
                    i = 20
                    this.showSpinner = false
                    return
                }

                if (i < 20 && typeof(vueInstance.$parent) !== 'undefined' ) {
                    vueInstance = vueInstance.$parent
                }
            }
            this.showSpinner = false
            return null
        },

        // 
        closeEntityModal: function () {
            this.$bvModal.hide("bs-modal")
            this.$bvModal.hide("entity-modal")
            this.$bvModal.hide(this.modalAttributes.uuid + '-modal')
            this.$bvModal.hide(this.modalAttributes.uuid_this + '-modal')
            this.$bvModal.hide(this.modalAttributes.uuid_entity_create + '-modal')
        },

        // 
        closeEntityDeleteModal: function () {
            this.$bvModal.hide("bs-modal-delete")
            this.$bvModal.hide("entity-modal-delete")
            this.$bvModal.hide(this.modalAttributes.uuid + '-modal-delete')
            this.$bvModal.hide(this.modalAttributes.uuid_this + '-modal-delete')
            this.$bvModal.hide(this.modalAttributes.uuid_entity_create + '-modal-delete')
        },

        // Inertia CRUD operations

        async fetchEntity (url) {
            try {
                let response = await axios.get(url)
                this.entity = response.data
            } catch (error) {
                // Handle validation errors
                this.errors = error;
                this.success = false;
                this.showErrorMessages(this.errors)
            }
        },

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
                    // console.log( 'page', page )
                    if (typeof this.refreshBootstrapTable === 'function') {this.refreshBootstrapTable()}
                    if (typeof this.closeEntityModal === 'function') {this.closeEntityModal()}
                    this.showSuccessMessage(page.props.flash.success)
                },
                onError: (errors) => {
                    // Handle validation errors
                    // console.log( 'errors', errors )
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
                    if (typeof this.closeEntityModal === 'function') {this.closeEntityModal()}
                    this.showSuccessMessage(response.statusText)
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

        // Update an item
        update: function(event) {
            event.preventDefault()
            event.srcElement.submit.firstChild.className += this.spinnerClasses
            this.showSpinner = true
            this.form['_method'] = 'PUT'

            var URL = event.target.action

            this.$inertia.post(URL, this.form, {
                onProgress: (progress) => {
                    // Handle progress event
                },
                onSuccess: (page) => {
                    // Handle success event
                    if (typeof this.refreshBootstrapTable === 'function') {this.refreshBootstrapTable()}
                    if (typeof this.closeEntityModal === 'function') {this.closeEntityModal()}
                    this.showSuccessMessage(page.props.flash.success)
                },
                onError: (errors) => {
                    // Handle validation errors
                    // console.log( 'errors', errors )
                    this.errors = errors;
                    this.success = false;
                    this.showErrorMessages(this.errors)
                },
                onFinish: () => {
                    event.srcElement.submit.firstChild.className = ''
                }
            })
        },

        // Update an item
        updateWithAjax: function(event) {
            event.preventDefault()
            event.srcElement.submit.firstChild.className += this.spinnerClasses
            this.showSpinner = true
            this.form['_method'] = 'PUT'

            var URL = event.target.action
            // axios.defaults.headers.common['Authorization'] = `Bearer ${await this.$auth.getAccessToken()}`
            axios.put(URL, this.form)
                .then(response => {
                    // Handle success event
                    if (typeof this.refreshBootstrapTable === 'function') {this.refreshBootstrapTable()}
                    if (typeof this.closeEntityModal === 'function') {this.closeEntityModal()}
                    this.showSuccessMessage(response.statusText)
                    if (response.data['updateParent']) {
                        this.updateParentLocalData(response.data)
                    } else {
                        this.updateLocalData(response.data)
                    }
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

        updateWithAjaxUpdateParent: function(event) {
            event.preventDefault()
            event.srcElement.submit.firstChild.className += this.spinnerClasses
            this.showSpinner = true
            this.form['_method'] = 'PUT'

            var URL = event.target.action
            // axios.defaults.headers.common['Authorization'] = `Bearer ${await this.$auth.getAccessToken()}`
            axios.put(URL, this.form)
                .then(response => {
                    // Handle success event
                    if (typeof this.refreshBootstrapTable === 'function') {this.refreshBootstrapTable()}
                    if (typeof this.closeEntityModal === 'function') {this.closeEntityModal()}
                    this.showSuccessMessage(response.statusText)
                    this.updateLocalData(response.data)
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

        // Delete an item
        destroy: function(event) {
            event.preventDefault()
            this.showSpinner = true
            event.srcElement.submit.firstChild.className += this.spinnerClasses

            var URL = event.target.action
            this.form._method = 'DELETE';
            
            this.$inertia.post(URL, this.form, {
                onProgress: (progress) => {
                    // Handle progress event
                },
                onSuccess: (page) => {
                    // Handle success event
                    if (typeof this.refreshBootstrapTable === 'function') {this.refreshBootstrapTable()}
                    if (typeof this.closeEntityDeleteModal === 'function') {this.closeEntityDeleteModal()}
                    this.showSuccessMessage(page.props.flash.success)
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
            }); 
        },

        // Delete an item
        destroyWithAjax: function(event) {
            event.preventDefault()
            this.showSpinner = true
            event.srcElement.submit.firstChild.className += this.spinnerClasses

            var URL = event.target.action
            this.form._method = 'DELETE';

            // axios.defaults.headers.common['Authorization'] = `Bearer ${await this.$auth.getAccessToken()}`
            axios.post(URL, this.form)
                .then(response => {
                    // Handle success event
                    // console.log( response )
                    if (typeof this.refreshBootstrapTable === 'function') {this.refreshBootstrapTable()}
                    if (typeof this.closeEntityDeleteModal === 'function') {this.closeEntityDeleteModal()}
                    this.showSuccessMessage(response.statusText)
                    this.updateLocalData(response.data)
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

        // Delete an item
        destroyWithAjaxUpdateParent: function(event) {
            event.preventDefault()
            this.showSpinner = true
            event.srcElement.submit.firstChild.className += this.spinnerClasses

            var URL = event.target.action
            this.form._method = 'DELETE';

            // axios.defaults.headers.common['Authorization'] = `Bearer ${await this.$auth.getAccessToken()}`
            axios.post(URL, this.form)
                .then(response => {
                    // Handle success event
                    if (typeof this.refreshBootstrapTable === 'function') {this.refreshBootstrapTable()}
                    if (typeof this.closeEntityDeleteModal === 'function') {this.closeEntityDeleteModal()}
                    this.showDeleteSuccessMessage(response.statusText)
                    this.updateParentLocalData(response.data)
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

        // Delete an item
        deleteMultiple: function(ids) {
            // console.log(ids)
            var URL = ''
            
            this.$inertia.post(URL, [], {
                onProgress: (progress) => {
                    // Handle progress event
                },
                onSuccess: (page) => {
                    // Handle success event
                    if (typeof this.refreshBootstrapTable === 'function') {this.refreshBootstrapTable()}
                    this.$bvModal.hide("bs-modal-delete")
                    this.$bvModal.hide("entity-modal-delete")
                    this.showSuccessMessage(page.props.flash.success)
                },
                onError: (errors) => {
                    // Handle validation errors
                    this.errors = errors;
                    this.success = false;
                    this.showErrorMessages(this.errors)
                },
                onFinish: () => {
                    // event.srcElement.submit.firstChild.className = ''
                }
            });            
        },

    }
}

// $('#bs-modal').modal( {
//     focus: false
// });
