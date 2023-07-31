<template>
    <div class="bg-white border rounded p-3">
        <div class="row">
            <div class="col-lg-6">
                <table class="table table-borderless table-sm table-no-spacing">
                    <tbody>
                        <tr>
                            <td width="200px">Review on</td>
                            <td>{{ data.review_on ? data.review_on : '' }}</td>
                        </tr>
                        <tr>
                            <td>Review by</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Review notes</td>
                            <td>
                                <div class="border rounded bg-light p-3" v-html="data.review_notes"></div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-6">
                <div class="h-100 pl-3 border-left">
                    <table class="table table-borderless table-sm table-no-spacing">
                        <tbody>
                            <tr>
                                <td width="200px">Review Status</td>
                                <td>{{ data.review_status ? data.review_status.name : data.review_status_id }}</td>
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