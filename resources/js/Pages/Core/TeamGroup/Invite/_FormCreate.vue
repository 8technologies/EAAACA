<template>
    <div>
        <b-form @submit="inviteMember" :action="route('team-members.store', data)" method="post">

            <div class="">
                <div class="">
                    <p>Add a new team member to your team, allowing them to collaborate with you</p>
                </div>

                <b-row class="form-group">
                    <b-col sm="3">
                        <label for="email">Email</label>
                    </b-col>
                    <b-col sm="9">
                        <b-form-input id="email" placeholder="" required="" autofocus v-model="form.email" :class="[errors.email ? 'is-invalid' : '']">
                        </b-form-input>
                        <span v-if="errors.email" :class="['label text-danger small']">{{ errors.email }}</span>
                    </b-col>
                </b-row>

                <b-row class="form-group">
                    <b-col sm="3">
                        <label for="email">Role</label>
                    </b-col>
                    <b-col sm="9">
                        <b-form-group 
                            v-slot="{ ariaDescribedby }">
                            <b-form-radio-group
                                v-model="form.role"
                                :options="options"
                                :aria-describedby="ariaDescribedby"
                                text-field="name"
                                value-field="key"
                                stacked
                                name="role">
                                </b-form-radio-group>
                        </b-form-group>
                        <span v-if="errors.role" :class="['label text-danger small']">{{ errors.role }}</span>
                    </b-col>
                </b-row>

            </div>

            <div class="form-group">
                <b-button class="" id="submit" type="submit" variant="primary">
                    <span class="" role="status" aria-hidden="true"></span>
                    Submit
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
        props: ['data'],
        data() {
          return {
                form: this.$inertia.form({
                    email: '',
                    role: 'administrator',
                }),
                selected: [],
                options: this.data.availableRoles,
            }
        },

        methods: {

            inviteMember(event) {
                event.preventDefault()
                event.srcElement.submit.firstChild.className += this.spinnerClasses

                this.form.post(route('team-members.store', this.data), {
                    // Add the errorBag for errors to be accessible
                    errorBag: 'addTeamMember',
                    // preserveScroll: true,
                    onSuccess: (page) => {
                        this.refreshBootstrapTable()
                        this.$bvModal.hide("bs-modal")
                        this.$bvModal.hide("entity-modal")
                        this.$bvModal.hide("custom-modal")
                        this.showSuccessMessage(page.props.flash.success)

                        event.srcElement.submit.firstChild.className = ''
                    },
                    onError: (errors) => {
                        this.errors = errors;
                        this.success = false;
                        this.showErrorMessages(this.errors)

                        event.srcElement.submit.firstChild.className = ''
                    }
                });

            },
        },

        // created: function() {
        //     console.log(this.data)
        // },
    }
</script>