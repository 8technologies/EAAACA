<template>
    <app-layout>

        <template #header>
        </template>

        <div class="text-center">
            <div class="mb-3">
                <b-img thumbnail fluid class="img-circle" style="height:150px;width:auto"
                    :src="user.thumbnail" 
                    :alt="user.name">
                </b-img>
            </div>
            <h2 class="font-weight-normal">
                Welcome, {{ user.name }}
            </h2>
            <p class="">Manage your account and change your password</p>
        </div>

        <div class="">
            <b-card class="border mb-2">
                <div class="row mb-3">
                    <div class="col">
                        <h4 class="card-title">Account info</h4>
                        <h6 class="card-subtitle mb-2 text-muted">Your basic profile information</h6>
                    </div>
                    <div class="col-auto">
                        <b-button v-on:click="showEditAccount($event)" class="btn-sm" variant="outline-primary">
                            <span class="fa fa-pencil-alt"></span> Edit
                        </b-button>
                    </div>
                    <div class="col-12">
                        <div class="border-bottom"></div>
                    </div>
                </div>
                
                <table class="table mb-0 table- table-no-spacing">
                <tbody>
                    <tr>
                        <td width="200px" class="border-0" vertical-align="middle">
                            Avatar
                        </td>
                        <td class="border-0">
                            <b-img fluid class="img-circle" style="height:50px;width:auto"
                                :src="data.thumbnail" 
                                :alt="data.name">
                            </b-img>
                        </td>
                    </tr>
                    <tr>
                    <tr>
                        <td>Name</td>
                        <td>{{ data.name }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{ data.email }}</td>
                    </tr>
                    <tr>
                        <td>Roles</td>
                        <td>
                            <div v-if="data.roles" class="" v-html="formatTags(data.roles)"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>Organization</td>
                        <td>
                            <div v-if="data.organization" class="">
                                {{ data.organization.name }}, {{ data.organization.member_state ? data.organization.member_state.name : '' }}
                            </div>
                        </td>
                    </tr>
                </tbody>
                </table>
            </b-card>
        </div>

        <div class="row">
            <div class="col-md-6 my-2">
                <b-card class="border h-100">
                    <div class="row mb-3">
                        <div class="col">
                            <h4 class="card-title">Password</h4>
                            <h6 class="card-subtitle mb-2 text-muted">Change your account's password</h6>
                        </div>
                        <div class="col-auto">
                            <b-button v-on:click="showEditAccountPassword()" class="btn-sm" variant="outline-primary">
                                <span class="fa fa-pencil-alt"></span> Edit
                            </b-button>
                        </div>
                        <div class="col-12">
                            <div class="border-bottom"></div>
                        </div>
                    </div>

                    <b-card-text>
                        .......
                    </b-card-text>
                </b-card>
            </div>
            <div class="col-md-6 my-2">
                <b-card class="border h-100">
                    <div class="row mb-3">
                        <div class="col">
                            <h4 class="card-title">Sessions</h4>
                            <h6 class="card-subtitle mb-2 text-muted">{{ data.sessions.length + ' (Active Browser Sessions)' }}</h6>
                        </div>
                        <div class="col-auto">
                            <b-button v-on:click="logoutFromOtherDevices()" class="btn-sm" variant="outline-primary">
                                <i class="fa fa-sign-out"></i> Logout other Sessions
                            </b-button>
                        </div>
                        <div class="col-12">
                            <div class="border-bottom"></div>
                        </div>
                    </div>

                    <table class="table m-0 table- table-no-spacing">
                    <thead>
                        <tr>
                            <th scope="col" width="5px">#</th>
                            <th scope="col">Agent</th>
                            <th scope="col">Last active</th>
                            <th scope="col">Current device</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in data.sessions" v-bind:key="'sessions'+index">
                            <td>{{ index+1 }}</td>
                            <td>{{ item.agent.browser }} ({{ item.agent.platform }})</td>
                            <td>{{ item.last_active }}</td>
                            <td>{{ item.is_current_device }}</td>
                        </tr>
                    </tbody>
                    </table>
                </b-card>
            </div>
        </div>


        <div class="mt-2">
            <b-card class="border mb-2">
                <div class="row mb-3">
                    <div class="col">
                        <h4 class="card-title">Profile Info</h4>
                        <h6 class="card-subtitle mb-2 text-muted">Your profile information</h6>
                    </div>
                    <div class="col-auto">
                        <b-button v-on:click="showEditAccountProfile($event)" class="btn-sm" variant="outline-primary">
                            <span class="fa fa-pencil-alt"></span> Edit
                        </b-button>
                    </div>
                    <div class="col-12">
                        <div class="border-bottom"></div>
                    </div>
                </div>
                
                <table class="table mb-0 table- table-no-spacing">
                <tbody>
                    <tr>
                        <td width="200px" class="border-0">Designation</td>
                        <td class="border-0">{{ data.designation ? data.designation : '' }}</td>
                    </tr>
                    <tr>
                        <td>Telephone Number</td>
                        <td>{{ data.telephone_number ? data.telephone_number : '' }}</td>
                    </tr>
                    <tr>
                        <td>Personal email</td>
                        <td>{{ data.personal_email ? data.personal_email : '' }}</td>
                    </tr>
                    <tr>
                        <td>Date joined</td>
                        <td>{{ data.date_joined }}</td>
                    </tr>
                    <tr>
                        <td>Date of Birth</td>
                        <td>{{ data.dob }}</td>
                    </tr>
                    <tr>
                        <td>Passport Number</td>
                        <td>{{ data.passport_number ? data.passport_number : '' }}</td>
                    </tr>
                    <tr>
                        <td>Date joined organization</td>
                        <td>{{ data.date_joined_organization ? data.date_joined_organization : '' }}</td>
                    </tr>
                    <tr>
                        <td>Area of expertise</td>
                        <td>
                            <div class="" v-html="data.area_of_expertise ? data.area_of_expertise : ''"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>Area of training of trainer</td>
                        <td>
                            <div class="" v-html="data.area_of_training_of_trainer ? data.area_of_training_of_trainer : ''"></div>
                        </td>
                    </tr>
                    
                </tbody>
                </table>
            </b-card>
        </div>


        <slot></slot>

        <bs-modal v-bind:modalAttributes="modalAttributes">
            <dynamic-component :is="modalComponent" v-bind="modalComponentParams"></dynamic-component>
        </bs-modal>

        <bs-modal-delete v-bind:modalAttributes="modalAttributes">
            <component :is="deleteComponent" v-bind="deleteComponentParams"></component>
        </bs-modal-delete>

    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import FunctionsMixin from '@/Mixins/Functions'
    import EntityComponentsMixin from '@/Mixins/EntityComponents'
    import ModalComponentsMixin from '@/Mixins/ModalComponents'
    import SeoMixin from '@/Mixins/SEO'

    import FormEditAccount from './_FormEditAccount'
    import FormEditAccountPassword from './_FormEditAccountPassword'
    import FormEditAccountProfile from './_FormEditAccountProfile'

    import FormSessions from './_FormSessions'
    import CustomModalDelete from '@/Components/CustomModalDelete'

    export default {
        mixins: [SeoMixin, FunctionsMixin, EntityComponentsMixin, ModalComponentsMixin],
        props: ['data'],
        data() {
            return {
                pageTitle: 'Account',
                user: this.$page.props.user
            }
        },
        components: {
            AppLayout,
            FormSessions,
            CustomModalDelete,

            FormEditAccount,
            FormEditAccountPassword,
            FormEditAccountProfile,
        },
        // created() {
        //     console.log( this.data )
        // },
        methods: {
            showSessionLogoutForm: function() {
                this.clearComponent()
                this.modalComponent = 'FormSessions'
                this.modalComponentParams = ''
                this.modalAttributes.title = '#Logout Other Browser Sessions';
                this.$bvModal.show("custom-modal-delete") 
            },
            showEditAccount: function(event) {
                // Use axios to edit in Modal, otherwise inertia will Redirect to a full page
                this.clearComponent()
                this.$bvModal.show("bs-modal")
                this.modalAttributes.title = '#Edit account'

                var url = route('account.edit')

                axios.get(url)
                    .then(response => {
                        this.modalComponent = 'FormEditAccount'
                        this.modalComponentParams = response
                    })
                    .catch(error => {
                        this.$bvModal.hide("bs-modal")
                        // Handle validation errors
                        this.errors = error;
                        this.success = false;
                        this.showErrorMessages(this.errors)
                    });
            },
            showEditAccountPassword: function() {
                // Use axios to edit in Modal, otherwise inertia will Redirect to a full page
                this.clearComponent()
                this.$bvModal.show("bs-modal")
                this.modalAttributes.title = '#Edit password'

                var url = route('account.edit')

                axios.get(url)
                    .then(response => {
                        this.modalComponent = 'FormEditAccountPassword'
                        this.modalComponentParams = response
                    })
                    .catch(error => {
                        this.$bvModal.hide("bs-modal")
                        // Handle validation errors
                        this.errors = error;
                        this.success = false;
                        this.showErrorMessages(this.errors)
                    });
            },

            logoutFromOtherDevices: function () {
                this.clearComponent()
                this.$bvModal.show("bs-modal")
                this.modalAttributes.title = '#logging out from other devices'

                var URL = route('account.logoutfromotherdevices')

                this.$inertia.post(URL, [], {
                    onProgress: (progress) => {
                        // Handle progress event
                    },
                    onSuccess: (page) => {
                        // Handle success event
                        // console.log( 'page', page )
                        // if (typeof this.refreshBootstrapTable === 'function') {this.refreshBootstrapTable()}
                        if (typeof this.closeEntityModal === 'function') {this.closeEntityModal()}
                        this.showSuccessMessage(page.props.flash.success)
                    },
                    onError: (errors) => {
                        // Handle validation errors
                        // console.log( 'errors', errors )
                        this.errors = errors;
                        this.success = false;
                        this.showErrorMessages(this.errors)
                    },
                    onFinish: () => {
                        // event.srcElement.submit.firstChild.className = ''
                    }
                })
            },




            showEditAccountProfile: function(event) {
                // Use axios to edit in Modal, otherwise inertia will Redirect to a full page
                this.clearComponent()
                this.$bvModal.show("bs-modal")
                this.modalAttributes.title = '#Edit Profile'

                var url = route('account.edit-profile')

                axios.get(url)
                    .then(response => {
                        this.modalComponent = 'FormEditAccountProfile'
                        this.modalComponentParams = response
                    })
                    .catch(error => {
                        this.$bvModal.hide("bs-modal")
                        // Handle validation errors
                        this.errors = error;
                        this.success = false;
                        this.showErrorMessages(this.errors)
                    });
            },

        },

    }
</script>