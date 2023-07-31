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

        <slot name="content">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="">
                        Jobs
                    </h3>

                    <!-- <EntityLinks :data="data"></EntityLinks>                    -->
                </div>
            </div>
        </slot>

        <TableList></TableList>

    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import SeoMixin from '@/Mixins/SEO'
    import TableList from './_TableList'

    export default {
        mixins: [SeoMixin],
        components: {
            AppLayout,
            TableList,
        },
        data() {
            return {
                pageTitle: 'Jobs',
            }
        },
    }

</script>

