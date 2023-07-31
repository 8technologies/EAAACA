<template>
    <div class="bg-white">
        <div class="border-bottom bg-light py-1 px-3">
        <div class="row no-gutters text-secondary draggable-area draggable-row-header">
            <div class="col">
                <i class="fas fa-arrows-alt"></i>
                Row:
                <span v-if="isProcessing" :class="spinnerClasses + ' text-primary'" role="status" aria-hidden="true"></span>
                <div class="d-inline">
                    <b-dropdown variant="link" size="md" toggle-class="text-decoration-none p-0" no-caret>
                        <template #button-content>
                            <i class="fa fa-plus-circle text-secondary"></i>
                        </template>
                        <b-dropdown-item :href="route('dashboard.layout_rows.addcolumn', {id:localData.id})" class="" v-on:click="showAddSilently($event)">
                            1 Column
                        </b-dropdown-item>
                        <b-dropdown-item :href="route('dashboard.layout_rows.addcolumn', {id:localData.id, columns: 2})" class="" v-on:click="showAddSilently($event)">
                            2 Columns
                        </b-dropdown-item>
                        <b-dropdown-item :href="route('dashboard.layout_rows.addcolumn', {id:localData.id, columns: 3})" class="" v-on:click="showAddSilently($event)">
                            3 Columns
                        </b-dropdown-item>
                        <b-dropdown-item :href="route('dashboard.layout_rows.addcolumn', {id:localData.id, columns: 4})" class="" v-on:click="showAddSilently($event)">
                            4 Columns
                        </b-dropdown-item>
                    </b-dropdown>
                </div>

            </div>
            <div class="col-">
                <b-link :href="route('dashboard.layout_rows.show', localData.id)" class="text-secondary" v-on:click="showEntity($event)">
                    <i class="fa fa-eye"></i>
                </b-link>
                <b-link :href="route('dashboard.layout_rows.edit', localData.id)" class="text-secondary" v-on:click="showEntityEdit($event)">
                    <i class="fa fa-pencil-alt"></i>
                </b-link>
                <b-link :href="route('dashboard.layout_rows.show', localData.id)" class="text-secondary" v-on:click="showEntityDelete($event)">
                    <i class="fa fa-trash"></i>
                </b-link>                
            </div>
        </div>
        </div>

        <div class="columns py-2">
            <draggable v-model="localData.layout_columns" handle=".draggable-column-header" v-bind="dragOptions" @start="drag = true" @end="drag = false" @change="updateSortPositions(entityUpdateUrl)" :class="'row'">
                <layout-column-preview v-for="item in localData.layout_columns" :key="'column' + item.id" :data.sync="item">
                </layout-column-preview>
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
    import EntityShow from './_FormShow'
    import EntityEdit from './_FormEdit'
    import EntityDelete from './_FormDelete'
    import layoutColumnPreview from '@/Pages/Core/Layout/LayoutColumn/_Preview'

    export default {
        props: ['data'],

        data() {
            return {
                localData: this.data,
                updatablePreview: true,
                entityUpdateUrl: route('dashboard.layout_rows.updatecolumns', this.data.id),
                returnJson: true,
                isProcessing: false,
            }
        },

        mixins: [
            EntityComponentsMixin,
        ],

        components: {
            draggable,
            EntityShow,
            EntityEdit,
            EntityDelete,
            layoutColumnPreview,
        },

        computed: {
            classes: function () {
                if (this.localData.width === null) {
                    return 'col-md-12'
                }
                return this.localData.width
            },
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
            // updateLocalDataInstance: function(data) {
            //     console.log( 'updateLocalData called' )
            // },
            updateSortPositions: function(url) {
                //console.log(url)
                this.isProcessing = true

                this.localData.layout_columns.map((item, index) => {
                    item.position = index + 1
                })
                var data = _.map(this.localData.layout_columns, function(item) {
                    return _.pick(item, ['id', 'position'])
                })
                this.showUpdateSilently(data, url)
            },
        },

        watch: { 
            data: function(newVal, oldVal) {
                this.localData = newVal
            },
        },

    }
</script>
