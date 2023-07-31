<template>

    <div class="">
        <div id="toolbar">
            <b-link :href="route('dashboard.users.create')" class="add-item btn btn-primary">
                <span class="fa fa-plus"></span> Add
            </b-link>

            <b-dropdown id="dropdown-filters" variant="outline-secondary" ref="dropdown" class="dropdown-filters" no-caret>
                <template #button-content>
                    <i class="fa fa-filter"></i>
                </template>
                <b-dropdown-form>
                <div class="row">
                    <div class="col-md-3 form-group">
                        <label>Roles</label>
                        <select2 id="role" @change="refreshBootstrapTable()" :name="route('dashboard.roles.index')" :settings="{ placeholder: 'Role', ajax: ajax, templateResult: formatState, templateSelection: formatState }">
                        </select2>
                    </div>
                </div>
                </b-dropdown-form>
                <b-dropdown-divider></b-dropdown-divider>
                <div class="px-2">
                    <b-link href="#" class="btn btn-default clear-Filters w-100 d-block">
                        Reset Filters
                    </b-link>
                </div>
            </b-dropdown>
        </div>

        <BootstrapTable
            :id="tableID"
            ref="bootstrapTable"
            :columns="columns"
            :options="options"
            :data-url="route('dashboard.users.index')">
        </BootstrapTable>

        <bs-modal v-bind:modalAttributes="modalAttributes">
            <dynamic-component :is="modalComponent" v-bind="modalComponentParams"></dynamic-component>
        </bs-modal>

        <bs-modal-delete v-bind:modalAttributes="modalAttributes">
            <component :is="deleteComponent" v-bind="deleteComponentParams"></component>
        </bs-modal-delete>

    </div>

</template>

<script>
    import ModalComponentsMixin from '@/Mixins/ModalComponents'
    import BootstrapTableMixin from '@/Mixins/Plugins/BootstrapTable'
    import Select2Mixin from '@/Mixins/Plugins/Select2'

    import FormShow from './_FormShow'
    import FormCreate from './_FormCreate'
    import FormEdit from './_FormEdit'
    import FormDelete from './_FormDelete'
    import FormEditVerified from './_FormEditVerified'
    import FormEditEnabled from './_FormEditEnabled'
    import FormEditPassword from './_FormEditPassword'

    import FormEditProfile from './_FormEditProfile'
    
    export default {
        mixins: [
            BootstrapTableMixin,
            ModalComponentsMixin,
            Select2Mixin,
        ],
        components: {
            FormShow,
            FormCreate,
            FormEdit,
            FormDelete,

            FormEditVerified,
            FormEditEnabled,
            FormEditPassword,

            FormEditProfile,
        },
        data() {
            return {
                addModalTitle: '#Add a User',
                columns: [{
                    field: 'state',
                    checkbox: true
                }, {
                    title: 'ID',
                    field: 'id',
                    sortable: 'true',
                    width: '50',
                    visible: false
                }, {
                    field: 'thumbnail',
                    title: '',
                    width: '80',
                    class: 'img-rounded-circle',
                    formatter: (value, row) => {
                        return this.imageUrlFormatter(value, row);
                    },
                }, {
                    field: 'name',
                    title: 'Name',
                    sortable: 'true',
                    formatter: (value, row) => {
                        return this.nameFormatter(value, row);
                    },
                }, {
                    field: 'email',
                    title: 'Email',
                    sortable: 'true',
                    width: '220',
                    formatter: (value, row) => {
                        return `
                            <div class="text-break">${ this.emailFormatter(value, row) }</div>
                        ` 
                    },
                }, {
                    field: 'roles',
                    title: 'Roles',
                    width: '130',
                    formatter: (value, row) => {
                        return `
                            <div class="text-break">${ this.objectNameListFormatter(value, row) }</div>
                        ` 
                    },
                }, {
                    field: 'password',
                    title: 'Password',
                    width: '50',
                    formatter: (value, row) => {
                        return this.actionFormatterPassword(value, row)
                    },
                }, {
                    field: 'email_verified_at',
                    title: 'Verified',
                    width: '50',
                    formatter: (value, row) => {
                        return this.actionFormatterVerified(value, row)
                    },
                }, {
                    field: 'enabled',
                    title: 'Enabled',
                    width: '50',
                    formatter: (value, row) => {
                        return this.actionFormatterEnabled(value, row);
                    },
                }, {
                    field: 'profile',
                    title: 'Profile',
                    width: '50',
                    formatter: (value, row) => {
                        return this.actionFormatterProfile(value, row);
                    },
                }, {
                    field: 'actions',
                    title: 'Actions',
                    width: '65',
                    formatter: (value, row) => {
                        return this.actionFormatter(value, row)
                    },
                }]
            }
        },
        mounted() {
            $('body').on('click', '.bootstrap-table a.edit-verified', (e) => {
                e.preventDefault()
                var el = $(e.currentTarget)
                var dataArray = {
                    'url':  el.attr('href'),
                }
                this.showEditVerified(dataArray)
            });
            $('body').on('click', '.bootstrap-table a.edit-enabled', (e) => {
                e.preventDefault()
                var el = $(e.currentTarget)
                var dataArray = {
                    'url':  el.attr('href'),
                }
                this.showEditEnabled(dataArray)
            });
            $('body').on('click', '.bootstrap-table a.edit-password', (e) => {
                e.preventDefault()
                var el = $(e.currentTarget)
                var dataArray = {
                    'url':  el.attr('href'),
                }
                this.showEditPassword(dataArray)
            });


            $('body').on('click', '.bootstrap-table a.edit-profile', (e) => {
                e.preventDefault()
                var el = $(e.currentTarget)
                var dataArray = {
                    'url':  el.attr('href'),
                }
                this.showEditProfile(dataArray)
            });
        },
        beforeDestroy () {
            $('body').off('click')
        },
        methods: {
            showEditVerified: function(data) {
                // Use axios to edit in Modal, otherwise inertia will Redirect to a full page
                this.clearComponent()
                this.$bvModal.show("bs-modal")
                this.modalAttributes.title = '#Verification - '

                axios.get(data.url)
                    .then(response => {
                        // console.log(response)
                        this.modalComponent = 'FormEditVerified'
                        this.modalComponentParams = response
                        // console.log( response )
                        this.modalAttributes.title = '#Verification Status - ' + response.data.name + '\'s Account';
                    })
                    .catch(error => {
                        this.$bvModal.hide("bs-modal")
                        // Handle validation errors
                        this.errors = error;
                        this.success = false;
                        this.showErrorMessages(this.errors)
                    });
            },
            showEditEnabled: function(data) {
                // Use axios to edit in Modal, otherwise inertia will Redirect to a full page
                this.clearComponent()
                this.$bvModal.show("bs-modal")
                this.modalAttributes.title = '#Account Status - '

                axios.get(data.url)
                    .then(response => {
                        // console.log(response)
                        this.modalComponent = 'FormEditEnabled'
                        this.modalComponentParams = response
                        // console.log( response )
                        this.modalAttributes.title = '#Account Status - ' + response.data.name;
                    })
                    .catch(error => {
                        this.$bvModal.hide("bs-modal")
                        // Handle validation errors
                        this.errors = error;
                        this.success = false;
                        this.showErrorMessages(this.errors)
                    });
            },
            showEditPassword: function(data) {
                // Use axios to edit in Modal, otherwise inertia will Redirect to a full page
                this.clearComponent()
                this.$bvModal.show("bs-modal")
                this.modalAttributes.title = '#Manage Password - '

                axios.get(data.url)
                    .then(response => {
                        // console.log(response)
                        this.modalComponent = 'FormEditPassword'
                        this.modalComponentParams = response
                        // console.log( response )
                        this.modalAttributes.title = '#Manage ' + response.data.name + '\'s Password';
                    })
                    .catch(error => {
                        this.$bvModal.hide("bs-modal")
                        // Handle validation errors
                        this.errors = error;
                        this.success = false;
                        this.showErrorMessages(this.errors)
                    });
            },


            showEditProfile: function(data) {
                // Use axios to edit in Modal, otherwise inertia will Redirect to a full page
                this.clearComponent()
                this.$bvModal.show("bs-modal")
                this.modalAttributes.title = '#Update Profile - '

                axios.get(data.url)
                    .then(response => {
                        // console.log(response)
                        this.modalComponent = 'FormEditProfile'
                        this.modalComponentParams = response
                        // console.log( response )
                        this.modalAttributes.title = '#Update ' + response.data.name + '\'s Profile';
                    })
                    .catch(error => {
                        this.$bvModal.hide("bs-modal")
                        // Handle validation errors
                        this.errors = error;
                        this.success = false;
                        this.showErrorMessages(this.errors)
                    });
            },
        }
    }

</script>
