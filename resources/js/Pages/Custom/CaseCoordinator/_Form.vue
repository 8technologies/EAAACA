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
                <label for="contact_point_id">Contact point</label>
            </b-col>
            <b-col sm="9">
                <div v-if="data && data.contact_point" class="border rounded bg-light p-2">
                    {{ data && data.contact_point ? data.contact_point.name : '' }}
                </div>
                <select2 v-else id="contact_point_id" 
                    :name="route('dashboard.contact-points.index')" 
                    :options="ajaxOptions" 
                    :settings="{ placeholder: 'Choose a Contact point', ajax: ajax, templateResult: formatState, templateSelection: formatState, allowClear: true }" 
                    v-model="form.contact_point_id" 
                    :class="[errors.contact_point_id ? 'is-invalid' : '']">
                </select2>
                <span v-if="errors.contact_point_id" :class="['label text-danger small']">{{ errors.contact_point_id }}</span>
            </b-col>
        </b-row>

        <b-row class="form-group">
            <b-col sm="3">
                <label for="is_inactive">De activate this user</label>
            </b-col>
            <b-col sm="9">
                <b-form-checkbox
                    id="is_inactive"
                    v-model="form.is_inactive"
                    name="is_inactive"
                    value="1"
                    unchecked-value="0"
                    >
                        
                </b-form-checkbox>
                <span v-if="errors.is_inactive" :class="['label text-danger small']">{{ errors.is_inactive }}</span>
            </b-col>
        </b-row>

    </div>
</template>
<script>
    import MessagesMixin from '@/Mixins/Messages'
    import DBOperationsMixin from '@/Mixins/DBOperations'
    import bootstrapTableMixin from '@/Mixins/Plugins/BootstrapTable'
    import Select2Mixin from '@/Mixins/Plugins/Select2'

    export default {
        mixins: [MessagesMixin, DBOperationsMixin, bootstrapTableMixin, Select2Mixin],
        props: ['data'],
        data() {
          return {
                form: this.$inertia.form({
                    case_id: this.data && this.data.case_id ? this.data.case_id : '',
                    contact_point_id: this.data && this.data.contact_point_id ? this.data.contact_point_id : '',
                }),
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

            // Select: contact_point_id
            if (this.data.contact_point_id != null || this.data.contact_point) {
                var selectElement = $('#contact_point_id')
                var data = {
                    id: this.data.contact_point_id ? this.data.contact_point_id : this.data.contact_point.id,
                    text: !!this.data.contact_point ? this.data.contact_point.name : '',
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