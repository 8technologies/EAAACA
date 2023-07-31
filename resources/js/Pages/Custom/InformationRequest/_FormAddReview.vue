<template>
    <div>
        <b-row class="form-group">
            <b-col sm="3">
                <label for="review_status_id">Review Status</label>
            </b-col>
            <b-col sm="9">
                <b-form-group
                    v-slot="{ ariaDescribedby }"
                    >
                    <b-form-radio
                        v-for="option in all_statuses"
                        v-model="form.review_status_id"
                        :key="option.name"
                        :value="option.id"
                        :aria-describedby="ariaDescribedby"
                    >
                    {{ option.name }}
                    </b-form-radio>
                </b-form-group>
                <span v-if="errors.review_status_id" :class="['label text-danger small']">{{ errors.review_status_id }}</span>
            </b-col>
        </b-row>

        <b-row class="form-group required">
            <b-col sm="3">
                <label for="case_id">Follows a Case</label>
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
                <label for="review_on">Date of Review</label>
            </b-col>
            <b-col sm="9">
                <date-picker 
                    id="review_on" 
                    :config="datePickerOptions" 
                    class="form-control w-auto" 
                    v-model="form.review_on" 
                    type="datetime" 
                    value-type="format" 
                    :class="[errors.review_on ? 'is-invalid' : '']">
                </date-picker>
                <span v-if="errors.review_on" :class="['label text-danger small']">{{ errors.review_on }}</span>
            </b-col>
        </b-row>

        <b-row class="form-group">
            <b-col sm="3">
                <label for="review_notes">Review Notes</label>
            </b-col>
            <b-col sm="9">
                <b-form-textarea 
                    id="review_notes" 
                    rows="4" 
                    max-rows="4" 
                    placeholder="Enter review notes" 
                    v-model="form.review_notes" 
                    :class="[errors.review_notes ? 'is-invalid' : '']">
                </b-form-textarea>
                <span v-if="errors.review_notes" :class="['label text-danger small']">{{ errors.review_notes }}</span>
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
                    review_status_id: this.data && this.data.review_status_id ? this.data.review_status_id : '',
                    review_on: this.data && this.data.review_on ? this.data.review_on : '',
                    review_notes: this.data && this.data.review_notes ? this.data.review_notes : '',
                }),
                all_statuses: this.data.all_statuses,
                datePickerOptions: {
                    format: 'MM/DD/Y hh:mm A',
                    keepOpen: false,
                    widgetPositioning: {vertical: 'bottom'},
                },
            }
        },
        mounted() {
            // Select: case_id
            if (this.data && (this.data.case_id != null || this.data.case)) {
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