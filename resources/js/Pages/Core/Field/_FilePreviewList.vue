<template>
    <div class="row no-gutters">
        <div class="col-auto text-center">
            <div v-if="entity && entity.id">
                <div v-if="photoPreview">
                    <span class="d-inline-block rounded border file-entity-preview"
                        :style="''+ photoPreviewStyle">
                    </span>
                </div>
                <div v-else-if="entity.id != 'local'" class="rounded border file-entity-preview">
                    <b-img v-if="entity.thumbnail" class="rounded m-auto" fluid :src="entity.thumbnail" style="max-width:100%; height:auto; max-height:70px">
                    </b-img>
                    <i v-else :class="entity.file_icon + ' fa-2x text-dark rounded p-3'" style="width:70px; max-width:100%; height:70px;"></i>
                </div>
                <span v-else class="d-inline-block rounded border file-entity-preview">
                    <i class="fa fa-exclamation-triangle"></i>
                    <div class="small pt-2">
                        Preview not available
                    </div>
                </span>
            </div>
            <div v-else>
                <span class="d-inline-block rounded border file-entity-preview">
                    <div class="small pt-2">
                        Choose a file/entity
                    </div>
                </span>
            </div>
        </div>
        <div class="col">
            <div v-if="entity && entity.id" class="small pl-2 h-100">
                <div v-if="entity.id == 'local'" class="rounded bg-primary small px-1 d-inline-block">Upload</div>
                <div class="text-wrap text-break">{{ entity.name }}</div>
                <div class="">{{ entity.file_size }}</div>
                <div class="">{{ entity.file_type }}</div>
            </div>
        </div>
        <div class="col-auto">
            <div class="small pl-2 h-100 text-right" style="min-width:100px;">
                <b-button v-if="!showDelete" class="btn-sm" variant="outline-secondary" :key="'deleteBtn'" v-on:click="showFileDelete()">
                    <i class="fa fa-trash"></i>
                </b-button>

                <!-- Show Delete Form -->
                <div v-if="showDelete" class="row">
                    <div class="col-md-12 pt-1">
                        <b-button class="btn-sm mr-1" variant="outline-secondary" :key="'cancelBtn'" v-on:click="cancleFileDelete()">
                            <i class="fa fa-reply"></i>
                        </b-button>
                        <b-button variant="outline-danger" :key="'deletBtn'" v-on:click="detachEntity($event)" class="btn-sm">
                            Remove
                            <span v-if="showSpinner" :class="spinnerClasses" role="status" aria-hidden="true"></span>
                        </b-button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    import MessagesMixin from '@/Mixins/Messages'
    import DBOperationsMixin from '@/Mixins/DBOperations'
    import FunctionsMixin from '@/Mixins/Functions'
    import MediaFiles from '@/Mixins/MediaFiles'

    export default {
        mixins: [MessagesMixin, DBOperationsMixin, FunctionsMixin, MediaFiles],
        props: ['data', 'mediaEntity'],
        data() {
            return {
                showSpinner: false,
                editFile: false,
                deleteFile: false,

                showEdit: false,
                showDelete: false,
                entity: this.mediaEntity,
            }
        },
        methods: {
            getEntity() {
                if (!this.data || !this.data.media || this.data.media.lenght < 0) {
                    return null
                }
                // find media entity with id = video_id
                return this.data.media.find(obj => {
                    return obj.thumbnail === this.data.thumbnail
                })
            },
            getEntityDetachUrl() {
                var parentEntity = this.getParentWithFormField('attachments_ids')

                if (parentEntity.data && parentEntity.data.entity_links && parentEntity.data.entity_links.url_view) {
                    return parentEntity.data.entity_links.url_view + '?_detach_attachment=' + this.entity.id
                }
                return null
            },
            showFileDelete(event) {
                this.showDelete = true
            },
            cancleFileDelete(event) {
                this.showDelete = false
            },

            detachEntity (event) {
                this.showSpinner = true

                var url = this.getEntityDetachUrl()
                var form = {
                    _method: 'PUT',
                }

                if (!url) {
                    this.showSpinner = true
                    this.$emit('removeAttachmentWithID', this.entity.id)
                    return
                }

                axios.put(url, form)
                    .then(response => {
                        // Handle success event
                        this.showSuccessMessage('Media entity removed')
                        this.$emit('removeAttachmentWithID', this.entity.id)
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
    }
</script>