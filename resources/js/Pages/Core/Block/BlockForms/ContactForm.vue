<template>
    <div>
        <b-form @submit="create" :action="route('messages.contact.store')" method="POST">
            
            <div class="row">
                <div class="col-md-6">
                    <b-form-group
                        id="input-group-name"
                        label="Name"
                        label-for="name"
                        description=""
                        >
                            <b-form-input id="name" placeholder="Enter name" v-model="form.name" :class="[errors.name ? 'is-invalid' : '']">
                            </b-form-input>
                            <span v-if="errors.name" :class="['label text-danger small']">{{ errors.name }}</span>
                    </b-form-group>

                    <b-form-group
                        id="input-group-email"
                        label="Email"
                        label-for="email"
                        description=""
                        >
                            <b-form-input id="email" type="email" placeholder="Enter Email" v-model="form.email" :class="[errors.email ? 'is-invalid' : '']">
                            </b-form-input>
                            <span v-if="errors.email" :class="['label text-danger small']">{{ errors.email }}</span>
                    </b-form-group>

                    <b-form-group
                        id="input-group-phone_number"
                        label="Phone number"
                        label-for="phone_number"
                        description=""
                        >
                            <b-form-input id="phone_number" placeholder="Enter phone number" v-model="form.phone_number" :class="[errors.phone_number ? 'is-invalid' : '']">
                            </b-form-input>
                            <span v-if="errors.phone_number" :class="['label text-danger small']">{{ errors.phone_number }}</span>
                    </b-form-group>
                </div>
                <div class="col-md-6">
                    <b-form-group
                        id="input-group-message"
                        label="Message"
                        label-for="message"
                        description=""
                        >
                            <b-form-textarea id="message" placeholder="Type your message here"  rows="8" max-rows="8" v-model="form.message" :class="[errors.message ? 'is-invalid' : '']">
                            </b-form-textarea>
                            <span v-if="errors.message" :class="['label text-danger small']">{{ errors.message }}</span>
                    </b-form-group>
                </div>
            </div>

            <div class="row no-gutters justify-content-end mt-3 form-btns-wrapper">
                <b-button class="" id="submit" type="submit" variant="primary">
                    <span v-if="showSpinner" :class="spinnerClasses" role="status" aria-hidden="true"></span>
                    Submit
                </b-button>
            </div>

        </b-form>
    </div>
</template>
<script>
    import MessagesMixin from '@/Mixins/Messages'
    import DBOperationsMixin from '@frontend/Mixins/DBOperations'

    export default {
        mixins: [MessagesMixin, DBOperationsMixin],
        // props: ['data'],
        data() {
          return {
                form: this.$inertia.form({
                    name: '',
                    email: '',
                    phone_number: '',
                    message: '',
                }),
            }
        },
        methods: {
            clearFormValues() {
                this.form.name = ''
                this.form.email = ''
                this.form.phone_number = ''
                this.form.message = ''
            },
        }
    }
</script>