<template>
    <table class="table table-sm table-borderless">
        <tbody>
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
