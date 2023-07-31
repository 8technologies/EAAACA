<template>
    <div class="">
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-borderless table-sm table-no-spacing">
                    <tbody>
                        <tr>
                            <td width="200px">Information Request</td>
                            <td>{{ data.information_request ? data.information_request.name : data.information_request_id }}</td>
                        </tr>
                        <tr>
                            <td>Date of Response</td>
                            <td>{{ data.date_of_response ? data.date_of_response : '' }}</td>
                        </tr>
                        <tr>
                            <td>Response</td>
                            <td>
                                <div class="border rounded bg-light p-3" v-html="data.response"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Attachments</td>
                            <td>
                                <div v-if="data.media_attachments && data.media_attachments[0]" class="">
                                    <FileDownload v-for="(item, index) in data.media_attachments" v-bind:key="item.uid"
                                        :data="data" 
                                        :mediaEntity="item"
                                        :class="(index == 0) ? '' : 'border-top pb-0'"
                                        class="py-3">
                                    </FileDownload>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>

                <PreviewFeedback :data="data"></PreviewFeedback>
            </div>
        </div>
    </div>
</template>
<script>
    import FileDownload from '@/Pages/Core/Field/_FileDownload'
    import PreviewFeedback from './_PreviewFeedback.vue'

    export default {
        props: ['data'],
        components: {
            FileDownload,
            PreviewFeedback,
        },
        data() {
            return {
            }
        },
    }
</script>