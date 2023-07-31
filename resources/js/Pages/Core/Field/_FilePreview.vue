<template>
    <div class="row no-gutters">
        <div class="col-4 text-center">
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
        <div class="col-8">
            <div v-if="entity && entity.id" class="small pl-2 ml-2 border-left h-100">
                <div v-if="entity.id == 'local'" class="rounded bg-primary small px-1 d-inline-block">Upload</div>
                <div class="text-wrap text-break">{{ entity.name }}</div>
                <div class="">{{ entity.file_size }}</div>
                <div class="">{{ entity.file_type }}</div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['entity', 'photoPreview', 'photoPreviewStyle'],
    }
</script>