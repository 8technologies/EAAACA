<template>
    <div class="">
        <div class="" v-html="data.body"></div>
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