<template>
    <div>
        <b-row class="form-group">
            <b-col sm="3">
                <label for="reference_number">Reference number</label>
            </b-col>
            <b-col sm="9">
                <b-form-input id="reference_number" placeholder="Enter reference number" required="" v-model="form.reference_number" :class="[errors.reference_number ? 'is-invalid' : '']">
                </b-form-input>
                <span v-if="errors.reference_number" :class="['label text-danger small']">{{ errors.reference_number }}</span>
            </b-col>
        </b-row>

        <b-row class="form-group">
            <b-col sm="3">
                <label for="organization_id">Organization</label>
            </b-col>
            <b-col sm="9">
                <div v-if="data && data.organization" class="border rounded bg-light py-2 px-3">
                    {{ data && data.organization ? data.organization.name : '' }}
                </div>
                <select2 v-else id="organization_id" 
                    :name="route('dashboard.organizations.index')" 
                    :options="ajaxOptions" 
                    :settings="{ placeholder: 'Choose an Organization', ajax: ajax, templateResult: formatState, templateSelection: formatState, allowClear: true }" 
                    v-model="form.organization_id" 
                    :class="[errors.organization_id ? 'is-invalid' : '']">
                </select2>
                <span v-if="errors.organization_id" :class="['label text-danger small']">{{ errors.organization_id }}</span>
            </b-col>
        </b-row>

        <b-row class="form-group">
            <b-col sm="3">
                <label for="date_created">Date and time created</label>
            </b-col>
            <b-col sm="9">
                <date-picker 
                    id="date_created" 
                    :config="datePickerOptions" 
                    class="form-control w-auto" 
                    v-model="form.date_created" 
                    type="datetime" 
                    value-type="format" 
                    :class="[errors.date_created ? 'is-invalid' : '']">
                </date-picker>
                <span v-if="errors.date_created" :class="['label text-danger small']">{{ errors.date_created }}</span>
            </b-col>
        </b-row>

        <b-row class="form-group">
            <b-col sm="3">
                <label for="description">Description</label>
            </b-col>
            <b-col sm="9">
                <ckeditor :editor="editor" v-model="form.description" :config="editorConfig" :class="[errors.description ? 'is-invalid' : '']"></ckeditor>
                <span v-if="errors.description" :class="['label text-danger small']">{{ errors.description }}</span>
            </b-col>
        </b-row>

        <!-- <b-row class="form-group">
            <b-col sm="3">
                <label for="description">Description</label>
            </b-col>
            <b-col sm="9">
                <b-form-textarea 
                    id="description" 
                    placeholder="" 
                    rows="4"
                    v-model="form.description" 
                    :class="[errors.description ? 'is-invalid' : '']">
                </b-form-textarea>
                <span v-if="errors.description" :class="['label text-danger small']">{{ errors.description }}</span>
            </b-col>
        </b-row> -->

        <b-row class="form-group">
            <b-col sm="3">
                <label for="user_id">Created by</label>
            </b-col>
            <b-col sm="9">
                <select2 id="user_id" 
                    :name="route('dashboard.users.index')" 
                    :options="ajaxOptions" 
                    :settings="{ placeholder: 'Choose a user', ajax: ajax, templateResult: formatState, templateSelection: formatState, allowClear: true }" 
                    v-model="form.user_id" 
                    :class="[errors.user_id ? 'is-invalid' : '']">
                </select2>
                <span v-if="errors.user_id" :class="['label text-danger small']">{{ errors.user_id }}</span>
            </b-col>
        </b-row>

        <b-row class="form-group">
            <b-col sm="3">
                <label for="attachments">Attachments</label>
            </b-col>
            <b-col sm="9">
                <FieldAttachments :data="data"></FieldAttachments>
            </b-col>
        </b-row>

    </div>
</template>
<script>
    import MessagesMixin from '@/Mixins/Messages'
    import DBOperationsMixin from '@/Mixins/DBOperations'
    import bootstrapTableMixin from '@/Mixins/Plugins/BootstrapTable'
    import Select2Mixin from '@/Mixins/Plugins/Select2'

    import FieldImage from '@/Pages/Core/Field/fieldImage'
    import FieldAttachments from '@/Pages/Core/Field/fieldAttachments'

    export default {
        mixins: [MessagesMixin, DBOperationsMixin, bootstrapTableMixin, Select2Mixin],
        props: ['data'],
        data() {
          return {
                form: this.$inertia.form({
                    reference_number: this.data.reference_number,
                    date_created: this.data && this.data.date_created ? this.data.date_created : '',

                    description: this.data.description,
                    organization_id: this.data && this.data.organization_id ? this.data.organization_id : '',
                    user_id: this.data && this.data.user_id ? this.data.user_id : '',
                    attachments: null,
                    attachments_ids: [],
                }),
                datePickerOptions: {
                    format: 'MM/DD/Y hh:mm A',
                    keepOpen: false,
                    widgetPositioning: {vertical: 'bottom'},
                },
            }
        },
        components: {
            FieldImage,
            FieldAttachments,
        },
        mounted() {
            // Select: organization_id
            if (this.data.organization_id != null || this.data.organization) {
                var selectElement = $('#organization_id')
                var data = {
                    id: this.data.organization_id ? this.data.organization_id : this.data.organization.id,
                    text: !!this.data.organization ? this.data.organization.name : '',
                    // thumbnail: !!this.data.head_of_department ? this.data.head_of_department.thumbnail : '',
                };
                var option = new Option(data.text, data.id, true, true)
                // option.dataset.thumbnail = data.thumbnail
                selectElement.append(option).trigger('change');
            }

            // Select: user_id
            if (this.data.user_id != null || this.data.user) {
                var selectElement = $('#user_id')
                var data = {
                    id: this.data.user_id ? this.data.user_id : this.data.user.id,
                    text: !!this.data.user ? this.data.user.name : '',
                    thumbnail: !!this.data.user ? this.data.user.thumbnail : '',
                };
                var option = new Option(data.text, data.id, true, true)
                option.dataset.thumbnail = data.thumbnail
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
