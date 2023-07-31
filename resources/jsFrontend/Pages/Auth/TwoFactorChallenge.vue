<template>
    <app-layout-auth>
        <template #title>
            Reset your Password
        </template>

        <div class="mb-4">
            <template v-if="! recovery">
                Please confirm access to your account by entering the authentication code provided by your authenticator application.
            </template>

            <template v-else>
                Please confirm access to your account by entering one of your emergency recovery codes.
            </template>
        </div>

        <StatusMessages class="mb-4" />

        <form @submit.prevent="submit">
            <div v-if="! recovery">
                <div class="form-group">
                    <label for="code">Code</label>
                    <b-form-input id="code" ref="code" type="text" inputmode="numeric" required autofocus autocomplete="one-time-code" v-model="form.code" :class="[errors.code ? 'is-invalid' : '']">
                    </b-form-input>
                    <span v-if="errors.code" :class="['label text-danger small']">{{ errors.code }}</span>
                </div>
            </div>

            <div v-else>
                <div class="form-group">
                    <label for="recovery_code">Recovery Code</label>
                    <b-form-input id="recovery_code" ref="recovery_code" type="text" required autocomplete="one-time-code" v-model="form.recovery_code" :class="[errors.recovery_code ? 'is-invalid' : '']">
                    </b-form-input>
                    <span v-if="errors.recovery_code" :class="['label text-danger small']">{{ errors.recovery_code }}</span>
                </div>
            </div>

            <div class="justify-end mt-4">
                <button type="button" class="text-sm text-gray-600 hover:text-gray-900 underline cursor-pointer" @click.prevent="toggleRecovery">
                    <template v-if="! recovery">
                        Use a recovery code
                    </template>

                    <template v-else>
                        Use an authentication code
                    </template>
                </button>
                <b-button class="float-right" id="submit" type="submit" variant="primary">
                    <span class="" role="status" aria-hidden="true"></span>
                    Login
                </b-button>
            </div>
        </form>
    </app-layout-auth>
</template>

<script>
    import AppLayoutAuth from '@frontend/Layouts/AppLayoutAuth'
    import SeoMixin from '@/Mixins/SEO'

    import MessagesMixin from '@frontend/Mixins/Messages'
    import DBOperationsMixin from '@frontend/Mixins/DBOperations'

    export default {
        mixins: [MessagesMixin, DBOperationsMixin, SeoMixin],
        components: {
            AppLayoutAuth,
        },

        data() {
            return {
                recovery: false,
                form: this.$inertia.form({
                    code: '',
                    recovery_code: '',
                }),
                pageTitle: 'Two Factor Challenge',
            }
        },

        methods: {
            toggleRecovery() {
                this.recovery ^= true

                this.$nextTick(() => {
                    if (this.recovery) {
                        this.$refs.recovery_code.focus()
                        this.form.code = '';
                    } else {
                        this.$refs.code.focus()
                        this.form.recovery_code = ''
                    }
                })
            },

            submit() {
                this.form.post(this.route('two-factor.login'))
            }
        }
    }
</script>
