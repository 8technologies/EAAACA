<template>
    <div :class="classes">
        <div class="live-edit-wrapper">
            <div class="live-edit-area">
            <div class="row no-gutters text-secondary draggable-area draggable-column-header">
                <div class="col">
                    <i class="fas fa-arrows-alt"></i>
                    Column: 
                    <span v-if="isProcessing" :class="spinnerClasses + ' text-primary'" role="status" aria-hidden="true"></span>
                    <div class="d-inline">
                        <b-dropdown id="dropdown-1" variant="link" size="md" toggle-class="text-decoration-none p-0" no-caret>
                            <template #button-content>
                                <i class="fa fa-plus-circle text-secondary"></i>
                            </template>
                            <b-dropdown-item :href="route('dashboard.layout_columns.createfieldtitle', localData.id)" class="" v-on:click="showAddFieldTitle($event)">
                                Add a Title
                            </b-dropdown-item>
                            <b-dropdown-item :href="route('dashboard.layout_columns.createfieldtext', localData.id)" class="" v-on:click="showAddFieldText($event)">
                                Add a Text
                            </b-dropdown-item>
                            <b-dropdown-item :href="route('dashboard.layout_columns.createfieldlink', localData.id)" class="" v-on:click="showAddFieldLink($event)">
                                Add a Link
                            </b-dropdown-item>
                            <b-dropdown-item :href="route('dashboard.layout_columns.createfieldimage', localData.id)" class="" v-on:click="showAddFieldImage($event)">
                                Add an Image
                            </b-dropdown-item>
                            <b-dropdown-item :href="route('dashboard.layout_columns.createfieldhtml', localData.id)" class="" v-on:click="showAddFieldHtml($event)">
                                Add Html
                            </b-dropdown-item>
                            <b-dropdown-item :href="route('dashboard.layout_columns.createfieldblock', localData.id)" class="" v-on:click="showAddFieldBlock($event)">
                                Add a Block
                            </b-dropdown-item>
                        </b-dropdown>
                    </div>
                </div>
                <div class="col-">
                    <b-link :href="route('dashboard.layout_columns.show', localData.id)" class="text-secondary" v-on:click="showEntity($event)">
                        <i class="fa fa-eye"></i>
                    </b-link>
                    <b-link :href="route('dashboard.layout_columns.edit', localData.id)" class="text-secondary" v-on:click="showEntityEdit($event)">
                        <i class="fa fa-pencil-alt"></i>
                    </b-link>
                    <b-link :href="route('dashboard.layout_columns.show', localData.id)" class="text-secondary" v-on:click="showEntityDelete($event)">
                        <i class="fa fa-trash"></i>
                    </b-link>                
                </div>
            </div>
            </div>

            <div :class="attributeClass" :style="_styles">
                <div class="field-wrapper">
                    <draggable v-model="localData.fields" handle=".draggable-header" v-bind="dragOptions" @start="drag = true" @end="drag = false" @change="updateSortPositions(entityUpdateUrl)">
                        <template v-for="item in localData.fields">
                            <fieldTitlePreview v-if="item.model_name === 'FieldTitle'" :key="item.uuid" :data="item">
                                field_title
                            </fieldTitlePreview>
                            <fieldTextPreview v-else-if="item.model_name === 'FieldText'" :key="item.uuid" :data="item">
                                field_text
                            </fieldTextPreview>
                            <fieldLinkPreview v-else-if="item.model_name === 'FieldLink'" :key="item.uuid" :data="item">
                                field_link
                            </fieldLinkPreview>
                            <fieldImagePreview v-else-if="item.model_name === 'FieldImage'" :key="item.uuid" :data="item">
                                field_image
                            </fieldImagePreview>
                            <fieldHtmlPreview v-else-if="item.model_name === 'FieldHtml'" :key="item.uuid" :data="item">
                                field_html
                            </fieldHtmlPreview>
                            <fieldBlockPreview v-else-if="item.model_name === 'FieldBlock'" :key="item.uuid" :data="item">
                                field_block
                            </fieldBlockPreview>
                            <div v-else>
                                Not preview
                            </div>
                        </template>
                    </draggable>
                </div>
            </div>
        </div>

        <entity-modal v-bind:modalAttributes="modalAttributes">
            <dynamic-component :is="modalComponent" v-bind="modalComponentParams"></dynamic-component>
        </entity-modal>

        <entity-modal-delete v-bind:modalAttributes="modalAttributes">
            <component :is="deleteComponent" v-bind="deleteComponentParams"></component>
        </entity-modal-delete>
    </div>
</template>

<script>
    import draggable from 'vuedraggable'
    import EntityComponentsMixin from '@/Mixins/EntityComponents'
    import JarallaxMixins from '@/Mixins/Plugins/Jarallax'
    import DraggableMixins from '@/Mixins/Plugins/Draggable'
    import DynamicStyles from '@/Mixins/DynamicStyles'

    import EntityShow from './_FormShow'
    import EntityCreate from './_FormCreate'
    import EntityEdit from './_FormEdit'
    import EntityDelete from './_FormDelete'
    import fieldTitlePreview from '@/Pages/Core/Field/FieldTitle/_PreviewLive'
    import fieldTextPreview from '@/Pages/Core/Field/FieldText/_PreviewLive'
    import fieldLinkPreview from '@/Pages/Core/Field/FieldLink/_PreviewLive'
    import fieldImagePreview from '@/Pages/Core/Field/FieldImage/_PreviewLive'
    import fieldHtmlPreview from '@/Pages/Core/Field/FieldHtml/_PreviewLive'
    import fieldBlockPreview from '@/Pages/Core/Field/FieldBlock/_PreviewLive'

    import EntityCreateFieldTitle from '@/Pages/Core/Field/FieldTitle/_FormCreate'
    import EntityCreateFieldText from '@/Pages/Core/Field/FieldText/_FormCreate'
    import EntityCreateFieldLink from '@/Pages/Core/Field/FieldLink/_FormCreate'
    import EntityCreateFieldImage from '@/Pages/Core/Field/FieldImage/_FormCreate'
    import EntityCreateFieldHtml from '@/Pages/Core/Field/FieldHtml/_FormCreate'
    import EntityCreateFieldBlock from '@/Pages/Core/Field/FieldBlock/_FormCreate'

    export default {
        mixins: [EntityComponentsMixin, DraggableMixins, JarallaxMixins, DynamicStyles],
        props: ['data'],
        components: {
            draggable,
            EntityShow,
            EntityCreate,
            EntityEdit,
            EntityDelete,
            fieldTitlePreview,
            fieldTextPreview,
            fieldLinkPreview,
            fieldImagePreview,
            fieldHtmlPreview,
            fieldBlockPreview,

            EntityCreateFieldTitle,
            EntityCreateFieldText,
            EntityCreateFieldLink,
            EntityCreateFieldImage,
            EntityCreateFieldHtml,
            EntityCreateFieldBlock,
        },

        data() {
            return {
                localData: this.data,
                updatablePreview: true,
                entityUpdateUrl: route('dashboard.layout_columns.updatecolumnfields', this.data.id),
                returnJson: true,
                isProcessing: false,
            }
        },

        methods: {
            updateSortPositions: function(url) {
                //console.log(url)
                this.isProcessing = true

                this.localData.fields.map((item, index) => {
                    item.position = index + 1
                })
                var data = _.map(this.localData.fields, function(item) {
                    return _.pick(item, ['id', 'model_name', 'position'])
                })
                this.showUpdateSilently(data, url)
            },
            showAddFieldTitle: function(event) {
                event.preventDefault()
                var data = {
                    'url': event.currentTarget.href,
                    'component': 'EntityCreateFieldTitle',
                    'modelTitle': '#Add new Title',
                }
                this.showAddCustomEntity(data)
            },
            showAddFieldText: function(event) {
                event.preventDefault()
                var data = {
                    'url': event.currentTarget.href,
                    'component': 'EntityCreateFieldText',
                    'modelTitle': '#Add new Text',
                }
                this.showAddCustomEntity(data)
            },
            showAddFieldLink: function(event) {
                event.preventDefault()
                var data = {
                    'url': event.currentTarget.href,
                    'component': 'EntityCreateFieldLink',
                    'modelTitle': '#Add new Link',
                }
                this.showAddCustomEntity(data)
            },
            showAddFieldImage: function(event) {
                event.preventDefault()
                var data = {
                    'url': event.currentTarget.href,
                    'component': 'EntityCreateFieldImage',
                    'modelTitle': '#Add new Image',
                }
                this.showAddCustomEntity(data)
            },
            showAddFieldHtml: function(event) {
                event.preventDefault()
                var data = {
                    'url': event.currentTarget.href,
                    'component': 'EntityCreateFieldHtml',
                    'modelTitle': '#Add new Html',
                }
                this.showAddCustomEntity(data)
            },
            showAddFieldBlock: function(event) {
                event.preventDefault()
                var data = {
                    'url': event.currentTarget.href,
                    'component': 'EntityCreateFieldBlock',
                    'modelTitle': '#Add new Block',
                }
                this.showAddCustomEntity(data)
            },
        },
        // created() {
        //     console.log( 'created', this )
        // },
        // updated() {
        //     console.log( 'updated', this )
        // }
    }
</script>
