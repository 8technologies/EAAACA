<template>
    <div>
        <b-row class="form-group">
            <b-col sm="3">
                <label for="feedback_status_id">Feedback Status</label>
            </b-col>
            <b-col sm="9">
                <b-form-group
                    v-slot="{ ariaDescribedby }"
                    >
                    <b-form-radio
                        v-for="option in all_statuses"
                        v-model="form.feedback_status_id"
                        :key="option.name"
                        :value="option.id"
                        :aria-describedby="ariaDescribedby"
                    >
                    {{ option.name }}
                    </b-form-radio>
                </b-form-group>
                <span v-if="errors.feedback_status_id" :class="['label text-danger small']">{{ errors.feedback_status_id }}</span>
            </b-col>
        </b-row>

        <b-row class="form-group">
            <b-col sm="3">
                <label for="feedback_on">Date of Feedback</label>
            </b-col>
            <b-col sm="9">
                <date-picker 
                    id="feedback_on" 
                    :config="datePickerOptions" 
                    class="form-control w-auto" 
                    v-model="form.feedback_on" 
                    type="datetime" 
                    value-type="format" 
                    :class="[errors.feedback_on ? 'is-invalid' : '']">
                </date-picker>
                <span v-if="errors.feedback_on" :class="['label text-danger small']">{{ errors.feedback_on }}</span>
            </b-col>
        </b-row>

        <b-row class="form-group">
            <b-col sm="3">
                <label for="feedback_notes">Feedback Notes</label>
            </b-col>
            <b-col sm="9">
                <b-form-textarea 
                    id="feedback_notes" 
                    rows="4" 
                    max-rows="4" 
                    placeholder="Enter Feedback notes" 
                    v-model="form.feedback_notes" 
                    :class="[errors.feedback_notes ? 'is-invalid' : '']">
                </b-form-textarea>
                <span v-if="errors.feedback_notes" :class="['label text-danger small']">{{ errors.feedback_notes }}</span>
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
                    feedback_status_id: this.data && this.data.feedback_status_id ? this.data.feedback_status_id : '',
                    feedback_on: this.data && this.data.feedback_on ? this.data.feedback_on : '',
                    feedback_notes: this.data && this.data.feedback_notes ? this.data.feedback_notes : '',
                }),
                all_statuses: this.data.all_statuses,
                datePickerOptions: {
                    format: 'MM/DD/Y hh:mm A',
                    keepOpen: false,
                    widgetPositioning: {vertical: 'bottom'},
                },
            }
        },
        // mounted() {
        //     // Select: feedback_status_id
        //     if (this.data && (this.data.feedback_status_id != null || this.data.feedback_status)) {
        //         var selectElement = $('#feedback_status_id')
        //         var data = {
        //             id: this.data.feedback_status_id ? this.data.feedback_status_id : this.data.feedback_status.id,
        //             text: !!this.data.feedback_status ? this.data.feedback_status.name : '',
        //             // thumbnail: !!this.data.head_of_department ? this.data.head_of_department.thumbnail : '',
        //         };
        //         var option = new Option(data.text, data.id, true, true)
        //         // option.dataset.thumbnail = data.thumbnail
        //         selectElement.append(option).trigger('change');
        //     }
        // },
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