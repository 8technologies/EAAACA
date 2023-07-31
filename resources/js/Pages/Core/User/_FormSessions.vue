<template>
    <div>
        <b-form @submit="logoutOtherBrowserSessions">

            <div class="">
                <p>Your account has multiple active browser sessions. Some of your recent sessions are listed in the "Browser Sessions" tab; however, this list may not be exhaustive. If you feel your account has been compromised, you should also update your password.</p>
                <p>Please enter your password to confirm you would like to logout of your other browser sessions across all of your devices.</p>
            </div>

            <div class="">

                <b-row class="form-group">
                    <b-col sm="3">
                        <label for="password">Password</label>
                    </b-col>
                    <b-col sm="9">
                        <b-form-input id="password" type="password" placeholder="Password" autofocus v-model="form.password" :class="[errors.password ? 'is-invalid' : '']">
                        </b-form-input>
                        <span v-if="errors.password" :class="['label text-danger small']">{{ errors.password }}</span>
                    </b-col>
                </b-row>

            </div>

            <div class="my-3">
                <b-button class="float-right" id="submit" type="submit" variant="danger">
                    <span class="" role="status" aria-hidden="true"></span>
                    Logout Other Browser Sessions
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
        // props: ['data'],
        data() {
            return {
                form: this.$inertia.form({
                    password: '',
                })
            }
        },

        methods: {

            logoutOtherBrowserSessions(event) {
                event.preventDefault()
                event.srcElement.submit.firstChild.className += this.spinnerClasses

                this.form.delete(route('other-browser-sessions.destroy'), {
                    preserveScroll: true,
                    onSuccess: response => {
                        this.$bvModal.hide("custom-modal-delete")
                        this.showSuccessMessage('You have been logged out from other browser sessions')
                        event.srcElement.submit.firstChild.className = ''
                    },
                    onError: (errors) => {
                        this.errors = errors;
                        this.success = false;
                        this.showErrorMessages(this.errors)
                        event.srcElement.submit.firstChild.className = ''
                    },
                    // onFinish: () => this.form.reset(),
                })
            },

        },

        // created: function() {
        //     console.log(this)
        // }
    }
</script>