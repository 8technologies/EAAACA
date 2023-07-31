<template>
    <div>
        <TableList :data="data"></TableList>
    </div>
</template>
<script>
    import TableList from '../Permission/_TableModelPermissions'

    export default {
        props: ['data'],
        components: {
            TableList,
        },
    }
</script>