<template>
    <div class="">

        <!-- <div class="border-top border-bottom bg-light p-2 my-3">
            <div class="row">
                <div class="col">
                    <span class="text-bold">REQUEST RESPONSES</span>
                </div>
                <div class="col-auto">
                    <b-button
                        :variant="'primary'" 
                        v-on:click="showAddAResponse()"
                        class="btn-sm">
                        <i class="fa fa-plus"></i> Add a Response
                    </b-button>
                </div>
            </div>
        </div> -->

        <div class="accordion" role="tablist">

            <b-card no-body class="">
                <b-card-header header-tag="header" class="" role="tab">
                    <div class="row no-gutters py-2">
                        <div class="col">
                            <b-button block 
                                :class="'btn-block'"
                                :variant="'default'"
                                v-b-toggle:my-collapse="'accordion-1'"
                                :style="'background-color: transparent; border:none'">
                                #1 Request Details
                            </b-button>
                        </div>
                        <div class="col-auto px-3">
                            <template>
                                <b-button :variant="'outline-success'" class="rounded-pill check-btn-circle">
                                    <i class="fa fa-check"></i>
                                </b-button>
                            </template>
                        </div>
                    </div>
                </b-card-header>

                <b-collapse :id="'accordion-1'" accordion="my-accordion" role="tabpanel">
                    <b-card-body>
                        <PreviewFull 
                            :data="data">
                        </PreviewFull>
                    </b-card-body>
                </b-collapse>
            </b-card>

            <b-card no-body class="">
                <b-card-header header-tag="header" class="" role="tab">
                    <div class="row no-gutters py-2">
                        <div class="col">
                            <b-button block 
                                :class="'btn-block'"
                                :variant="'default'"
                                v-b-toggle:my-collapse="'accordion-2'"
                                :style="'background-color: transparent; border:none'">
                                #2 Review Details
                            </b-button>
                        </div>

                        <div v-if="data.entity_status == 'NEW'" class="col-auto px-3">
                            <b-button
                                :variant="'primary'" 
                                v-on:click="showReviewRequest()"
                                class="btn ml-2 rounded-pill bg-white border-secondary btn-outline-light">
                                <i class="fa fa-plus float-left pr-2"></i> Review Request
                            </b-button>
                        </div>
                        <div v-else class="col-auto px-3">
                            <template>
                                <b-button :variant="'outline-success'" class="rounded-pill check-btn-circle">
                                    <i class="fa fa-check"></i>
                                </b-button>
                            </template>
                        </div>
                    </div>
                </b-card-header>

                <b-collapse :id="'accordion-2'" accordion="my-accordion" role="tabpanel">
                    <b-card-body :class="''">
                        <div class="">
                            <PreviewReview
                                :class="'border rounded bg-white p-3'"
                                :data="data">
                            </PreviewReview>
                        </div>
                    </b-card-body>
                </b-collapse>
            </b-card>

            <b-card no-body class="">
                <b-card-header header-tag="header" class="" role="tab">
                    <div class="row no-gutters py-2">
                        <div class="col">
                            <b-button block 
                                :class="'btn-block'"
                                :variant="'default'"
                                v-b-toggle:my-collapse="'accordion-3'"
                                :style="'background-color: transparent; border:none'">
                                #3 Request Responses ({{ data.request_responses_count ? data.request_responses_count : '0' }})
                            </b-button>
                        </div>
                        
                        <div v-if="data.review_status_id == 1 && data.entity_status != 'COMPLETED'" class="col-auto px-3">
                            <b-button
                                :variant="'primary'" 
                                v-on:click="showAddAResponse()"
                                class="btn ml-2 rounded-pill bg-white border-secondary btn-outline-light">
                                <i class="fa fa-plus float-left pr-2"></i> Add a Response
                            </b-button>
                        </div>
                        <div v-else-if="data.entity_status == 'COMPLETED'" class="col-auto px-3">
                            <template>
                                <b-button :variant="'outline-success'" class="rounded-pill check-btn-circle">
                                    <i class="fa fa-check"></i>
                                </b-button>
                            </template>
                        </div>
                        <div v-else class="col-auto px-3">
                            <template>
                                <b-button :variant="'outline-secondary'" disabled class="rounded-pill text-center check-btn-circle">
                                    <i class="fa fa-ellipsis-h"></i>
                                </b-button>
                            </template>
                        </div>

                    </div>
                </b-card-header>

                <b-collapse :id="'accordion-3'" accordion="my-accordion" role="tabpanel">
                    <b-card-body :class="'rounded rounded-bottom'">
                        <div v-if="data.request_responses && data.request_responses[0]" class="">
                            <template v-for="(item, index) in data.request_responses">
                                <PreviewRequestResponse
                                    :class="'border rounded bg-white p-3 mb-3'"
                                    :data="item"
                                    :cardOptions="getCardHeaderOptions('NEW', index)"
                                    :cardDataObject="null">
                                </PreviewRequestResponse>
                            </template>
                        </div>
                    </b-card-body>
                </b-collapse>
            </b-card>

            <!-- <div v-if="data.request_responses && data.request_responses[0]" class="pb-3">
                <PreviewDetailsCard
                    :data="data"
                    :cardOptions="getCardHeaderOptions('NEW', 2)"
                    :cardDataObject="null">
                </PreviewDetailsCard>
                
                <template v-for="(item, index) in data.request_responses">
                    <PreviewDetailsCard
                        :data="item"
                        :cardOptions="getCardHeaderOptions('NEW', index)"
                        :cardDataObject="null">
                    </PreviewDetailsCard>
                </template>
            </div> -->
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
    import PreviewFull from './_PreviewFull'
    import PreviewDetailsCard from './_PreviewDetailsCard'
    import FileDownload from '@/Pages/Core/Field/_FileDownload'

    import FunctionsMixin from '@/Mixins/Functions'
    import EntityComponentsMixin from '@/Mixins/EntityComponents'

    import EntityCreate from '@/Pages/Custom/RequestResponse/_FormCreate'
    import EntityEdit from './_FormReview'
    import EntityDelete from './_FormDelete'
    import PreviewReview from './_PreviewReview'
    import PreviewRequestResponse from '@/Pages/Custom/RequestResponse/_Preview'

    export default {
        mixins: [FunctionsMixin, EntityComponentsMixin],
        props: ['data'],
        data() {
            return {
            }
        },
        components: {
            PreviewFull,
            PreviewDetailsCard,
            FileDownload,

            EntityCreate,
            EntityEdit,
            EntityDelete,
            PreviewReview,

            PreviewRequestResponse
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
            showAddAResponse: function() {
                this.clearComponent()
                // this.$bvModal.show("entity-modal")
                this.$bvModal.show(this.modalAttributes.uuid + '-modal')
                this.modalAttributes.title = "#Add a Response"
                var URL = route('dashboard.request-responses.create', {information_request_id: this.data.id})
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
            showReviewRequest: function() {
                this.clearComponent()
                // this.$bvModal.show("entity-modal")
                this.$bvModal.show(this.modalAttributes.uuid + '-modal')
                this.modalAttributes.title = "#Add a Review"
                var URL = route('dashboard.information-requests.getreview', this.data.id)
                axios.get(URL)
                .then(response => {
                    // console.log(response)
                    this.modalComponent = 'EntityEdit'
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