<template>
    <div>
        <b-form @submit="update" :action="route('dashboard.users.update-verified', data.id)" method="PUT">

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
                        <label for="email_verified_at">Email Verified At</label>
                    </b-col>
                    <b-col sm="9">
                        <b-form-input id="email_verified_at" placeholder="Now (current date)" :disabled="data.email_verified_at ? true : false" v-model="form.email_verified_at">
                        </b-form-input>
                        <span v-if="errors.email_verified_at" :class="['label text-danger small']">{{ errors.email_verified_at }}</span>
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
                            :disabled="data.email_verified_at ? true : false"
                            unchecked-value="0"
                            >
                                Notify user after Verification
                        </b-form-checkbox>
                        <span v-if="errors.notify_user" :class="['label text-danger small']">{{ errors.notify_user }}</span>
                    </b-col>
                </b-row>

            </div>

            <div class="row no-gutters justify-content-end mt-3 form-btns-wrapper">
                <b-button class="float-right" id="submit" type="submit" variant="primary"
                    :disabled="data.email_verified_at ? true : false">
                    <span class="" role="status" aria-hidden="true"></span>
                    Update
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
                    email_verified_at: this.data.email_verified_at ? this.data.email_verified_at : '',
                    notify_user: 1,
                }),
            }
        },
    }
</script>
