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

        <template v-if="data.introduction_text" #pageIntro>
            <div class="row justify-content-center pt-1 pb-4">
                <div class="col-md-9 font-size-x">
                    {{ data.introduction_text }}
                </div>
            </div>
        </template>

        <template #pageBreadcrumb>
            <ol class="breadcrumb p-0 d-inline-flex bg-transparent">
                <li class="breadcrumb-item">
                    <inertia-link :href="route('front')" class="" :active="route().current('front')">
                        Home
                    </inertia-link>
                </li>
                <li class="breadcrumb-item">
                    <inertia-link :href="route('our_work')" class="" :active="route().current('our_work')">
                        Our work
                    </inertia-link>
                </li>
                <li class="breadcrumb-item active"></li>
            </ol>
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
    import EntityComponentsMixin from '@frontend/Mixins/EntityComponents'

    // import layoutSection from '@frontend/Pages/Core/Layout/LayoutSection/Show'

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
            // layoutSection,
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
