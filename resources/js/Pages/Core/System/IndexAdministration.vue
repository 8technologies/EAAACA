<template>
    <app-layout>

        <template #header>
            Administration
        </template>

        <div class="my-3">
            <div class="border rounded bg-light px-3">
                <span class=""></span>
            </div>
            <ul class="admin-list">
                <li class="nav-item" v-if="route().has('dashboard.blocks.index') && checkPermission('manage.block')">
                    <b-link :href="route('dashboard.blocks.index')" class="nav-link inertia-link" :class="checkActivePaths(['dashboard/blocks']) ? 'active' : '' ">
                        <span class="label">Blocks</span>
                        <div class="description">Manage "Blocks"</div>
                    </b-link>
                </li>

                <li class="nav-item" v-if="route().has('dashboard.notifications.index') && checkPermission('manage.notification')">
                    <b-link :href="route('dashboard.notifications.index')" class="nav-link inertia-link" :class="{ 'active': route().current('dashboard.notifications.index') }">
                        <span class="label">Notifications</span>
                        <div class="description">Manage "Notifications"</div>
                    </b-link>
                </li>

                <li class="nav-item" v-if="route().has('dashboard.contact_messages.index') && checkPermission('manage.contact_message')">
                    <b-link :href="route('dashboard.contact_messages.index')" class="nav-link inertia-link" :class="checkActivePaths(['dashboard/messages/contact_messages']) ? 'active' : '' ">
                        <span class="label">Contact Messages</span>
                        <div class="description">Manage "Contact Messages"</div>
                    </b-link>
                </li>

                <li class="nav-item" v-if="route().has('dashboard.taxonomy') && checkPermission('manage.taxonomy')">
                    <b-link :href="route('dashboard.taxonomy')" class="nav-link inertia-link" :class="checkActivePath('dashboard/taxonomy') ? 'active' : '' ">
                        <span class="label">Taxonomy</span>
                        <div class="description">Manage "Taxonomy"</div>
                    </b-link>
                </li>

                <li class="nav-item" v-if="route().has('dashboard.users.index') && checkPermission('manage.user')">
                    <b-link :href="route('dashboard.users.index')" class="nav-link inertia-link" :class="checkActivePath('dashboard/users') ? 'active' : '' ">
                        <span class="label">Users</span>
                        <div class="description">Manage "Users"</div>
                    </b-link>
                </li>

                <li class="nav-item" v-if="route().has('dashboard.roles-permissions') && checkPermission('manage.role_permission')">
                    <b-link :href="route('dashboard.roles-permissions')" class="nav-link inertia-link" :class="checkActivePath('dashboard/roles-permissions') ? 'active' : '' ">
                        <span class="label">Roles & Permissions</span>
                        <div class="description">Manage "Roles & Permissions"</div>
                    </b-link>
                </li>

                <li class="nav-item" v-if="route().has('dashboard.teams-groups') && checkPermission('manage.team_group')">
                    <b-link :href="route('dashboard.teams-groups')" class="nav-link inertia-link" :class="checkActivePath('dashboard/teams-groups') ? 'active' : '' ">
                        <span class="label">Teams & Groups</span>
                        <div class="description">Manage "Teams & Groups"</div>
                    </b-link>
                </li>

                <li class="nav-item" v-if="route().has('dashboard.media') && checkPermission('manage.media')">
                    <b-link :href="route('dashboard.media')" class="nav-link inertia-link" :class="checkActivePath('dashboard/media') ? 'active' : '' ">
                        <span class="label">Media</span>
                        <div class="description">Manage "Media"</div>
                    </b-link>
                </li>

                <li class="nav-item" v-if="route().has('dashboard.layout') && checkPermission('manage.layout')">
                    <b-link :href="route('dashboard.layout')" class="nav-link inertia-link" :class="checkActivePath('dashboard/layout') ? 'active' : '' ">
                        <span class="label">Layouts</span>
                        <div class="description">Manage "Layouts"</div>
                    </b-link>
                </li>

                <li class="nav-item" v-if="route().has('dashboard.fields') && checkPermission('manage.field')">
                    <b-link :href="route('dashboard.fields')" class="nav-link inertia-link" :class="checkActivePath('dashboard/fields') ? 'active' : '' ">
                        <span class="label">Fields</span>
                        <div class="description">Manage "Fields"</div>
                    </b-link>
                </li>
            </ul>
        </div>

    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import SeoMixin from '@/Mixins/SEO'
    import FunctionsMixin from '@/Mixins/Functions'

    export default {
        mixins: [SeoMixin, FunctionsMixin],
        components: {
            AppLayout,
        },
        data() {
            return {
                pageTitle: 'Administration',
            }
        },
    }

</script>

