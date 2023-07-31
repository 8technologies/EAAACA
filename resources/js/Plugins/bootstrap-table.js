import './jquery.js'

import Vue from 'vue'
// import 'bootstrap'
import 'bootstrap-table/dist/bootstrap-table'
import 'bootstrap-table/dist/extensions/export/bootstrap-table-export'
import 'tableexport.jquery.plugin/libs/FileSaver/FileSaver.min.js'
import 'tableexport.jquery.plugin/tableExport.min.js'
// Styles
import 'bootstrap-table/dist/bootstrap-table.min.css'

import BootstrapTable from 'bootstrap-table/dist/bootstrap-table-vue.esm'
Vue.component('BootstrapTable', BootstrapTable)
