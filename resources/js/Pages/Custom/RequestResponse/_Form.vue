<template>
    <div>
        <b-row class="form-group">
            <b-col sm="3">
                <label for="information_request_id">Information Request</label>
            </b-col>
            <b-col sm="9">
                <div v-if="data && data.information_request" class="border rounded bg-light p-2">
                    {{ data && data.information_request ? data.information_request.name : '' }}
                </div> 
                <select2 v-else id="information_request_id" 
                    :name="route('dashboard.information-requests.index')" 
                    :options="ajaxOptions" 
                    :settings="{ placeholder: 'Choose an Information Request', ajax: ajax, templateResult: formatState, templateSelection: formatState, allowClear: true }" 
                    v-model="form.information_request_id" 
                    :class="[errors.information_request_id ? 'is-invalid' : '']">
                </select2>
                <span v-if="errors.information_request_id" :class="['label text-danger small']">{{ errors.information_request_id }}</span>
            </b-col>
        </b-row>

        <b-row class="form-group">
            <b-col sm="3">
                <label for="response">Response</label>
            </b-col>
            <b-col sm="9">
                <ckeditor :editor="editor" 
                    v-model="form.response" 
                    :config="editorConfig" 
                    :class="[errors.response ? 'is-invalid' : '']">
                </ckeditor>
                <span v-if="errors.response" :class="['label text-danger small']">{{ errors.response }}</span>
            </b-col>
        </b-row>

        <b-row class="form-group">
            <b-col sm="3">
                <label for="date_of_response">Date of Response</label>
            </b-col>
            <b-col sm="9">
                <date-picker 
                    id="date_of_response" 
                    :config="datePickerOptions" 
                    class="form-control w-auto" 
                    v-model="form.date_of_response" 
                    type="datetime" 
                    value-type="format" 
                    :class="[errors.date_of_response ? 'is-invalid' : '']">
                </date-picker>
                <span v-if="errors.date_of_response" :class="['label text-danger small']">{{ errors.date_of_response }}</span>
            </b-col>
        </b-row>

        <b-row class="form-group">
            <b-col sm="3">
                <label for="attachments">Attachments</label>
            </b-col>
            <b-col sm="9">
                <field-attachments :data="data"/>
                <span v-if="errors.response" :class="['label text-danger small']">{{ errors.response }}</span>
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
                    information_request_id: this.data && this.data.information_request_id ? this.data.information_request_id : '',
                    date_of_response: this.data && this.data.date_of_response ? this.data.date_of_response : '',
                    response: this.data && this.data.response ? this.data.response : '',

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
            // Select: information_request_id
            if (this.data && (this.data.information_request_id != null || this.data.information_request)) {
                var selectElement = $('#information_request_id')
                var data = {
                    id: this.data.information_request_id ? this.data.information_request_id : this.data.information_request.id,
                    text: !!this.data.information_request ? this.data.information_request.name : '',
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