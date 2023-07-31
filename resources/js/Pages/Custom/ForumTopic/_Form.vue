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
                <label for="forum_category_id">Forum category</label>
                <select2 id="forum_category_id" 
                    :name="route('dashboard.forum-categories.index')" 
                    :options="ajaxOptions" 
                    :settings="{ placeholder: 'Choose a Forum Category', ajax: ajax, templateResult: formatState, templateSelection: formatState, allowClear: true }" 
                    v-model="form.forum_category_id" 
                    :class="[errors.forum_category_id ? 'is-invalid' : '']">
                </select2>
                <span v-if="errors.forum_category_id" :class="['label text-danger small']">{{ errors.forum_category_id }}</span>
            </div>
            <div class="form-group">
                <label for="body">Body</label>
                <ckeditor :editor="editor" v-model="form.body" :config="editorConfig" :class="[errors.body ? 'is-invalid' : '']"></ckeditor>
                <span v-if="errors.body" :class="['label text-danger small']">{{ errors.body }}</span>
            </div>

            <div class="form-group">
                <label for="attachments">Attachments</label>
                <FieldAttachments :data="data"></FieldAttachments>
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
                    forum_category_id: this.data && this.data.forum_category_id ? this.data.forum_category_id : '',
                    body: this.data && this.data.body ? this.data.body : '',
                    user_id: this.data && this.data.user_id ? this.data.user_id : '',
                    attachments: null,
                    attachments_ids: [],

                    created_at: this.data.created_at ? this.data.created_at : '',
                }),
            }
        },
        mounted() {
            // Select: forum_category_id
            if (this.data.forum_category_id != null || this.data.forum_category) {
                var selectElement = $('#forum_category_id')
                var data = {
                    id: this.data.forum_category_id ? this.data.forum_category_id : this.data.forum_category.id,
                    text: !!this.data.forum_category ? this.data.forum_category.name : '',
                    // thumbnail: !!this.data.head_of_department ? this.data.head_of_department.thumbnail : '',
                };
                var option = new Option(data.text, data.id, true, true)
                // option.dataset.thumbnail = data.thumbnail
                selectElement.append(option).trigger('change');
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