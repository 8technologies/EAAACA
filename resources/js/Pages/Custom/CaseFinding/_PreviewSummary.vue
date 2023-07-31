<template>
    <div class="">
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-borderless table-sm table-no-spacing">
                    <tbody>
                        <tr>
                            <td width="200px">Case investigation</td>
                            <td>{{ data.case_investigation ? data.case_investigation.name : data.case_investigation_id }}</td>
                        </tr>
                        <tr>
                            <td>Date of submission</td>
                            <td>{{ data.date_of_submission ? data.date_of_submission : '' }}</td>
                        </tr>
                        <tr>
                            <td>Findings</td>
                            <td>
                                <div class="border rounded bg-white p-3" v-html="data.findings"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Attachments</td>
                            <td>
                                <div v-if="data.media_attachments[0]" class="">
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
            </div>
        </div>
    </div>
</template>
<script>
    import FileDownload from '@/Pages/Core/Field/_FileDownload'

    export default {
        props: ['data'],
        components: {
            FileDownload,
        },
        data() {
            return {
            }
        },
    }
</script>