<template>
    <div>

        <div class="row">
            <div class="col-md-4">
                <Preview :data="data" class="display-4"></Preview>
            </div>
            <div class="col-md-8">
                <Details :data="data"></Details>
            </div>
        </div>

    </div>
</template>
<script>
    import Preview from './_Preview'
    import Details from './_Details'
    export default {
        props: ['data'],
        data() {
          return {
            }
        },
        components: {
            Preview,
            Details,
        },
        // created() {
        //     console.log( this.data )
        // }
    }
</script>