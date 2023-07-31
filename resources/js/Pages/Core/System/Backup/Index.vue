
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
            Backups
        </h3>

        <div class="">
            <div class="mb-3">
                <BackupStatuses :backup-statuses="backupStatuses"></BackupStatuses>
            </div>

            <TableListBackups
                v-if="activeDisk"
                :disks="disks"
                :backups="activeDiskBackups"
                :active-disk.sync="activeDisk">
            </TableListBackups>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import SeoMixin from '@/Mixins/SEO'
    import FunctionsMixin from '@/Mixins/Functions'
    import Messages from '@/Mixins/Messages'
    import TableListBackups from './_TableListBackups'

    import BackupStatuses from './BackupStatuses';

    export default {
        props: [
            'data'
        ],
        mixins: [SeoMixin, FunctionsMixin, Messages],
        components: {
            AppLayout,
            TableListBackups,
            BackupStatuses
        },
        computed: {
            disks() {
                return this.backupStatuses.map(backupStatus => backupStatus.disk);
            },
            backupStatuses() {
                if (!this.activeDisk) {
                    this.activeDisk = this.data.backup_statuses[0].disk;
                }
                return this.data.backup_statuses
            },
        },
        data: () => ({
            pageTitle: 'Backups',
            activeDisk: null,
            activeDiskBackups: [],
            initialLoading: true,
            modalVisibility: false,
            loading: true
        }),
        methods: {
            deleteBackup({ disk, path }) {
                return api.deleteBackup({ disk, path });
            },
        },
    };
</script>
