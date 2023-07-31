<template>
    <app-layout :data="data">

        <template #pageSectionTops>
            <div class="page-section-top-wrapper">
                <div class="row no-gutters draggable-row-header">
                    <div class="col">
                        <span v-if="isProcessing" :class="spinnerClasses + ' text-primary'" role="status" aria-hidden="true"></span>
                    </div>
                </div>

                <draggable v-model="localData.layout_section_tops" handle=".draggable-section-header" v-bind="dragOptions" @start="drag = true" @end="drag = false" @change="updateSectionsSortPositions(entityUpdateUrl)" :class="'layout-sections'">
                    <div class="" v-for="item in localData.layout_section_tops" :key="item.id">
                        <layoutSectionTopPreview :data="item"></layoutSectionTopPreview>
                    </div>
                    <div v-if="!localData.layout_section_tops[0]" class="p-1 m-2 rounded border border-dotted text-center border-primary">
                        <b-link :href="route('dashboard.pages.addpagesectiontop', localData.id)" class="" v-on:click="showAddSilently($event)">
                            <i class="fa fa-plus fa-md"></i> Section Top
                        </b-link>
                    </div>
                </draggable>
            </div>
        </template>
        
        <template #pageTitle>
            {{ data.name }}
        </template>

        <template v-if="data.introduction_text" #pageIntro>
            <div class="row justify-content-center pt-1 pb-4">
                <div class="col-md-9 font-size-x">
                    {{ data.introduction_text }}
                </div>
            </div>
        </template>
        
        <!-- <template #pageBreadcrumb>
            <ol class="breadcrumb p-0 d-inline-flex bg-transparent">
                <li class="breadcrumb-item">
                    <inertia-link :href="route('front')" class="" :active="route().current('front')">
                    Home
                </inertia-link>
                </li>
                <li class="breadcrumb-item active"></li>
            </ol>
        </template> -->

        <template #pageFeaturedImage>
            <div class="page-featured-image-wrapper container">
                <b-img-lazy 
                    :src="data.media_image ? data.media_image['preview-lg'] : ''" 
                    fluid 
                    :height="'auto'"
                    alt="">
                </b-img-lazy>
            </div>
        </template>

        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="" v-html="data.body"></div>
            </div>
        </div>

        <template #pageSections>

            <div class="page-sections-wrapper">
                <div class="row no-gutters draggable-row-header">
                    <div class="col">
                        <span v-if="isProcessing" :class="spinnerClasses + ' text-primary'" role="status" aria-hidden="true"></span>
                    </div>
                </div>

                <draggable v-model="localData.layout_sections" handle=".draggable-section-header" v-bind="dragOptions" @start="drag = true" @end="drag = false" @change="updateSectionsSortPositions(entityUpdateUrl)" :class="'layout-sections'">
                    <div class="" v-for="item in localData.layout_sections" :key="item.id">
                        <layoutSectionPreview :data="item"></layoutSectionPreview>
                    </div>
                    <div class="p-1 m-2 rounded border border-dotted text-center border-primary">
                        <b-link :href="route('dashboard.pages.addpagesection', localData.id)" class="" v-on:click="showAddSilently($event)">
                            <i class="fa fa-plus fa-md"></i> Section
                        </b-link>
                    </div>
                </draggable>
            </div>

        </template>
            
    </app-layout>
</template>

<script>
    import AppLayout from '@frontend/Layouts/LayoutContent'
    import FunctionsMixin from '@/Mixins/Functions'
    import SeoMixin from '@/Mixins/SEO'

    import layoutSection from '@/Pages/Core/Layout/LayoutSection/Show'

    import draggable from 'vuedraggable'
    import MessagesMixin from '@/Mixins/Messages'
    import DBOperationsMixin from '@/Mixins/DBOperations'

    import EntityComponentsMixin from '@/Mixins/EntityComponents'
    import layoutRowPreview from '@/Pages/Core/Layout/LayoutRow/_Preview'
    import layoutSectionPreview from '@/Pages/Core/Layout/LayoutSection/_PreviewLive'
    import layoutSectionTopPreview from '@/Pages/Core/Layout/LayoutSectionTop/_PreviewLive'

    export default {
        props: [
            'data',
        ],
        mixins: [FunctionsMixin, SeoMixin, MessagesMixin, DBOperationsMixin, EntityComponentsMixin],
        components: {
            AppLayout,
            layoutSection,

            draggable,
            layoutRowPreview,
            layoutSectionPreview,
            layoutSectionTopPreview,
        },
        data() {
            return {
                pageTitle: this.data.name,

                localData: this.data,
                updatablePreview: true,
                entityUpdateUrl: route('dashboard.pages.updatepagesections', this.data.id),
                returnJson: true,
                isProcessing: false,
            }
        },
        computed: {
            dragOptions() {
                return {
                    animation: 200,
                    // group: "description",
                    disabled: false,
                    ghostClass: "ghost"
                }
            },
        },
        methods: {
            updateSectionsSortPositions: function(url) {
                //console.log(url)
                this.isProcessing = true

                this.localData.layout_sections.map((item, index) => {
                    item.position = index + 1
                })
                var data = _.map(this.localData.layout_sections, function(item) {
                    return _.pick(item, ['id', 'position'])
                })
                this.showUpdateSilently(data, url)
            },
        },
        watch: { 
            data: function(newVal, oldVal) {
                this.localData = newVal
            },
        },
        // created() {
        //     console.log( this.data.media_image )
        // }
    }
</script>
