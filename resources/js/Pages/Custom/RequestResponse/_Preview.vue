<template>
    <div>
        <div class="">
            <div class="row">
                <div class="col">
                    <div class="text-bold text-uppercase">{{ data.name }}</div>
                </div>
                <div class="col-auto d-inline">
                    <b-button
                        :variant="'outline-primary'" 
                        v-on:click="showAddFeedback({url: route('dashboard.request-responses.getfeedback', data.id)})"
                        class="btn-sm py-1 px-2 rounded-pill">
                        <span class="fa fa-plus"></span> Add Feedback 
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

            <PreviewSummary 
                :data="data">
            </PreviewSummary>
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
    import PreviewSummary from './_PreviewSummary.vue'

    import EntityCreate from './_FormFeedback'
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
            EntityShow,
            EntityEdit,
            EntityDelete,
            EntityCreate,

            PreviewSummary,
        },
        methods: {
            showAddFeedback: function(data) {
            // Use axios to edit in Modal, otherwise inertia will Redirect to a full page
            this.clearComponent()
            // this.$bvModal.show("entity-modal")
            this.$bvModal.show(this.modalAttributes.uuid + '-modal')
            this.modalAttributes.title = '#Add Feedback - '

            axios.get(data.url)
                .then(response => {
                    // console.log(response)
                    this.modalComponent = 'EntityCreate'
                    this.modalComponentParams = response
                        // console.log( response )
                    this.modalAttributes.title = '#Add Feedback - ' + response.data.name;
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
    }
</script>