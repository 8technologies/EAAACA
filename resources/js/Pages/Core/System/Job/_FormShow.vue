<template>
    <div class="">
        <table class="table table-borderless table-sm table-no-spacing">
            <tbody>
                <tr>
                    <th width="150px">Queue</th>
                    <td>{{ data.queue }}</td>
                </tr>
                <tr>
                    <th>Payload</th>
                    <td>
                        <div v-html="data.payload" class="p-3 border rounded"></div>
                    </td>
                </tr>
                <tr>
                    <th>Attempts</th>
                    <td>{{ data.attempts }}</td>
                </tr>
                <tr>
                    <th>Reserved at</th>
                    <td>{{ data.reserved_at }}</td>
                </tr>
                <tr>
                    <th>Available at</th>
                    <td>{{ data.available_at }}</td>
                </tr>
                <tr>
                    <th>Created at</th>
                    <td>{{ data.created_at }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import FunctionsMixin from '@/Mixins/Functions'

    export default {
        mixins: [FunctionsMixin],
        props: [
            'data',
        ],
        data() {
            return {

            }
        },
        components: {
        }
    }
</script>
