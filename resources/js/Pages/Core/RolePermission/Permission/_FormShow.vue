<template>
    <div>
        <table class="table table-sm table-borderless">
            <tbody>
                <tr>
                    <th width="200px">Name: </th>
                    <td>{{ data.name }}</td>
                </tr>
                <tr>
                    <th>Model: </th>
                    <td>{{ data.model.name }}</td>
                </tr>
                <tr>
                    <th>Description: </th>
                    <td>{{ data.description }}</td>
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
