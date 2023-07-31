<template>

    <div class="border rounded bg-white mb-3 smaller">
        <div class="p-3">
            <div class="">
                <label>Created on: </label> {{ created_at }}
            </div>
            <div class="">
                <label>Last Update: </label> {{ updated_at }}
            </div>
            <div class="">
                <label>Author: </label> {{ data && data.user ? data.user.name : '' }}
            </div>
        </div>
        <div class="accordion" role="tablist">
            <b-card class="mb-0 rounded-0" no-body="">
                <b-card-header class="p-0" header-tag="header" role="tab">
                    <b-link block="" v-b-toggle.accordion-1="" class="px-3 py-2 d-block bg-light">
                        URL ALIAS
                    </b-link>
                </b-card-header>
                <b-collapse accordion="my-accordion" id="accordion-1" role="tabpanel">
                    <b-card-body>
                        <div class="">
                            <b-form-checkbox
                                id="auto-alias"
                                v-model="autoAlias"
                                name="auto-alias"
                                :value="true"
                                :unchecked-value="false">
                                Generate automatic URL alias<br>
                                <small>Uncheck this to create a custom alias below</small>
                            </b-form-checkbox>
                        </div>
                        <div class="">
                            <label for="slug">URL alias</label>
                            <b-form-input 
                                id="slug" 
                                placeholder="Enter URL Slug" 
                                :disabled="autoAlias == true ? true : false" 
                                v-model="slug" 
                                :class="[errors.slug ? 'is-invalid' : '']"
                                >
                            </b-form-input>
                            <small>Specify an alternative path by which this data can be accessed. For example, type "/about" when writing an about page.</small>
                            <span v-if="errors.slug" :class="['label text-danger small']">{{ errors.slug }}</span>
                        </div>

                    </b-card-body>
                </b-collapse>
            </b-card>
            <b-card class="mb-0" no-body="">
                <b-card-header class="p-0" header-tag="header" role="tab">
                    <b-link block="" v-b-toggle.accordion-2="" class="px-3 py-2 d-block bg-light">
                        AUTHORING INFORMATION
                    </b-link>
                </b-card-header>
                <b-collapse accordion="my-accordion" id="accordion-2" role="tabpanel">
                    <b-card-body>
                        <div class="form-group">
                            <label>Authored by</label>
                            <div class="">
                                <select2 id="user_id" :name="route('dashboard.users.index')" :options="ajaxOptions" :settings="{ placeholder: 'Author', ajax: ajax, templateResult: formatState, templateSelection: formatState }" v-model="user_id" :class="[errors.user_id ? 'is-invalid' : '']">
                                </select2>
                                <span v-if="errors.user_id" :class="['label text-danger small']">{{ errors.user_id }}</span>
                            </div>
                        </div>
                        <div class="form-group position-relative">
                            <label>Created on</label>
                            <date-picker 
                                id="created_at" 
                                :config="datePickerOptions" 
                                class="form-control" 
                                v-model="created_at" 
                                type="datetime" 
                                value-type="format" 
                                :class="[errors.created_at ? 'is-invalid' : '']">
                            </date-picker>
                            <span v-if="errors.created_at" :class="['label text-danger small']">{{ errors.created_at }}</span>
                        </div>
                    </b-card-body>
                </b-collapse>
            </b-card>
        </div> 
    </div>

</template>

<script>
    import MessagesMixin from '@/Mixins/Messages'
    import DBOperationsMixin from '@/Mixins/DBOperations'
    import Select2Mixin from '@/Mixins/Plugins/Select2'

    export default {
        mixins: [MessagesMixin, DBOperationsMixin, Select2Mixin],
        props: ['data'],
        data() {
            return {
                user_id: this.data && this.data.user_id ? this.data.user_id : '',
                slug: this.data && this.data.slug ? this.data.slug : '',
                created_at: this.data && this.data.created_at ? this.data.created_at : '',
                updated_at: this.data && this.data.updated_at ? this.data.updated_at : '',
                
                autoAlias: false,
                datePickerOptions: {
                    format: 'MM/DD/Y hh:mm A',
                    keepOpen: false,
                    widgetPositioning: {vertical: 'bottom'},
                },
            }
        },

        methods: {

        },
        watch: {
            autoAlias: {
                immediate: true,
                handler: function(newVal, oldVal) {
                    if (this.autoAlias == true) {
                        this.getParentWithFormField('slug').form.slug = ''
                    }
                    // this.$emit('updateParentFormValues', newVal)
                }
            },
            user_id: {
                // immediate: true,
                handler: function(newVal, oldVal) {
                    this.getParentWithFormField('user_id').form.user_id = newVal
                }
            },
            slug: {
                // immediate: true,
                handler: function(newVal, oldVal) {
                    this.getParentWithFormField('slug').form.slug = newVal
                }
            },
            created_at: {
                // immediate: true,
                handler: function(newVal, oldVal) {
                    this.getParentWithFormField('created_at').form.created_at = newVal
                }
            }
        },
        mounted() {
            // Author
            var data = {
                id: this.$page.props.user.id,
                text: this.$page.props.user.name,
                thumbnail: this.$page.props.user.thumbnail ? this.$page.props.user.thumbnail : ''
            };

            if (this.data.user) {
                data = {
                    id: this.data.user.id,
                    text: this.data.user.name,
                    thumbnail: this.data.user.thumbnail ? this.data.user.thumbnail : ''
                }   
            }

            var authorSelect = $('#user_id')
            var option = new Option(data.text, data.id, true, true)
            // SET CUSTOM DATA
            option.dataset.thumbnail = data.thumbnail
            authorSelect.append(option).trigger('change');
        },
        // created() {
        //     console.log( this.data.user )
        // }
    }

</script>

