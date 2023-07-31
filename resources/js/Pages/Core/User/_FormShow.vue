<template>
    <div class="row align-items-center">
        <div class="col-sm-4" style="max-width:200px !important;">
            <ImagePreview 
                :data="data" 
                :options="{
                    url: data.thumbnail, 
                    classes: 'img-circle img-thumbnail img-fluid'
                }">
            </ImagePreview>
        </div>
        <div class="col">
            <div class="pb-3">
                <h3 class="">{{ data.name }}</h3>
                <div class="">{{ data.email }}</div>
                <div class="" v-html="formatTags(data.roles, ', ')"></div>
            </div>
        </div>
    </div>
</template>
<script>
    import FunctionsMixin from '@/Mixins/Functions'

    export default {
        mixins: [FunctionsMixin],
        props: ['data'],
    }
</script>