import Vue from 'vue'

export default {

    data() {
        return {
            optionSelected: null,
            optionsSelected: null,
            inputVal: "",
            ajaxOptions: [],
            ajax: {
                data: function(params) {
                    return {
                        // term: params.term || "",
                        query: params.term || "",
                        page: params.page || 1
                    };
                },

                url: function() {
                    if (this.attr('name')) {
                        return this.attr('name')
                    }
                },

                processResults: function (response) {
                    // console.log(response)
                    // console.log( this['$element'][0].name )
                    var idField = 'id'
                    var url = new URL(this['$element'][0].name)
                    var idParam = url.searchParams.get('id_field')

                    if (idParam != null) {
                        idField = idParam
                    }
                    // console.log( idField )
                    // Tranforms the top-level key of the response object from 'items' to 'results'
                    return {
                        results: response.data.map(item => {
                            return {
                                id: item[idField], 
                                text: item.name,
                                icon: item.file_icon,
                                // size: item.file_size,
                                thumbnail: item.thumbnail ? item.thumbnail : item.file_thumbnail,
                            }
                        }),
                        pagination: {
                            more: (function(response) {
                                // console.log(response.next_page_url)
                                if (response.next_page_url == null) {
                                    return false
                                }
                                return true
                            }(response))
                        }
                    };
                }

            },
            ajaxOptionsSelected: null
        };
    },

    mounted() {
        // $('select:not(.normal)').each(function () {
        //     console.log( this.select2 )
        //     // $(this).select2({
        //     //     dropdownParent: $(this).parent()
        //     // })
        // })
    },

    computed: {
        idField: function () {
            return 'id'
        },
    },

    methods: {

        formatState (state) {
            var thumbnail = state.thumbnail
            var icon = state.icon

            if (typeof state.element !== 'undefined') {
                if (state.element.dataset.icon) {
                    icon = state.element.dataset.icon
                }
                if (state.element.dataset.thumbnail) {
                    thumbnail = state.element.dataset.thumbnail
                }
            }
            // Return template with thumbnail if available
            if (thumbnail) {
                var $state = $(
                    `<div class="row align-items-center no-gutters">
                        <div class="col-auto pr-2"><img src="${thumbnail}" class="select-preview"/></div>
                        <div class="col text-break">${state.text}</div>
                    </div>`
                );
                return $state;
            }
            // Return template with icon if available
            if (icon) {
                var $state = $(
                    `<div class="row align-items-center no-gutters">
                        <div class="col-auto pr-2"><i class="${icon} select-preview"></i></div>
                        <div class="col text-break">${state.text}</div>
                    </div>`
                );
                return $state;
            }
            // Return the text attribute
            return state.text;
        },

        formatThumbnailPreview (state) {
            var thumbnail = state.thumbnail
            var icon = state.icon

            if (typeof state.element !== 'undefined') {
                if (state.element.dataset.icon) {
                    icon = state.element.dataset.icon
                }
                if (state.element.dataset.thumbnail) {
                    thumbnail = state.element.dataset.thumbnail
                }
            }
            // Return template with thumbnail if available
            if (thumbnail) {
                this.thumbnailPreview = thumbnail
            }

            // Return the text attribute
            return state.text;
        },

    },
}

