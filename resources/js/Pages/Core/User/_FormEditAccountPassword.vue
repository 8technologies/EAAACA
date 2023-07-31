<template>
    <div>
        <b-form @submit="update" :action="route('account.updatepassword')" method="PUT">

            <div class="">
                <p></p>
            </div>

            <div class="">
                <b-row class="form-group">
                    <b-col sm="3">
                        <label for="email">Email</label>
                    </b-col>
                    <b-col sm="9">
                        <b-form-input id="email" placeholder="" :disabled="data.email ? true : false" v-model="data.email">
                        </b-form-input>
                    </b-col>
                </b-row>

                <b-row class="form-group">
                    <b-col sm="3">
                        <label for="password">Password</label>
                    </b-col>
                    <b-col sm="9">
                        <b-form-radio-group
                            id="passwordoptions"
                            v-model="form.passwordoptions"
                            name="passwordoptions"
                            stacked>
                            <b-form-radio value="sendresetlink">Send password reset link</b-form-radio>
                            <b-form-radio value="generatenew">Generate a new Password</b-form-radio>
                        </b-form-radio-group>
                    </b-col>
                </b-row>

                <b-row class="form-group">
                    <b-col sm="3">
                        <label>Notify User</label>
                    </b-col>
                    <b-col sm="9">
                        <b-form-checkbox
                            id="notify_user"
                            v-model="form.notify_user"
                            name="notify_user"
                            value="1"
                            unchecked-value="0"
                            >
                                Notify User
                        </b-form-checkbox>
                        <span v-if="errors.notify_user" :class="['label text-danger small']">{{ errors.notify_user }}</span>
                    </b-col>
                </b-row>

            </div>

            <div class="row no-gutters justify-content-end mt-3 form-btns-wrapper">
                <b-button class="float-right" id="submit" type="submit" variant="primary">
                    <span class="" role="status" aria-hidden="true"></span>
                    Submit
                </b-button>
            </div>

        </b-form>
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
                    password: '',
                    passwordoptions: 'sendresetlink',
                    notify_user: 1,
                }),
            }
        },

        methods: {

        },
    }
</script>
