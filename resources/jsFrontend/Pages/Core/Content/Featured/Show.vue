<template>
    <app-layout :data="data">

        <template #pageBreadcrumb>
            <ol class="breadcrumb p-0 d-inline-flex bg-transparent">
                <li class="breadcrumb-item">
                    <inertia-link :href="route('front')" class="" :active="route().current('front')">
                        Home
                    </inertia-link>
                </li>
            </ol>
        </template>

        <!-- <template #pageTitle>
            {{ data.name }}
        </template> -->

        <template #pageIntro>
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <h1 class="smaller-h1">
                        {{ data.name }}
                    </h1>
                </div>
            </div>
        </template>

        <div class="row justify-content-center">
            <div class="col-md-8 content">
                <div class="content-image-wrapper ">
                    <ImagePreview :data="data"></ImagePreview>
                </div>

                <div class="content-body" v-html="data.body"></div>
            </div>

            <div class="col-md-4">
                <div class="pb-3">
                    {{ formatDate(data.created_at) }}
                </div>
            </div>
        </div>

    </app-layout>
</template>

<script>
    import AppLayout from '@frontend/Layouts/LayoutContent'
    import SeoMixin from '@/Mixins/SEO'
    import FunctionsMixin from '@/Mixins/Functions'
    import FrontEndMixin from '@frontend/Mixins/FrontEnd'
    import List from '@frontend/Pages/Core/_LayoutStyle/_Grid'

    export default {
        props: [
            'data',
        ],
        mixins: [SeoMixin, FunctionsMixin, FrontEndMixin],
        components: {
            AppLayout,
            List,
        },
        data() {
            return {
                pageTitle: this.data.name + ' - Featured',
            }
        },
    }
</script>
