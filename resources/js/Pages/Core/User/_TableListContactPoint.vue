<template>

    <div class="">
        <!-- <div id="toolbar">
            <b-link :href="createUrl" class="add-item btn btn-primary">
                <span class="fa fa-plus"></span> Add
            </b-link>
        </div> -->

        <BootstrapTable
            :id="tableID"
            ref="bootstrapTable"
            :columns="columns"
            :options="options"
            :data-url="baseUrl"
            :data-base="url">
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
    import FunctionsMixin from '@/Mixins/Functions'

    import FormShow from './_FormShow'
    import FormCreate from './_FormCreate'
    import FormEdit from './_FormEdit'

    import FormEditProfile from './_FormEditProfile'
    
    export default {
        mixins: [
            BootstrapTableMixin,
            ModalComponentsMixin,
            Select2Mixin,
            FunctionsMixin,
        ],
        props: {
            'createUrl': {
                type: String,
                default: route('dashboard.users.index'),
            },
            'baseUrl': {
                type: String,
                default: route('dashboard.contact-points.index'),
            },
            'url': {
                type: String,
                default: route('dashboard.users.index'),
            },
        },
        components: {
            FormShow,
            FormCreate,
            FormEdit,

            FormEditProfile,
        },
        data() {
            return {
                addModalTitle: '#Add a Contact Point',
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
                    field: 'roles',
                    title: 'Roles',
                    width: '150',
                    formatter: (value, row) => {
                        return `
                            <div class="text-break">${ this.objectNameListFormatter(value, row) }</div>
                        ` 
                    },
                }, {
                    field: 'organization_id',
                    title: 'Organization',
                    width: '150',
                    formatter: (value, row) => {
                        return row.organization ? row.organization.name : value;
                    },
                }, {
                    field: 'email',
                    title: 'Email',
                    sortable: 'true',
                    width: '250',
                    formatter: (value, row) => {
                        return `
                            <div class="text-break">${ this.emailFormatter(value, row) }</div>
                        ` 
                    },
                }, {
                    field: 'telephone_number',
                    title: 'Telephone',
                    width: '150',
                }, {
                    field: 'enabled',
                    title: 'Enabled',
                    width: '50',
                    formatter: (value, row) => {
                        return this.formatEnabled(value, row);
                    },
                }, {
                    field: 'actions',
                    title: 'Actions',
                    width: '65',
                    visible: false,
                    formatter: (value, row) => {
                        return this.actionFormatter(value, row)
                    },
                }
            ]
            }
        },
        mounted() {
            
        },
        beforeDestroy () {
            $('body').off('click')
        },
        methods: {

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
