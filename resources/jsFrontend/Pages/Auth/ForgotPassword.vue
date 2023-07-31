<template>
    <app-layout-auth>
        <template #title>
            Reset your Password
        </template>

        <div class="mb-4">
            Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
        </div>

        <StatusMessages class="mb-4" />

        <form @submit.prevent="submit">
            <div class="form-group">
                <label for="email">Email</label>
                <b-form-input id="email" type="email" required autofocus v-model="form.email" :class="[errors.email ? 'is-invalid' : '']">
                </b-form-input>
                <span v-if="errors.email" :class="['label text-danger small']">{{ errors.email }}</span>
            </div>

            <div class="row no-gutters mt-4">
                <div class="col-">
                    <inertia-link :href="route('login')" class="d-block mt-2">
                        Back to login
                    </inertia-link>
                </div>

                <div class="col">
                    <b-button class="float-right" id="submit" type="submit" variant="primary">
                        <span class="" role="status" aria-hidden="true"></span>
                        Email Password Reset Link
                    </b-button>
                </div>
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

        props: {
            status: String
        },

        data() {
            return {
                form: this.$inertia.form({
                    email: ''
                }),
                pageTitle: 'Password Reset',
            }
        },

        methods: {
            submit() {
                this.form.post(this.route('password.email'), {
                    onProgress: (progress) => {
                    },
                    onSuccess: (response) => {
                        // console.log( response )
                    },
                    onError: (errors) => {
                        // console.log( 'errors', errors )
                    },
                    onFinish: () => {
                    },
                })
            }
        }
    }
</script>
