<template>
    <div class="">
        <div class="row">
            <div class="col-lg-12">
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
                                <div class="border rounded bg-light p-3" v-html="data.description"></div>
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

                <div class="mt-3 pt-3 border-top">
                    <strong class="">Investigation findings</strong>
                    <div class="pt-3">
                        <PreviewCaseFinding v-for="(item, index) in data.case_findings" 
                            class="p-3 border bg-light rounded"
                            :class="(index != (data.case_findings.length-1)) ? 'mb-3' : ''"
                            v-bind:key="item.uuid"
                            :data="item">
                        </PreviewCaseFinding>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import FileDownload from '@/Pages/Core/Field/_FileDownload'
    import PreviewCaseFinding from '@/Pages/Custom/CaseFinding/_Preview'

    export default {
        props: ['data'],
        components: {
            FileDownload,
            PreviewCaseFinding,
        },
        // created() {
        //     console.log( this.data.case_findings )
        // },
    }
</script>