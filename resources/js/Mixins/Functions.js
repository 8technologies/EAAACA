import Vue from 'vue'

export default {

    methods: {
        inertiaVisit: function(data) {
            this.$inertia.get(data.url, [], [])
            // Inertia.visit(data.url, {method: 'get'})
        },


        truncateText (text=null, length=200, suffix='...') {
            if (text != null) {
                text = text.replace(/(<([^>]+)>)/gi, "")
                return text.substring(0, length) + suffix
            } else {
                return text
            }
        },
        humanFileSize: function(size) {
            var i = Math.floor( Math.log(size) / Math.log(1024) )
            return (size / Math.pow(1024, i)).toFixed(2) * 1 + ' ' + ['B', 'KB', 'MB', 'GB', 'TB'][i]
        },





        timestampToDateTime (timestamp) {
            var date = new Date(timestamp)
            return date
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
        dateShort(value) {
            return value
            // return moment(value).format('ll');
        },
        formatDate(value) {
            return new Date(value).toLocaleDateString('en-us', { 
                day:"numeric", 
                month:"long", 
                year:"numeric"
            })
        },




        getCurrentUrl() {
            return this.route().t.url + this.$page.url
        },

        checkIfCurrentUrl(link) {
            if (link == this.getCurrentUrl()) {
                return true
            }
            return false
        },
        checkActivePath(path) {
            if (this.$page.url.includes(path)) {
                return true
            }
            return false
        },

        checkActivePaths(paths) {
            for (var i = 0; i < paths.length; i++) {
                if (this.$page.url.includes(paths[i])) {
                    return true
                }
            }
            return false
        },



        // Permission methods

        checkModelPermissions(entity, permission = null) {
            // if Null, check for listing  permissions only
            if (permission === null) {
                var viewAny = this.$page.props.permissions.indexOf(entity + '.index') !== -1
                var manageAll = this.$page.props.permissions.indexOf(entity + '.*') !== -1

                if (viewAny || manageAll) {
                    return true
                } else {
                    return false
                }
            }

            return this.$page.props.permissions.indexOf(entity + '.' + permission) !== -1;
        },

        checkPermission(permission) {
            return this.$page.props.permissions.indexOf(permission) !== -1;
        },

        checkPermissionAndModelAccess(permission, model) {
            if (this.checkPermission(permission) == true) {
                return false // Enable link
            }

            if (this.checkModelPermissions(model) == true) {
                return false // Enable link
            }

            return true // disable the link
        },

        checkUserRoles(role) {
            if (this.$page.props.user.roles) {
                var roleExists = this.$page.props.user.roles.find(item => item.name === role);
                // console.log( roleExists === '' )
                return roleExists
            }
        },




        // search
        search: function (event) {
            event.preventDefault()
            event.srcElement.submit.firstChild.className += this.spinnerClasses
            this.showSpinner = true

            var URL = event.target.action

            var params = ''
            var paramsArray = []
            var element = null
            var useElementName = true
            var object = event.target.elements

            for (const key in object) {
                element = object[key]

                if (element.hasOwnProperty.call(object, key) && object[key].name && object[key].value) {
                    element = object[key]
                    useElementName = true

                    if (element.name.length > 10) {
                        useElementName = false
                    }

                    if ( paramsArray.indexOf(element.name) === -1 ) {
                        if (useElementName) {
                            params += '&'+element.name + '=' + element.value
                        } else {
                            params += '&'+element.id + '=' + element.value
                        }
                        paramsArray.push( element.name )
                    }
                }
            }

            if (params != '') {
                URL = URL + '?' + params
            }

            this.$inertia.get(URL, this.form, {
                onProgress: (progress) => {
                    // Handle progress event
                },
                onSuccess: (page) => {
                    // Handle success event
                    // this.showSuccessMessage(page.props.flash.success)
                },
                onError: (errors) => {
                    // Handle validation errors
                    this.errors = errors;
                    this.success = false;
                    this.showErrorMessages(this.errors)
                },
                onFinish: () => {
                    event.srcElement.submit.firstChild.className = ''
                }
            })
        },




        
        getParentWithFormField: function(formField) {
            var vueInstance = this
            for (var i = 0; i < 10; i++) {
                if ( typeof(vueInstance) !== 'undefined' && Object.keys(vueInstance._data).includes('form') && Object.keys(vueInstance._data.form).includes(formField) ) {
                    i = 10
                }

                if (i < 10 && typeof(vueInstance.$parent) !== 'undefined' ) {
                    vueInstance = vueInstance.$parent
                }
            }
            return vueInstance
        },

        getParentWithForm: function() {
            var vueInstance = this
            for (var i = 0; i < 10; i++) {
                if ( typeof(vueInstance) !== 'undefined' && Object.keys(vueInstance._data).includes('form') ) {
                    i = 10
                }

                if (i < 10 && typeof(vueInstance.$parent) !== 'undefined' ) {
                    vueInstance = vueInstance.$parent
                }
            }
            return vueInstance
        },
        getParentWithMethod: function(methodName) {
            var vueInstance = this.$parent
            for (var i = 0; i < 10; i++) {
                if ( typeof vueInstance[methodName] == 'function' ) {
                    // console.log( 'found', vueInstance )
                    i = 10
                }

                if (i < 10 && typeof(vueInstance.$parent) !== 'undefined' ) {
                    // console.log( 'not found', vueInstance )
                    vueInstance = vueInstance.$parent
                }
            }
            return vueInstance
        },



        formatTags(objArray, separator = ', ') {
            let tagString = ''
            objArray.forEach(function (element, index, objArray) {

                if (element.entity_links) {
                    tagString += `
                        <a href="${ element.entity_links.url }" class="inertia-link tag">${ element.name }</a>${ separator != null && (objArray.length-1) != index ? separator : '' }
                    `
                } else {
                    tagString += `
                        <span class="tag">${ element.name }</span>${ separator != null && (objArray.length-1) != index ? separator : '' }
                    `
                }
            });

            return tagString            
        },








        formatEnabled(value, row) {
            var markup = ''

            var editLink = `
                <span class="edit-enabled btn btn-sm ${ value ? 'btn-success' : 'btn-secondary'}">
                    ${ value ? 'Y' : 'N'}
                </span>`

            markup = `
                <div class="d-flex">
                    ${editLink}
                </div>
            `;

            return markup
        },

        // Custom functions
        formatStatus(status) {
            var formattedStatus = ``

            switch (status) {
                case 'NEW':
                    formattedStatus = `<span class="rounded-pill btn btn-sm btn-outline-primary text-nowrap d-block px-3">
                        ${ status }
                    </span>`
                    break;

                case 'PENDING':
                    formattedStatus = `<span class="rounded-pill btn btn-sm btn-outline-danger text-nowrap d-block px-3">
                        ${ status }
                    </span>`
                    break;

                case 'AWAITING RESPONSE':
                    formattedStatus = `<span class="rounded-pill btn btn-sm btn-outline-warning text-nowrap d-block px-3">
                        ${ status }
                    </span>`
                    break;

                case 'AWAITING FEEDBACK':
                    formattedStatus = `<span class="rounded-pill btn btn-sm btn-outline-info text-nowrap d-block px-3">
                        ${ status }
                    </span>`
                    break;

                case 'COMPLETED':
                    formattedStatus = `<span class="rounded-pill btn btn-sm btn-success text-nowrap d-block px-3">
                        ${ status }
                    </span>`
                    break;

                case 'AWAITING FEEDBACK':
                    formattedStatus = `<span class="rounded-pill btn btn-sm btn-outline-black text-nowrap d-block px-3">
                        ${ status }
                    </span>`
                    break;

                case 'MORE INFORMATION NEEDED':
                    formattedStatus = `<span class="rounded-pill btn btn-sm btn-outline-info text-nowrap d-block px-3">
                        ${ status }
                    </span>`
                    break;
                                
                default:
                    formattedStatus = `<span class="rounded-pill btn btn-sm btn-dark text-nowrap d-block px-3">
                        ! ${ status }
                    </span>`
                    break;
            }
            return formattedStatus            
        },


    }
}

