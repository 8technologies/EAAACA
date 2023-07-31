<template>
    <app-layout>
        
        <!-- Page SectionTops -->
        <slot name="pageSectionTops" v-if="hasSectionTop">

        </slot>
        <!-- Page Header -->
        <slot v-else name="pageHeader">
            <div class="container-fluid page-top-wrapper">
                <div class="container">
                    <slot name="pageBreadcrumb"></slot>

                    <template v-if="$slots.pageTitle">
                        <h1 class="">
                            <slot name="pageTitle"></slot>
                        </h1>
                    </template>

                    <slot name="pageIntro"></slot>

                    <slot name="pageSectionTops"></slot>
                </div>
            </div>
        </slot>

        <!-- Page pageBreadcrumb -->
        <!-- <slot name="pageBreadcrumb">
            <ol class="breadcrumb p-0 d-inline-flex bg-transparent">
                <li class="breadcrumb-item">
                    <inertia-link :href="route('front')" class="" :active="route().current('front')">
                    Home
                </inertia-link>
                </li>
                <li class="breadcrumb-item active"></li>
            </ol>
        </slot> -->

        <slot name="pageFeaturedImage"></slot>

        <!-- Secondary Nav -->
        <SecondaryNav></SecondaryNav>

        <!-- Page Content -->
        <main :class="'main-content' + hasPageBottom()">
            <!-- Page EntityLinks -->
            <template v-if="showLinks">
                <div class="container">
                    <slot name="EntityLinks">
                        <b-nav tabs class="secondary-navbar">
                            <b-nav-item :href="data.entity_links.url" :class="'inertia-link'" :active="checkIfCurrentUrl(data.entity_links.url) || checkIfCurrentUrl(data.entity_links.url_view)">
                                View
                            </b-nav-item>
                            <b-nav-item :href="data.entity_links.url_edit" :class="'inertia-link'" :active="checkIfCurrentUrl(data.entity_links.url_edit)">
                                Edit
                            </b-nav-item>
                            <li class="nav-item">
                                <b-link :href="data.entity_links.url_view" class="nav-link text-danger" v-on:click="showEntityDelete($event)">
                                    Delete
                                </b-link>
                            </li>
                        </b-nav>
                    </slot>
                </div>
            </template>

            <div v-if="!$slots.pageSections || data.body" class="container-fluid pt-5">
                <!-- <div class="container py-1">
                    <slot name="content-links">
                    </slot>
                </div> -->

                <div class="container pb-5">
                    <slot></slot>
                </div>
            </div>
        </main>

        <!-- Page Sections -->
        <slot name="pageSections" v-if="$slots.pageSections"></slot>

        <!-- Page Bottom -->
        <slot name="pageBottom" v-if="$slots.pageBottom"></slot>

    </app-layout>
</template>

<script>
    import AppLayout from '@frontend/Layouts/AppLayout'
    import FunctionsMixin from '@/Mixins/Functions'
    import EntityComponentsMixin from '@frontend/Mixins/EntityComponents'
    import {jarallax, jarallaxVideo} from 'jarallax';
    import SecondaryNav from '@frontend/Layouts/_partials/SecondaryNav'
    jarallaxVideo();
    
    export default {
        props: [
            'data',
        ],
        mixins: [FunctionsMixin, EntityComponentsMixin],
        components: {
            AppLayout,
            SecondaryNav,
        },
        computed: {
            hasSectionTop() {
                if (typeof(this.data) === 'undefined' || typeof(this.data.layout_section_tops) === 'undefined') {
                    return false
                }

                if (this.data.layout_section_tops.length > 0) {
                    return true
                }
            },
            showLinks() {
                if (typeof(this.data) !== 'undefined' && this.$page.props.user != null ) {
                    return true
                }
                return false
            },
        },
        methods: {
            hasPageBottom() {
                return this.$slots.pageBottom ? ' has-page-bottom' : ''
            },
        },
        mounted() {
            // Todo
            jarallax(document.querySelectorAll('.jarallax'), 'destroy');

            // 
            jarallax(document.querySelectorAll('.jarallax'), {
                speed: 0.2
            });
        },
    }
</script>