<template>
    <b-card no-body :class="checkCardActiveStatus(cardOptions.cardStatus)">
        <b-card-header header-tag="header" class="" role="tab">
            <div class="row no-gutters py-2" :class="getCardRowClass(cardOptions)">
                <div class="col">
                    <b-button block 
                        v-b-toggle:my-collapse="'accordion-'+cardOptions.cardPosition"
                        :style="'background-color: transparent; border:none'"
                        :variant="cardOptions.cardHeaderVariant">
                        #{{ cardOptions.cardPosition + 1 }} {{ data.name }}
                        <!-- {{ cardOptions.cardHeaderText }} -->
                    </b-button>
                </div>
                <div class="col-auto px-3">
                    <template v-if="cardOptions.cardDisabled == false && cardOptions.cardCompleted == false">
                        <template v-for="(item, index) in cardOptions.cardLinks">
                            <b-button v-bind:key="cardOptions.cardStatus + index"
                                :variant="'outline-light'" 
                                v-on:click="showActionForm(item)"
                                class="ml-2 rounded-pill bg-white border-secondary">
                                {{ item.btnText ? item.btnText : '+ Add' }}
                            </b-button>
                        </template>
                    </template>
                    <template v-else-if="cardOptions.cardDisabled == true && cardOptions.cardCompleted == false">
                        <b-button :variant="'secondary'" disabled class="rounded-pill text-center check-btn-circle">
                            <i class="fa fa-ellipsis-h"></i>
                        </b-button>
                    </template>
                    <template v-else-if="cardOptions.cardCompleted == true">
                        <b-button :variant="'outline-success'" class="rounded-pill check-btn-circle">
                            <i class="fa fa-check"></i>
                        </b-button>
                    </template>
                    
                </div>
            </div>
        </b-card-header>

        <b-collapse :id="'accordion-' + cardOptions.cardPosition" :visible="checkActiveStatus(cardOptions.cardStatus)" accordion="my-accordion" role="tabpanel">
            <b-card-body :class="'bg-white'">
                <template v-if="cardDataObject != null">
                    <component v-for="(item, index) in cardDataObject" 
                        :is="cardOptions.cardShowComponent"
                        class="p-3 border bg-light rounded"
                        :class="(index != (cardDataObject.length-1)) ? 'mb-3' : ''"
                        v-bind:key="item.uuid"
                        :data="item">
                    </component> 
                </template>
                <template v-else>
                    <component
                        :is="cardOptions.cardShowComponent"
                        :data="data">
                    </component>
                </template>
            </b-card-body>
        </b-collapse>

        <entity-modal v-if="cardOptions.cardDisabled == false && cardOptions.cardCompleted == false" 
            v-bind:modalAttributes="modalAttributes">
            <dynamic-component :is="modalComponent" v-bind="modalComponentParams"></dynamic-component>
        </entity-modal>

    </b-card>
</template>
<script>
    import FunctionsMixin from '@/Mixins/Functions'
    import EntityComponentsMixin from '@/Mixins/EntityComponents'

    // import EntityCreate from '@/Pages/Custom/GrmGrievance/ActionTaken/_FormCreate'

    import FormCaseInvestigation from '@/Pages/Custom/CaseInvestigation/_FormCreate'
    import PreviewCaseInvestigation from '@/Pages/Custom/CaseInvestigation/_Preview'

    export default {
        mixins: [FunctionsMixin, EntityComponentsMixin],
        props: ['data', 'cardOptions', 'cardDataObject'],
        data() {
            return {
            }
        },
        components: {
            // EntityCreate,

            FormCaseInvestigation,
            PreviewCaseInvestigation,
        },
        methods: {
            checkActiveStatus(grievanceStatus) {
                // || this.data.grievance_status == 'PENDING' && grievanceStatus == 'UN-ASSIGNED'
                if (this.data.grievance_status == grievanceStatus || this.data.grievance_status == 'NO REMARKS' && grievanceStatus == 'UN-ASSIGNED') {
                    return true
                }
                return false
            },

            showActionForm: function (ctaItem) {
                this.clearComponent()
                // this.$bvModal.show("entity-modal")
                this.$bvModal.show(this.modalAttributes.uuid + '-modal')
                this.modalAttributes.title = ctaItem.title
                var URL = ctaItem.url
                axios.get(URL)
                    .then(response => {
                        // console.log(response)
                        this.modalComponent = ctaItem.component
                        this.modalComponentParams = response
                        // console.log( response )
                    })
                    .catch(error => {
                        // this.$bvModal.hide("entity-modal")
                        this.$bvModal.hide(this.modalAttributes.uuid + '-modal')
                        // Handle validation errors
                        this.errors = error;
                        this.success = false;
                        this.showErrorMessages(this.errors)
                    });
            },

            getCardRowClass(cardOptions) {
                if (this.data.grievance_status == 'NO REMARKS' && cardOptions.cardStatus == 'UN-ASSIGNED') {
                    return 'bg-primary'
                }

                if (cardOptions.cardDisabled == false && cardOptions.cardCompleted == false) {
                    // this.data.grievance_status != 'NO REMARKS'
                    if (this.data.grievance_status == cardOptions.cardStatus) {
                        return 'bg-primary'
                    }
                }
            },

            checkCardActiveStatus(grievanceStatus) {
                if (this.data.grievance_status == grievanceStatus || this.data.grievance_status == 'NO REMARKS' && grievanceStatus == 'UN-ASSIGNED') {
                    return 'active-card-accordion'
                }
                return ''
            }

        },
        // created() {
        //     console.log( this.data )
        //     console.log( this.cardOptions.cardStatus )
        // }
    }
</script>