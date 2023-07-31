<template>
    <app-layout :data="data">
        <template #content>
            <div class="row">
                <div class="col-md-12">
                    <EntityShow :data="data"></EntityShow>

                    <EntityLinks :data="data" class="mt-3"></EntityLinks>                   
                </div>
            </div>
        </template>

    </app-layout>
</template>

<script>
    import AppLayout from './Layout'
    import SeoMixin from '@/Mixins/SEO'
    import FunctionsMixin from '@/Mixins/Functions'
    import EntityComponentsMixin from '@/Mixins/EntityComponents'
    import EntityDelete from './_FormDelete'

    import EntityLinks from '@/Pages/Core/_Includes/_EntityLinks'

    import EntityShow from './_FormShow'

    export default {
        mixins: [SeoMixin, FunctionsMixin, EntityComponentsMixin],
        props: [
            'data',
        ],
        components: {
            AppLayout,
            EntityShow,
            EntityDelete,
            EntityLinks,
        },
        data() {
            return {
                pageTitle: this.data.name + ' - User',
            }
        },
    }
</script>