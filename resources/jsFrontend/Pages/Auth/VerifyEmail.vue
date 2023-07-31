<template>
    <app-layout-auth>
        <template #title>
            Verify your Email
        </template>

        <div class="mb-4">
            Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.
        </div>

        <b-alert v-if="verificationLinkSent" show variant="success" class="mb-4">
            A new verification link has been sent to the email address you provided during registration.
        </b-alert>

        <StatusMessages class="mb-4" />

        <form @submit.prevent="submit">
            <div class="mt-4 justify-between">
                <b-button class="float-right" id="submit" type="submit" variant="primary">
                    <span class="" role="status" aria-hidden="true"></span>
                    Resend Verification Email
                </b-button>

                <inertia-link :href="route('logout')" method="post" as="button" class="btn btn-danger">Logout</inertia-link>
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
                form: this.$inertia.form(),
                pageTitle: 'Verify your Email',
            }
        },

        methods: {
            submit() {
                this.form.post(this.route('verification.send'))
            },
        },

        computed: {
            verificationLinkSent() {
                return this.status === 'verification-link-sent';
            }
        }
    }
</script>
