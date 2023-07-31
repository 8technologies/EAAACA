<template>
    <div class="">
        <TableList :data="data"></TableList>
    </div>
</template>
<script>
    import TableList from '../Permission/_TableRolePermissions'

    export default {
        props: ['data'],
        components: {
            TableList,
        },
    }
</script>