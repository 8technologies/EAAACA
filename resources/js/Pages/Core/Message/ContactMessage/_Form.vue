<template>
    <div>
        <b-row class="form-group">
            <b-col sm="3">
                <label>Name</label>
            </b-col>
            <b-col sm="9">
                <b-form-input id="name" placeholder="Enter name" v-model="form.name" :class="[errors.name ? 'is-invalid' : '']">
                </b-form-input>
                <span v-if="errors.name" :class="['label text-danger small']">{{ errors.name }}</span>
            </b-col>
        </b-row>

        <b-row class="form-group">
            <b-col sm="3">
                <label>Email</label>
            </b-col>
            <b-col sm="9">
                <b-form-input id="email" type="email" placeholder="Enter email" v-model="form.email" :class="[errors.name ? 'is-invalid' : '']">
                </b-form-input>
                <span v-if="errors.email" :class="['label text-danger small']">{{ errors.email }}</span>
            </b-col>
        </b-row>

        <b-row class="form-group">
            <b-col sm="3">
                <label>Phone number</label>
            </b-col>
            <b-col sm="9">
                <b-form-input id="phone_number" placeholder="Enter phone number" v-model="form.phone_number" :class="[errors.phone_number ? 'is-invalid' : '']">
                </b-form-input>
                <span v-if="errors.phone_number" :class="['label text-danger small']">{{ errors.phone_number }}</span>
            </b-col>
        </b-row>

        <b-row class="form-group">
            <b-col sm="3">
                <label>Message</label>
            </b-col>
            <b-col sm="9">
                <b-form-textarea id="message" rows="4" max-rows="6" v-model="form.message" :class="[errors.message ? 'is-invalid' : '']">
                </b-form-textarea>
                <span v-if="errors.message" :class="['label text-danger small']">{{ errors.message }}</span>
            </b-col>
        </b-row>

    </div>
</template>
<script>
    import MessagesMixin from '@/Mixins/Messages'
    import DBOperationsMixin from '@/Mixins/DBOperations'
    import bootstrapTableMixin from '@/Mixins/Plugins/BootstrapTable'

    export default {
        mixins: [MessagesMixin, DBOperationsMixin, bootstrapTableMixin],
        props: ['data'],
        data() {
          return {
                form: this.$inertia.form({
                    name: this.data.name,
                    email: this.data.email,
                    phone_number: this.data.phone_number,
                    message: this.data.message,
                }),
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