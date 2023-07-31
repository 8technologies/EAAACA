<template>
    <div>
        <div class="form-group">
            <label for="name">Name</label>
            <b-form-input id="name" placeholder="Enter Name" required="" v-model="form.name" :class="[errors.name ? 'is-invalid' : '']">
            </b-form-input>
            <span v-if="errors.name" :class="['label text-danger small']">{{ errors.name }}</span>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <ckeditor :editor="editor" v-model="form.description" :config="editorConfig" :class="[errors.description ? 'is-invalid' : '']"></ckeditor>
            <span v-if="errors.description" :class="['label text-danger small']">{{ errors.description }}</span>
        </div>
    </div>
</template>
<script>
    import MessagesMixin from '@/Mixins/Messages'
    import DBOperationsMixin from '@/Mixins/DBOperations'
    import bootstrapTableMixin from '@/Mixins/Plugins/BootstrapTable'

    export default {
        mixins: [MessagesMixin, DBOperationsMixin, bootstrapTableMixin],
        props: ['data'],
        data() {
          return {
                form: this.$inertia.form({
                    name: this.data.name,
                    description: this.data.description,
                }),
            }
        },
        watch: {
            form: {
                deep: true,
                immediate: true,
                handler: function(newVal, oldVal) {
                    this.$emit('updateParentFormValues', newVal)
                }
            }
        },
    }
</script>