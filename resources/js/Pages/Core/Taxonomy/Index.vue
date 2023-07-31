<template>
    <app-layout>

        <template #header>
            Taxonomy
        </template>

        <div class="my-3">
            <div class="border rounded bg-light py-2 px-3">
                <span class="">Manage taxonomy types, terms</span>
            </div>

            <ul class="admin-list">
                <li class="">
                    <b-link :href="route('dashboard.taxonomy_terms.index')" class="inertia-link">
                        <span class="label">Taxonomy Terms</span>
                        <div class="description">Manage taxonomy terms</div>
                    </b-link>
                </li>
                <li class="">
                    <b-link :href="route('dashboard.taxonomy_types.index')" class="inertia-link">
                        <span class="label">Taxonomy Types</span>
                        <div class="description">Manage taxonomy types</div>
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
                pageTitle: 'Taxonomy',
            }
        },

    }

</script>

