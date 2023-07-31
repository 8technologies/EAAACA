<template>
    <div>
        <b-row class="form-group">
            <b-col sm="3">
                <label>UUID</label>
            </b-col>
            <b-col sm="9">
                <b-form-input id="uuid" disabled="disabled" v-model="form.uuid" :class="[errors.uuid ? 'is-invalid' : '']">
                </b-form-input>
                <span v-if="errors.uuid" :class="['label text-danger small']">{{ errors.uuid }}</span>
            </b-col>
        </b-row>

        <b-row class="form-group">
            <b-col sm="3">
                <label>Name</label>
            </b-col>
            <b-col sm="9">
                <b-form-input id="name" placeholder="Enter name" v-model="form.name" :class="[errors.name ? 'is-invalid' : '']">
                </b-form-input>
                <span v-if="errors.name" :class="['label text-danger small']">{{ errors.name }}</span>
            </b-col>
        </b-row>

        <b-row class="form-group">
            <b-col sm="3">
                <label>Body</label>
            </b-col>
            <b-col sm="9">
                <b-form-textarea id="title" rows="4" max-rows="6" v-model="form.body" :class="[errors.body ? 'is-invalid' : '']">
                </b-form-textarea>
                <span v-if="errors.body" :class="['label text-danger small']">{{ errors.body }}</span>
            </b-col>
        </b-row>

        <div class="accordion" role="tablist">

            <b-card no-body class="mb-0">
                <b-card-header header-tag="header" role="tab">
                    <b-button block v-b-toggle.accordion-visibility variant="link secondary">Block visibility<i class="fa fa-angle-right"></i></b-button>
                </b-card-header>
                <b-collapse id="accordion-visibility" accordion="settings-accordion" role="tabpanel">
                    <b-card-body>
                        <b-row class="form-group">
                            <b-col sm="3">
                                <label>Show on the following Pages</label>
                            </b-col>
                            <b-col sm="9">
                                <b-form-textarea id="show_on_pages" rows="3" max-rows="4" v-model="form.show_on_pages" :class="[errors.show_on_pages ? 'is-invalid' : '']">
                                </b-form-textarea>
                                <span v-if="errors.show_on_pages" :class="['label text-danger small']">{{ errors.show_on_pages }}</span>
                            </b-col>
                        </b-row>
                    </b-card-body>
                </b-collapse>
            </b-card>

            <b-card no-body class="mb-0">
                <b-card-header header-tag="header" role="tab">
                    <b-button block v-b-toggle.accordion-settings variant="link secondary">Dynamic Data Settings<i class="fa fa-angle-right"></i></b-button>
                </b-card-header>
                <b-collapse id="accordion-settings" accordion="settings-accordion" role="tabpanel">
                    <b-card-body>

                        <b-row class="form-group">
                            <b-col sm="3">
                                <label>Controller Name</label>
                            </b-col>
                            <b-col sm="9">
                                <b-form-input id="controller_name" v-model="form.controller_name" placeholder="Enter Controller Name" ></b-form-input>
                                <span v-if="errors.controller_name" :class="['label text-danger small']">{{ errors.controller_name }}</span>
                            </b-col>
                        </b-row>

                        <b-row class="form-group">
                            <b-col sm="3">
                                <label>Controller Method</label>
                            </b-col>
                            <b-col sm="9">
                                <b-form-input id="controller_method" v-model="form.controller_method" placeholder="Enter Controller method" ></b-form-input>
                                <span v-if="errors.controller_method" :class="['label text-danger small']">{{ errors.controller_method }}</span>
                            </b-col>
                        </b-row>

                        <b-row class="form-group">
                            <b-col sm="3">
                                <label>Component Name</label>
                            </b-col>
                            <b-col sm="9">
                                <b-form-input id="component_name" v-model="form.component_name" placeholder="Enter component name" ></b-form-input>
                                <span v-if="errors.component_name" :class="['label text-danger small']">{{ errors.component_name }}</span>
                            </b-col>
                        </b-row>

                        <!-- <b-row class="form-group">
                            <b-col sm="3">
                                <label>Display Style</label>
                            </b-col>
                            <b-col sm="9">
                                <b-form-input id="display_style" v-model="form.display_style" placeholder="Enter display style" ></b-form-input>
                                <span v-if="errors.display_style" :class="['label text-danger small']">{{ errors.display_style }}</span>
                            </b-col>
                        </b-row> -->
                    </b-card-body>
                </b-collapse>
            </b-card>

        </div>
    </div>
</template>
<script>
    import MessagesMixin from '@/Mixins/Messages'
    import DBOperationsMixin from '@/Mixins/DBOperations'
    import bootstrapTableMixin from '@/Mixins/Plugins/BootstrapTable'

    export default {
        mixins: [MessagesMixin, DBOperationsMixin, bootstrapTableMixin],
        props: ['data'],
        data() {
          return {
                form: this.$inertia.form({
                    uuid: this.data.uuid,
                    name: this.data.name,
                    body: this.data.body,
                    component_name: this.data.component_name,
                    controller_name: this.data.controller_name,
                    controller_method: this.data.controller_method,
                    show_on_pages:  this.data.show_on_pages,
                    display_style: this.data.display_style,
                }),
                returnJson: true,
            }
        },

        watch: {
            form: {
                deep: true,
                immediate: true,
                handler: function(newVal, oldVal) {
                    this.$emit('updateParentFormValues', newVal)
                }
            }
        },
    }
</script>