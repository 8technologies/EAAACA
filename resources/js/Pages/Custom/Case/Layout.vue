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
            <!-- <li class="breadcrumb-item">
                <inertia-link :href="route('dashboard.content')" class="">
                    Content
                </inertia-link>
            </li> -->
            <li class="breadcrumb-item">
                <inertia-link :href="route('dashboard.cases.index')" class="">
                    Cases
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

                    <PreviewSummary :data="data"></PreviewSummary>

                    <b-nav tabs class="mb-4">
                        <b-nav-item :href="data.entity_links.url" :class="'inertia-link'" :active="checkIfCurrentUrl(data.entity_links.url) || checkIfCurrentUrl(data.entity_links.url_view)">
                            Overview
                        </b-nav-item>
                        <b-nav-item :href="route('dashboard.cases.information-requests', {id: data.id})" :class="'inertia-link'" :active="checkIfCurrentUrl(route('dashboard.cases.information-requests', {id: data.id}))">
                            Information Requests
                            <b-badge variant="primary">{{ data.information_requests_count ? data.information_requests_count : '0' }}</b-badge>
                        </b-nav-item>
                        <b-nav-item :href="route('dashboard.cases.case-coordinators', {id: data.id})" :class="'inertia-link'" :active="checkIfCurrentUrl(route('dashboard.cases.case-coordinators', {id: data.id}))">
                            Case Coordinators
                            <b-badge variant="primary">{{ data.case_coordinators_count ? data.case_coordinators_count : '0' }}</b-badge>
                        </b-nav-item>
                        <b-nav-item :href="route('dashboard.cases.case-contributors', {id: data.id})" :class="'inertia-link'" :active="checkIfCurrentUrl(route('dashboard.cases.case-contributors', {id: data.id}))">
                            Case Contributors
                            <b-badge variant="primary">{{ data.case_contributors_count ? data.case_contributors_count : '0' }}</b-badge>
                        </b-nav-item>
                        <!-- <b-nav-item :href="route('dashboard.organizations.contact-points', {id: data.id})" :class="'inertia-link'" :active="checkIfCurrentUrl(route('dashboard.organizations.contact-points', {id: data.id}))">
                            Contact Points
                        </b-nav-item> -->

                        
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
    import PreviewSummary from './_PreviewSummary'

    export default {
        props: [
            'data',
        ],
        mixins: [FunctionsMixin, EntityComponentsMixin],
        components: {
            AppLayout,
            EntityDelete,
            EntityLinks,

            PreviewSummary,
        },
    }
</script>