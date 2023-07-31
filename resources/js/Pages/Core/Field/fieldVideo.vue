<template>

    <div class="">
        <div class="row">
            <div class="col-md-4">
                <FilePreview 
                    :entity="entity" 
                    :photoPreview="photoPreview" 
                    :photoPreviewStyle="photoPreviewStyle">
                </FilePreview>
            </div>
            
            <div class="col-md-8">
                <div v-if="showPreview" class="row">
                    <div class="col-md-12">
                        <b-button variant="link" :key="'changeBtn'" v-on:click="showFileUpload()">
                            Change
                        </b-button> |
                        <b-button variant="link" :key="'deleteBtn'" v-on:click="showFileDelete()">
                            Remove
                        </b-button>
                    </div>
                </div>
                <!-- Show Upload Form -->
                <div v-if="showUpload" class="row">
                    <div class="col-md-12">
                        <b-button v-if="hasFile" variant="link" :key="'cancelBtn'" v-on:click="cancelChanges()">
                            Cancel
                        </b-button>
                        <p v-else class="small font-italic">
                            Upload a new media_video or use an existing media_video
                        </p>
                    </div>

                    <div class="col-md-12">
                        <select2 id="media_video_id" :name="route('dashboard.media.videos.index')" :options="ajaxOptions" :settings="{ placeholder: 'Search existing videos', ajax: ajax, templateResult: formatState, templateSelection: formatThumbnailPreview, allowClear: true }" v-model="media_video_id" :class="[errors.media_video_id ? 'is-invalid' : '']" @change="existingmedia_videoChanged($event)">
                        </select2>
                    </div>
                </div>
                <!-- Show Delete Form -->
                <div v-if="showDelete" class="row">
                    <div class="col-md-12">
                        <b-button v-if="hasFile" variant="link" :key="'cancelBtn'" v-on:click="showFilePreview()">
                            Cancel
                        </b-button>
                    </div>

                    <div class="col-md-12">
                        <b-button v-if="hasFile" :key="'cancelBtn'" v-on:click="detachEntity($event)">
                            Remove
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
    import Select2Mixin from '@/Mixins/Plugins/Select2'
    import MediaFiles from '@/Mixins/MediaFiles'
    import FunctionsMixin from '@/Mixins/Functions'

    import FilePreview from './_FilePreview'

    export default {
        mixins: [MessagesMixin, DBOperationsMixin, Select2Mixin, MediaFiles, FunctionsMixin],
        props: ['data'],
        data() {
            return {
                media_video: null,
                media_video_id: null,
                entity: this.getEntity(),
                originalEntity: {...this.getEntity()},
            }
        },
        components: {
            FilePreview,
        },
        methods: {
            getEntity() {
                if (!this.data) {
                    return null
                }
                // find media entity with id = video_id
                return this.data
            },
            existingmedia_videoChanged: function(value) {
                this.clearFileUpload()
                if (value != null) {
                    this.fetchEntity( route('dashboard.videos.show', value) )
                }
                this.photoPreview = null
            },
            getEntityDetachUrl() {
                var parentEntityUrl = this.getParentWithFormField('media_video_id').data.entity_links.url_view
                return parentEntityUrl + '?_detach_media_video=' + this.entity.id
            },
            clearSelect2() {
                var select2Field = $('#media_video_id')
                select2Field.val(null).trigger('change');
                this.media_video_id = null
            },
        },
        watch: {
            media_video: function(newVal, oldVal) {
                this.getParentWithFormField('media_video').form.media_video = newVal
            },
            media_video_id: function(newVal, oldVal) {
                this.getParentWithFormField('media_video_id').form.media_video_id = newVal
            },
        },
        // created() {
        //     console.log( this.data )
        // }
    }

</script>

