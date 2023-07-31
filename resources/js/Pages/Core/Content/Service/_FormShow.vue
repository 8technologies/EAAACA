<template>
    <app-layout :data="data">

        <template #pageSectionTops>
            <div class="" v-for="item in localData.layout_section_tops" :key="item.id">
                <layoutSectionTopPreview :data="item"></layoutSectionTopPreview>
            </div>
        </template>
        
        <template #pageTitle>
            {{ data.name }}
        </template>

        <template #pageBreadcrumb>
            <ol class="breadcrumb p-0 d-inline-flex bg-transparent">
                <li class="breadcrumb-item">
                    <inertia-link :href="route('front')" class="" :active="route().current('front')">
                    Home
                </inertia-link>
                </li>
                <li class="breadcrumb-item active"></li>
            </ol>
        </template>

        <template #content-links>
            <b-nav tabs>
                <b-nav-item :href="route('dashboard.services.show', data.id)" :class="'inertia-link'" :active="route().current('dashboard.services.show', data.id)">
                    View
                </b-nav-item>
                <b-nav-item :href="route('dashboard.services.edit', data.id)" :class="'inertia-link'" :active="route().current('dashboard.services.edit', data.id)">
                    Edit
                </b-nav-item>
                <li class="nav-item">
                    <b-link :href="route('dashboard.services.show', data.id)" class="nav-link text-danger" v-on:click="showEntityDelete($event)">
                        Delete
                    </b-link>
                </li>
            </b-nav>
        </template>

        <div class="">
            <div class="" v-html="data.body"></div>
        </div>

        <template #pageSections>
            <div class="" v-for="item in localData.layout_sections" :key="item.id">
                <layoutSectionPreview :data="item"></layoutSectionPreview>
            </div>
        </template>
            
    </app-layout>
</template>

<script>
    import AppLayout from '@frontend/Layouts/LayoutContent'
    import FunctionsMixin from '@/Mixins/Functions'
    import SeoMixin from '@/Mixins/SEO'

    import layoutSection from '@/Pages/Core/Layout/LayoutSection/Show'

    import EntityComponentsMixin from '@/Mixins/EntityComponents'
    import layoutRowPreview from '@/Pages/Core/Layout/LayoutRow/_FormShow'
    import layoutSectionPreview from '@/Pages/Core/Layout/LayoutSection/_FormShow'
    import layoutSectionTopPreview from '@/Pages/Core/Layout/LayoutSectionTop/_FormShow'

    export default {
        props: [
            'data',
        ],
        mixins: [FunctionsMixin, SeoMixin, EntityComponentsMixin],
        components: {
            AppLayout,
            layoutSection,

            layoutRowPreview,
            layoutSectionPreview,
            layoutSectionTopPreview,
        },
        data() {
            return {
                pageTitle: this.data.name,

                localData: this.data,
            }
        },

    }
</script>
