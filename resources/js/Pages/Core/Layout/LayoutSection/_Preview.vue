<template>
    <div class="bg-white rounded">
        <div class="border-bottom bg-light py-2 px-3">
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

        <div class="columns bg-white p-3">
            <draggable v-model="localData.layout_rows" handle=".draggable-row-header" v-bind="dragOptions" @start="drag = true" @end="drag = false" @change="updateSortPositions(entityUpdateUrl)" :class="'layout-sections'">
                <div class="border-top border-bottom mb-3" v-for="item in localData.layout_rows" :key="item.id">
                    <layout-row-preview :data="item">
                    </layout-row-preview>
                </div>
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
    import DraggableMixins from '@/Mixins/Plugins/Draggable'
    import DynamicStyles from '@/Mixins/DynamicStyles'

    import EntityShow from './_FormShow'
    import EntityEdit from './_FormEdit'
    import EntityDelete from './_FormDelete'
    import layoutRowPreview from '@/Pages/Core/Layout/LayoutRow/_Preview'
    import layoutColumnPreview from '@/Pages/Core/Layout/LayoutColumn/_Preview'
    import fieldBlockPreview from '@/Pages/Core/Field/FieldBlock/_Preview'

    export default {
        mixins: [EntityComponentsMixin, DraggableMixins, DynamicStyles],
        props: ['data'],
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
        },
        methods: {
            updateSortPositions: function(url) {
                this.isProcessing = true

                this.localData.layout_rows.map((item, index) => {
                    item.position = index + 1
                })
                var data = _.map(this.localData.layout_rows, function(item) {
                    return _.pick(item, ['id', 'position'])
                })
                this.showUpdateSilently(data, url)
            },
        },
    }
</script>
