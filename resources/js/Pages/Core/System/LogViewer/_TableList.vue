<template>

    <div class="">

        <div id="toolbar">
        </div>

        <BootstrapTable
            :id="tableID"
            ref="bootstrapTable"
            :columns="columns"
            :options="options"
            data-toolbar="#toolbar"
            :data="data">
        </BootstrapTable>

    </div>

</template>

<script>
    import ModalComponentsMixin from '@/Mixins/ModalComponents'
    import BootstrapTableMixin from '@/Mixins/Plugins/BootstrapTable'

    export default {
        props: [
            'data',
        ],
        mixins: [
            BootstrapTableMixin, 
            ModalComponentsMixin,
        ],
        data() {
            return {
                columns: [{
                    title: '',
                    field: '',
                    visible: false,
                }, {
                    field: 'level',
                    title: 'Level',
                    sortable: 'true',
                    formatter: (value, row) => {
                        return value
                    },
                }, {
                    field: 'datetime',
                    title: 'Time',
                    sortable: 'true',
                    width: '220',
                    formatter: (value, row) => {
                        return `<button class="btn btn-sm btn-outline-secondary">
                                ${ value }
                            </button>`
                    },
                }, {
                    field: 'header',
                    title: 'Header',
                }]
            }
        },
        methods: {
            detailFormatter(index, row) {
                var html = []
                $.each(row, function (key, value) {
                    html.push('<p><b>' + key + ':</b> ' + value + '</p>')
                })
                return html.join('')
            },
        },
        created() {
            this.$delete( this.options, 'serverSort')
            this.$delete( this.options, 'sidePagination')

            this.$set( this.options, 'pageSize', 25)
            this.$set( this.options, 'showHeader', true)

            this.$set( this.options, 'detailView', true)
            this.$set( this.options, 'detailFormatter', (index, row) => {
                return `<div class="text-danger"><code>${ row.stack }</code></div>`
            })
        },
    }





</script>

