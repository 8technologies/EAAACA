<template>

    <div class="">
        <div class="row no-gutters">
            <div class="col-md-4">
                <div class="row no-gutters">
                    <div class="col-4 text-center">
                        <div v-if="entity && entity.id">
                            <div v-if="photoPreview">
                                <span class="d-inline-block rounded"
                                    :style="'width:70px; height:70px; max-width: 100%;'+ photoPreviewStyle">
                                </span>
                            </div>
                            <div v-else-if="entity.id != 'local'" class="">
                                <b-img v-if="entity.thumbnail" class="rounded m-auto" fluid :src="entity.thumbnail" style="max-width:100%; height:auto; max-height:70px">
                                </b-img>
                                <i v-else :class="entity.file_icon + ' fa-2x text-dark border rounded p-3'" style="width:70px; max-width:100%; height:70px;"></i>
                            </div>
                            <span v-else class="d-inline-block rounded border"
                                :style="'width:70px; max-width:100%; height:70px;'">
                                <i class="fa fa-exclamation-triangle"></i>
                                <div class="small pt-2">
                                    No Preview
                                </div>
                            </span>
                        </div>
                    </div>
                    <div class="col-8">
                        <div v-if="entity && entity.id" class="small pl-2 ml-2 border-left h-100">
                            <div v-if="entity.id == 'local'" class="rounded bg-primary small px-1 d-inline-block">Upload</div>
                            <div class="text-wrap text-break">{{ entity.name }}</div>
                            <div class="">{{ entity.file_size }}</div>
                            <div class="">{{ entity.file_type }}</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-8">
                <div class="pl-2">
                    <div v-if="showPreview" class="row">
                        <div class="col-md-12">
                            <b-button variant="link" :key="'changeBtn'" v-on:click="showFileUpload()">
                                Change file
                            </b-button> |
                            <b-button variant="link" :key="'editBtn'" v-on:click="showFileEdit()">
                                Edit
                            </b-button> |
                            <b-button variant="link" :key="'deleteBtn'" v-on:click="showFileDelete()">
                                Delete
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
                                Upload a new file or use an existing file
                            </p>
                        </div>

                        <div class="col-md-6">
                            <!-- file Upload Input -->
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
                            <select2 ref="file_id" :name="route('dashboard.media.files.index', {'mime_type': 'video'})" :options="ajaxOptions" :settings="{ placeholder: 'Search Existing file', ajax: ajax, templateResult: formatState, templateSelection: formatThumbnailPreview, allowClear: true }" v-model="file_id" :class="[errors.file_id ? 'is-invalid' : '']" @change="existingFileChanged($event)">
                            </select2>
                        </div>
                    </div>
                    <!-- Show Edit Form -->
                    <div v-if="showEdit" class="row">
                        <div class="col-md-12">
                            <b-button v-if="hasFile" variant="link" :key="'cancelBtn'" v-on:click="showFilePreview()">
                                Cancel
                            </b-button>
                        </div>

                        <div class="col-md-12">
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

    export default {
        mixins: [MessagesMixin, DBOperationsMixin, Select2Mixin, MediaFiles, FunctionsMixin],
        props: ['data'],
        data() {
            return {
                file: null,
                file_id: null,
            }
        },
        methods: {
            getEntity() {
                if (!this.data || !this.data.media || this.data.media.lenght < 0) {
                    return null
                }
                // find media entity with id = video_id
                return this.data.media.find(obj => {
                    return obj.id === this.data.video_id
                })
            },
        },
        watch: {
            file: function(newVal, oldVal) {
                this.getParentWithFormField('video').form.video = newVal
            },
            file_id: function(newVal, oldVal) {
                // console.log( newVal )
                this.getParentWithFormField('video_id').form.video_id = newVal
            },
        },

    }

</script>

