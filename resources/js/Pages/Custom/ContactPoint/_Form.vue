<template>
    <div>
        <b-row class="form-group">
            <b-col sm="3">
                <label for="organization_id">Organization</label>
            </b-col>
            <b-col sm="9">
                <div v-if="data && data.organization" class="border rounded bg-light p-2">
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
                <label for="user_account_id">User account</label>
            </b-col>
            <b-col sm="9">
                <div v-if="data && data.user_account" class="border rounded bg-light p-2">
                    {{ data && data.user_account ? data.user_account.name : '' }}
                </div>
                <select2 v-else id="user_account_id" 
                    :name="route('dashboard.users.index')" 
                    :options="ajaxOptions" 
                    :settings="{ placeholder: 'Choose a User account', ajax: ajax, templateResult: formatState, templateSelection: formatState, allowClear: true }" 
                    v-model="form.user_account_id" 
                    :class="[errors.user_account_id ? 'is-invalid' : '']">
                </select2>
                <span v-if="errors.user_account_id" :class="['label text-danger small']">{{ errors.user_account_id }}</span>
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
                        Is inactive
                </b-form-checkbox>
                <span v-if="errors.is_inactive" :class="['label text-danger small']">{{ errors.is_inactive }}</span>
            </b-col>
        </b-row>

        <b-row class="form-group">
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
                    name: this.data.name,
                    description: this.data.description,
                    organization_id: this.data && this.data.organization_id ? this.data.organization_id : '',
                    user_account_id: this.data && this.data.user_account_id ? this.data.user_account_id : '',
                }),
            }
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

            // Select: user_account_id
            if (this.data.user_account_id != null || this.data.user_account) {
                var selectElement = $('#user_account_id')
                var data = {
                    id: this.data.user_account_id ? this.data.user_account_id : this.data.user_account.id,
                    text: !!this.data.user_account ? this.data.user_account.name : '',
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