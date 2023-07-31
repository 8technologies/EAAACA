<template>
    <app-layout>

        <template #header>
            Fields
        </template>

        <div class="my-3">
            <div class="border rounded bg-light py-2 px-3">
                <span class="">Manage your fields</span>
            </div>
            <ul class="admin-list">
                <li class="">
                    <b-link :href="route('dashboard.field_titles.index')" class="inertia-link">
                        <span class="label">Title Fields</span>
                        <div class="description">Manage "Title Fields" used in layout builder</div>
                    </b-link>
                </li>
                <li class="">
                    <b-link :href="route('dashboard.field_texts.index')" class="inertia-link">
                        <span class="label">Text Fields</span>
                        <div class="description">Manage "Text Fields" used in layout builder</div>
                    </b-link>
                </li>
                <li class="">
                    <b-link :href="route('dashboard.field_links.index')" class="inertia-link">
                        <span class="label">Link Fields</span>
                        <div class="description">Manage "Link Fields" used in layout builder</div>
                    </b-link>
                </li>
                <li class="">
                    <b-link :href="route('dashboard.field_images.index')" class="inertia-link">
                        <span class="label">Image Fields</span>
                        <div class="description">Manage "Image Fields" used in layout builder</div>
                    </b-link>
                </li>
                <li class="">
                    <b-link :href="route('dashboard.field_htmls.index')" class="inertia-link">
                        <span class="label">Html Fields</span>
                        <div class="description">Manage "Html Fields" used in layout builder</div>
                    </b-link>
                </li>
                <li class="">
                    <b-link :href="route('dashboard.field_blocks.index')" class="inertia-link">
                        <span class="label">Block Fields</span>
                        <div class="description">Manage "Block Fields" used in layout builder.</div>
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
                pageTitle: 'Fields',
            }
        },
    }

</script>

