<template>
    <app-layout>

        <template #header>
            Settings 
        </template>

        <div class="my-3">
            <div class="border-top rounded bg-light px-3 mb-2">
                <span class=""></span>
            </div>

            <div class="row">
                <div class="col-lg-12 mt-3">
                    <div class="h-100 border p-3 rounded bg-white">
                        <!-- <h5 class="text-bold border-bottom pb-1">Location</h5> -->
                        <ul class="admin-list m-0">

                            <li class="nav-item" v-if="route().has('dashboard.statuses.index') && checkPermission('manage.system')">
                                <b-link :href="route('dashboard.statuses.index')" class="nav-link inertia-link" :class="checkActivePath('dashboard/statuses') ? 'active' : '' ">
                                    <span class="label">Statuses</span>
                                    <div class="description">Manage "Statuses"</div>
                                </b-link>
                            </li>
                            <li class="nav-item" v-if="route().has('dashboard.countries.index') && checkPermission('manage.system')">
                                <b-link :href="route('dashboard.countries.index')" class="nav-link inertia-link" :class="checkActivePaths(['dashboard/countries']) ? 'active' : '' ">
                                    <span class="label">Countries</span>
                                    <div class="description">Manage "Countries"</div>
                                </b-link>
                            </li>



                            <li class="nav-item" v-if="route().has('dashboard.information-restrictions.index') && checkPermission('manage.system')">
                                <b-link :href="route('dashboard.information-restrictions.index')" class="nav-link inertia-link" :class="checkActivePath('dashboard/information-restrictions') ? 'active' : '' ">
                                    <span class="label">Information Restrictions</span>
                                    <div class="description">Manage "Information Restrictions" options</div>
                                </b-link>
                            </li>
                            <li class="nav-item" v-if="route().has('dashboard.nature-of-offences.index') && checkPermission('manage.system')">
                                <b-link :href="route('dashboard.nature-of-offences.index')" class="nav-link inertia-link" :class="checkActivePath('dashboard/nature-of-offences') ? 'active' : '' ">
                                    <span class="label">Nature of Offences</span>
                                    <div class="description">Manage "Nature of Offences" options</div>
                                </b-link>
                            </li>
                            <li class="nav-item" v-if="route().has('dashboard.case-types.index') && checkPermission('manage.system')">
                                <b-link :href="route('dashboard.case-types.index')" class="nav-link inertia-link" :class="checkActivePath('dashboard/case-types') ? 'active' : '' ">
                                    <span class="label">Case Types</span>
                                    <div class="description">Manage "Case Types"</div>
                                </b-link>
                            </li>
                            <li class="nav-item" v-if="route().has('dashboard.forum-categories.index') && checkPermission('manage.system')">
                                <b-link :href="route('dashboard.forum-categories.index')" class="nav-link inertia-link" :class="checkActivePath('dashboard/forum-categories') ? 'active' : '' ">
                                    <span class="label">Forum Categories</span>
                                    <div class="description">Manage "Forum Categories"</div>
                                </b-link>
                            </li>

                        </ul>
                    </div>
                </div>

            </div>
        </div>

    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import SeoMixin from '@/Mixins/SEO'
    import FunctionsMixin from '@/Mixins/Functions'

    export default {
        mixins: [SeoMixin, FunctionsMixin],
        components: {
            AppLayout,
        },
        data() {
            return {
                pageTitle: 'Settings',
            }
        },
    }

</script>

