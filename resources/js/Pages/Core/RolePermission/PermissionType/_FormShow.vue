<template>
    <div>
        <table class="table table-borderless table-sm table-no-spacing">
        <tbody>
            <tr>
                <th width="200px">Name:</th>
                <td>{{ data.name }}</td>
            </tr>
            <tr>
                <th>Description:</th>
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