<template>
    <div class="">
        <b-tabs content-class="mt-3" align="right">
            <b-tab title="Content" active>
                <div>
                    <b-row class="form-group">
                        <b-col sm="3">
                            <label>Element</label>
                        </b-col>
                        <b-col sm="9">
                            <b-form-input id="attributes['element']['key']" hidden v-model="attributeElement.key">
                            </b-form-input>
                            <b-form-select v-model="attributeElement.value" :options="headingOptions"></b-form-select>
                        </b-col>
                    </b-row>

                    <b-row class="form-group">
                        <b-col sm="3">
                            <label>Title Text</label>
                        </b-col>
                        <b-col sm="9">
                            <b-form-textarea id="title" rows="2" max-rows="3" placeholder="Enter title" v-model="form.title" :class="[errors.title ? 'is-invalid' : '']">
                            </b-form-textarea>
                            <span v-if="errors.title" :class="['label text-danger small']">{{ errors.title }}</span>
                        </b-col>
                    </b-row>

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

                </div>

            </b-tab>
            <b-tab title="Settings">
                <div class="accordion" role="tablist">
                    <b-card no-body class="mb-0">
                        <b-card-header header-tag="header" role="tab">
                            <b-button block v-b-toggle.accordion-link variant="link secondary">Link<i class="fa fa-angle-right"></i></b-button>
                        </b-card-header>
                        <b-collapse id="accordion-link" visible accordion="settings-accordion" role="tabpanel">
                            <b-card-body>
                                <b-card-text>
                                    <b-row class="form-group">
                                        <b-col sm="3">
                                            <label>URL</label>
                                        </b-col>
                                        <b-col sm="9">
                                            <b-form-input id="attributes['url']['key']" hidden v-model="attributeUrl.key">
                                            </b-form-input>
                                            <b-form-input id="attributes['url']['value']" v-model="attributeUrl.value" placeholder="Enter Url" >
                                            </b-form-input>
                                        </b-col>
                                    </b-row>
                                    <b-row class="form-group">
                                        <b-col sm="3">
                                            <label>Target</label>
                                        </b-col>
                                        <b-col sm="9">
                                            <b-form-input id="attributes['url_target']['key']" hidden v-model="attributeUrlTarget.key">
                                            </b-form-input>
                                            <b-form-select v-model="attributeUrlTarget.value" :options="urlTargetOptions"></b-form-select>
                                        </b-col>
                                    </b-row>
                                </b-card-text>
                            </b-card-body>
                        </b-collapse>
                    </b-card>
                    <b-card no-body class="mb-0">
                        <b-card-header header-tag="header" role="tab">
                            <b-button block v-b-toggle.accordion-1 variant="link secondary">CSS Styles <i class="fa fa-angle-right"></i></b-button>
                        </b-card-header>
                        <b-collapse id="accordion-1" accordion="settings-accordion" role="tabpanel">
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

                                <b-row class="form-group">
                                    <b-col sm="3">
                                        <label>Color</label>
                                    </b-col>
                                    <b-col sm="9">
                                        <b-form-input id="styles['color']['key']" hidden v-model="styleColor.key"></b-form-input>
                                        <b-form-input id="styles['color']['value']" v-model="styleColor.value" placeholder="Enter Color"></b-form-input>
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
                    title: this.data.title,
                    position: this.data.position,
                    attributes: this.data.attributes,
                    styles: this.data.styles,
                }),
            }
        },
        // created() {
        //     console.log( this.data )
        // },
        computed: {
            // attributes
            attributeElement: function () {
                var index = this.getFieldKeyIndex('attributes', 'element')
                return this.form.attributes[index]
            },
            attributeClass: function () {
                var index = this.getFieldKeyIndex('attributes', 'class')
                return this.form.attributes[index]
            },
            attributeUrl: function () {
                var index = this.getFieldKeyIndex('attributes', 'url')
                return this.form.attributes[index]
            },
            attributeUrlTarget: function () {
                var index = this.getFieldKeyIndex('attributes', 'url_target')
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