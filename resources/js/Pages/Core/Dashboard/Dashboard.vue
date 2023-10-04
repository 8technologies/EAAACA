<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="p-2 border rounded bg-white mb-3">
            <div class="row">
                <div class="col-lg-6">
                    <ChartInformationRequestStatus
                        :data="data.chart_data">
                    </ChartInformationRequestStatus>
                </div>
                <div class="col-lg-6">
                    <div class="p-3">
                        <h5 class="border-bottom pb-1 mb-3 text-bold">
                            Member States
                        </h5>
                        <table class="table table-borderless table-sm table-no-spacing">
                            <thead>
                                <tr>
                                    <td width=""></td>
                                    <td width="100px">Organizations</td>
                                    <td width="100px">In-coming</td>
                                    <td width="100px">Out-going</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(member_state, index) in data.member_states" v-bind:key="'member_state-'+member_state.id" class="border-top">
                                    <th width="">
                                        {{ member_state.name }}
                                    </th>
                                    <td>
                                        {{ member_state.organizations_count }}
                                    </td>
                                    <td>
                                        {{ member_state.information_requests_incoming_count }}
                                    </td>
                                    <td>
                                        {{ member_state.information_requests_count }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="pb-3">
            <ul class="nav nav-tabs row no-gutters bg-white m-auto p-0" id="informationRequestTab" role="tablist">
                <li class="nav-item col pr-1" role="presentation">
                    <button class="nav-link w-100 active" id="incoming-tab" data-toggle="tab" data-target="#incoming" type="button" role="tab" aria-controls="incoming" aria-selected="true">In-Coming</button>
                </li>
                <li class="nav-item col pr-0" role="presentation">
                    <button class="nav-link w-100" id="outgoing-tab" data-toggle="tab" data-target="#outgoing" type="button" role="tab" aria-controls="outgoing" aria-selected="false">Out-Going</button>
                </li>
            </ul>
            <div class="tab-content mt-0 p-3 bg-white border border-top-0" id="informationRequestTabContent">
                <div class="tab-pane fade show active" id="incoming" role="tabpanel" aria-labelledby="incoming-tab">
                    <h5 class="border-bottom pb-1 mb-3">
                        In-Coming Information Requests
                    </h5>
                    <table class="table table-borderless table-sm table-no-spacing mb-3">
                        <thead>
                            <tr>
                                <td width="250px"></td>
                                <td width="120px">New</td>
                                <td width="120px">Pending</td>
                                <td width="120px">Awaiting Response</td>
                                <td width="120px">Awaiting Feedback</td>
                                <td width="150px">More infomation needed</td>
                                <td width="120px">Completed</td>
                                <td width="120px"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(member_state, index) in data.member_states" v-bind:key="'member_state-'+member_state.id" class="border-top">
                                <th width="">{{ member_state.name }}</th>
                                <td>
                                    {{ getEntityStatusCount('NEW', member_state.information_requests_incoming) }}
                                </td>
                                <td>
                                    {{ getEntityStatusCount('PENDING', member_state.information_requests_incoming) }}
                                </td>
                                <td>
                                    {{ getEntityStatusCount('AWAITING RESPONSE', member_state.information_requests_incoming) }}
                                </td>
                                <td>
                                    {{ getEntityStatusCount('AWAITING FEEDBACK', member_state.information_requests_incoming) }}
                                </td>
                                <td>
                                    {{ getEntityStatusCount('MORE INFORMATION NEEDED', member_state.information_requests_incoming) }}
                                </td>
                                <td>
                                    {{ getEntityStatusCount('COMPLETED', member_state.information_requests_incoming) }}
                                </td>
                                <th>
                                    {{ member_state.information_requests_incoming_count }}
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="tab-pane fade" id="outgoing" role="tabpanel" aria-labelledby="outgoing-tab">
                    <h5 class="border-bottom pb-1 mb-3">
                        Out-Going Information Requests
                    </h5>
                    <table class="table table-borderless table-sm table-no-spacing mb-3">
                        <thead>
                            <tr>
                                <td width="250px"></td>
                                <td width="120px">New</td>
                                <td width="120px">Pending</td>
                                <td width="120px">Awaiting Response</td>
                                <td width="120px">Awaiting Feedback</td>
                                <td width="150px">More infomation needed</td>
                                <td width="120px">Completed</td>
                                <td width="120px"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(member_state, index) in data.member_states" v-bind:key="'member_state-'+member_state.id" class="border-top">
                                <th width="">{{ member_state.name }}</th>
                                <td>
                                    {{ getEntityStatusCount('NEW', member_state.information_requests) }}
                                </td>
                                <td>
                                    {{ getEntityStatusCount('PENDING', member_state.information_requests) }}
                                </td>
                                <td>
                                    {{ getEntityStatusCount('AWAITING RESPONSE', member_state.information_requests) }}
                                </td>
                                <td>
                                    {{ getEntityStatusCount('AWAITING FEEDBACK', member_state.information_requests) }}
                                </td>
                                <td>
                                    {{ getEntityStatusCount('MORE INFORMATION NEEDED', member_state.information_requests) }}
                                </td>
                                <td>
                                    {{ getEntityStatusCount('COMPLETED', member_state.information_requests) }}
                                </td>
                                <th>
                                    {{ member_state.information_requests_count }}
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="bg-white p-3 border rounded">
            <h3 class="border-bottom pb-2 mb-3">{{ organization ? organization.name : '' }}</h3>
            <div class="row pt-2">
                <div class="col-md-4">
                    <div class="bg-light border rounded p-3 h-100">
                        <table class="table table-borderless table-sm table-no-spacing">
                            <tbody>
                                <!-- <tr>
                                    <td width="150px">Organization</td>
                                    <th>{{ organization.name }}</th>
                                </tr> -->
                                <tr>
                                    <td>Member Country</td>
                                    <td>{{ organization && organization.member_state ? organization.member_state.name : '' }}</td>
                                </tr>
                                <tr>
                                    <td>Contact Points </td>
                                    <td>{{ '' }}</td>
                                </tr>
                                <tr>
                                    <td>Telephone</td>
                                    <td>{{ organization ? organization.telephone : '' }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>{{ organization ? organization.email : '' }}</td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td>{{ organization ? organization.address : '' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="h-100">
                        <div class="border-bottom text-bold mb-2">Information Requests</div>
                        <table class="table table-borderless table-sm table-no-spacing">
                            <thead>
                                <tr>
                                    <td></td>
                                    <td>Out-going</td>
                                    <td>In-coming</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td width="">New</td>
                                    <th></th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <td>Pending</td>
                                    <th></th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <td>Awaiting Response</td>
                                    <th></th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <td>Awaiting Feedback</td>
                                    <th></th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <td>More infomation needed</td>
                                    <th></th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <td>Completed</td>
                                    <th></th>
                                    <th></th>
                                </tr>
                                <tr class="border-top">
                                    <th>Total</th>
                                    <th>{{ data.information_requests.count ? data.information_requests.count : '' }}</th>
                                    <th></th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="">
            <div class="mt-3">
                <div class="row">
                    <div class="col-md-6">
                        <div class="border p-3 rounded bg-white h-100">
                            <div class="text-bold mb-2">CASES</div>
                            <TableListCaseDashboard></TableListCaseDashboard>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="border p-3 bg-light rounded h-100">
                            <div class="text-bold mb-2">CONTACT POINTS</div>
                            
                            <div class="">
                                <TableListOnlineStatus></TableListOnlineStatus>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-3 border p-3 bg-white rounded">
            <div class="row">
                <div class="col-md-6">
                    <div class="">
                        <div class="border-bottom text-bold mb-2">Out-going Requests</div>
                        <div class="">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="">
                        <div class="border-bottom text-bold mb-2">In-coming Requests</div>
                        <div class="">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import SeoMixin from '@/Mixins/SEO'
    import FunctionsMixin from '@/Mixins/Functions'

    import TableListCaseDashboard from '@/Pages/Custom/Case/_TableListDashboard'
    import TableListOnlineStatus from '@/Pages/Core/User/_TableListOnlineStatus'
    import ChartInformationRequestStatus from './ChartInformationRequestStatus.vue'

    export default {
        mixins: [SeoMixin, FunctionsMixin],
        props: [
            'data',
        ],
        data() {
            return {
                user: this.$page.props.user,
                pageTitle: 'Dashboard',
                organization: this.data.organization ? this.data.organization : null,
            }
        },
        components: {
            AppLayout,
            TableListCaseDashboard,
            TableListOnlineStatus,

            ChartInformationRequestStatus,
        },
        methods: {
            getVisitsPerDay() {
                return 'dates'
            },

            getEntityStatusCount: function(entityStatus, informationRequestData) {
                if (informationRequestData) {
                    var itemIndex = informationRequestData.find(item => item.entity_status == entityStatus)
                    
                    if (itemIndex) {
                        return itemIndex.entity_status_count
                    }

                    return 0
                }
                return 0
            },
        },
        // created() {
        //     console.log( this.data.member_states )
        // },
    }
</script>