<template>
    <div class="bg-white border rounded p-3">
        <div class="row no-gutters">
            <div class="col-lg-6">
                <table class="table table-borderless table-sm table-no-spacing">
                    <tbody>
                        <tr>
                            <td width="200px">Reference Number</td>
                            <td>{{ data.reference_number ? data.reference_number : '' }}</td>
                        </tr>
                        <tr>
                            <td>Organization</td>
                            <td>{{ data.organization ? data.organization.name : data.organization_id }}</td>
                        </tr>
                        <tr>
                            <td>Date Created</td>
                            <td>{{ data.date_created }}</td>
                        </tr>
                        <tr>
                            <td>Review Status</td>
                            <td></td>
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
                                <td></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="border-bottom my-3"></div>

                    <table class="table table-borderless table-sm table-no-spacing">
                        <tbody>
                            <tr>
                                <td width="200px">Investigations</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
<script>    
    export default {
        props: ['data'],
        data() {
            return {
            }
        },
    }
</script>