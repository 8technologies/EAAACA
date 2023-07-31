<template>
    <app-layout>

        <template #header>
        </template>

        <template #breadcrumb>
            <li class="breadcrumb-item">
                <inertia-link :href="route('dashboard')" class="" :active="route().current('dashboard')">
                    Dashboard
                </inertia-link>
            </li>
            <li class="breadcrumb-item">
                <inertia-link :href="route('dashboard.system')">
                    System
                </inertia-link>
            </li>
            <li class="breadcrumb-item active"></li>
        </template>

        <h3 class="">
            Run Artisan Commands
        </h3>

        <div class="my-3">
            <div>
                <b-form @submit="submit" :action="route('dashboard.system.commands')" method="post">

                    <div class="">
                        <div class="form-group">
                            <!-- <label>Command</label> -->
                            <div class="">
                                <b-form-textarea id="command" rows="10" max-rows="12" required
                                    placeholder="Provide a Shell Command to run"
                                    v-model="form.command" 
                                    :class="[errors.command ? 'is-invalid' : '']">
                                </b-form-textarea>
                                <span v-if="errors.command" :class="['label text-danger small']">{{ errors.command }}</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Server response</label>
                            <div :class="responseStatus" role="alert"
                                class="alert"
                                v-html="responseMessage" 
                                style="min-height: 100px;">
                            </div>
                        </div>
                    </div>

                    <div class="row no-gutters w-100 mt-3 form-btns-wrapper">
                        <b-button class="d-block w-100" id="submit" type="submit" variant="primary">
                            <span v-if="showSpinner" :class="spinnerClasses" role="status" aria-hidden="true"></span>
                            Run Command
                        </b-button>
                    </div>

                </b-form>
            </div>
        </div>

    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import SeoMixin from '@/Mixins/SEO'

    import MessagesMixin from '@/Mixins/Messages'
    import DBOperationsMixin from '@/Mixins/DBOperations'

    export default {
        props: ['data'],
        mixins: [SeoMixin, MessagesMixin, DBOperationsMixin],
        components: {
            AppLayout,
        },
        data() {
            return {
                pageTitle: 'Run Artisan Commands',
                form: this.$inertia.form({
                    command: this.data.command,
                }),
                responseMessage: '',
                responseStatus: 'alert-secondary',
            }
        },
        methods: {
            submit: function (event) {
                event.preventDefault()
                event.srcElement.submit.firstChild.className += this.spinnerClasses
                this.showSpinner = true

                var URL = event.target.action

                this.responseMessage = ''
                this.responseStatus = 'alert-secondary'

                this.$inertia.post(URL, this.form, {
                    onProgress: (progress) => {
                        // Handle progress event
                    },
                    onSuccess: (page) => {
                        // Handle success event
                        // console.log( 'page', page )
                        this.responseStatus = 'alert-success'
                        this.responseMessage = page.props.flash.success
                        // this.showSuccessMessage(page.props.flash.success)
                    },
                    onError: (errors) => {
                        // Handle validation errors
                        // console.log( 'errors', errors )
                        this.errors = errors;
                        this.success = false;
                        this.showErrorMessages(this.errors)
                    },
                    onFinish: () => {
                        event.srcElement.submit.firstChild.className = ''
                    }
                })
            },
        },
    }

</script>

