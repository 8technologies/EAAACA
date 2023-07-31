<template>
    <app-layout :data="data">

        <template #header>
            My Files
        </template>

        <TableList :data="data"></TableList>

        <template #breadcrumb>
            <li class="breadcrumb-item">
                <inertia-link :href="route('dashboard')" class="" :active="route().current('dashboard')">
                    Dashboard
                </inertia-link>
            </li>
            <li class="breadcrumb-item">
                <inertia-link :href="route('profile.show')" class="">
                    Account
                </inertia-link>
            </li>
            <li class="breadcrumb-item active"></li>
        </template>

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
    import TableList from '@/Pages/Core/Media/File/_TableUserFiles'
    
    export default {
        props: [
            'data',
        ],
        mixins: [EntityComponentsMixin, SeoMixin],
        components: {
            AppLayout,
            TableList,
        },
        data() {
            return {
                pageTitle: 'My Files',
            }
        }
    }
</script>
