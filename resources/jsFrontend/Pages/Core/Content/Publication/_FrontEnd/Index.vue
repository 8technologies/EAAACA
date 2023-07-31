<template>
    <app-layout>

        <template #pageTitle>
            {{ pageTitle }}
        </template>

        <template #pageIntro>
            <div class="row justify-content-center">
                <div class="col-md-9 font-size-x">
                    All Documents and Media downloads 
                </div>
            </div>

            <div class="row justify-content-center pt-3 gutter-sm">
                <div class="col-md-9">
                    <b-form @submit="search" :action="pageRoute" method="get">
                        <div class="row">
                            <div class="col">
                                <b-form-input id="search" 
                                    name="query"
                                    placeholder="Keywords" 
                                    class="rounded-pill"
                                    v-model="textSearch">
                                </b-form-input>
                            </div>
                            <div class="col-auto">
                                <b-button class="d-block w-100 rounded-pill px-4" id="submit" type="submit" variant="primary">
                                    <span class="" role="status" aria-hidden="true"></span>
                                    Search
                                </b-button>
                            </div>
                            <div class="col-auto">
                                <b-button :href="pageRoute" variant="danger" class="inertia-link btn btn-danger d-block w-100 rounded-pill px-4">
                                    Reset
                                </b-button>
                            </div>
                        </div>
                    </b-form>
                </div>
            </div>
        </template>

        <List :data="data"></List>

        <div class="col-lg-12 p-0 pt-3">
            <Pagination :data="data"></Pagination>
        </div>

    </app-layout>
</template>

<script>
    import AppLayout from '@frontend/Layouts/LayoutContent'
    import SeoMixin from '@/Mixins/SEO'
    import FunctionsMixin from '@/Mixins/Functions'
    import FrontEndMixin from '@frontend/Mixins/FrontEnd'
    import Select2Mixin from '@/Mixins/Plugins/Select2'
    import List from '@frontend/Pages/Core/_LayoutStyle/_List'

    export default {
        props: ['data'],
        mixins: [SeoMixin, FunctionsMixin, Select2Mixin, FrontEndMixin, FunctionsMixin],
        components: {
            AppLayout,
            List,
        },
        data() {
            return {
                pageTitle: 'Publications',
                pageRoute: route('publications'),
            }
        },
        computed: {
            textSearch: {
                get: function () {
                    return (new URL(location)).searchParams.get('query')
                },
                set: function (value) {
                },
            },
        },
    }

</script>

