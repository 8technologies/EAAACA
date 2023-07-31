<template>
    <div class="">
        <div class="row">
            <div class="col-lg-6">
                <table class="table table-borderless table-sm table-no-spacing">
                    <tbody>
                        <tr>
                            <td width="200px">Case</td>
                            <td>{{ data.case ? data.case.name : data.case_id }}</td>
                        </tr>
                        <tr>
                            <td>Assigned contributor</td>
                            <td>{{ data.assigned_contributor ? data.assigned_contributor.name : data.assigned_contributor_id }}</td>
                        </tr>
                        <tr>
                            <td>Assigned on</td>
                            <td>{{ data.assigned_on ? data.assigned_on : '' }}</td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td>
                                <div v-html="data.description"></div>
                            </td>
                        </tr>
                    </tbody>
                </table>
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