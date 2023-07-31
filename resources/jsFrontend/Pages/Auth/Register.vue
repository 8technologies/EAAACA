<template>
    <app-layout-auth>
        <template #title>
            Register
        </template>

        <StatusMessages class="mb-4" />

        <form @submit.prevent="submit">
            <div class="form-group">
                <label for="name">Name</label>
                <b-form-input id="name" autofocus required="" autocomplete="name" v-model="form.name" :class="[errors.name ? 'is-invalid' : '']">
                </b-form-input>
                <span v-if="errors.name" :class="['label text-danger small']">{{ errors.name }}</span>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <b-form-input id="email" type="email" required="" autocomplete="email" v-model="form.email" :class="[errors.email ? 'is-invalid' : '']">
                </b-form-input>
                <span v-if="errors.email" :class="['label text-danger small']">{{ errors.email }}</span>
            </div>

            <div class="row">
                <div class="col form-group">
                    <label for="password">Password</label>
                    <b-form-input id="password" type="password" required="" autocomplete="current-password" v-model="form.password" :class="[errors.password ? 'is-invalid' : '']">
                    </b-form-input>
                    <span v-if="errors.password" :class="['label text-danger small']">{{ errors.password }}</span>
                </div>

                <div class="col form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <b-form-input id="password_confirmation" type="password" required="" v-model="form.password_confirmation" :class="[errors.password_confirmation ? 'is-invalid' : '']">
                    </b-form-input>
                    <span v-if="errors.password_confirmation" :class="['label text-danger small']">{{ errors.password_confirmation }}</span>
                </div>
            </div>

            <div class="form-group" v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature">
                <b-form-checkbox
                    id="terms"
                    v-model="form.terms"
                    name="terms">
                    I agree to the <a :href="route('terms.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Terms of Service</a> and <a :href="route('policy.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Privacy Policy</a>
                </b-form-checkbox>
                <span v-if="errors.remember" :class="['label text-danger small']">{{ errors.remember }}</span>
            </div>

            <div class="row mt-4">
                <div class="col">
                    <inertia-link :href="route('login')" class="d-block mt-2">
                        Login instead
                    </inertia-link>
                </div>

                <div class="col">
                    <b-button class="float-right px-4" id="submit" type="submit" variant="primary">
                        <span class="" role="status" aria-hidden="true"></span>
                        Register
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

        data() {
            return {
                form: this.$inertia.form({
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    terms: false,
                }),
                pageTitle: 'Register',
            }
        },

        methods: {
            submit() {
                this.form.post(this.route('register'), {
                    onFinish: () => this.form.reset('password', 'password_confirmation'),
                })
            }
        }
    }
</script>
