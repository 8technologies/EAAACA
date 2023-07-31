<template>
    <app-layout>

        <template #pageTitle>
            {{ pageTitle }}
        </template>

        <template #pageIntro>
            <div class="row justify-content-center">
                <div class="col-md-9 font-size-x">
                    What we have accomplished 
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
                pageTitle: 'Our work',
                pageRoute: route('our_work'),
            }
        },
    }

</script>

