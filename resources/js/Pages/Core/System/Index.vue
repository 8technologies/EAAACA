<template>
    <app-layout>

        <template #header>
            System
        </template>

        <div class="my-3">
            <div class="admin-grid-items row no-gutters border rounded bg-white mb-4">
                <div class="col-sm-6 col-md-4">
                    <div class="h-100">
                        <span class="label">Laravel Version</span>
                        <div class="description">{{ data.laravelEnv.version }}</div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="h-100">
                        <span class="label">App Size</span>
                        <div class="description">{{ data.laravelEnv.app_size }}</div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="h-100">
                        <span class="label">Php Version</span>
                        <div class="description">{{ data.serverEnv.server_software }}</div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="h-100">
                        <span class="label">Timezone</span>
                        <div class="description">{{ data.laravelEnv.timezone }}</div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-8">
                    <div class="h-100">
                        <span class="label">Server OS</span>
                        <div class="description">{{ data.serverEnv.server_os }}</div>
                    </div>
                </div>
            </div>

            <ul class="admin-list">
                <li class="">
                    <b-link :href="route('dashboard.activities.index')" class="inertia-link">
                        <span class="label">User Activity</span>
                        <div class="description">View user activity logs</div>
                    </b-link>
                </li>
                <li class="">
                    <b-link :href="route('dashboard.system.commands')" class="inertia-link">
                        <span class="label">Artisan Commands</span>
                        <div class="description">Run PHP Artisan Commands</div>
                    </b-link>
                </li>
                <li class="">
                    <b-link :href="route('dashboard.jobs.index')" class="inertia-link">
                        <span class="label">System Jobs</span>
                        <div class="description">View queued and failed jobs</div>
                    </b-link>
                </li>
                <li class="">
                    <b-link :href="route('dashboard.logs.index')" class="inertia-link">
                        <span class="label">App Logs</span>
                        <div class="description">View application log files</div>
                    </b-link>
                </li>
                <li class="">
                    <b-link :href="route('dashboard.system.packages')" class="inertia-link">
                        <span class="label">Packages</span>
                        <div class="description">View installed packages</div>
                    </b-link>
                </li>
                <li class="">
                    <b-link :href="route('dashboard.backup.index')" class="inertia-link">
                        <span class="label">Backups</span>
                        <div class="description">Manage system backups</div>
                    </b-link>
                </li>
                <li class="">
                    <b-link :href="route('dashboard.system.status-report')" class="inertia-link">
                        <span class="label">Status report</span>
                        <div class="description">View system status report</div>
                    </b-link>
                </li>
            </ul>
        </div>

    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import SeoMixin from '@/Mixins/SEO'

    export default {
        props: ['data'],
        mixins: [SeoMixin],
        components: {
            AppLayout,
        },
        data() {
            return {
                pageTitle: 'System',
            }
        },
    }

</script>

