<template>
    <app-layout-auth>
        <template #title>
            Confirm your password
        </template>

        <div class="mb-4">
            This is a secure area of the application. Please confirm your password before continuing.
        </div>

        <StatusMessages class="mb-4" />

        <form @submit.prevent="submit">
            <div class="form-group">
                <label for="password">Password</label>
                <b-form-input id="password" type="password" required="" autofocus autocomplete="current-password" v-model="form.password" :class="[errors.password ? 'is-invalid' : '']">
                </b-form-input>
                <span v-if="errors.password" :class="['label text-danger small']">{{ errors.password }}</span>
            </div>

            <div class="flex justify-end mt-4">
                <b-button class="float-right" id="submit" type="submit" variant="primary">
                    <span class="" role="status" aria-hidden="true"></span>
                    Confirm
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
                form: this.$inertia.form({
                    password: '',
                }),
                pageTitle: 'Confirm your password',
            }
        },

        methods: {
            submit() {
                this.form.post(this.route('password.confirm'), {
                    onFinish: () => this.form.reset(),
                })
            }
        }
    }
</script>
