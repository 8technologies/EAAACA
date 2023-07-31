<template>
    <app-layout>

        <template #header>
            Roles & Permissions
        </template>

        <div class="my-3">
            <div class="border rounded bg-light py-2 px-3">
                <span class="">Manage user roles & permissions</span>
            </div>

            <ul class="admin-list">
                <li class="">
                    <b-link :disabled="checkPermissionAndModelAccess('manage.role_permission', 'role')" :href="route('dashboard.roles.index')" class="inertia-link">
                        <span class="label">Roles</span>
                        <div class="description">Manage user roles</div>
                    </b-link>
                </li>
                <li class="">
                    <b-link :disabled="checkPermissionAndModelAccess('manage.role_permission', 'permission')" :href="route('dashboard.permissions.index')" class="inertia-link">
                        <span class="label">Permissions</span>
                        <div class="description">Manage permissions</div>
                    </b-link>
                </li>
                <li class="">
                    <b-link :disabled="checkPermissionAndModelAccess('manage.role_permission', 'model')" :href="route('dashboard.models.index')" class="inertia-link">
                        <span class="label">Models</span>
                        <div class="description">Manage system models and their permissions</div>
                    </b-link>
                </li>
                <li class="">
                    <b-link :disabled="checkPermissionAndModelAccess('manage.role_permission', 'permission_type')" :href="route('dashboard.permission_types.index')" class="inertia-link">
                        <span class="label">Permission Types</span>
                        <div class="description">Manage basic model permissions</div>
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
                pageTitle: 'Roles & Permissions',
            }
        },
        // created() {
        //     console.log( this.$page.props.permissions )
        //     console.log( this.checkModelPermissions('role') == true )
        // }
    }

</script>

