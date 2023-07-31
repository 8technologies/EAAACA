<template>
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <label for="subject">Subject</label>
                <b-form-input id="subject" placeholder="Enter subject" required="" v-model="form.subject" :class="[errors.subject ? 'is-invalid' : '']">
                </b-form-input>
                <span v-if="errors.subject" :class="['label text-danger small']">{{ errors.subject }}</span>
            </div>
            <div class="form-group">
                <label for="email_from">From</label>
                <b-form-input id="email_from" placeholder="Enter from email" required="" v-model="form.email_from" :class="[errors.email_from ? 'is-invalid' : '']">
                </b-form-input>
                <span v-if="errors.email_from" :class="['label text-danger small']">{{ errors.email_from }}</span>
            </div>
            <div class="form-group">
                <label for="email_to">Email to</label>
                <b-form-input id="email_to" placeholder="Enter recipients" required="" v-model="form.email_to" :class="[errors.email_to ? 'is-invalid' : '']">
                </b-form-input>
                <span v-if="errors.email_to" :class="['label text-danger small']">{{ errors.email_to }}</span>
            </div>
            <div class="form-group">
                <label for="email_cc">Email Cc</label>
                <b-form-input id="email_cc" placeholder="Enter CC recipients" v-model="form.email_cc" :class="[errors.email_cc ? 'is-invalid' : '']">
                </b-form-input>
                <span v-if="errors.email_cc" :class="['label text-danger small']">{{ errors.email_cc }}</span>
            </div>
            <div class="form-group">
                <label for="email_bc">Email Bcc</label>
                <b-form-input id="email_bc" placeholder="Enter BC recipients" v-model="form.email_bc" :class="[errors.email_bc ? 'is-invalid' : '']">
                </b-form-input>
                <span v-if="errors.email_bc" :class="['label text-danger small']">{{ errors.email_bc }}</span>
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
                    subject: this.data && this.data.subject ? this.data.subject : '',
                    email_from: this.data && this.data.email_from ? this.data.email_from : '',
                    email_to: this.data && this.data.email_to ? this.data.email_to : '',
                    email_cc: this.data && this.data.email_cc ? this.data.email_cc : '',
                    email_bc: this.data && this.data.email_bc ? this.data.email_bc : '',
                    body: this.data && this.data.body ? this.data.body : '',
                    user_id: this.data && this.data.user_id ? this.data.user_id : '',
                    attachments: null,
                    attachments_ids: [],

                    created_at: this.data.created_at ? this.data.created_at : '',
                }),
            }
        },
        mounted() {
            // // Select: forum_category_id
            // if (this.data.forum_category_id != null || this.data.forum_category) {
            //     var selectElement = $('#forum_category_id')
            //     var data = {
            //         id: this.data.forum_category_id ? this.data.forum_category_id : this.data.forum_category.id,
            //         text: !!this.data.forum_category ? this.data.forum_category.name : '',
            //         // thumbnail: !!this.data.head_of_department ? this.data.head_of_department.thumbnail : '',
            //     };
            //     var option = new Option(data.text, data.id, true, true)
            //     // option.dataset.thumbnail = data.thumbnail
            //     selectElement.append(option).trigger('change');
            // }
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