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
                <inertia-link :href="route('dashboard.system')">
                    System
                </inertia-link>
            </li>
            <li class="breadcrumb-item active"></li>
        </template>

        <h3 class="">
            Status Report
        </h3>

        <div class="my-3">
            <h5 class="mt-4">
                Laravel environment
            </h5>

            <table class="table table-no-spacing border rounded bg-white">
                <tbody>
                    <tr>
                        <th width="30%">Version</th>
                        <td>{{ data.laravelEnv.version }}</td>
                    </tr>
                    <tr>
                        <th>App size</th>
                        <td>{{ data.laravelEnv.app_size }}</td>
                    </tr>
                    <tr>
                        <th>Debug mode</th>
                        <td>{{ data.laravelEnv.debug_mode }}</td>
                    </tr>
                    <tr>
                        <th>Storage directory writable</th>
                        <td>{{ data.laravelEnv.storage_dir_writable }}</td>
                    </tr>
                    <tr>
                        <th>Cache directory writable</th>
                        <td>{{ data.laravelEnv.cache_dir_writable }}</td>
                    </tr>
                    <tr>
                        <th>Timezone</th>
                        <td>{{ data.laravelEnv.timezone }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="my-3">
            <h5 class="mt-4">
                Server environment
            </h5>

            <table class="table table-no-spacing border rounded bg-white">
                <tbody>
                    <tr>
                        <th width="30%">Server software</th>
                        <td>{{ data.serverEnv.server_software }}</td>
                    </tr>
                    <tr>
                        <th>Server OS</th>
                        <td>{{ data.serverEnv.server_os }}</td>
                    </tr>
                    <tr>
                        <th>Database connection name</th>
                        <td>{{ data.serverEnv.database_connection_name }}</td>
                    </tr>
                    <tr>
                        <th>Session driver</th>
                        <td>{{ data.serverEnv.session_driver }}</td>
                    </tr>
                    <tr>
                        <th>Cache driver</th>
                        <td>{{ data.serverEnv.cache_driver }}</td>
                    </tr>
                    <tr>
                        <th>SSL installed</th>
                        <td>{{ data.serverEnv.ssl_installed }}</td>
                    </tr>
                    <tr>
                        <th>Openssl</th>
                        <td>{{ data.serverEnv.openssl }}</td>
                    </tr>
                    <tr>
                        <th>Pdo</th>
                        <td>{{ data.serverEnv.pdo }}</td>
                    </tr>
                    <tr>
                        <th>Mbstring</th>
                        <td>{{ data.serverEnv.mbstring }}</td>
                    </tr>
                    <tr>
                        <th>Tokenizer</th>
                        <td>{{ data.serverEnv.tokenizer }}</td>
                    </tr>
                    <tr>
                        <th>Xml</th>
                        <td>{{ data.serverEnv.xml }}</td>
                    </tr>
                </tbody>
            </table>
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
                pageTitle: 'Status Report',
            }
        },
    }

</script>

