<template>
    <app-layout>

        <template #header>
            Sessions
        </template>

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

        <TableList></TableList>

        <entity-modal-delete v-bind:modalAttributes="modalAttributes">
            <component :is="deleteComponent" v-bind="deleteComponentParams"></component>
        </entity-modal-delete>

    </app-layout>
</template>

<script>
    import Layout from './Layout'
    import AppLayout from '@/Layouts/AppLayout'
    import EntityComponentsMixin from '@/Mixins/EntityComponents'
    import TableList from './_TableListMySessions'

    export default {
        mixins: [EntityComponentsMixin],
        props: ['data'],
        components: {
            AppLayout,
            Layout,
            TableList,
        },
        data() {
            return {
                pageTitle: 'My Sessions',
            }
        }
    }

</script>