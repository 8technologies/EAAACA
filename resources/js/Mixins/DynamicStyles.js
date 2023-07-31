import Vue from 'vue'

export default {
    data() {
        return {

        }
    },

    computed: {
        classes: function () {
            if (this.localData.width === null) {
                return 'col-md-12'
            }
            return this.localData.width
        },
        attributeClass() {
            return this.getFieldKeyValue('attributes', 'class')
        },
        _styles() {
            return this.getFieldKeyValueObject('styles')
        }
    },

    methods: {
        getFieldKeyValue: function(field, keyValue) {
            if (this.data[field] === null || typeof(this.data[field]) === 'undefined') {
                return null
            }

            var index = null
            index = this.data[field].findIndex(item => item['key'] === keyValue)

            if (index === -1) {
                return null
            } else {
                return this.data[field][index].value
            }
        },
        getFieldKeyValueObject: function(field) {
            // console.log( this )
            if (this.data[field] === null || typeof(this.data[field]) === 'undefined') {
                if (this.data.bg_image) {
                    var bgImageObj = {}
                    bgImageObj['background-image'] = `url('${ this.data.bg_image }')`
                    return bgImageObj
                }
                return null
            }

            var fieldObject = this.data[field].reduce(function(map, obj) {
                map[obj.key] = obj.value
                return map
            }, {})

            if (this.data.bg_image) {
                var bgImageObj = {}
                bgImageObj['background-image'] = `url('${ this.data.bg_image }')`
                // append 'background-image' style
                Object.assign(fieldObject, bgImageObj)
            }
            // console.log( Object.assign(fieldObject, bgImageObj) )
            return fieldObject
        },
        getAttributeElement: function () {
            var value = this.getFieldKeyValue('attributes', 'element')
            return value ? value : 'div'
        },
        getAttributeClass: function () {
            var value = this.getFieldKeyValue('attributes', 'class')
            return value ? value : null
        },
    },
}

