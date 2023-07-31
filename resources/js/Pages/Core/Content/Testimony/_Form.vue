<template>
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <label for="name">Name</label>
                <b-form-input id="name" placeholder="Enter name" required="" v-model="form.name" :class="[errors.name ? 'is-invalid' : '']">
                </b-form-input>
                <span v-if="errors.name" :class="['label text-danger small']">{{ errors.name }}</span>
            </div>

            <div class="form-group">
                <label for="company_name">Company name</label>
                <b-form-input id="company_name" placeholder="Enter company name" required="" v-model="form.company_name" :class="[errors.company_name ? 'is-invalid' : '']">
                </b-form-input>
                <span v-if="errors.company_name" :class="['label text-danger small']">{{ errors.company_name }}</span>
            </div>

            <div class="form-group">
                <label for="testimony">Testimony</label>
                <ckeditor :editor="editor" v-model="form.testimony" :config="editorConfig" :class="[errors.testimony ? 'is-invalid' : '']"></ckeditor>
                <span v-if="errors.testimony" :class="['label text-danger small']">{{ errors.testimony }}</span>
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <FieldImage :data="data"></FieldImage>
            </div>

        </div>
        <div class="col-md-4">
            <content-sidebar :data="data"/>
        </div>
    </div>
</template>
<script>
    import MessagesMixin from '@/Mixins/Messages'
    import DBOperationsMixin from '@/Mixins/DBOperations'
    import EntityComponentsMixin from '@/Mixins/EntityComponents'
    import Select2Mixin from '@/Mixins/Plugins/Select2'
    import ContentSidebar from '@/Pages/Core/Content/_Partials/Sidebar'
    import FieldImage from '@/Pages/Core/Field/fieldImage'

    export default {
        mixins: [MessagesMixin, DBOperationsMixin, EntityComponentsMixin, Select2Mixin],
        props: ['data'],
        components: {
            ContentSidebar,
            FieldImage,
        },
        data() {
          return {
                form: this.$inertia.form({
                    name: this.data && this.data.name ? this.data.name : '',
                    company_name: this.data && this.data.company_name ? this.data.company_name : '',
                    testimony: this.data && this.data.testimony ? this.data.testimony : '',
                    user_id: this.data && this.data.user_id ? this.data.user_id : '',
                    image: null,
                    image_id: null,
                    slug: this.data && this.data.slug ? this.data.slug : '',

                    created_at: this.data.created_at ? this.data.created_at : '',
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