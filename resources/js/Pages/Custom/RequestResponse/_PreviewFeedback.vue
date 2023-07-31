<template>
    <div class="mt-3">
    <div class="text-bold pb-1 border-bottom mb-3">FEEDBACK</div>
    <div class="p-3 bg-light border rounded">
        <table v-if="data.feedback_status_id" class="table table-borderless table-sm table-no-spacing">
            <tbody>
                <tr>
                    <td width="200px">Feedback Status</td>
                    <td>{{ data.feedback_status ? data.feedback_status.name : data.feedback_status_id }}</td>
                </tr>
                <tr>
                    <td>Date of Feedback</td>
                    <td>{{ data.feedback_on ? data.feedback_on : '' }}</td>
                </tr>
                <tr>
                    <td>Feedback Notes</td>
                    <td>
                        <div class="border rounded bg-light p-3" v-html="data.feedback_notes"></div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    </div>
</template>
<script>

    export default {
        props: ['data'],
        components: {
        },
        data() {
            return {
            }
        },
    }
</script>