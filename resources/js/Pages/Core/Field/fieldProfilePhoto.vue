<template>

    <div class="">
        <div class="row">
            <div class="col-md-3">
            <div class="border rounded bg-white p-1 text-center" style="width:100px; height: 100px;">
                <!-- Current Profile Photo -->
                <div class="text-center m-auto" v-show="! photoPreview">
                    <b-img class="rounded m-auto" fluid :src="form.thumbnail" style="width: 100px; height: auto; min-height: 90px;">
                    </b-img>
                </div>

                <!-- New Profile Photo Preview -->
                <div class="" v-show="photoPreview">
                    <span class="d-inline-block rounded"
                        :style="'width: 100px; height: 90px; max-width: 100%; background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>
            </div>
            </div>
            
            <div class="col-md-9">

                <div v-if="showPreview" class="row">
                    <div class="col-md-12">
                        <b-button variant="link" :key="'changeBtn'" v-on:click="showFileUpload()">
                            Change Image
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
                            Upload a new image or use an existing image
                        </p>
                    </div>

                    <div class="col-md-6">
                        <!-- Image Upload Input -->
                        <b-form-file
                            id="image"
                            ref="image"
                            v-model="image"
                            :class="[errors.image ? 'is-invalid' : '']"
                            placeholder="Choose an image or drop it here..."
                            drop-placeholder="Drop image here..."
                            @change="updateImagePreview($event)">
                        </b-form-file>
                        <span v-if="errors.image" :class="['label text-danger small']">{{ errors.image }}</span>

                    </div>
                    <div class="col-md-6">
                        <select2 id="image_id" :name="route('dashboard.media.files.index', {'mime_type': 'image'})" :options="ajaxOptions" :settings="{ placeholder: 'Search Existing Image', ajax: ajax, templateResult: formatState, templateSelection: formatThumbnailPreview, allowClear: true }" v-model="image_id" :class="[errors.image_id ? 'is-invalid' : '']" @change="existingImageChanged($event)">
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

</template>

<script>
    import MessagesMixin from '@/Mixins/Messages'
    import DBOperationsMixin from '@/Mixins/DBOperations'
    // import EntityComponentsMixin from '@/Mixins/EntityComponents'
    import Select2Mixin from '@/Mixins/Plugins/Select2'

    export default {
        mixins: [MessagesMixin, DBOperationsMixin, Select2Mixin],
        props: ['data'],
        data() {
            return {
                form: {
                    thumbnail: this.data.thumbnail,
                },
                thumbnailPreview: null,
                photoPreview: null,

                image: null,
                image_id: null,
                
                hasFile: this.data.thumbnail ? true : false,

                uploadFile: false,
                editFile: false,
                deleteFile: false,

                showPreview: this.data.thumbnail ? true : false,
                showUpload: this.data.thumbnail ? false : true,
                showEdit: false,
                showDelete: false,
            }
        },

        methods: {

            closeAllTabs() {
                this.showPreview = false
                this.showUpload = false
                this.showEdit = false
                this.showDelete = false
            },
            cancelChanges() {
                this.clearSelect2()
                this.clearFileUpload()
                this.existingImageChanged()

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

            existingImageChanged: function(value) {
                this.clearFileUpload()
                if (value == null) {
                    this.photoPreview = null
                }
            },

            updateImagePreview(event) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.photoPreview = e.target.result;
                };
                reader.readAsDataURL(event.target.files[0]);
                this.clearSelect2()
            },

            clearSelect2() {
                var select2Field = $('#image_id')
                select2Field.val(null).trigger('change');
                this.image_id = null
            },
            clearFileUpload() {
                this.$refs.image.reset()
                this.image = null
            },
        },

        watch: { 
            thumbnailPreview: function(newVal, oldVal) {
                this.photoPreview = newVal
                // this.$emit('update:data', {id: 99})
            },
            image: function(newVal, oldVal) {
                this.getParentWithFormField('profile_photo').form.profile_photo = newVal
                // this.$parent.form.image = newVal
                // this.$emit('update:data', {id: 99})
            },
            image_id: function(newVal, oldVal) {
                this.getParentWithFormField('profile_photo_id').form.profile_photo_id = newVal
                // this.$parent.form.image_id = newVal
                // this.$emit('update:data', {id: 99})
            },
        },

    }

</script>

