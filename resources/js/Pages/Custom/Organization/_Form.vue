<template>
    <div>

        <b-row class="form-group required">
            <b-col sm="3">
                <label for="name">Name</label>
            </b-col>
            <b-col sm="9">
                <b-form-input id="name" placeholder="Enter Name" required="" v-model="form.name" :class="[errors.name ? 'is-invalid' : '']">
                </b-form-input>
                <span v-if="errors.name" :class="['label text-danger small']">{{ errors.name }}</span>
            </b-col>
        </b-row>

        <b-row class="form-group required">
            <b-col sm="3">
                <label for="member_state_id">Member State</label>
            </b-col>
            <b-col sm="9">
                <div v-if="data && data.member_state" class="border rounded bg-light p-2">
                    {{ data && data.member_state ? data.member_state.name : '' }}
                </div>
                <select2 v-else id="member_state_id" 
                    :name="route('dashboard.member-states.index')" 
                    :options="ajaxOptions" 
                    :settings="{ placeholder: 'Choose a Member State', ajax: ajax, templateResult: formatState, templateSelection: formatState, allowClear: true }" 
                    v-model="form.member_state_id" 
                    :class="[errors.member_state_id ? 'is-invalid' : '']">
                </select2>
                <span v-if="errors.member_state_id" :class="['label text-danger small']">{{ errors.member_state_id }}</span>
            </b-col>
        </b-row>

        <b-row class="form-group required">
            <b-col sm="3">
                <label for="address">Address</label>
            </b-col>
            <b-col sm="9">
                <b-form-input id="address" placeholder="Enter Address" required="" v-model="form.address" :class="[errors.address ? 'is-invalid' : '']">
                </b-form-input>
                <span v-if="errors.address" :class="['label text-danger small']">{{ errors.address }}</span>
            </b-col>
        </b-row>

        <b-row class="form-group required">
            <b-col sm="3">
                <label for="telephone">Telephone</label>
            </b-col>
            <b-col sm="9">
                <b-form-input id="telephone" placeholder="Enter telephone" v-model="form.telephone" :class="[errors.telephone ? 'is-invalid' : '']">
                </b-form-input>
                <span v-if="errors.telephone" :class="['label text-danger small']">{{ errors.telephone }}</span>
            </b-col>
        </b-row>

        <b-row class="form-group required">
            <b-col sm="3">
                <label for="fax">Fax</label>
            </b-col>
            <b-col sm="9">
                <b-form-input id="fax" placeholder="Enter fax" v-model="form.fax" :class="[errors.fax ? 'is-invalid' : '']">
                </b-form-input>
                <span v-if="errors.fax" :class="['label text-danger small']">{{ errors.fax }}</span>
            </b-col>
        </b-row>

        <b-row class="form-group required">
            <b-col sm="3">
                <label for="email">Email</label>
            </b-col>
            <b-col sm="9">
                <b-form-input id="email" placeholder="Enter email" v-model="form.email" :class="[errors.email ? 'is-invalid' : '']">
                </b-form-input>
                <span v-if="errors.email" :class="['label text-danger small']">{{ errors.email }}</span>
            </b-col>
        </b-row>

        <b-row class="form-group required">
            <b-col sm="3">
                <label for="description">Description</label>
            </b-col>
            <b-col sm="9">
                <ckeditor :editor="editor" v-model="form.description" :config="editorConfig" :class="[errors.description ? 'is-invalid' : '']"></ckeditor>
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
                    address: this.data.address,
                    telephone: this.data.telephone,
                    fax: this.data.fax,
                    email: this.data.email,
                    member_state_id: this.data && this.data.member_state_id ? this.data.member_state_id : '',

                }),
            }
        },
        mounted() {
            // Select: member_state_id
            if (this.data.member_state_id != null || this.data.member_state) {
                var selectElement = $('#member_state_id')
                var data = {
                    id: this.data.member_state_id ? this.data.member_state_id : this.data.member_state.id,
                    text: !!this.data.member_state ? this.data.member_state.name : '',
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