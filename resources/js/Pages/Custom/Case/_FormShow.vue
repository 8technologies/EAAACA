<template>
    <div class="">

        <table class="table table-borderless table-sm table-no-spacing">
            <tbody>
                <tr>
                    <td></td>
                    <td>
                        <div class="">
                            <b-button
                                :variant="'outline-primary'" 
                                v-on:click="showEdit({url: data.entity_links.url_edit})"
                                class="btn-sm p-1">
                                <span class="fa fa-pencil-alt"></span> Edit Case
                            </b-button>
                            <b-button
                                :variant="'outline-danger'" 
                                v-on:click="showDelete({url: data.entity_links.url})"
                                class="btn-sm p-1">
                                <span class="fa fa-trash"></span> Delete Case
                            </b-button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="200px">Case Description</td>
                    <td><div class="border p-3 rounded bg-white" v-html="data.description"></div></td>
                </tr>
                <tr>
                    <td>Case Attachments</td>
                    <td>
                        <div class="border p-3 rounded bg-white">
                        <div v-if="data.media_attachments[0]">
                            <FileDownload v-for="(item, index) in data.media_attachments" v-bind:key="item.uid"
                                :data="data" 
                                :mediaEntity="item"
                                :class="(index == 0) ? '' : 'border-top pb-0'"
                                class="py-2">
                            </FileDownload>
                        </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="border-top border-bottom bg-light p-2 my-3">
            <div class="row">
                <div class="col">
                    <span class="text-bold">INVESTIGATIONS</span>
                </div>
                <div class="col-auto">
                    <b-button
                        :variant="'primary'" 
                        v-on:click="showAddAnInvestigation()"
                        class="btn-sm">
                        <i class="fa fa-plus"></i> Add an Investigation
                    </b-button>
                </div>
            </div>
        </div>

        <div v-if="data.case_investigations && data.case_investigations[0]" class="">

            <div class="accordion" role="tablist">
                <template v-for="(item, index) in data.case_investigations">
                    <PreviewDetailsCard
                        :data="item"
                        :cardOptions="getCardHeaderOptions('NEW', index)"
                        :cardDataObject="null">
                    </PreviewDetailsCard>
                </template>
            </div>
            
        </div>

        <entity-modal v-bind:modalAttributes="modalAttributes">
            <dynamic-component :is="modalComponent" v-bind="modalComponentParams"></dynamic-component>
        </entity-modal>

        <entity-modal-delete v-bind:modalAttributes="modalAttributes">
            <component :is="deleteComponent" v-bind="deleteComponentParams"></component>
        </entity-modal-delete>

    </div>
</template>
<script>    
    import PreviewDetailsCard from './_PreviewDetailsCard'
    import FileDownload from '@/Pages/Core/Field/_FileDownload'

    import FunctionsMixin from '@/Mixins/Functions'
    import EntityComponentsMixin from '@/Mixins/EntityComponents'

    import EntityCreate from '@/Pages/Custom/CaseInvestigation/_FormCreate'
    import EntityEdit from './_FormEdit'
    import EntityDelete from './_FormDelete'

    export default {
        mixins: [FunctionsMixin, EntityComponentsMixin],
        props: ['data'],
        data() {
            return {
            }
        },
        components: {
            PreviewDetailsCard,
            FileDownload,

            EntityCreate,
            EntityEdit,
            EntityDelete,
        },
        methods: {
            getCardHeaderOptions(gStatus = null, gPosition = null) {
                var cardOptions = {}
                var cardLink = '#'
                cardOptions['cardStatus'] = gStatus
                cardOptions['cardPosition'] = gPosition
                cardOptions['cardShowComponent'] = 'PreviewCaseInvestigation'
                cardOptions['cardCTALink'] = {}
                cardOptions['cardLinks'] = []
                cardOptions['cardHeaderText'] = '#'
                cardOptions['cardHeaderVariant'] = ''
                cardOptions['cardDisabled']= false
                cardOptions['cardCompleted'] = false

                return cardOptions
            },
            showAddAnInvestigation: function() {
                this.clearComponent()
                // this.$bvModal.show("entity-modal")
                this.$bvModal.show(this.modalAttributes.uuid + '-modal')
                this.modalAttributes.title = "#Add an Investigation"
                var URL = route('dashboard.case-investigations.create', {case_id: this.data.id})
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
    }
</script>