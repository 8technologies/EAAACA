<template>
    <div class="">
        <template v-if="data.file_preview">
            <b-img thumbnail fluid :src="data.file_preview" :alt="data.name" class="w-100"></b-img>
        </template>
        <template v-else>
            <div class="row py-4 align-items-center text-center img-thumbnail">
                <i class="col-md-12 border-0" :class="data.file_icon"></i>
            </div>
        </template>
    </div>
</template>
<script>

    export default {
        props: ['data'],
        data() {
          return {
            }
        },

    }
</script>