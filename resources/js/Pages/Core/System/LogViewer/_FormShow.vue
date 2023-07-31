<template>
    <div>
        <table class="table table-sm table-borderless">
            <tbody>
                <tr>
                    <th width="150px">ID: </th>
                    <td>{{ data.id }}</td>
                </tr>
                <tr>
                    <th>Type: </th>
                    <td>{{ data.type }}</td>
                </tr>
                <tr>
                    <th>Notifiable Type: </th>
                    <td>{{ data.notifiable_type }}</td>
                </tr>
                <tr>
                    <th>Notifiable Id: </th>
                    <td>{{ data.notifiable_id }}</td>
                </tr>
                <tr>
                    <th>Data: </th>
                    <td>{{ data.data }}</td>
                </tr>
                <tr>
                    <th>Read At: </th>
                    <td>{{ data.read_at }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
    export default {
        props: ['data'],
    }
</script>