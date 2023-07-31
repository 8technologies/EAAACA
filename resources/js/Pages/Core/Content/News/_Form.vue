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
                <label for="body">Body</label>
                <ckeditor :editor="editor" v-model="form.body" :config="editorConfig" :class="[errors.body ? 'is-invalid' : '']"></ckeditor>
                <span v-if="errors.body" :class="['label text-danger small']">{{ errors.body }}</span>
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <FieldImage :data="data"></FieldImage>
            </div>

            <div class="form-group">
                <label for="attachments">Attachments</label>
                <FieldAttachments :data="data"></FieldAttachments>
            </div>

            <div class="form-group">
                <label for="tags">Tags</label>
                <select2 id="tags" 
                    :name="route('dashboard.taxonomy_terms.index', {taxonomy_type: 1})" 
                    :options="ajaxOptions" 
                    :settings="{ multiple: true, tags: true, tokenSeparators: [','], placeholder: 'Add tags', ajax: ajax, templateResult: formatState, templateSelection: formatState, allowClear: true }" 
                    v-model="form.tags" 
                    :class="[errors.tags ? 'is-invalid' : '']">
                </select2>
                <span v-if="errors.tags" :class="['label text-danger small']">{{ errors.tags }}</span>
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
                    attachments: null,
                    attachments_ids: [],
                    slug: this.data && this.data.slug ? this.data.slug : '',

                    tags: this.data.tags ? this.data.tags.map(item => {return item.id}) : [],
                    created_at: this.data.created_at ? this.data.created_at : '',
                }),
            }
        },
        mounted() {
            // Select: tags
            if (this.data.tags != null) {
                var selectElement = $('#tags')
                var options = []
                this.data.tags.forEach(element => {
                    options.push( new Option(element.name, element.id, true, true) )
                });
                selectElement.append(options).trigger('change');
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