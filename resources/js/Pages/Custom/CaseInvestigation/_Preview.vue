<template>
    <div>
        <div class="">
            <div class="row">
                <div class="col">
                    <!-- <h5 class="">{{ data.name }}</h5> -->
                </div>
                <div class="col-auto d-inline">
                    <b-button
                        :variant="'primary'" 
                        v-on:click="showCaseFinding({url: route('dashboard.case-findings.create', {case_investigation_id: data.id})})"
                        class="btn-sm p-1">
                        <span class="fa fa-plus"></span> Add Findings
                    </b-button>
                    <b-button
                        :variant="'outline-primary'" 
                        v-on:click="showEdit({url: data.entity_links.url_edit})"
                        class="btn-sm p-1">
                        <span class="fa fa-pencil-alt"></span>
                    </b-button>
                    <b-button
                        :variant="'outline-danger'" 
                        v-on:click="showDelete({url: data.entity_links.url})"
                        class="btn-sm p-1">
                        <span class="fa fa-trash"></span>
                    </b-button>
                </div>
            </div>
            <div class="border-top mt-2 pb-3"></div>
            <EntityShow 
                :data="data">
            </EntityShow>
        </div>

        <entity-modal v-bind:modalAttributes="modalAttributes">
            <dynamic-component :is="modalComponent" v-bind="modalComponentParams"></dynamic-component>
        </entity-modal>

        <entity-modal-delete v-bind:modalAttributes="modalAttributes">
            <dynamic-component :is="deleteComponent" v-bind="deleteComponentParams"></dynamic-component>
        </entity-modal-delete>

    </div>
</template>
<script>
    import FunctionsMixin from '@/Mixins/Functions'
    import EntityComponentsMixin from '@/Mixins/EntityComponents'

    import EntityCreate from '@/Pages/Custom/CaseFinding/_FormCreate'
    import EntityShow from './_FormShow'
    import EntityEdit from './_FormEdit'
    import EntityDelete from './_FormDelete'

    export default {
        mixins: [FunctionsMixin, EntityComponentsMixin],
        props: ['data'],
        data() {
          return {
                form: null,
            }
        },
        components: {
            EntityCreate,
            EntityShow,
            EntityEdit,
            EntityDelete,
        },
        methods: {
            showCaseFinding: function() {
                this.clearComponent()
                // this.$bvModal.show("entity-modal")
                this.$bvModal.show(this.modalAttributes.uuid + '-modal')
                this.modalAttributes.title = "#Add an Case Finding"
                var URL = route('dashboard.case-findings.create', {case_investigation_id: this.data.id})
                axios.get(URL)
                .then(response => {
                    // console.log(response)
                    this.modalComponent = 'EntityCreate'
                    this.modalComponentParams = response
                    // console.log( response )
                })
                .catch(error => {
                    // this.$bvModal.hide("entity-modal")
                    this.$bvModal.hide(this.modalAttributes.uuid + '-modal')
                    // console.log(this)
                    // Handle validation errors
                    this.errors = error;
                    this.success = false;
                    this.showErrorMessages(this.errors)
                });

            },
        },
        // created() {
        //     console.log( this.data )
        // },
    }
</script>