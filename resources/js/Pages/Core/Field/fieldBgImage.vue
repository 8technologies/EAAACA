<template>

    <div class="">
        <div class="row no-gutters">
            <div class="col-md-4">
                <FilePreview 
                    :entity="entity" 
                    :photoPreview="photoPreview" 
                    :photoPreviewStyle="photoPreviewStyle">
                </FilePreview>
            </div>
            
            <div class="col-md-8">
                <div class="pl-2">
                    <div v-if="showPreview" class="">
                        <b-button class="pl-0 pt-0" variant="link" :key="'changeBtn'" v-on:click="showFileUpload()">
                            Change
                        </b-button> |
                        <b-button class="pt-0" variant="link" :key="'deleteBtn'" v-on:click="showFileDelete()">
                            Remove
                        </b-button>
                    </div>
                    <!-- Show Upload Form -->
                    <div v-if="showUpload" class="row">
                        <div class="col-md-12">
                            <b-button class="pl-0 pt-0" v-if="hasFile" variant="link" :key="'cancelBtn'" v-on:click="cancelChanges()">
                                <i class="fa fa-reply"></i> Cancel
                            </b-button>
                            <p v-else class="small font-italic">
                                Upload a new file or use an existing file
                            </p>
                        </div>
                        <div class="col-md-6">
                            <b-form-file
                                ref="file"
                                v-model="file"
                                :class="[errors.file ? 'is-invalid' : '']"
                                placeholder="Choose an file or drop it here..."
                                drop-placeholder="Drop file here..."
                                @change="updateFilePreview($event)">
                            </b-form-file>
                            <span v-if="errors.file" :class="['label text-danger small']">{{ errors.file }}</span>
                        </div>
                        <div class="col-md-6">
                            <select2 ref="file_id" :name="route('dashboard.media.files.index', {'mime_type': 'image'})" :options="ajaxOptions" :settings="{ placeholder: 'Search Existing file', ajax: ajax, templateResult: formatState, templateSelection: formatThumbnailPreview, allowClear: true }" v-model="file_id" :class="[errors.file_id ? 'is-invalid' : '']" @change="existingFileChanged($event)">
                            </select2>
                        </div>
                    </div>
                    <!-- Show Delete Form -->
                    <div v-if="showDelete" class="row">
                        <div class="col-md-12">
                            <b-button class="pl-0 pt-0" v-if="hasFile" variant="link" :key="'cancelBtn'" v-on:click="showFilePreview()">
                                <i class="fa fa-reply"></i> Cancel
                            </b-button>
                        </div>

                        <div class="col-md-12">
                            <b-button v-if="hasFile" variant="outline-danger" :key="'cancelBtn'" v-on:click="detachEntity($event)">
                                Remove
                                <span v-if="showSpinner" :class="spinnerClasses" role="status" aria-hidden="true"></span>
                            </b-button>
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

    import FilePreview from './_FilePreview'

    export default {
        mixins: [MessagesMixin, DBOperationsMixin, Select2Mixin, MediaFiles, FunctionsMixin],
        props: ['data'],
        data() {
            return {
                bg_image: null,
                bg_image_id: null,
                form: {
                    bg_thumbnail: this.data.bg_thumbnail,
                },
                hasFile: this.data.bg_thumbnail ? true : false,
                showPreview: this.data.bg_thumbnail ? true : false,
                showUpload: this.data.bg_thumbnail ? false : true,

                file: null,
                file_id: null,
                entity: this.getEntity(),
                originalEntity: {...this.getEntity()},
            }
        },
        components: {
            FilePreview,
        },
        methods: {
            getEntity() {
                if (!this.data || !this.data.media || this.data.media.lenght < 0) {
                    return null
                }
                // find media entity with id = video_id
                return this.data.media.find(obj => {
                    return obj.thumbnail === this.data.bg_thumbnail
                })
            },
            getEntityDetachUrl() {
                var parentEntityUrl = this.getParentWithFormField('bg_image_id').data.entity_links.url_view
                return parentEntityUrl + '?_detach_bg_image=' + this.entity.id
            },
        },
        watch: {
            file: function(newVal, oldVal) {
                this.getParentWithFormField('bg_image').form.bg_image = newVal
            },
            file_id: function(newVal, oldVal) {
                this.getParentWithFormField('bg_image_id').form.bg_image_id = newVal
            },
        },
    }

</script>