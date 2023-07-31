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
        </div>
        <div class="col">
            <div v-if="entity && entity.id" class="pl-2">
                <div class="text-wrap text-break">{{ entity.name }}</div>
                <div class="">{{ entity.file_size }}</div>
                <div class="">{{ entity.file_type }}</div>
            </div>
        </div>
        <div class="col-auto">
            <div class="pl-2">
                <b-link variant="secondary" 
                    :key="'downloadBtn'" 
                    target="_blank"
                    :href="entity.download_link"
                    class="btn-sm">
                    Download
                </b-link>
            </div>
        </div>
    </div>
</template>

<script>
    import FunctionsMixin from '@/Mixins/Functions'
    import MediaFiles from '@/Mixins/MediaFiles'

    export default {
        mixins: [FunctionsMixin, MediaFiles],
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
        },
    }
</script>