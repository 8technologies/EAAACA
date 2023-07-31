<template>
    <div class="bg-white border rounded p-3">
        <h3 class="">
            {{ data.name }}
        </h3>
        <div class="row">
            <div class="col-lg-6">
                <table class="table table-borderless table-sm table-no-spacing">
                    <tbody>
                        <tr>
                            <td width="200px">Reference Number</td>
                            <td>{{ data.request_reference_no ? data.request_reference_no : '' }}</td>
                        </tr>
                        <tr>
                            <td>Requesting authority</td>
                            <td>{{ data.organization ? data.organization.name : data.organization_id }}</td>
                        </tr>
                        <tr>
                            <td>To Member State</td>
                            <td>{{ data.member_state ? data.member_state.name : data.member_state_id }}</td>
                        </tr>
                        <tr>
                            <td>Date time of request</td>
                            <td>{{ data.date_time_of_request ? data.date_time_of_request : '' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-6">
                <div class="h-100 pl-3 border-left">
                    <table class="table table-borderless table-sm table-no-spacing">
                        <tbody>
                            <tr>
                                <td width="200px">Status</td>
                                <td>
                                    <div v-html="this.formatStatus(data.entity_status)"></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="border-bottom my-3"></div>

                    <table class="table table-borderless table-sm table-no-spacing">
                        <tbody>
                            <tr>
                                <td width="200px">Total Responses</td>
                                <td>
                                    {{ data.request_responses_count ? data.request_responses_count : '0' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import FunctionsMixin from '@/Mixins/Functions'

    export default {
        props: ['data'],
        mixins: [
            FunctionsMixin,
        ],
        data() {
            return {
            }
        },
    }
</script>