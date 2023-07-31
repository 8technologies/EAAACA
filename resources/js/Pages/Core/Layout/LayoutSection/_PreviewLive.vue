<template>
    <div class="live-edit-wrapper">
        <div class="live-edit-area">
        <div class="row no-gutters text-secondary draggable-area draggable-section-header">
            <div class="col">
                <i class="fas fa-arrows-alt"></i>
                Section:
                <span v-if="isProcessing" :class="spinnerClasses + ' text-primary'" role="status" aria-hidden="true"></span>
                <div class="d-inline">
                    <b-dropdown id="dropdown-1" variant="link" size="md" toggle-class="text-decoration-none p-0" no-caret>
                        <template #button-content>
                            <i class="fa fa-plus-circle text-secondary"></i>
                        </template>
                        <b-dropdown-item :href="route('dashboard.layout_sections.addrow', localData.id)" class="" v-on:click="showAddSilently($event)">
                            Add a Row
                        </b-dropdown-item>
                        <b-dropdown-item :href="route('dashboard.layout_sections.createfieldblock', localData.id)" class="" v-on:click="showAddFieldBlock($event)">
                            Add a Block
                        </b-dropdown-item>
                    </b-dropdown>
                </div>

            </div>
            <div class="col-">
                <b-link :href="route('dashboard.layout_sections.show', localData.id)" class="text-secondary" v-on:click="showEntity($event)">
                    <i class="fa fa-eye"></i>
                </b-link>
                <b-link :href="route('dashboard.layout_sections.edit', localData.id)" class="text-secondary" v-on:click="showEntityEdit($event)">
                    <i class="fa fa-pencil-alt"></i>
                </b-link>
                <b-link :href="route('dashboard.layout_sections.show', localData.id)" class="text-secondary" v-on:click="showEntityDelete($event)">
                    <i class="fa fa-trash"></i>
                </b-link>                
            </div>
        </div>
        </div>

        <div class="section- pt-4" :class="attributeClass" :style="_styles" v-bind="dataJarallaxVideoAttribute">
            <draggable v-model="localData.layout_rows" handle=".draggable-row-header" v-bind="dragOptions" @start="drag = true" @end="drag = false" @change="updateSortPositions(entityUpdateUrl)" :class="'layout-sections'">
                
                <template v-for="item in localData.fields">
                    <div class="container" v-if="item.model_name === 'LayoutRow'" :key="item.uuid">
                        <layoutRowPreview :key="item.uuid" :data="item">
                            layout_row
                        </layoutRowPreview>
                    </div>
                    <fieldBlockPreview v-else-if="item.model_name === 'FieldBlock'" :key="item.uuid" :data="item">
                        field_block
                    </fieldBlockPreview>
                    <div v-else>
                        No preview
                    </div>
                </template>
                
                <!-- <div class="container" v-for="item in localData.layout_rows" :key="item.id">
                    <layout-row-preview :data="item">
                    </layout-row-preview>
                </div> -->
            </draggable>
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
    import EntityEdit from './_FormEdit'
    import EntityDelete from './_FormDelete'
    import layoutRowPreview from '@/Pages/Core/Layout/LayoutRow/_PreviewLive'
    import layoutColumnPreview from '@/Pages/Core/Layout/LayoutColumn/_PreviewLive'
    import fieldBlockPreview from '@/Pages/Core/Field/FieldBlock/_PreviewLive'

    import EntityCreateFieldBlock from '@/Pages/Core/Field/FieldBlock/_FormCreateLayoutSection'

    export default {
        props: ['data'],
        mixins: [EntityComponentsMixin, DraggableMixins, JarallaxMixins, DynamicStyles],
        data() {
            return {
                localData: this.data,
                updatablePreview: true,
                entityUpdateUrl: route('dashboard.layout_sections.updaterows', this.data.id),
                returnJson: true,
                isProcessing: false,
            }
        },
        components: {
            draggable,
            EntityShow,
            EntityEdit,
            EntityDelete,
            layoutRowPreview,
            layoutColumnPreview,
            fieldBlockPreview,

            EntityCreateFieldBlock,
        },

        methods: {
            // updateSortPositions: function(url) {
            //     this.isProcessing = true

            //     this.localData.layout_rows.map((item, index) => {
            //         item.position = index + 1
            //     })
            //     var data = _.map(this.localData.layout_rows, function(item) {
            //         return _.pick(item, ['id', 'position'])
            //     })
            //     this.showUpdateSilently(data, url)
            // },
            updateSortPositions: function(url) {
                this.isProcessing = true

                this.localData.fields.map((item, index) => {
                    item.position = index + 1
                })
                var data = _.map(this.localData.fields, function(item) {
                    return _.pick(item, ['id', 'model_name', 'position'])
                })
                this.showUpdateSilently(data, url)
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
    }
</script>
