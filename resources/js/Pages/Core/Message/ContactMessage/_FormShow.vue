<template>
    <table class="table table-sm table-borderless">
        <tbody>
            <tr>
                <th width="150px">Name: </th>
                <td>{{ data.name }}</td>
            </tr>
            <tr>
                <th>Email: </th>
                <td>{{ data.email }}</td>
            </tr>
            <tr>
                <th>Phone number: </th>
                <td>{{ data.phone_number }}</td>
            </tr>
            <tr>
                <th>Message: </th>
                <td>
                    <b-form-textarea
                        class="bg-white"
                        disabled
                        rows="5"
                        v-model="data.message"
                        >
                    </b-form-textarea>
                </td>
            </tr>
            <tr>
                <th>Created at: </th>
                <td>{{ data.created_at }}</td>
            </tr>
        </tbody>
    </table>
</template>

<script>
    import FrontEndMixin from '@frontend/Mixins/FrontEnd'

    export default {
        mixins: [FrontEndMixin],
        props: [
            'data',
        ],
        data() {
            return {
            }
        },
    }
</script>
