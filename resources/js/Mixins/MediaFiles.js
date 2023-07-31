import Vue from 'vue'

export default {

    data() {
        return {
            form: {
                thumbnail: this.getThumbnail(),
            },
            entity: this.getEntity(),
            originalEntity: {...this.getEntity()},

            photoPreview: null,
            thumbnailPreview: null,
            hasFile: this.getThumbnail() ? true : false,

            uploadFile: false,
            editFile: false,
            deleteFile: false,

            showPreview: this.getThumbnail() ? true : false,
            showUpload: this.getThumbnail() ? false : true,
            showEdit: false,
            showDelete: false,
        }
    },
    computed: {
        photoPreviewStyle() {
            if (this.photoPreview == null) {
                return ''
            }
            return 'background-image: url(\'' + this.photoPreview + '\');' + 'background-size: cover; background-repeat: no-repeat; background-position: center center;'
        },
    },
    methods: {
        getThumbnail() {
            if (!this.data || !this.data.media_image ) {
                return null
            }

            if (this.data && this.data.media_image) {
                if (this.data.media_image.thumbnail) {
                    return this.data.media_image.thumbnail
                } else {
                    return this.data.media_image.original
                }   
            }

            return null
        },
        closeAllTabs() {
            this.showPreview = false
            this.showUpload = false
            this.showEdit = false
            this.showDelete = false
        },
        clearEntity() {
            this.entity = this.originalEntity
        },
        cancelChanges() {
            this.clearSelect2()
            this.clearFileUpload()
            this.clearEntity()
            this.existingFileChanged()

            if (this.hasFile) {
                this.showFilePreview()
            } else {
                this.showFileUpload()
            }
        },
        showFilePreview(event) {
            this.closeAllTabs()
            this.showPreview = true
        },
        showFileUpload(event) {
            this.closeAllTabs()
            this.showUpload = true
        },
        showFileEdit(event) {
            this.closeAllTabs()
            this.showEdit = true
        },
        showFileDelete(event) {
            this.closeAllTabs()
            this.showDelete = true
        },
        existingFileChanged: function(value) {
            this.clearFileUpload()
            if (value != null) {
                this.fetchEntity( route('dashboard.media.files.show', value) )
            }
            this.photoPreview = null
        },
        updateFilePreview(event) {
            const reader = new FileReader();
            var file = null

            // Check if Event was fired by file upload field
            if (event.target.files) {
                file = event.target.files[0]
            } else {
                file = this.file
            }

            this.entity = {
                id: 'local',
                name: file.name,
                file_size: this.humanFileSize(file.size),
                file_type: file.type,
                file_icon: null,
            }
            
            this.photoPreview = null
            if (file.size < 5500000) {
                reader.onload = (event) => {
                    this.photoPreview = event.target.result;
                }
                reader.readAsDataURL(file)
            }
            this.clearSelect2()
        },
        clearSelect2() {
            if (this.$refs.file_id) {
                var select2Field = this.$refs.file_id
                select2Field.setValue(null)
                // select2Field.val(null).trigger('change');
                this.file_id = null
            }
        },
        clearFileUpload() {
            if (this.$refs.file) {
                this.$refs.file.reset()
                this.file = null
            }
        },
        updateEntityDetached() {
            this.entity = {id: null}
            this.originalEntity = null
            this.form.thumbnail = ''
            this.hasFile = false
            this.showPreview = false
            this.showUpload = true
            this.showEdit = false
            this.showDelete = false
        },
        detachEntity (event) {
            this.showSpinner = true

            var form = {
                _method: 'PUT',
            }

            // console.log( this.getEntityDetachUrl() )
            axios.put(this.getEntityDetachUrl(), form)
                .then(response => {
                    // Handle success event
                    this.showSuccessMessage('Media entity removed')
                    this.cancelChanges()
                    this.updateEntityDetached()
                })
                .catch(errors => {
                    // Handle validation errors
                    this.errors = errors;
                    this.success = false;
                    this.showErrorMessages(this.errors)
                })

            // this.$inertia.post(this.getEntityDetachUrl(), form, {
            //     onSuccess: (page) => {
            //         // Handle success event
            //         console.log( page )
            //         this.showSuccessMessage(page.props.flash.success)
            //     },
            //     onError: (errors) => {
            //         // Handle validation errors
            //         console.log( 'errors', errors )
            //         this.errors = errors;
            //         this.success = false;
            //         this.showErrorMessages(this.errors)
            //     },
            // })

            // remove spinning icon
            this.showSpinner = false
        },
    },
    watch: { 
        thumbnailPreview: function(newVal, oldVal) {
            this.photoPreview = newVal
        },
    },
}

