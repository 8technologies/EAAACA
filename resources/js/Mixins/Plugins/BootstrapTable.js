import Vue from 'vue'
import moment from 'moment'
import '@/Plugins/bootstrap-table.js'

export default {

    data() {
        return {
            uuid: 'uuid-' + this._uid,
            tableID: 'bootstrap-table-' + this._uid,
            options: {
                height: 680,
                toolbar: '#toolbar',
                showColumns: true,
                showExport: true,
                showRefresh: true,
                // table classes
                classes: 'table table-md bg-white rounded border',
                // thead classes
                theadClasses: 'bg-light',
                // // button class
                buttonsClass: 'outline-secondary',

                detailFormatter: (index, row) => {
                    var html = []

                    for (var key in row) {
                        var value = row[key];
                        html.push('<p><b>' + key + ':</b> ' + value + '</p>')
                    }

                    return '<p>' + html.join('') + '</p>'
                },
                // enable stable sort
                sortStable: false,
                // remember order direction
                rememberOrder: false,
                // enable server-side sort
                serverSort: true,
                // total field
                totalField: 'total',
                // total not filtered
                totalNotFilteredField: 'totalNotFiltered',
                // data field
                dataField: 'data',
                // AJAX options
                method: 'get',
                // url: undefined,
                // ajax: 'ajaxRequest',
                cache: false,
                contentType: 'application/json',
                dataType: 'json',
                ajaxOptions: {},
                queryParams: (params, tableID = this.tableID) => {
                    var $table = $('table#' + tableID)
                    var options = $table.bootstrapTable('getOptions')

                    // console.log( tableID )
                    $(options.toolbar).find('input[name], select').each(function () {
                        if ($(this).attr('name').length > 10 && $(this).val() != null) {
                            params[$(this).attr('id')] = $(this).val()
                        } else {
                            if ($(this).val() != null) {
                                params[$(this).attr('name')] = $(this).val()
                            }
                        }
                    })

                    // console.log( params )

                    // Export all records with server side pagination
                    if (!options.pagination) {
                        params.limit = options.totalRows
                    }

                    params.page = params.offset / params.limit + 1
                    // params.sort = 'id'
                    params.sortby = params.sort
                    params.sorttype = params.order
                    params.query = params.search
                    
                    return params;
                },
                queryParamsType: 'limit', // undefined
                // pagination options
                pagination: true,
                onlyInfoPagination: false,
                showExtendedPagination: false,
                paginationLoop: false,
                sidePagination: 'server', // client or server
                // totalRows: 20, // server side need to set
                // totalNotFiltered: 0,
                pageNumber: 1,
                pageSize: 25,
                pageList: [25, 50, 100, 200, 500, 1000, 2000, 5000, 'All'],
                paginationHAlign: 'right', //right, left
                paginationVAlign: 'bottom', //bottom, top, both
                paginationDetailHAlign: 'left', //right, left
                paginationPreText: '&lsaquo;',
                paginationNextText: '&rsaquo;',
                paginationSuccessivelySize: 5, // Maximum successively number of pages in a row
                paginationPagesBySide: 1, // Number of pages on each side (right, left) of the current page.
                paginationUseIntermediate: false, // Calculate intermediate pages for quick access
                // live search options
                search: true,
                searchOnEnterKey: false,
                strictSearch: false,
                searchAlign: 'left',
                visibleSearch: false,
                showButtonIcons: true,
                showButtonText: false,
                showSearchButton: false,
                showSearchClearButton: false,
                // name of radio or checkbox input
                selectItemName: 'btSelectItem',
                // show table header
                showHeader: true,
                stickyHeader: true,
                // show table footer
                showFooter: false,
                // show specific columns
                showColumns: true,
                // show toggle all
                showColumnsToggleAll: true,
                // shows column search field
                showColumnsSearch: true,
                // show pagination switch
                showPaginationSwitch: false,
                // show refresh button
                showRefresh: true,
                // show toggle button (card view & detail view)
                showToggle: true,
                // show fullscreen button
                showFullscreen: true,
                // auto display card view
                smartDisplay: true,
                // escape a string for insertion into HTML
                escape: false,
                // minimum number of columns to hide from the columns drop down list.
                minimumCountColumns: 2,
                // which field is an identity field
                idField: 'id',
                // unique identifier for each row
                uniqueId: 'id',
                // enable card view
                cardView: false,
                // detail view
                detailView: false,
                showExport: true,
                exportDataType: 'all',
                exportTypes: ['json', 'xml', 'csv', 'txt', 'sql', 'excel'],
                loadingTemplate: function() {
                    return '<i class="fa fa-spinner fa-spin fa-fw fa-2x"></i>'
                },
            }
        }
    },

    mounted() {

        this.$root.$on('bv::dropdown::hide', bvEvent => {
            if (document.activeElement.className == 'select2-search__field') {
                bvEvent.preventDefault()
            }
        })

        var $table = $('table#' + this.tableID)
        var $remove = $('#remove')
        var selections = []

        $table.on('check.bs.table uncheck.bs.table ' + 'check-all.bs.table uncheck-all.bs.table', (e) => {
            $remove.prop('disabled', !$table.bootstrapTable('getSelections').length)
                // save your data, here just save the current page
            selections = this.getIdSelections()
                // console.log(selections)
        });

        $remove.click((e) => {
            e.preventDefault()

            var ids = this.getIdSelections()
            this.deleteMultiple(ids)
        });

        $('body').on('click', 'a.clear-Filters', (e) => {
            e.preventDefault()
            this.clearInputFilters()
            this.clearSelect2Filters()
            this.refreshBootstrapTable()
        });

    },


    methods: {

        getBoostrapTableID: function(refValue) {
            return 'bootstrap-table-' + this.getParentWithRef('bootstrapTable')._uid
        },

        getChildBoostrapTableID: function() {
            if (this.getChildWithRef('bootstrapTable')) {
                return 'bootstrap-table-' + this.getChildWithRef('bootstrapTable')._uid
            }
        },

        getParentWithRef: function(refValue) {
            var vueInstance = this
            for (var i = 0; i < 10; i++) {
                if ( typeof(vueInstance) !== 'undefined' && Object.keys(vueInstance.$refs).includes(refValue) ) {
                    i = 10
                }

                if (i < 10 && typeof(vueInstance.$parent) !== 'undefined' ) {
                    vueInstance = vueInstance.$parent
                }
            }
            return vueInstance
        },

        getChildWithRef: function(refValue) {
            var vueInstance = this
            var refInstance = null

            for (var i = 0; i < 10; i++) {
                if ( typeof(vueInstance) !== 'undefined' && vueInstance.$children[0] ) {
                    var currentInstance = vueInstance.$children
                    currentInstance.forEach(element => {
                        if ( Object.keys(element.$refs).includes(refValue) ) {
                            refInstance = element
                            i = 10
                        }
                    });
                }

                if (i < 10 && typeof(vueInstance.$parent) !== 'undefined' ) {
                    vueInstance = vueInstance.$parent
                }
            }
            return refInstance
        },

        getIdSelections: function() {
            if ($('input[name="btSelectAll"]').prop("checked") == true) {
                return ['all']
            }
            return $.map($('table#' + this.tableID).bootstrapTable('getSelections'), function(row) {
                return row.id
            })
        },

        clearSelect2Filters() {
            $('#dropdown-filters').find('select').each(function () {
                $(this).val(null).trigger('change');
            })
        },

        clearInputFilters() {
            $('#dropdown-filters').find('input').each(function () {
                $(this).val(null);
            })
        },

        moment: function(value) {
            return moment(value);
        },
        // Bootstrap-table methods
        refreshBootstrapTable() {
            // console.log( this.getBoostrapTableID() )          
            if (this.$refs.bootstrapTable) {
                this.$refs.bootstrapTable.refresh()
            } else {
                if (document.getElementById(this.getBoostrapTableID()) != null) {
                    $('table#' + this.getBoostrapTableID()).bootstrapTable('refresh')
                } else {
                    var tableID = this.getChildBoostrapTableID()
                    if (tableID) {
                        $('table#' + this.getChildBoostrapTableID()).bootstrapTable('refresh')
                    }
                }
            }
        },
        getBootstrapTableUrl() {
            var url = $('table#' + this.tableID).bootstrapTable('getOptions').url;

            if (url) {
                return url;
            } else {
                return false;
            }
        },
        getBootstrapTableBaseUrl() {
            var baseurl = $('table#' + this.tableID).bootstrapTable('getOptions').baseurl;

            if (baseurl) {
                return baseurl;
            } else {
                return false;
            }
        },
        nameFormatter(value, row) {
            var url = ''
            var markup = ''

            if (typeof row.entity_links !== 'undefined') {
                markup = `
                    <a class="inertia-link font-weight-500" href="${ row.entity_links['url'] }">
                        ${value}
                    </a>
                `;
            } else {
                if (this.getBootstrapTableBaseUrl()) {
                    url = this.getBootstrapTableBaseUrl();
                } else {
                    url = this.getBootstrapTableUrl();
                }

                markup = `
                    <a class="inertia-link font-weight-500" href="${url}/${row.id}">
                        ${value}
                    </a>
                `;
            }

            // check if entity_permissions is set, an determine if the user has access to view
            if (typeof row.entity_permissions !== 'undefined') {

                if (row.entity_permissions['view'] == false) {
                    markup = `
                            ${value}
                    `;
                }
            }

            return markup;
        },

        linkEntityNameFormatter(value, row) {
            if (typeof value !== 'object') {
                return
            }

            var url = value.entity_links.url
            var name = value.name
            var markup = ''

            markup = `
                <a class="inertia-link font-weight-500" href="${ url }">
                    ${ name }
                </a>
            `;

            // check if entity_permissions is set, an determine if the user has access to view
            if (typeof row.entity_permissions !== 'undefined') {

                if (row.entity_permissions['view'] == false) {
                    markup = `
                            ${name}
                    `;
                }
            }

            return markup;
        },

        truncateFormatter(value, row, length = 50) {
            const suffix = '...'

            if (value != null && value.length > length) {
                return value.substring(0, length) + suffix
            } else {
                return value
            }
        },
        emailFormatter(value, row) {
            return `
                <a class="email-link" href="mailto:${value}" title="${value}">
                    ${value}
                </a>
            `;
        },
        objectFormatter(value, row) {
            return JSON.stringify(value, null, 2);
        },
        objectNameListFormatter(value, row) {
            var htmlString = '';
            for (var i = value.length - 1; i >= 0; i--) {
                htmlString += value[i].name;
                if (i > 0) {
                    htmlString += ', ';
                } else {
                    htmlString += ' ';
                }
            }
            return htmlString;
        },
        objectNameFormatter(value, row) {
            if (value) {
                return value['name'];
            }
        },
        imageUrlFormatter(value, row) {
            var url = value;
            var markup = ``
            
            if (value) {
                markup = `
                    <img src="${url}" class="img-fluid img-thumbnail">
                `
            }
            
            return markup;
        },

        authorFormatter(value, row) {
            var url = '';
            var markup = ''

            if (value && value.thumbnail) {
                url = value.thumbnail
            } else if (value && value.thumbnail) {
                url = value.thumbnail
            }

            markup = `
                <div class="row align-items-center no-gutters">
                    <div class="col-auto pr-2">
                        <img src="${url}" class="select-preview"/>
                    </div>
                    <div class="col text-truncate width-100px">
                        ${ value && value.name ? value.name : ''}
                    </div>
                </div>`;

            return markup;
        },
        objectImageFormatter(value, row) {
            var url = value;
            const markup = `
                <img src="${url}" class="img-fluid img-thumbnail">
            `;
            return markup;
        },
        downloadFormatter(value, row) {
            var html = '';
            $.each(value, function(key, item) {
                var downloadLink = item['download_link'];
                var downloadIcon = item['icon'];
                var downloadName = item['file_name'];
                html = html + `
                    <div class="">
                        <a href="${downloadLink}">
                            <span class="${downloadIcon}"></span>
                            ${downloadName}
                        </a>
                    </div>
                `;
            });
            return html;
        },
        timeAgo(value, row) {
            var dateValue = this.moment(value).fromNow('D MMM YYYY');
            const markup = `
                ${dateValue}
            `;
            return markup;
        },
        dateFormatter(value, row) {
            var dateValue = this.moment(value).format('D MMM YYYY');
            const markup = `
                ${dateValue}
            `;
            return markup;
        },
        dateDayFormatter(value, row) {
            var dateValue = this.moment(value).format('D');
            const markup = `
                ${dateValue}
            `;
            return markup;
        },
        jaascriptDateFormatter(date) {
            return this.moment(date).format('D MMM, YYYY hh:mm');
        },
        calDifferenceBtnDates(date1, date2) {
            var date1 = this.jaascriptDateFormatter(date1)
            var date2 = this.jaascriptDateFormatter(date2)

            var fromDate = parseInt(new Date(date1).getTime()); 
            var toDate = parseInt(new Date(date2).getTime());
            var timeDiff = (toDate - fromDate);  // will give difference in hrs

            return this.convertMS(timeDiff)
        },
        convertMS(ms) {
            var d, h, m, s;
            s = Math.floor(ms / 1000);
            m = Math.floor(s / 60);
            s = s % 60;
            h = Math.floor(m / 60);
            m = m % 60;
            d = Math.floor(h / 24);
            h = h % 24;
            h += d * 24;
            return h + ':' + m;
        },
        convertSecondsToHMS(seconds) {
            var d = Number(seconds)

            if (d <= 0) {
                return 0;
            }

            var h = Math.floor(d / 3600)
            var m = Math.floor(d % 3600 / 60)
            var s = Math.floor(d % 3600 % 60)

            if (seconds) {
                return h + ':' + m;
            }
            
        },
        dateMonthFormatter(value, row) {
            var dateValue = this.moment(value).format('MM');
            const markup = `
                ${dateValue}
            `;
            return markup;
        },
        dateTimeFormatter(value, row) {
            if (!value) {
                return
            }
            var dateValue = this.moment(value).format('lll');
            const markup = `
                ${dateValue}
            `;
            return markup;
        },
        getTableBaseUrl() {
            var url = '';
            // get the BootstrapTable url
            if (this.getBootstrapTableBaseUrl()) {
                url = this.getBootstrapTableBaseUrl();
            } else {
                url = this.getBootstrapTableUrl();
            }

            return url
        },
        actionFormatterInertia(value, row) {
            var markup = ''
            var url = this.getTableBaseUrl()
            var redirect = '?destination='+this.$page.url

            var viewLink = `
                <a href="${url}/${row.id}" title="${row.name}" class="mr-2 inertia-link text-secondary">
                    <span class="fa fa-eye"></span>
                </a>`
            var editLink = `
                <a href="${url}/${row.id}/edit" title="${row.name}" class="mr-2 inertia-link text-secondary">
                    <span class="fa fa-pencil-alt"></span>
                </a>`
            var deleteLink = `
                <a href="${url}/${row.id}" data-id="${row.id}" title="Delete" class="delete-item text-secondary">
                    <span class="fa fa-trash"></span>
                </a>`

            // check if entity_urls are set, and modify the link variables
            if (typeof row.entity_links !== 'undefined') {
                viewLink = `
                    <a href="${row.entity_links['url_view']}" title="${row.name}" class="mr-2 inertia-link text-secondary">
                        <span class="fa fa-eye"></span>
                    </a>`
                editLink = `
                    <a href="${row.entity_links['url_edit']+redirect}" title="${row.name}" class="mr-2 inertia-link text-secondary">
                        <span class="fa fa-pencil-alt"></span>
                    </a>`
                deleteLink = `
                    <a href="${row.entity_links['url_view']}" data-id="${row.id}" title="Delete" class="delete-item text-secondary">
                        <span class="fa fa-trash"></span>
                    </a>`
            }

            // 
            markup = `
                <div class="d-flex">
                    ${viewLink}
                    ${editLink}
                    ${deleteLink}
                </div>
            `;

            // if entity_permissions is set, modify the visible links
            if (typeof row.entity_permissions !== 'undefined') {
                markup = `
                    <div class="d-flex">
                        ${row.entity_permissions['view'] ? viewLink : '<span class="ml-2 mr-3"> </span>'}
                        ${row.entity_permissions['edit'] ? editLink : '<span class="ml-2 mr-3"> </span>'}
                        ${row.entity_permissions['delete'] ? deleteLink : '<span class="ml-2 mr-3"> </span>'}
                    </div>
                `;
            }

            return markup

        },
        actionFormatterVerified(value, row) {
            var markup = ''
            var url = this.getTableBaseUrl()

            var editLink = `
                <a href="${url}/${row.id}/edit" title="${row.name}" class="edit-verified btn btn-sm ${ value ? 'btn-success' : 'btn-secondary'}">
                    ${ value ? 'Y' : 'N'}
                </a>`

            markup = `
                <div class="d-flex">
                    ${editLink}
                </div>
            `;

            return markup
        },
        actionFormatterEnabled(value, row) {
            var markup = ''
            var url = this.getTableBaseUrl()

            var editLink = `
                <a href="${url}/${row.id}/edit" title="${row.name}" class="edit-enabled btn btn-sm ${ value ? 'btn-success' : 'btn-secondary'}">
                    ${ value ? 'Y' : 'N'}
                </a>`

            markup = `
                <div class="d-flex">
                    ${editLink}
                </div>
            `;

            return markup
        },
        actionFormatterPassword(value, row) {
            var markup = ''
            var url = this.getTableBaseUrl()

            var editLink = `
                <a href="${url}/${row.id}/edit" title="${row.name}" class="edit-password btn btn-sm btn-outline-secondary">
                    Reset
                </a>`

            markup = `
                <div class="d-flex">
                    ${editLink}
                </div>
            `

            return markup
        },
        actionFormatter(value, row) {
            var markup = ''
            var url = this.getTableBaseUrl()

            var viewLink = `
                <a href="${url}/${row.id}" title="${row.name}" class="mr-2 view-item text-secondary">
                    <span class="fa fa-eye"></span>
                </a>`
            var editLink = `
                <a href="${url}/${row.id}/edit" title="${row.name}" class="mr-2 edit-item text-secondary">
                    <span class="fa fa-pencil-alt"></span>
                </a>`
            var deleteLink = `
                <a href="${url}/${row.id}" data-id="${row.id}" title="Delete" class="delete-item text-secondary">
                    <span class="fa fa-trash"></span>
                </a>`

            // check if entity_urls are set, and modify the link variables
            if (typeof row.entity_links !== 'undefined') {
                viewLink = `
                    <a href="${row.entity_links['url']}" title="${row.name}" class="mr-2 view-item text-secondary">
                        <span class="fa fa-eye"></span>
                    </a>`
                editLink = `
                    <a href="${row.entity_links['url_edit']}" title="${row.name}" class="mr-2 edit-item text-secondary">
                        <span class="fa fa-pencil-alt"></span>
                    </a>`
                deleteLink = `
                    <a href="${row.entity_links['url_view']}" data-id="${row.id}" title="Delete" class="delete-item text-secondary">
                        <span class="fa fa-trash"></span>
                    </a>`
            }

            // 
            markup = `
                <div class="d-flex">
                    ${viewLink}
                    ${editLink}
                    ${deleteLink}
                </div>
            `;

            // if entity_permissions is set, modify the visible links
            if (typeof row.entity_permissions !== 'undefined') {
                markup = `
                    <div class="d-flex">
                        ${row.entity_permissions['view'] ? viewLink : '<span class="ml-2 mr-3"> </span>'}
                        ${row.entity_permissions['edit'] ? editLink : '<span class="ml-2 mr-3"> </span>'}
                        ${row.entity_permissions['delete'] ? deleteLink : '<span class="ml-2 mr-3"> </span>'}
                    </div>
                `;
            }

            return markup

        },

        actionFormatterViewDelete(value, row) {
            if (row.entity_data && row.permissions) {

                const viewLink = `
                    <a href="${row.entity_data['url']}" title="${row.name}" class="view-item btn btn-sm btn-outline-primary">
                        <span class="fa fa-eye"></span>
                    </a>
                    `;
                const deleteLink = `
                    <a href="javascript:void(0);" data-href="${row.entity_data['url_delete']}" title="Delete" data-title="${row.name}" class="delete-item btn btn-sm btn-outline-danger">
                        <span class="fa fa-trash"></span>
                    </a>
                    `;

                if (typeof row.editable === 'undefined') {
                    const markup = `
                        <div class="d-flex">
                        ${row.permissions['view'] ? viewLink : ''}
                        ${row.permissions['delete'] ? deleteLink : ''}
                        </div>
                    `;
                    return markup;
                }

                const markup = `
                    <div class="d-flex">
                    ${row.permissions['view'] && row.editable ? viewLink : ''}
                    ${row.permissions['delete'] && row.editable ? deleteLink : ''}
                    </div>
                `;
                return markup;

            } else {

                var url = this.getTableBaseUrl()

                const markup = `
                    <div class="d-flex">
                        <a href="${url}/${row.id}" title="${row.name}" class="mr-2 view-item text-secondary">
                            <span class="fa fa-eye"></span>
                        </a>
                        <a href="${url}/${row.id}" data-id="${row.id}" title="Delete" class="delete-item text-secondary">
                            <span class="fa fa-trash"></span>
                        </a>
                    </div>
                `;

                return markup;
            }
        },






        actionFormatterProfile(value, row) {
            var markup = ''
            var url = this.getTableBaseUrl()

            var editLink = `
                <a href="${url}/${row.id}/edit-profile" title="${row.name}" class="edit-profile px-3 btn btn-sm ${ value ? 'btn-outline-primary' : 'btn-outline-primary'}">
                    ${ 'Edit'}
                </a>`

            markup = `
                <div class="d-flex">
                    ${editLink}
                </div>
            `;

            return markup
        },


    }
}