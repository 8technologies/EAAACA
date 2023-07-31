<template>
    <app-layout>

        <template #header>
        </template>

        <template #breadcrumb>
            <li class="breadcrumb-item">
                <inertia-link :href="route('dashboard')" class="" :active="route().current('dashboard')">
                    Dashboard
                </inertia-link>
            </li>
            <li class="breadcrumb-item">
                <inertia-link :href="route('dashboard.layout')" class="">
                    Layouts
                </inertia-link>
            </li>
            <li class="breadcrumb-item active"></li>
        </template>

        <h3 class="">
            Columns
        </h3>

        <TableList></TableList>

        <entity-modal v-bind:modalAttributes="modalAttributes">
            <dynamic-component :is="modalComponent" v-bind="modalComponentParams"></dynamic-component>
        </entity-modal>

        <entity-modal-delete v-bind:modalAttributes="modalAttributes">
            <component :is="deleteComponent" v-bind="deleteComponentParams"></component>
        </entity-modal-delete>

    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import EntityComponentsMixin from '@/Mixins/EntityComponents'
    import SeoMixin from '@/Mixins/SEO'
    import TableList from './_TableList'

    import EntityCreate from './_FormCreate'
    import EntityEdit from './_FormEdit'
    import EntityDelete from './_FormDelete'

    export default {
        mixins: [EntityComponentsMixin, SeoMixin],
        components: {
            AppLayout,
            TableList,
            EntityCreate,
            EntityEdit,
            EntityDelete,
        },
        data() {
            return {
                pageTitle: 'Columns',
            }
        },
    }

</script>

