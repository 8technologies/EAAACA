<template>
    <app-layout-auth>
        <template #title>
            Login
        </template>

        <StatusMessages class="mb-4" />

        <form @submit.prevent="submit">

            <div class="form-group">
                <label for="email">Email</label>

                <b-form-input id="email" type="email" autofocus required="" autocomplete="email" v-model="form.email" :class="[errors.email ? 'is-invalid' : '']">
                </b-form-input>
                <span v-if="errors.email" :class="['label text-danger small']">{{ errors.email }}</span>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <b-form-input id="password" type="password" required="" autocomplete="current-password" v-model="form.password" :class="[errors.password ? 'is-invalid' : '']">
                </b-form-input>
                <span v-if="errors.password" :class="['label text-danger small']">{{ errors.password }}</span>
            </div>

            <div class="form-group row no-gutters">
                <div class="col">
                    <b-form-checkbox
                        id="remember"
                        v-model="form.remember"
                        name="remember">
                        Remember me
                    </b-form-checkbox>
                    <span v-if="errors.remember" :class="['label text-danger small']">{{ errors.remember }}</span>
                </div>
                <div class="col">
                    <inertia-link v-if="canResetPassword" :href="route('password.request')" class="float-right">
                        Forgot your password?
                    </inertia-link>
                </div>
            </div>

            <div class="form-group row no-gutters pt-4">
                <div v-if="route().has('register')" class="col">
                    <inertia-link :href="route('register')" class="mt-2">
                        Register
                    </inertia-link>
                </div>
                
                <div class="col-12">
                    <b-button class="d-block w-100 px-4" id="submit" type="submit" variant="primary">
                        <span class="" role="status" aria-hidden="true"></span>
                        Login
                    </b-button>
                </div>
            </div>

            <!-- <div class="my-4 social-divider border-bottom">
                <span></span>
            </div>

            <div class="justify-end my-4">
                <a :href="route('social.oauth', 'google')" class="btn btn-danger">
                    Google
                </a>
            </div> -->

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
            canResetPassword: Boolean,
            status: String
        },

        data() {
            return {
                form: this.$inertia.form({
                    email: '',
                    password: '',
                    remember: false
                }),
                pageTitle: 'Login',
            }
        },

        methods: {
            submit() {
                this.form
                    .transform(data => ({
                        ... data,
                        remember: this.form.remember ? 'on' : ''
                    }))
                    .post(this.route('login'), {
                        onProgress: (progress) => {
                        },
                        onSuccess: (response) => {
                            // console.log( response )
                            // this.showErrorMessages(response.props.flash.error)
                            // window.location.href = response.url
                            // window.location.replace(response.url)
                        },
                        onError: (errors) => {
                            console.log( 'errors', errors )
                            // this.showErrorMessages(this.errors)
                        },
                        onFinish: () => {
                            this.form.reset('password')
                        },
                    })
            }
        }
    }
</script>
