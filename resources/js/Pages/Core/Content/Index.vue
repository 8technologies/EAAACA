<template>
    <app-layout>

        <template #header>
            Content
        </template>

        <div class="my-3">
            <div class="border rounded bg-light py-2 px-3">
                <span class="">Manage app content entities</span>
            </div>
            <ul class="admin-list">
                <li class="">
                    <b-link :href="route('dashboard.pages.index')" class="inertia-link">
                        <span class="label">Pages</span>
                        <div class="description">Manage "Pages"</div>
                    </b-link>
                </li>
                <!-- <li class="">
                    <b-link :href="route('dashboard.job-adverts.index')" class="inertia-link">
                        <span class="label">Job Adverts</span>
                        <div class="description">Manage "Job Adverts"</div>
                    </b-link>
                </li> -->
                <!-- <li class="">
                    <b-link :href="route('dashboard.our_work.index')" class="inertia-link">
                        <span class="label">Our Work</span>
                        <div class="description">Manage "Our Work" content types</div>
                    </b-link>
                </li> -->
                <li class="">
                    <b-link :href="route('dashboard.news.index')" class="inertia-link">
                        <span class="label">News</span>
                        <div class="description">Manage "News" content types</div>
                    </b-link>
                </li>
                <li class="">
                    <b-link :href="route('dashboard.events.index')" class="inertia-link">
                        <span class="label">Events</span>
                        <div class="description">Manage "event" content types</div>
                    </b-link>
                </li>
                <li class="">
                    <b-link :href="route('dashboard.publications.index')" class="inertia-link">
                        <span class="label">Publications</span>
                        <div class="description">Manage "publication" content types</div>
                    </b-link>
                </li>
                <li class="">
                    <b-link :href="route('dashboard.blog-posts.index')" class="inertia-link">
                        <span class="label">Blog posts</span>
                        <div class="description">Manage "Blog Post" content types</div>
                    </b-link>
                </li>
                <li class="">
                    <b-link :href="route('dashboard.featured.index')" class="inertia-link">
                        <span class="label">Featured</span>
                        <div class="description">Manage "Featured" content types</div>
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
                pageTitle: 'Content',
            }
        },
    }

</script>

