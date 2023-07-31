<template>
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <label for="title">Title</label>
                <b-form-input id="title" placeholder="Enter Title" required="" v-model="form.title" :class="[errors.title ? 'is-invalid' : '']">
                </b-form-input>
                <span v-if="errors.title" :class="['label text-danger small']">{{ errors.title }}</span>
            </div>

            <div class="form-group">
                <label for="body">Featured content</label>
                <b-textarea id="body" required rows="10" max-rows="10" placeholder="Enter featured text/markup" v-model="form.body" :class="[errors.body ? 'is-invalid' : '']">
                </b-textarea>
                <span v-if="errors.body" :class="['label text-danger small']">{{ errors.body }}</span>
            </div>

            <div class="form-group">
                <label for="image">Featured image</label>
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
    import FieldAttachments from '@/Pages/Core/Field/fieldAttachments'

    export default {
        mixins: [MessagesMixin, DBOperationsMixin, EntityComponentsMixin, Select2Mixin],
        props: ['data'],
        components: {
            ContentSidebar,
            FieldImage,
            FieldAttachments,
        },
        data() {
          return {
                form: this.$inertia.form({
                    title: this.data && this.data.title ? this.data.title : '',
                    body: this.data && this.data.body ? this.data.body : '',
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
                    // console.log( newVal )
                    this.$emit('updateParentFormValues', newVal)
                }
            }
        },
    }
</script>