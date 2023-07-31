<template>

    <div class="">
        <div class="row no-gutters">
            <div class="col-md-12">
                <div class="">
                <FilePreview v-for="(media_file, index) in files" 
                    v-bind:key="'media_file'+media_file.id+'-'+index" 
                    :class="'py-2 '+ (index == 0 ? '' : 'border-top')"
                    :mediaEntity="media_file" 
                    :data="data"
                    @removeAttachmentWithID="removeAttachmentWithID">
                </FilePreview>
                </div>
            </div>
            
            <div class="col-md-12">
                <div class="pt-2">
                    <!-- Show Upload Form -->
                    <div class="row">
                        <div class="col-md-5">
                            <b-form-file
                                ref="file"
                                v-model="file"
                                multiple
                                :file-name-formatter="formatNames"
                                placeholder="Choose an file or drop it here..."
                                drop-placeholder="Drop file here...">
                            </b-form-file>
                            <span v-if="errors.file" :class="['label text-danger small']">{{ errors.file }}</span>
                        </div>
                        <div class="col-md-2">
                            <div class="pt-1 text-center">
                                - OR -
                            </div>
                        </div>
                        <div class="col-md-5">
                            <select2 ref="file_id" 
                                :name="route('dashboard.media.files.index')" 
                                :options="ajaxOptions" 
                                :settings="{ placeholder: 'Attach an existing file', ajax: ajax, templateResult: formatState, templateSelection: formatThumbnailPreview, allowClear: true }" 
                                v-model="file_id" 
                                :class="[errors.file_id ? 'is-invalid' : '']" 
                                @change="existingFileSelected($event)">
                            </select2>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import MessagesMixin from '@/Mixins/Messages'
    import DBOperationsMixin from '@/Mixins/DBOperations'
    import Select2Mixin from '@/Mixins/Plugins/Select2'
    import MediaFiles from '@/Mixins/MediaFiles'
    import FunctionsMixin from '@/Mixins/Functions'

    import FilePreview from './_FilePreviewList'

    export default {
        mixins: [MessagesMixin, DBOperationsMixin, Select2Mixin, MediaFiles, FunctionsMixin],
        props: ['data'],
        data() {
            return {
                files: this.data.media_attachments ? this.data.media_attachments : [],
                file: null,
                file_id: null,
            }
        },
        components: {
            FilePreview,
        },
        methods: {
            formatNames(files) {
                return files.length === 1 ? files[0].name : `${files.length} files selected`
            },
            existingFileSelected: function(value) {
                // this.clearFileUpload()
                if (value != null) {
                    // console.log( value )
                    this.fetchEntity( route('dashboard.media.files.show', value) )
                }
                // this.photoPreview = null
            },

            async fetchEntity (url) {
                try {
                    let response = await axios.get(url)
                    // this.entity = response.data
                    this.files.push(response.data)
                } catch (error) {
                    // Handle validation errors
                    this.errors = error;
                    this.success = false;
                    this.showErrorMessages(this.errors)
                }
            },

            getEntity() {
                return null
                // if (!this.data || !this.data.media || this.data.media.lenght < 0) {
                //     return null
                // }
                // // find media entity with id = video_id
                // return this.data.media.find(obj => {
                //     return obj.thumbnail === this.data.thumbnail
                // })
            },
            getEntityDetachUrl() {
                var parentEntityUrl = this.getParentWithFormField('attachments_ids').data.entity_links.url_view
                return parentEntityUrl + '?_detach_file=' + this.entity.id
            },
            
            removeAttachmentWithID(value) {
                let newFiles = this.files.filter(function(item, index) {
                    return item.id !== value
                })
                this.files = newFiles
            },
        },
        watch: {
            file: function(newVal, oldVal) {
                this.getParentWithFormField('attachments').form.attachments = newVal
            },
            file_id: function(newVal, oldVal) {
                this.getParentWithFormField('attachments_ids').form.attachments_ids.push(newVal)
            },
        },
        // created() {
        //     console.log( this.data )
        // }
    }

</script>