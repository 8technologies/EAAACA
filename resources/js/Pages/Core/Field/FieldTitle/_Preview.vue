<template>
    <div class="bg-white">
        <div class="bg-light py-2">
        <div class="row no-gutters border-top border-bottom draggable-area py-1 draggable-header">
            <div class="col text-truncate">
                <i class="fas fa-arrows-alt text-secondary"></i> {{ data.name }}
            </div>
            <div class="col-">
                <div class="">
                    <b-dropdown  variant="link" toggle-class="text-decoration-none p-0" no-caret right>
                        <template #button-content>
                            <i class="fa fa-cog text-secondary"></i>
                        </template>
                        <b-dropdown-item :href="route('dashboard.field_titles.show', data.id)" class="" v-on:click="showEntity($event)">
                            View
                        </b-dropdown-item>
                        <b-dropdown-item :href="route('dashboard.field_titles.edit', data.id)" class="" v-on:click="showEntityEdit($event)">
                            Edit
                        </b-dropdown-item>
                        <b-dropdown-item :href="route('dashboard.field_titles.show', data.id)" class="" v-on:click="showEntityDelete($event)">
                            Delete
                        </b-dropdown-item>
                    </b-dropdown>
                </div>               
            </div>
        </div>

        <div class="px-3 pt-1">
            <div class="pl-1">
                {{ data.name }}
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
    import EntityComponentsMixin from '@/Mixins/EntityComponents'
    import EntityShow from './_FormShow'
    import EntityEdit from './_FormEdit'
    import EntityDelete from './_FormDelete'

    export default {
        props: ['data'],

        data() {
            return {
                localData: this.data,
            }
        },

        mixins: [
            EntityComponentsMixin,
        ],

        components: {
            EntityShow,
            EntityEdit,
            EntityDelete,
        },

    }
</script>
