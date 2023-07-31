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
                <inertia-link :href="route('dashboard.roles-permissions')">
                    Roles & Permissions
                </inertia-link>
            </li>
            <li class="breadcrumb-item">
                <inertia-link :href="route('dashboard.roles.index')" class="">
                    Roles
                </inertia-link>
            </li>
            <li class="breadcrumb-item active"></li>
        </template>

        <div class="row">
            <div class="col-md-12">
                <h3 class="">
                    {{ data.name }}
                </h3>

                <table class="table table-sm table-borderless">
                    <tbody>
                        <tr>
                            <td width="150px">Guard Name: </td>
                            <td>{{ data.guard_name }}</td>
                        </tr>
                    </tbody>
                </table>

                <div class="mb-3">
                    <b-nav tabs>
                        <b-nav-item :href="route('dashboard.roles.show', data.id)" :class="'inertia-link'" :active="route().current('dashboard.roles.show', data.id)">
                            Permissions <b-badge variant="secondary">{{ data.permissions_count }}</b-badge>
                        </b-nav-item>
                        <b-nav-item :href="route('dashboard.roles.users', data.id)" :class="'inertia-link'" :active="route().current('dashboard.roles.users', data.id)">
                            Users <b-badge variant="secondary">{{ data.users_count }}</b-badge>
                        </b-nav-item>
                        <b-nav-item :href="route('dashboard.roles.edit', data.id)" :class="'inertia-link'" :active="route().current('dashboard.roles.edit', data.id)">
                            Edit
                        </b-nav-item>
                        <li class="nav-item">
                            <b-link :href="route('dashboard.roles.show', data.id)" class="nav-link text-danger" v-on:click="showEntityDelete($event)">
                                Delete
                            </b-link>
                        </li>
                    </b-nav>
                </div>
                    
            </div>
        </div>

        <entity-modal-delete v-bind:modalAttributes="modalAttributes">
            <component :is="deleteComponent" v-bind="deleteComponentParams"></component>
        </entity-modal-delete>

        <slot></slot>

    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import FunctionsMixin from '@/Mixins/Functions'
    import EntityComponentsMixin from '@/Mixins/EntityComponents'
    import EntityLinks from '@/Pages/Core/_Includes/_EntityLinks'
    import EntityDelete from './_FormDelete'

    export default {
        props: [
            'data',
        ],
        mixins: [FunctionsMixin, EntityComponentsMixin],
        components: {
            AppLayout,
            EntityLinks,
            EntityDelete,
        },
    }
</script>
