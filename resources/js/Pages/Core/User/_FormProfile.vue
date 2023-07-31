<template>
    <div>
        <div class="">

            <b-row class="form-group">
                <b-col sm="3">
                    <label for="designation">Designation</label>
                </b-col>
                <b-col sm="9">
                    <b-form-input id="designation" placeholder="Designation" autocomplete="designation" v-model="form.designation" :class="[errors.designation ? 'is-invalid' : '']">
                    </b-form-input>
                    <span v-if="errors.designation" :class="['label text-danger small']">{{ errors.designation }}</span>
                </b-col>
            </b-row>

            <b-row class="form-group">
                <b-col sm="3">
                    <label for="telephone_number">Telephone number</label>
                </b-col>
                <b-col sm="9">
                    <b-form-input id="telephone_number" placeholder="Telephone number" v-model="form.telephone_number" :class="[errors.telephone_number ? 'is-invalid' : '']" class="w-auto">
                    </b-form-input>
                    <span v-if="errors.telephone_number" :class="['label text-danger small']">{{ errors.telephone_number }}</span>
                </b-col>
            </b-row>

            <b-row class="form-group">
                <b-col sm="3">
                    <label for="personal_email">Personal email</label>
                </b-col>
                <b-col sm="9">
                    <b-form-input id="personal_email" placeholder="Personal email" v-model="form.personal_email" :class="[errors.personal_email ? 'is-invalid' : '']" class="w-auto">
                    </b-form-input>
                    <span v-if="errors.personal_email" :class="['label text-danger small']">{{ errors.personal_email }}</span>
                </b-col>
            </b-row>

            <b-row class="form-group">
                <b-col sm="3">
                    <label for="date_joined">Date joined</label>
                </b-col>
                <b-col sm="9">
                    <b-form-input id="date_joined" placeholder="Date joined" v-model="form.date_joined" :class="[errors.date_joined ? 'is-invalid' : '']" class="w-auto">
                    </b-form-input>
                    <span v-if="errors.date_joined" :class="['label text-danger small']">{{ errors.date_joined }}</span>
                </b-col>
            </b-row>

            <b-row class="form-group">
                <b-col sm="3">
                    <label for="dob">Date of  Birth</label>
                </b-col>
                <b-col sm="9">
                    <b-form-input id="dob" placeholder="Enter date of  birth" v-model="form.dob" :class="[errors.dob ? 'is-invalid' : '']" class="w-auto">
                    </b-form-input>
                    <span v-if="errors.dob" :class="['label text-danger small']">{{ errors.dob }}</span>
                </b-col>
            </b-row>

            <b-row class="form-group">
                <b-col sm="3">
                    <label for="passport_number">Passport Number</label>
                </b-col>
                <b-col sm="9">
                    <b-form-input id="passport_number" placeholder="Enter Passport Number" v-model="form.passport_number" :class="[errors.passport_number ? 'is-invalid' : '']" class="w-auto">
                    </b-form-input>
                    <span v-if="errors.passport_number" :class="['label text-danger small']">{{ errors.passport_number }}</span>
                </b-col>
            </b-row>

            <b-row class="form-group">
                <b-col sm="3">
                    <label for="date_joined_organization">Date joined organization</label>
                </b-col>
                <b-col sm="9">
                    <b-form-input id="date_joined_organization" placeholder="Date joined organization" v-model="form.date_joined_organization" :class="[errors.date_joined_organization ? 'is-invalid' : '']" class="w-auto">
                    </b-form-input>
                    <span v-if="errors.date_joined_organization" :class="['label text-danger small']">{{ errors.date_joined_organization }}</span>
                </b-col>
            </b-row>

            <b-row class="form-group">
                <b-col sm="3">
                    <label for="area_of_expertise">Area of expertise</label>
                </b-col>
                <b-col sm="9">
                    <b-form-textarea id="area_of_expertise" rows="3" placeholder="Enter area of expertise" v-model="form.area_of_expertise" :class="[errors.area_of_expertise ? 'is-invalid' : '']">
                    </b-form-textarea>
                    <span v-if="errors.area_of_expertise" :class="['label text-danger small']">{{ errors.area_of_expertise }}</span>
                </b-col>
            </b-row>

            <b-row class="form-group">
                <b-col sm="3">
                    <label for="area_of_training_of_trainer">Area of training of trainer</label>
                </b-col>
                <b-col sm="9">
                    <b-form-textarea id="area_of_training_of_trainer" rows="3" placeholder="Enter area of training of trainer" v-model="form.area_of_training_of_trainer" :class="[errors.area_of_training_of_trainer ? 'is-invalid' : '']">
                    </b-form-textarea>
                    <span v-if="errors.area_of_training_of_trainer" :class="['label text-danger small']">{{ errors.area_of_training_of_trainer }}</span>
                </b-col>
            </b-row>

        </div>

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
                    designation: this.data.designation ? this.data.designation : '',
                    telephone_number: this.data.telephone_number ? this.data.telephone_number : '',
                    personal_email: this.data.personal_email ? this.data.personal_email : '',
                    date_joined: this.data.date_joined ? this.data.date_joined : '',
                    dob: this.data.dob ? this.data.dob : '',
                    passport_number: this.data.passport_number ? this.data.passport_number : '',

                    date_joined_organization: this.data.date_joined_organization ? this.data.date_joined_organization : '',
                    area_of_expertise: this.data.area_of_expertise ? this.data.area_of_expertise : '',
                    area_of_training_of_trainer: this.data.area_of_training_of_trainer ? this.data.area_of_training_of_trainer : '',
                }),
            }
        },
        components: {
        },
        mounted() {

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
