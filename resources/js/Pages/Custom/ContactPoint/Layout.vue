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
                <inertia-link :href="route('dashboard.contact-points.index')" class="">
                    Contact points
                </inertia-link>
            </li>
            <li class="breadcrumb-item active"></li>
        </template>

        <slot name="content">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="">
                        {{ data.name }}
                    </h3>

                    <EntityLinks :data="data"></EntityLinks>                   
                </div>
            </div>
        </slot>

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
    import EntityDelete from './_FormDelete'

    import EntityLinks from '@/Pages/Core/_Includes/_EntityLinks'

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
