<template>
    <app-layout>

        <template #header>
            Layouts
        </template>

        <div class="my-3">
            <div class="border rounded bg-light py-2 px-3">
                <span class="">Manage your dynamic layouts and their content</span>
            </div>

            <ul class="admin-list">
                <li class="">
                    <b-link :href="route('dashboard.layout_sections.index')" class="inertia-link">
                        <span class="label">LayoutSections</span>
                        <div class="description">Manage "LayoutSections" used in layout builder</div>
                    </b-link>
                </li>
                <li class="">
                    <b-link :href="route('dashboard.layout_section_tops.index')" class="inertia-link">
                        <span class="label">LayoutSectionTops</span>
                        <div class="description">Manage "LayoutSectionTops" used in layout builder</div>
                    </b-link>
                </li>
                <li class="">
                    <b-link :href="route('dashboard.layout_rows.index')" class="inertia-link">
                        <span class="label">LayoutRows</span>
                        <div class="description">Manage "LayoutRows" used in layout builder</div>
                    </b-link>
                </li>
                <li class="">
                    <b-link :href="route('dashboard.layout_columns.index')" class="inertia-link">
                        <span class="label">LayoutColumns</span>
                        <div class="description">Manage "LayoutColumns" used in layout builder</div>
                    </b-link>
                </li>
            </ul>
        </div>

    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import SeoMixin from '@/Mixins/SEO'

    export default {
        mixins: [SeoMixin],
        components: {
            AppLayout,
        },

        data() {
            return {
                pageTitle: 'Layouts',
            }
        },

    }

</script>

