<template>
    <app-layout>

        <template #header>
            My Teams
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

        <TableList :data="user"></TableList>

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
    import TableList from '@/Pages/Core/TeamGroup/Team/_TableUserTeams'
    
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
                user: this.$page.props.user,
                pageTitle: 'My Teams',
            }
        }
    }
</script>
