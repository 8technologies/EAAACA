<template>
    <div class="">
        <div class="">
            <table class="table table-bordered bg-white">
                <tbody>
                    <tr>
                        <th width="50%">Requesting authority (name, address, telephone, fax, email, Member State)</th>
                        <td>
                            <div class="">
                                <div v-if="data.organization" class="">
                                    <div class="mb-2 text-bold">
                                        {{ data.organization ? data.organization.name : data.organization_id }}
                                    </div>
                                    <div class="">
                                        <div class="row">
                                            <div class="col">
                                                <div class="">Member state: {{ data.organization && data.organization.member_state ? data.organization.member_state.name : '' }}</div>
                                                <div class="">Address: {{ data.organization && data.organization.address ? data.organization.address : '' }}</div>
                                                <div class="">Telephone: {{ data.organization && data.organization.telephone ? data.organization.telephone : '' }}</div>
                                            </div>
                                            <div class="col">
                                                <div class="">Fax: {{ data.organization && data.organization.fax ? data.organization.fax : '' }}</div>
                                                <div class="">Email: {{ data.organization && data.organization.email ? data.organization.email : '' }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>To the following Member State</th>
                        <td>
                            <div class="">
                                {{ data.member_state ? data.member_state.name : data.member_state_id }}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>Date time of this request</th>
                        <td>
                            <div class="">
                                {{ data.date_time_of_request ? data.date_time_of_request : '' }}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>Reference number of this request</th>
                        <td>
                            <div class="">
                                {{ data.request_reference_no ? data.request_reference_no : '' }}
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="">
            <table class="table table-bordered bg-white">
                <tbody>
                    <tr>
                        <th colspan="4">Previous requests</th>
                    </tr>
                    <tr>
                        <td colspan="2" width="50%">This is the first request on this case</td>
                        <td colspan="2">
                            <div class="">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">This request follows previous requests in the same case</td>
                        <td colspan="2">
                            <div class="">

                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            Previous request(s)
                        </td>
                        <td colspan="2">
                            Answer(s)
                        </td>
                    </tr>
                    <tr>
                        <td width="200px">
                            Date
                        </td>
                        <td>
                            Reference number (in the requesting Member State)
                        </td>
                        <td width="200px">
                            Date
                        </td>
                        <td>
                            Reference number (in the requesting Member State)
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class=""></div>
                        </td>
                        <td>

                        </td>
                        <td>

                        </td>
                        <td>

                        </td>
                    </tr>
                    <tr>
                        <td>

                        </td>
                        <td>

                        </td>
                        <td>

                        </td>
                        <td>

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="">
            <table class="table table-bordered bg-white">
                <tbody>
                    <tr>
                        <th>Type of crime(s) or criminal activity(s) being investigated</th>
                    </tr>
                    <tr>
                        <td>
                            <div class="h-50px">
                                <div class="" v-html="data.type_of_crimes_investigated"></div>
                            </div>                            
                        </td>
                    </tr>
                    <tr>
                        <td>                            
                            <div class="small">Description of the circumstances in which the offence(s) was (were) committed, including the time, place an degree of participation in the offence(s) by the person who is the subject of the request for information or intelligence</div>
                            <div class="h-50px pt-2">
                                <div class="" v-html="data.description_of_circumstances"></div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="">
            <table class="table table-bordered bg-white">
                <tbody>
                    <tr>
                        <th colspan="2">Nature of the offence(s)</th>
                    </tr>
                    <tr>
                        <td width="50%">
                            <div class="form-group">
                                <template v-for="(option, index) in all_nature_of_offences">
                                    <b-form-checkbox v-if="index < (all_nature_of_offences.length / 2)"
                                        v-model="data_nature_of_offences"
                                        :key="option.name"
                                        :value="option.id"
                                        disabled
                                    >
                                    <span class="text-dark">{{ option.name }}</span>
                                    </b-form-checkbox>
                                </template>                                    
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <template v-for="(option, index) in all_nature_of_offences">
                                    <b-form-checkbox v-if="index > (all_nature_of_offences.length / 2)"
                                        v-model="data_nature_of_offences"
                                        :key="option.name"
                                        :value="option.id"
                                        disabled
                                    >
                                    <span class="text-dark">{{ option.name }}</span>
                                    </b-form-checkbox>
                                </template>                                    
                            </div>                           
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="">
            <table class="table table-bordered bg-white">
                <tbody>
                    <tr>
                        <th>Purpose for which the information or intelligence is requested</th>
                    </tr>
                    <tr>
                        <td>
                            <div class="h-50px">
                                <div class="" v-html="data.purpose_for_information_request"></div>
                            </div>                            
                        </td>
                    </tr>

                    <tr>
                        <th>Connection between the purpose for which the information or intelligence is requested and the person who is the subject fo the information or intelligence.</th>
                    </tr>
                    <tr>
                        <td>
                            <div class="h-50px">
                                <div class="" v-html="data.connection_btw_information_request"></div>
                            </div>                            
                        </td>
                    </tr>

                    <tr>
                        <th>Identity(ies) (as far as known) of the person(s) being the main subject(s) of the criminal investigation or criminal intelligence operation underlying the request for information or intelligence</th>
                    </tr>
                    <tr>
                        <td>
                            <div class="h-50px">
                                <div class="" v-html="data.identity_of_the_persons"></div>
                            </div>                            
                        </td>
                    </tr>

                    <tr>
                        <th>Reasons for believing that the information or intelligence is in the requested Member State</th>
                    </tr>
                    <tr>
                        <td>
                            <div class="h-50px">
                                <div class="" v-html="data.reasons_tobe_in_member_state"></div>
                            </div>                            
                        </td>
                    </tr>

                    <tr>
                        <th>Restrictions of the use of information contained in this request for purposes other than those for which it has been supplied of preventing an immediate and serious threat to public security.</th>
                    </tr>
                    <tr>
                        <td>
                            <div class="h-50px">
                                <div class="form-group">
                                    <template v-for="(option, index) in all_information_restrictions">
                                        <b-form-checkbox v-if="index"
                                            v-model="data_information_restrictions"
                                            :key="option.name"
                                            :value="option.id"
                                            disabled
                                        >
                                        <span class="text-dark">{{ option.name }}</span>
                                        </b-form-checkbox>
                                    </template>                                    
                                </div>
                            </div>                            
                        </td>
                    </tr>
                </tbody>
            </table>
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
    import FunctionsMixin from '@/Mixins/Functions'
    import EntityComponentsMixin from '@/Mixins/EntityComponents'

    import EntityEdit from './_FormEdit'
    import EntityDelete from './_FormDelete'

    export default {
        mixins: [FunctionsMixin, EntityComponentsMixin],
        props: ['data'],
        components: {
            EntityEdit,
            EntityDelete,
        },
        data() {
            return {
                data_nature_of_offences: this.data.nature_of_offences ? this.data.nature_of_offences.map(item => {return item.id}) : [],
                data_information_restrictions: this.data.information_restrictions ? this.data.information_restrictions.map(item => {return item.id}) : [],

                all_nature_of_offences: this.data.all_nature_of_offences,
                all_information_restrictions: this.data.all_information_restrictions,
                
            }
        },
    }
</script>