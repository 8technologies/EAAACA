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
                <inertia-link :href="route('dashboard.organizations.index')" class="">
                    Organizations
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

                    <b-nav tabs class="mb-4">
                        <b-nav-item :href="data.entity_links.url" :class="'inertia-link'" :active="checkIfCurrentUrl(data.entity_links.url) || checkIfCurrentUrl(data.entity_links.url_view)">
                            Overview
                        </b-nav-item>
                        <b-nav-item :href="route('dashboard.organizations.cases', {id: data.id})" :class="'inertia-link'" :active="checkIfCurrentUrl(route('dashboard.organizations.cases', {id: data.id}))">
                            Cases 
                            <b-badge variant="primary">{{ data.cases_count ? data.cases_count : '0' }}</b-badge>
                        </b-nav-item>
                        <b-nav-item :href="route('dashboard.organizations.information-requests', {id: data.id})" :class="'inertia-link'" :active="checkIfCurrentUrl(route('dashboard.organizations.information-requests', {id: data.id}))">
                            Information Requests
                            <b-badge variant="primary">{{ data.information_requests_count ? data.information_requests_count : '0' }}</b-badge>
                        </b-nav-item>
                        <b-nav-item :href="route('dashboard.organizations.contact-points', {id: data.id})" :class="'inertia-link'" :active="checkIfCurrentUrl(route('dashboard.organizations.contact-points', {id: data.id}))">
                            Contact Points
                            <b-badge variant="primary">{{ data.contact_points_count ? data.contact_points_count : '0' }}</b-badge>
                        </b-nav-item>
                        <!-- <b-nav-item :href="data.entity_links.url_edit" :class="'inertia-link'" :active="checkIfCurrentUrl(data.entity_links.url_edit)">
                            Edit
                        </b-nav-item>
                        <li class="nav-item">
                            <b-link :href="data.entity_links.url_view" class="nav-link text-danger" v-on:click="showEntityDelete($event)">
                                Delete
                            </b-link>
                        </li> -->
                    </b-nav>

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
        methods: {
            showEntityDelete(event) {
                var vueInstance = this.getParentWithMethod('showEntityDelete')
                vueInstance.showEntityDelete(event)
            },
        },
    }
</script>
