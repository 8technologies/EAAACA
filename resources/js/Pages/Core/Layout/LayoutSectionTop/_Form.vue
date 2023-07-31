<template>
    <div>
        <b-tabs content-class="mt-3" align="right">
            <b-tab title="General" active>
                <div class="">
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
                </div>
                <div class="accordion" role="tablist">
                    <b-card no-body class="mb-0">
                        <b-card-header header-tag="header" role="tab">
                            <b-button block v-b-toggle.accordion-background variant="link">Background image <i class="fa fa-angle-right"></i></b-button>
                        </b-card-header>
                        <b-collapse id="accordion-background" accordion="background-accordion" role="tabpanel">
                            <b-card-body>
                                <b-row class="form-group">
                                    <b-col sm="3">
                                        <label>Background Color</label>
                                    </b-col>
                                    <b-col sm="9">
                                        <b-form-input id="styles['background-color']['key']" hidden v-model="styleBackgroundColor.key"></b-form-input>
                                        <b-form-input id="styles['background-color']['value']" v-model="styleBackgroundColor.value" placeholder="Enter background-color"></b-form-input>
                                    </b-col>
                                </b-row>

                                <b-row class="form-group">
                                    <b-col sm="3">
                                        <label>Background Image</label>
                                    </b-col>
                                    <b-col sm="9">
                                        <b-form-input id="styles['background-image']['key']" hidden v-model="styleBackgroundImage.key"></b-form-input>
                                        <field-bg-image :data="data"/>
                                        <b-form-input id="styles['background-image']['value']" hidden v-model="styleBackgroundImage.value" placeholder="Enter background-image url"></b-form-input>
                                    </b-col>
                                </b-row>

                                <b-row class="form-group">
                                    <b-col sm="3">
                                        <label>Background Repeat</label>
                                    </b-col>
                                    <b-col sm="9">
                                        <b-form-input id="styles['background-repeat']['key']" hidden v-model="styleBackgroundRepeat.key"></b-form-input>
                                        <b-form-input id="styles['background-repeat']['value']" v-model="styleBackgroundRepeat.value" placeholder="Enter background-repeat"></b-form-input>
                                    </b-col>
                                </b-row>

                                <b-row class="form-group">
                                    <b-col sm="3">
                                        <label>Background Size</label>
                                    </b-col>
                                    <b-col sm="9">
                                        <b-form-input id="styles['background-size']['key']" hidden v-model="styleBackgroundSize.key"></b-form-input>
                                        <b-form-input id="styles['background-size']['value']" v-model="styleBackgroundSize.value" placeholder="Enter background-size"></b-form-input>
                                    </b-col>
                                </b-row>
                            </b-card-body>
                        </b-collapse>
                    </b-card>

                    <b-card no-body class="mb-0">
                        <b-card-header header-tag="header" role="tab">
                            <b-button block v-b-toggle.accordion-background-video variant="link">Background video <i class="fa fa-angle-right"></i></b-button>
                        </b-card-header>
                        <b-collapse id="accordion-background-video" accordion="background-accordion" role="tabpanel">
                            <b-card-body>
                                <b-row class="form-group">
                                    <b-col sm="3">
                                        <label>Video</label>
                                    </b-col>
                                    <b-col sm="9">
                                        <template v-if="data.media_videos[0]">
                                            <field-video v-for="item in data.media_videos" :key="'media_video'+item.id" :data="item"/>
                                        </template>
                                        <template v-else>
                                            <field-video :data="data"/>
                                        </template>
                                    </b-col>
                                </b-row>

                                <b-row class="form-group">
                                    <b-col sm="3">
                                        <label>Use Parallax</label>
                                    </b-col>
                                    <b-col sm="9">

                                    </b-col>
                                </b-row>
                            </b-card-body>
                        </b-collapse>
                    </b-card>
                </div>

            </b-tab>
            <b-tab title="Settings">
                <div class="accordion" role="tablist">
                    <b-card no-body class="mb-0">
                        <b-card-header header-tag="header" role="tab">
                            <b-button block v-b-toggle.accordion-layout variant="link secondary">CSS Styles <i class="fa fa-angle-right"></i></b-button>
                        </b-card-header>
                        <b-collapse id="accordion-layout" visible accordion="settings-accordion" role="tabpanel">
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

                    <b-card no-body class="mb-0">
                        <b-card-header header-tag="header" role="tab">
                            <b-button block v-b-toggle.accordion-positioning variant="link">Visibility <i class="fa fa-angle-right"></i></b-button>
                        </b-card-header>
                        <b-collapse id="accordion-positioning" accordion="settings-accordion" role="tabpanel">
                            <b-card-body>

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
    import FieldBgImage from '@/Pages/Core/Field/fieldBgImage'
    import FieldVideo from '@/Pages/Core/Field/fieldVideo'

    export default {
        mixins: [MessagesMixin, DBOperationsMixin, bootstrapTableMixin],
        props: ['data'],
        data() {
          return {
                form: this.$inertia.form({
                    position: this.data.position,
                    attributes: this.data.attributes,
                    styles: this.data.styles,
                    bg_image: null,
                    bg_image_id: null,
                    media_video_id: null,
                }),
                returnJson: true,
            }
        },

        components: {
            FieldBgImage,
            FieldVideo,
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
            styleBackgroundImage: function () {
                var index = this.getFieldKeyIndex('styles', 'background-image')
                return this.form.styles[index]
            },
            styleBackgroundColor: function () {
                var index = this.getFieldKeyIndex('styles', 'background-color')
                return this.form.styles[index]
            },
            styleBackgroundPosition: function () {
                var index = this.getFieldKeyIndex('styles', 'background-position')
                return this.form.styles[index]
            },
            styleBackgroundRepeat: function () {
                var index = this.getFieldKeyIndex('styles', 'background-repeat')
                return this.form.styles[index]
            },
            styleBackgroundSize: function () {
                var index = this.getFieldKeyIndex('styles', 'background-size')
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