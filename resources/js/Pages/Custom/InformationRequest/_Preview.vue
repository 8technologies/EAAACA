<template>
    <div>
        <div class="">
            <div class="row">
                <div class="col">
                    <!-- <h5 class="">{{ data.name }}</h5> -->
                </div>
                <div class="col-auto d-inline">
                    <b-button
                        :variant="'outline-primary'" 
                        v-on:click="showEdit({url: data.entity_links.url_edit})"
                        class="btn-sm p-1">
                        <span class="fa fa-pencil-alt"></span>
                    </b-button>
                    <b-button
                        :variant="'outline-danger'" 
                        v-on:click="showDelete({url: data.entity_links.url})"
                        class="btn-sm p-1">
                        <span class="fa fa-trash"></span>
                    </b-button>
                </div>
            </div>
            <div class="border-top mt-2 pb-3"></div>
            <EntityShow 
                :data="data">
            </EntityShow>
        </div>

        <entity-modal v-bind:modalAttributes="modalAttributes">
            <dynamic-component :is="modalComponent" v-bind="modalComponentParams"></dynamic-component>
        </entity-modal>

        <entity-modal-delete v-bind:modalAttributes="modalAttributes">
            <dynamic-component :is="deleteComponent" v-bind="deleteComponentParams"></dynamic-component>
        </entity-modal-delete>

    </div>
</template>
<script>
    import FunctionsMixin from '@/Mixins/Functions'
    import EntityComponentsMixin from '@/Mixins/EntityComponents'

    import EntityShow from './_FormShow'
    import EntityEdit from './_FormEdit'
    import EntityDelete from './_FormDelete'

    export default {
        mixins: [FunctionsMixin, EntityComponentsMixin],
        props: ['data'],
        data() {
          return {
                form: null,
            }
        },
        components: {
            EntityShow,
            EntityEdit,
            EntityDelete,
        },
    }
</script>