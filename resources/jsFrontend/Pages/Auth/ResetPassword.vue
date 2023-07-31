<template>
    <app-layout-auth>
        <template #title>
            Reset your Password
        </template>

        <StatusMessages class="mb-4" />

        <form @submit.prevent="submit">
            <div class="form-group">
                <label for="email">Email</label>
                <b-form-input id="email" type="email" required autofocus autocomplete="email" v-model="form.email" :class="[errors.email ? 'is-invalid' : '']">
                </b-form-input>
                <span v-if="errors.email" :class="['label text-danger small']">{{ errors.email }}</span>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <b-form-input id="password" type="password" required autocomplete="new-password" v-model="form.password" :class="[errors.password ? 'is-invalid' : '']">
                </b-form-input>
                <span v-if="errors.password" :class="['label text-danger small']">{{ errors.password }}</span>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <b-form-input id="password_confirmation" type="password" required autocomplete="new-password" v-model="form.password_confirmation" :class="[errors.password_confirmation ? 'is-invalid' : '']">
                </b-form-input>
                <span v-if="errors.password_confirmation" :class="['label text-danger small']">{{ errors.password_confirmation }}</span>
            </div>

            <div class="justify-end mt-4">
                <b-button class="float-right" id="submit" type="submit" variant="primary">
                    <span class="" role="status" aria-hidden="true"></span>
                    Reset Password
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

        props: {
            email: String,
            token: String,
        },

        data() {
            return {
                form: this.$inertia.form({
                    token: this.token,
                    email: this.email,
                    password: '',
                    password_confirmation: '',
                }),
                pageTitle: 'Reset your Password',
            }
        },

        methods: {
            submit() {
                this.form.post(this.route('password.update'), {
                    onFinish: () => this.form.reset('password', 'password_confirmation'),
                })
            }
        }
    }
</script>
