<template>
    <div>
        <b-form @submit="update" :action="route('dashboard.services.update', data.id)" method="PUT">

            <div class="row">
                <div class="col-md-8">

                    <div class="">
                        <div v-if="!localData.layout_section_tops[0]" class="mb-3 border-top border-bottom pl-2 py-2 bg-light">
                            <div class="row no-gutters draggable-row-header">
                                <div class="col font-weight-bold">
                                    # SECTION TOP
                                    <span v-if="isProcessing" :class="spinnerClasses + ' text-primary'" role="status" aria-hidden="true"></span>
                                </div>
                                <div class="px-1 border rounded text-center border-primary mr-2">
                                    <b-link :href="route('dashboard.services.addpagesectiontop', localData.id)" class="" v-on:click="showAddSilently($event)">
                                        <i class="fa fa-plus fa-md"></i> Add
                                    </b-link>
                                </div>
                            </div>
                        </div>
                        <div v-else id="layout_section_tops">
                            <draggable v-model="localData.layout_section_tops" handle=".draggable-section-top-header" v-bind="dragOptions" @start="drag = true" @end="drag = false" @change="updateSectionTopsSortPositions(entityUpdateUrlTop)" :class="'layout-sections-top'">
                                <div class="border-top border-bottom mb-4" v-for="item in localData.layout_section_tops" :key="item.id">
                                    <layout-section-top-preview :data="item">
                                    </layout-section-top-preview>
                                </div>
                            </draggable>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="title">Title</label>
                        <b-form-input id="title" placeholder="Enter Title" required="" v-model="form.title" :class="[errors.title ? 'is-invalid' : '']">
                        </b-form-input>
                        <span v-if="errors.title" :class="['label text-danger small']">{{ errors.title }}</span>
                    </div>
                    <div class="form-group">
                        <label for="body">Body</label>
                        <ckeditor :editor="editor" v-model="form.body" :config="editorConfig" :class="[errors.body ? 'is-invalid' : '']"></ckeditor>
                        <span v-if="errors.body" :class="['label text-danger small']">{{ errors.body }}</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <content-sidebar :data="data"/>
                </div>
            </div>


            <div class="">
                <div class="my-3 border-top border-bottom pl-2 py-2 bg-light font-weight-500">
                    <div class="row no-gutters draggable-row-header">
                        <div class="col">
                            <strong># SECTIONS</strong>
                            <span v-if="isProcessing" :class="spinnerClasses + ' text-primary'" role="status" aria-hidden="true"></span>
                        </div>
                    </div>
                </div>

                <draggable v-model="localData.layout_sections" handle=".draggable-section-header" v-bind="dragOptions" @start="drag = true" @end="drag = false" @change="updateSectionsSortPositions(entityUpdateUrl)" :class="'layout-sections'">
                    <div class="border-top border-bottom mb-4" v-for="item in localData.layout_sections" :key="item.id">
                        <layout-section-preview :data="item">
                        </layout-section-preview>
                    </div>
                    <div class="p-1 border rounded border-dotted text-center border-primary">
                        <b-link :href="route('dashboard.services.addpagesection', localData.id)" class="" v-on:click="showAddSilently($event)">
                            <i class="fa fa-plus fa-md"></i> Section
                        </b-link>
                    </div>
                </draggable>
            </div>

            <div class="border-top mt-4 pt-2">
                <b-form-checkbox
                  id="status"
                  v-model="form.status_id"
                  name="status"
                  value="1"
                  unchecked-value="2">
                  Promoted
                </b-form-checkbox>
            </div>

            <div class="row no-gutters justify-content-end mt-3 form-btns-wrapper">
                <b-button class="" id="submit" type="submit" variant="primary">
                    <span class="" role="status" aria-hidden="true"></span>
                    Update
                </b-button>
            </div>

        </b-form>
    </div>
</template>
<script>
    import draggable from 'vuedraggable'
    import MessagesMixin from '@/Mixins/Messages'
    import DBOperationsMixin from '@/Mixins/DBOperations'
    import bootstrapTableMixin from '@/Mixins/Plugins/BootstrapTable'
    import Select2Mixin from '@/Mixins/Plugins/Select2'
    import ContentSidebar from './../_Partials/Sidebar'

    import EntityComponentsMixin from '@/Mixins/EntityComponents'
    import layoutRowPreview from '@/Pages/Core/Layout/LayoutRow/_Preview'
    import layoutSectionPreview from '@/Pages/Core/Layout/LayoutSection/_Preview'
    import layoutSectionTopPreview from '@/Pages/Core/Layout/LayoutSectionTop/_Preview'

    export default {
        mixins: [MessagesMixin, DBOperationsMixin, bootstrapTableMixin, Select2Mixin, EntityComponentsMixin],
        props: ['data'],
        data() {
          return {
                form: this.$inertia.form({
                    title: this.data && this.data.title ? this.data.title : '',
                    body: this.data && this.data.body ? this.data.body : '',
                    user_id: this.data && this.data.user_id ? this.data.user_id : this.$page.props.user.id,
                    status_id: this.data && this.data.status_id ? this.data.status_id : '',
                    slug: this.data && this.data.slug ? this.data.slug : '',
                }),
                localData: this.data,
                updatablePreview: true,
                entityUpdateUrl: route('dashboard.services.updatepagesections', this.data.id),
                entityUpdateUrlTop: route('dashboard.services.updatepagesectiontops', this.data.id),
                returnJson: true,
                isProcessing: false,
            }
        },

        components: {
            draggable,
            layoutRowPreview,
            layoutSectionPreview,
            layoutSectionTopPreview,
            ContentSidebar,
        },

        computed: {
            dragOptions() {
                return {
                    animation: 200,
                    // group: "description",
                    disabled: false,
                    ghostClass: "ghost"
                }
            },
        },

        methods: {
            updateSectionTopsSortPositions: function(url) {
                //console.log(url)
                this.isProcessing = true

                this.localData.layout_section_tops.map((item, index) => {
                    item.position = index + 1
                })
                var data = _.map(this.localData.layout_section_tops, function(item) {
                    return _.pick(item, ['id', 'position'])
                })
                this.showUpdateSilently(data, url)
            },

            updateSectionsSortPositions: function(url) {
                //console.log(url)
                this.isProcessing = true

                this.localData.layout_sections.map((item, index) => {
                    item.position = index + 1
                })
                var data = _.map(this.localData.layout_sections, function(item) {
                    return _.pick(item, ['id', 'position'])
                })
                this.showUpdateSilently(data, url)
            },
        },

        watch: { 
            data: function(newVal, oldVal) {
                this.localData = newVal
                // this.$emit('update:data', {id: 99})
            },
        },

    }
</script>