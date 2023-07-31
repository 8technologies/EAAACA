<template>
    <div>   
        <b-tabs content-class="mt-3" align="right">
            <b-tab title="Content" active>
                <div class="form-group">
                    <label for="body">Html</label>
                    <b-form-textarea id="body" rows="4" max-rows="6" placeholder="Enter Html" v-model="form.body" :class="[errors.body ? 'is-invalid' : '']">
                    </b-form-textarea>
                    <span v-if="errors.body" :class="['label text-danger small']">{{ errors.body }}</span>
                </div>

                <b-row class="form-group">
                    <b-col sm="3">
                        <label>CSS Classes</label>
                    </b-col>
                    <b-col sm="9">
                        <b-form-input id="attributes['class']['key']" hidden v-model="attributeClass.key">
                        </b-form-input>
                        <b-form-input id="attributes['class']['value']" v-model="attributeClass.value" placeholder="Enter CSS Classes" >
                        </b-form-input>
                    </b-col>
                </b-row>

                <b-row class="form-group">
                    <b-col sm="3">
                        <label for="position">Position</label>
                    </b-col>
                    <b-col sm="9">
                        <b-form-input id="position" placeholder="Enter Position" v-model="form.position" :class="[errors.position ? 'is-invalid' : '']">
                        </b-form-input>
                        <span v-if="errors.position" :class="['label text-danger small']">{{ errors.position }}</span>
                    </b-col>
                </b-row>

            </b-tab>
            <b-tab title="Settings">
                <div class="accordion" role="tablist">
                    <b-card no-body class="mb-0">
                        <b-card-header header-tag="header" role="tab">
                            <b-button block v-b-toggle.accordion-1 variant="link secondary">Layout <i class="fa fa-angle-right"></i></b-button>
                        </b-card-header>
                        <b-collapse id="accordion-1" visible accordion="settings-accordion" role="tabpanel">
                            <b-card-body>
                                <b-row class="form-group">
                                    <b-col sm="3">
                                        <label>Padding</label>
                                    </b-col>
                                    <b-col sm="9">
                                        <b-form-input id="styles['padding']['key']" hidden v-model="stylePadding.key"></b-form-input>
                                        <b-form-input id="styles['padding']['value']" v-model="stylePadding.value" placeholder="Enter Padding"></b-form-input>
                                    </b-col>
                                </b-row>

                                <b-row class="form-group">
                                    <b-col sm="3">
                                        <label>Margin</label>
                                    </b-col>
                                    <b-col sm="9">
                                        <b-form-input id="styles['margin']['key']" hidden v-model="styleMargin.key"></b-form-input>
                                        <b-form-input id="styles['margin']['value']" v-model="styleMargin.value" placeholder="Enter Margin"></b-form-input>
                                    </b-col>
                                </b-row>
                            </b-card-body>
                        </b-collapse>
                    </b-card>
                </div>
            </b-tab>
        </b-tabs>
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
                    body: this.data.body,
                    position: this.data.position,
                    attributes: this.data.attributes,
                    styles: this.data.styles,
                }),
                returnJson: true,
            }
        },

        computed: {
            // attributes
            attributeClass: function () {
                var index = this.getFieldKeyIndex('attributes', 'class')
                return this.form.attributes[index]
            },

            // Styles
            stylePadding: function () {
                var index = this.getFieldKeyIndex('styles', 'padding')
                return this.form.styles[index]
            },
            styleMargin: function () {
                var index = this.getFieldKeyIndex('styles', 'margin')
                return this.form.styles[index]
            },
            styleColor: function () {
                var index = this.getFieldKeyIndex('styles', 'color')
                return this.form.styles[index]
            },
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