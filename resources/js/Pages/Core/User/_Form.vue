<template>
    <div>
        <div class="">
            <b-row class="form-group">
                <b-col sm="3">
                    <label>Image</label>
                </b-col>
                <b-col sm="9">
                    <FieldImage :data="data"></FieldImage>
                </b-col>
            </b-row>

            <b-row class="form-group">
                <b-col sm="3">
                    <label for="name">Name</label>
                </b-col>
                <b-col sm="9">
                    <b-form-input id="name" placeholder="" required="" autocomplete="name" v-model="form.name" :class="[errors.name ? 'is-invalid' : '']">
                    </b-form-input>
                    <span v-if="errors.name" :class="['label text-danger small']">{{ errors.name }}</span>
                </b-col>
            </b-row>

            <b-row class="form-group">
                <b-col sm="3">
                    <label for="email">Email</label>
                </b-col>
                <b-col sm="9">
                    <b-form-input id="email" placeholder="" :disabled="data.email ? true : false" v-model="form.email">
                    </b-form-input>
                </b-col>
            </b-row>

        </div>

        <b-row class="form-group">
            <b-col sm="3">
                <label for="roles">Roles</label>
            </b-col>
            <b-col sm="9">
                <div class="form-group">
                    <div class="">
                        <b-form-group
                            v-slot="{ ariaDescribedby }"
                            >
                            <b-form-checkbox
                                v-for="option in rolesOptions"
                                v-model="form.roles"
                                :key="option.name"
                                :value="option.id"
                                :aria-describedby="ariaDescribedby"
                            >
                            {{ option.name }}
                            </b-form-checkbox>
                        </b-form-group>
                    </div>
                </div>
                <span v-if="errors.roles" :class="['label text-danger small']">{{ errors.roles }}</span>
            </b-col>
        </b-row>

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

    </div>
</template>
<script>
    import MessagesMixin from '@/Mixins/Messages'
    import DBOperationsMixin from '@/Mixins/DBOperations'
    import bootstrapTableMixin from '@/Mixins/Plugins/BootstrapTable'
    import FieldImage from '@/Pages/Core/Field/fieldImage'
    import Select2Mixin from '@/Mixins/Plugins/Select2'

    export default {
        mixins: [MessagesMixin, DBOperationsMixin, bootstrapTableMixin, Select2Mixin],
        props: ['data'],
        data() {
            return {
                form: this.$inertia.form({
                    name: this.data.name ? this.data.name : '',
                    roles: this.data.roles ? this.data.roles.map(item => {return item.id}) : [],
                    organization_id: this.data && this.data.organization_id ? this.data.organization_id : '',
                    email: this.data.email ? this.data.email : '',
                    image: null,
                    image_id: null,
                    photo: null,
                }),
                rolesOptions: this.data.system_roles,
                photoPreview: null,
            }
        },
        components: {
            FieldImage,
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
