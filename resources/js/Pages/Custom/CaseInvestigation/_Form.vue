<template>
    <div>
        <b-row class="form-group">
            <b-col sm="3">
                <label for="case_id">Case</label>
            </b-col>
            <b-col sm="9">
                <div v-if="data && data.case" class="border rounded bg-light p-2">
                    {{ data && data.case ? data.case.name : '' }}
                </div> 
                <select2 v-else id="case_id" 
                    :name="route('dashboard.cases.index')" 
                    :options="ajaxOptions" 
                    :settings="{ placeholder: 'Choose a Case', ajax: ajax, templateResult: formatState, templateSelection: formatState, allowClear: true }" 
                    v-model="form.case_id" 
                    :class="[errors.case_id ? 'is-invalid' : '']">
                </select2>
                <span v-if="errors.case_id" :class="['label text-danger small']">{{ errors.case_id }}</span>
            </b-col>
        </b-row>

        <b-row class="form-group">
            <b-col sm="3">
                <label for="assigned_contributor_id">Assigned contributor</label>
            </b-col>
            <b-col sm="9">
                <div v-if="data && data.assigned_contributor" class="border rounded bg-light p-2">
                    {{ data && data.assigned_contributor ? data.assigned_contributor.name : '' }}
                </div>
                <select2 v-else id="assigned_contributor_id" 
                    :name="route('dashboard.case-contributors.index')" 
                    :options="ajaxOptions" 
                    :settings="{ placeholder: 'Choose a Contributor', ajax: ajax, templateResult: formatState, templateSelection: formatState, allowClear: true }" 
                    v-model="form.assigned_contributor_id" 
                    :class="[errors.assigned_contributor_id ? 'is-invalid' : '']">
                </select2>
                <span v-if="errors.assigned_contributor_id" :class="['label text-danger small']">{{ errors.assigned_contributor_id }}</span>
            </b-col>
        </b-row>

        <b-row class="form-group">
            <b-col sm="3">
                <label for="assigned_on">Assigned on</label>
            </b-col>
            <b-col sm="9">
                <date-picker 
                    id="assigned_on" 
                    :config="datePickerOptions" 
                    class="form-control w-auto" 
                    v-model="form.assigned_on" 
                    type="datetime" 
                    value-type="format" 
                    :class="[errors.assigned_on ? 'is-invalid' : '']">
                </date-picker>
                <span v-if="errors.assigned_on" :class="['label text-danger small']">{{ errors.assigned_on }}</span>
            </b-col>
        </b-row>

        <b-row class="form-group">
            <b-col sm="3">
                <label for="description">Description</label>
            </b-col>
            <b-col sm="9">
                <ckeditor :editor="editor" 
                    v-model="form.description" 
                    :config="editorConfig" 
                    :class="[errors.description ? 'is-invalid' : '']">
                </ckeditor>
                <span v-if="errors.description" :class="['label text-danger small']">{{ errors.description }}</span>
            </b-col>
        </b-row>

        <b-row class="form-group">
            <b-col sm="3">
                <label for="attachments">Attachments</label>
            </b-col>
            <b-col sm="9">
                <field-attachments :data="data"/>
                <span v-if="errors.attachments" :class="['label text-danger small']">{{ errors.attachments }}</span>
            </b-col>
        </b-row>

    </div>
</template>
<script>
    import MessagesMixin from '@/Mixins/Messages'
    import DBOperationsMixin from '@/Mixins/DBOperations'
    import bootstrapTableMixin from '@/Mixins/Plugins/BootstrapTable'
    import Select2Mixin from '@/Mixins/Plugins/Select2'
    import FieldAttachments from '@/Pages/Core/Field/fieldAttachments'

    export default {
        mixins: [MessagesMixin, DBOperationsMixin, bootstrapTableMixin, Select2Mixin],
        props: ['data'],
        components: {
            FieldAttachments,
        },
        data() {
          return {
                form: this.$inertia.form({
                    description: this.data.description,
                    case_id: this.data && this.data.case_id ? this.data.case_id : '',
                    assigned_on: this.data && this.data.assigned_on ? this.data.assigned_on : '',
                    assigned_contributor_id: this.data && this.data.assigned_contributor_id ? this.data.assigned_contributor_id : '',

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
        mounted() {
            // Select: case_id
            if (this.data.case_id != null || this.data.case) {
                var selectElement = $('#case_id')
                var data = {
                    id: this.data.case_id ? this.data.case_id : this.data.case.id,
                    text: !!this.data.case ? this.data.case.name : '',
                    // thumbnail: !!this.data.head_of_department ? this.data.head_of_department.thumbnail : '',
                };
                var option = new Option(data.text, data.id, true, true)
                // option.dataset.thumbnail = data.thumbnail
                selectElement.append(option).trigger('change');
            }

            // Select: assigned_contributor_id
            if (this.data.assigned_contributor_id != null || this.data.assigned_contributor) {
                var selectElement = $('#assigned_contributor_id')
                var data = {
                    id: this.data.assigned_contributor_id ? this.data.assigned_contributor_id : this.data.assigned_contributor.id,
                    text: !!this.data.assigned_contributor ? this.data.assigned_contributor.name : '',
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