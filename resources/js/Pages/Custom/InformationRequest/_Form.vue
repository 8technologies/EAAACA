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
                                <select2 id="member_state_id" 
                                    :name="route('dashboard.member-states.index')" 
                                    :options="ajaxOptions" 
                                    :settings="{ placeholder: 'Choose a Member State', ajax: ajax, templateResult: formatState, templateSelection: formatState, allowClear: true }" 
                                    v-model="form.member_state_id" 
                                    :class="[errors.member_state_id ? 'is-invalid' : '']">
                                </select2>
                                <span v-if="errors.member_state_id" :class="['label text-danger small']">{{ errors.member_state_id }}</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>Date time of this request</th>
                        <td>
                            <div class="position-relative">
                                <date-picker 
                                    id="date_time_of_request" 
                                    :config="datePickerOptions" 
                                    class="form-control w-auto" 
                                    v-model="form.date_time_of_request" 
                                    type="datetime" 
                                    value-type="format" 
                                    :class="[errors.date_time_of_request ? 'is-invalid' : '']">
                                </date-picker>
                                <span v-if="errors.date_time_of_request" :class="['label text-danger small']">{{ errors.date_time_of_request }}</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>Reference number of this request</th>
                        <td>
                            <div class="">
                                <b-form-input 
                                    id="request_reference_no" 
                                    placeholder="Enter Request reference number" 
                                    required="" 
                                    v-model="form.request_reference_no" 
                                    :class="[errors.request_reference_no ? 'is-invalid' : ''] + ' w-auto'">
                                </b-form-input>
                                <span v-if="errors.request_reference_no" :class="['label text-danger small']">{{ errors.request_reference_no }}</span>
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
                                <div>
                                    <b-form-textarea 
                                        id="type_of_crimes_investigated" 
                                        rows="4" 
                                        max-rows="4" 
                                        placeholder="Enter type of crime(s) or criminal activity(s) here" 
                                        v-model="form.type_of_crimes_investigated" 
                                        :class="[errors.type_of_crimes_investigated ? 'is-invalid' : '']">
                                    </b-form-textarea>
                                    <span v-if="errors.type_of_crimes_investigated" :class="['label text-danger small']">{{ errors.type_of_crimes_investigated }}</span>
                                </div>
                            </div>                            
                        </td>
                    </tr>
                    <tr>
                        <td>                            
                            <div class="small">Description of the circumstances in which the offence(s) was (were) committed, including the time, place an degree of participation in the offence(s) by the person who is the subject of the request for information or intelligence</div>
                            <div class="h-50px pt-2">
                                <div class="">
                                    <b-form-textarea 
                                        id="description_of_circumstances" 
                                        rows="6" 
                                        max-rows="8" 
                                        placeholder="Enter description of the circumstances in which the offence(s) was (were) committed here" 
                                        v-model="form.description_of_circumstances" 
                                        :class="[errors.description_of_circumstances ? 'is-invalid' : '']">
                                    </b-form-textarea>
                                    <span v-if="errors.description_of_circumstances" :class="['label text-danger small']">{{ errors.description_of_circumstances }}</span>
                                </div>
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
                                        v-model="form.nature_of_offences"
                                        :key="option.name"
                                        :value="option.id"
                                    >
                                    <span class="">{{ option.name }}</span>
                                    </b-form-checkbox>
                                </template>                                    
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <template v-for="(option, index) in all_nature_of_offences">
                                    <b-form-checkbox v-if="index > (all_nature_of_offences.length / 2)"
                                        v-model="form.nature_of_offences"
                                        :key="option.name"
                                        :value="option.id"
                                    >
                                    <span class="">{{ option.name }}</span>
                                    </b-form-checkbox>
                                </template>                                    
                            </div>  
                            <span v-if="errors.nature_of_offences" :class="['label text-danger small']">{{ errors.nature_of_offences }}</span>                         
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
                                <div class="">
                                    <b-form-textarea 
                                        id="purpose_for_information_request" 
                                        rows="4" 
                                        max-rows="4" 
                                        placeholder="Enter purpose for which the information here" 
                                        v-model="form.purpose_for_information_request" 
                                        :class="[errors.purpose_for_information_request ? 'is-invalid' : '']">
                                    </b-form-textarea>
                                    <span v-if="errors.purpose_for_information_request" :class="['label text-danger small']">{{ errors.purpose_for_information_request }}</span>
                                </div>
                            </div>                            
                        </td>
                    </tr>

                    <tr>
                        <th>Connection between the purpose for which the information or intelligence is requested and the person who is the subject fo the information or intelligence.</th>
                    </tr>
                    <tr>
                        <td>
                            <div class="h-50px">
                                <b-form-textarea 
                                    id="connection_btw_information_request" 
                                    rows="6" 
                                    max-rows="8" 
                                    placeholder="Enter connection between the request and the subject here" 
                                    v-model="form.connection_btw_information_request" 
                                    :class="[errors.connection_btw_information_request ? 'is-invalid' : '']">
                                </b-form-textarea>
                                <span v-if="errors.connection_btw_information_request" :class="['label text-danger small']">{{ errors.connection_btw_information_request }}</span>
                            </div>                            
                        </td>
                    </tr>

                    <tr>
                        <th>Identity(ies) (as far as known) of the person(s) being the main subject(s) of the criminal investigation or criminal intelligence operation underlying the request for information or intelligence</th>
                    </tr>
                    <tr>
                        <td>
                            <div class="h-50px">
                                <b-form-textarea 
                                    id="identity_of_the_persons" 
                                    rows="4" 
                                    max-rows="4" 
                                    placeholder="Enter identity of persons here" 
                                    v-model="form.identity_of_the_persons" 
                                    :class="[errors.identity_of_the_persons ? 'is-invalid' : '']">
                                </b-form-textarea>
                                <span v-if="errors.identity_of_the_persons" :class="['label text-danger small']">{{ errors.identity_of_the_persons }}</span>
                            </div>                            
                        </td>
                    </tr>

                    <tr>
                        <th>Reasons for believing that the information or intelligence is in the requested Member State</th>
                    </tr>
                    <tr>
                        <td>
                            <div class="h-50px">
                                <b-form-textarea 
                                    id="reasons_tobe_in_member_state" 
                                    rows="6" 
                                    max-rows="8" 
                                    placeholder="Enter reasons information is in Member State here" 
                                    v-model="form.reasons_tobe_in_member_state" 
                                    :class="[errors.reasons_tobe_in_member_state ? 'is-invalid' : '']">
                                </b-form-textarea>
                                <span v-if="errors.reasons_tobe_in_member_state" :class="['label text-danger small']">{{ errors.reasons_tobe_in_member_state }}</span>

                            </div>                            
                        </td>
                    </tr>

                    <tr>
                        <th>Restrictions of the use of information contained in this request for purposes other than those for which it has been supplied of preventing an immediate and serious threat to public security.</th>
                    </tr>
                    <tr>
                        <td>
                            <div class="h-50px">
                                <b-form-group
                                    v-slot="{ ariaDescribedby }"
                                    >
                                    <b-form-checkbox
                                        v-for="option in all_information_restrictions"
                                        v-model="form.information_restrictions"
                                        :key="option.name"
                                        :value="option.id"
                                        :aria-describedby="ariaDescribedby"
                                    >
                                    {{ option.name }}
                                    </b-form-checkbox>
                                </b-form-group>
                                <span v-if="errors.information_restrictions" :class="['label text-danger small']">{{ errors.information_restrictions }}</span>
                            </div>                            
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>


    </div>
</template>
<script>
    import MessagesMixin from '@/Mixins/Messages'
    import DBOperationsMixin from '@/Mixins/DBOperations'
    import EntityComponentsMixin from '@/Mixins/EntityComponents'
    import Select2Mixin from '@/Mixins/Plugins/Select2'
    import FieldImage from '@/Pages/Core/Field/fieldImage'

    export default {
        mixins: [MessagesMixin, DBOperationsMixin, EntityComponentsMixin, Select2Mixin],
        props: ['data'],
        components: {
            FieldImage,
        },
        data() {
            return {
                form: this.$inertia.form({
                    nature_of_offences: this.data.nature_of_offences ? this.data.nature_of_offences.map(item => {return item.id}) : [],
                    information_restrictions: this.data.information_restrictions ? this.data.information_restrictions.map(item => {return item.id}) : [],
                    
                    organization_id: this.data && this.data.organization_id ? this.data.organization_id : '',
                    member_state_id: this.data && this.data.member_state_id ? this.data.member_state_id : '',
                    date_time_of_request: this.data && this.data.date_time_of_request ? this.data.date_time_of_request : '',
                    request_reference_no: this.data && this.data.request_reference_no ? this.data.request_reference_no : '',
                    case_id: this.data && this.data.case_id ? this.data.case_id : '',

                    type_of_crimes_investigated: this.data && this.data.type_of_crimes_investigated ? this.data.type_of_crimes_investigated : '',
                    description_of_circumstances: this.data && this.data.description_of_circumstances ? this.data.description_of_circumstances : '',
                    purpose_for_information_request: this.data && this.data.purpose_for_information_request ? this.data.purpose_for_information_request : '',
                    connection_btw_information_request: this.data && this.data.connection_btw_information_request ? this.data.connection_btw_information_request : '',
                    identity_of_the_persons: this.data && this.data.identity_of_the_persons ? this.data.identity_of_the_persons : '',
                    
                    reasons_tobe_in_member_state: this.data && this.data.reasons_tobe_in_member_state ? this.data.reasons_tobe_in_member_state : '',
                }),
                all_nature_of_offences: this.data.all_nature_of_offences,
                all_information_restrictions: this.data.all_information_restrictions,
                datePickerOptions: {
                    format: 'MM/DD/Y hh:mm A',
                    keepOpen: false,
                    widgetPositioning: {vertical: 'bottom'},
                },
            }
        },
        mounted() {
            // Select: member_state_id
            if (this.data.member_state_id != null || this.data.member_state) {
                var selectElement = $('#member_state_id')
                var data = {
                    id: this.data.member_state_id ? this.data.member_state_id : this.data.member_state.id,
                    text: !!this.data.member_state ? this.data.member_state.name : '',
                    // thumbnail: !!this.data.head_of_department ? this.data.head_of_department.thumbnail : '',
                };
                var option = new Option(data.text, data.id, true, true)
                // option.dataset.thumbnail = data.thumbnail
                selectElement.append(option).trigger('change');
            }
        },
        watch: {
            form: {
                deep: true,
                immediate: true,
                handler: function(newVal, oldVal) {
                    this.$emit('updateParentFormValues', newVal)
                }
            }
        },
    }
</script>