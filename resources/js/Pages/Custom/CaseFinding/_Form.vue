<template>
    <div>
        <b-row class="form-group">
            <b-col sm="3">
                <label for="case_investigation_id">Case investigation</label>
            </b-col>
            <b-col sm="9">
                <div v-if="data && data.case_investigation" class="border rounded bg-light p-2">
                    {{ data && data.case_investigation ? data.case_investigation.name : '' }}
                </div> 
                <select2 v-else id="case_investigation_id" 
                    :name="route('dashboard.case-investigations.index')" 
                    :options="ajaxOptions" 
                    :settings="{ placeholder: 'Choose a Case investigation', ajax: ajax, templateResult: formatState, templateSelection: formatState, allowClear: true }" 
                    v-model="form.case_investigation_id" 
                    :class="[errors.case_investigation_id ? 'is-invalid' : '']">
                </select2>
                <span v-if="errors.case_investigation_id" :class="['label text-danger small']">{{ errors.case_investigation_id }}</span>
            </b-col>
        </b-row>

        <b-row class="form-group">
            <b-col sm="3">
                <label for="findings">Findings</label>
            </b-col>
            <b-col sm="9">
                <ckeditor :editor="editor" 
                    v-model="form.findings" 
                    :config="editorConfig" 
                    :class="[errors.findings ? 'is-invalid' : '']">
                </ckeditor>
                <span v-if="errors.findings" :class="['label text-danger small']">{{ errors.findings }}</span>
            </b-col>
        </b-row>

        <b-row class="form-group">
            <b-col sm="3">
                <label for="date_of_submission">Date of Submission</label>
            </b-col>
            <b-col sm="9">
                <date-picker 
                    id="date_of_submission" 
                    :config="datePickerOptions" 
                    class="form-control w-auto" 
                    v-model="form.date_of_submission" 
                    type="datetime" 
                    value-type="format" 
                    :class="[errors.date_of_submission ? 'is-invalid' : '']">
                </date-picker>
                <span v-if="errors.date_of_submission" :class="['label text-danger small']">{{ errors.date_of_submission }}</span>
            </b-col>
        </b-row>

        <b-row class="form-group">
            <b-col sm="3">
                <label for="attachments">Attachments</label>
            </b-col>
            <b-col sm="9">
                <field-attachments :data="data"/>
                <span v-if="errors.findings" :class="['label text-danger small']">{{ errors.findings }}</span>
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
                    case_investigation_id: this.data && this.data.case_investigation_id ? this.data.case_investigation_id : '',
                    date_of_submission: this.data && this.data.date_of_submission ? this.data.date_of_submission : '',
                    findings: this.data && this.data.findings ? this.data.findings : '',

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
            // Select: case_investigation_id
            if (this.data && (this.data.case_investigation_id != null || this.data.case_investigation)) {
                var selectElement = $('#case_investigation_id')
                var data = {
                    id: this.data.case_investigation_id ? this.data.case_investigation_id : this.data.case_investigation.id,
                    text: !!this.data.case_investigation ? this.data.case_investigation.name : '',
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