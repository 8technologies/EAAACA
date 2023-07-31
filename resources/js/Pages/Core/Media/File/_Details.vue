<template>
    <table class="table table-sm table-borderless">
        <tbody>
            <tr>
                <th width="150px">File Name: </th>
                <td>
                    {{ data.file_name }}
                </td>
            </tr>
            <tr>
                <th>File Description: </th>
                <td>
                    {{ data.file_description }}
                </td>
            </tr>
            <tr>
                <th>Owner: </th>
                <td>
                    {{ data.user ? data.user.name : '' }}
                </td>
            </tr>
            <tr>
                <th>Usage: </th>
                <td>
                    {{ data.file_usage }}
                </td>
            </tr>
            <tr>
                <th>File Size: </th>
                <td>
                    {{ data.file_size }}
                </td>
            </tr>
            <tr>
                <th>Mime Type: </th>
                <td>
                    {{ data.mime_type }}
                </td>
            </tr>
        </tbody>
    </table>
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