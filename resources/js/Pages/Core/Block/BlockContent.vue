<template>
    <div class="">
        <component :is="dataComponent"></component>
    </div>
</template>
<script>
    import ContactForm from '@/Pages/Core/Block/BlockForms/ContactForm'

    export default {
        props: ['data'],
        data() {
          return {
                dataComponent: this.data.component_name
            }
        },
        components: {
            ContactForm,
        },
    }
</script>