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
                <inertia-link :href="route('dashboard.information-requests.index')" class="">
                    Information Requests
                </inertia-link>
            </li>
            <li class="breadcrumb-item active"></li>
        </template>

        <slot name="content">
            <div class="row">
                <div class="col-md-12">

                    <PreviewSummary :data="data" :class="''"></PreviewSummary>

                    <b-nav tabs class="mb-4">
                        <b-nav-item :href="data.entity_links.url" :class="'inertia-link'" :active="checkIfCurrentUrl(data.entity_links.url) || checkIfCurrentUrl(data.entity_links.url_view)">
                            View
                        </b-nav-item>
                        <!-- <b-nav-item :href="route('dashboard.information-requests.responses', {id: data.id})" :class="'inertia-link'" :active="checkIfCurrentUrl(route('dashboard.information-requests.responses', {id: data.id}))">
                            Request Responses
                            <b-badge variant="primary">{{ data.request_responses_count ? data.request_responses_count : '0' }}</b-badge>
                        </b-nav-item> -->
                        <b-nav-item :href="data.entity_links.url_edit" :class="'inertia-link'" :active="checkIfCurrentUrl(data.entity_links.url_edit)">
                            Edit
                        </b-nav-item>
                        <li class="nav-item">
                            <b-link :href="data.entity_links.url_view" class="nav-link text-danger" v-on:click="showEntityDelete($event)">
                                Delete
                            </b-link>
                        </li>
                    </b-nav>

                    <!-- <b-nav tabs class="mb-4">
                        <b-nav-item :href="data.entity_links.url" :class="'inertia-link'" :active="checkIfCurrentUrl(data.entity_links.url) || checkIfCurrentUrl(data.entity_links.url_view)">
                            Overview
                        </b-nav-item>
                        <b-nav-item :href="data.entity_links.url" :class="'inertia-link'">
                            Request Details
                        </b-nav-item>
                    </b-nav> -->
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