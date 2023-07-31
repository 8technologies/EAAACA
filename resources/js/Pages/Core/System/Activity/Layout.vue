<template>
    <app-layout>

        <template #header>
            <h3 class="">
                {{ data.name }}
            </h3>
        </template>

        <template #breadcrumb>
            <li class="breadcrumb-item">
                <inertia-link :href="route('dashboard')" class="" :active="route().current('dashboard')">
                    Dashboard
                </inertia-link>
            </li>
            <li class="breadcrumb-item">
                <inertia-link :href="route('dashboard.activities.index')" class="">
                    Activities
                </inertia-link>
            </li>
            <li class="breadcrumb-item active"></li>
        </template>

        <div class="row">
            <div class="col-md-12">
                <h3 class="">
                    {{ data.name }}
                </h3>

                <div class="mb-3">
                    <b-nav tabs>
                        <b-nav-item :href="route('dashboard.activities.show', data.id)" :class="'inertia-link'" :active="route().current('dashboard.activities.show', data.id)">
                            View
                        </b-nav-item>
                        <b-nav-item :href="route('dashboard.activities.edit', data.id)" :class="'inertia-link'" :active="route().current('dashboard.activities.edit', data.id)">
                            Edit
                        </b-nav-item>
                        <li class="nav-item">
                            <b-link :href="route('dashboard.activities.show', data.id)" class="nav-link text-danger" v-on:click="showEntityDelete($event)">
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
    import EntityDelete from './_FormDelete'

    export default {
        props: [
            'data',
        ],
        mixins: [FunctionsMixin, EntityComponentsMixin],
        components: {
            AppLayout,
            EntityDelete,
        },
    }
</script>