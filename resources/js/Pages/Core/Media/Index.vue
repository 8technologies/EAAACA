<template>
    <app-layout>

        <template #header>
            Media
        </template>

        <div class="my-3">
            <div class="border rounded bg-light py-2 px-3">
                <span class="">Manage all media & files</span>
            </div>

            <ul class="admin-list">
                <li class="">
                    <b-link :href="route('dashboard.media.files.index')" class="inertia-link">
                        <span class="label">All files</span>
                        <div class="description">Manage all uploaded files</div>
                    </b-link>
                </li>
                <li class="">
                    <b-link :href="route('dashboard.media.files.index')" class="inertia-link">
                        Images
                        <span class="label">LayoutSections</span>
                        <div class="description">Manage uploaded images</div>
                    </b-link>
                </li>
                <li class="">
                    <b-link :href="route('dashboard.media.files.index')" class="inertia-link">
                        <span class="label">Documents</span>
                        <div class="description">Manage all documents entities</div>
                    </b-link>
                </li>
                <li class="">
                    <b-link :href="route('dashboard.media.videos.index')" class="inertia-link">
                        <span class="label">Videos</span>
                        <div class="description">Manage all video entities</div>
                    </b-link>
                </li>
                <li class="">
                    <b-link :href="route('dashboard.media.providers.index')" class="inertia-link">
                        <span class="label">Providers</span>
                        <div class="description">Manage media providers</div>
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
                pageTitle: 'Media',
            }
        },

    }

</script>

