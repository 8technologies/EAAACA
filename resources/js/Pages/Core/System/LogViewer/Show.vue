<template>
    <app-layout>

        <template #header>
        </template>

        <template #breadcrumb>
            <li class="breadcrumb-item">
                <inertia-link :href="route('dashboard')">
                    Dashboard
                </inertia-link>
            </li>
            <li class="breadcrumb-item">
                <inertia-link :href="route('dashboard.system')">
                    System
                </inertia-link>
            </li>
            <li class="breadcrumb-item">
                <inertia-link :href="route('dashboard.logs.index')">
                    Logs
                </inertia-link>
            </li>
        </template>

        <h3 class="">
            {{ data.name }}
        </h3>

        <table class="table table-sm table-borderless">
            <tbody>
                <tr>
                    <th width="150px">File path: </th>
                    <td>{{ data.log.path }}</td>
                </tr>
                <tr>
                    <th>Size: </th>
                    <td>{{ data.size }}</td>
                </tr>
                <tr>
                    <th>Entries: </th>
                    <td>{{ data.count }}</td>
                </tr>
                <tr>
                    <th>Created at: </th>
                    <td>{{ data.created_at }}</td>
                </tr>
                <tr>
                    <th>Updated at: </th>
                    <td>{{ data.updated_at }}</td>
                </tr>
                <tr>
                    <th></th>
                    <td></td>
                </tr>
            </tbody>
        </table>

        <TableList :data="data.log.entries"></TableList>

    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import SeoMixin from '@/Mixins/SEO'
    import TableList from './_TableList'
    
    export default {
        props: [
            'data',
        ],
        mixins: [SeoMixin],
        components: {
            AppLayout,
            TableList,
        },
        data() {
            return {
                pageTitle: this.data.name + ' - Logs',
            }
        },
    }
</script>
