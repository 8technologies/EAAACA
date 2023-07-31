<template>
    <table cellpadding="0" cellspacing="0" class="table bg-white table-borderless border w-full">
        <thead class="bg-light border-bottom">
            <tr>
                <th class="">
                    {{ 'Name' }}
                </th>
                <th class="" width="140px">
                    {{ 'Disk' }}
                </th>
                <th class="" width="140px">
                    {{ 'Healthy' }}
                </th>
                <th class="" width="200px">
                    {{ 'Amount of backups' }}
                </th>
                <th class="" width="150px">
                    {{ 'Newest backup' }}
                </th>
                <th class="" width="140px">
                    {{ 'Used Storage' }}
                </th>
            </tr>
        </thead>
        <tbody>
        <tr v-for="backupStatus in backupStatuses" :key="backupStatus.disk">
            <td>{{ backupStatus.name }}</td>
            <td>{{ backupStatus.disk }}</td>
            <td>
                <svg
                    :is="backupStatus.healthy ? 'icon-healthy' : 'icon-unhealthy'"
                    height="24px"
                />
            </td>
            <td>{{ backupStatus.amount }}</td>
            <td>{{ backupStatus.newest }}</td>
            <td>{{ backupStatus.usedStorage }}</td>
        </tr>
        </tbody>
    </table>
</template>

<script>
import IconHealthy from './icons/IconHealthy';
import IconUnhealthy from './icons/IconUnhealthy';

export default {
    props: {
        backupStatuses: { required: true, type: Array },
    },

    components: {
        IconHealthy,
        IconUnhealthy,
    },
};
</script>
