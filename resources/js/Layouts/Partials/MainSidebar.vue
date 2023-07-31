<template>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <b-link :href="route('front')" class="brand-link inertia-link">
            <img alt="AdminLTE Logo" class="brand-image img-rounded px-2 py-1 bg-white elevation-3" :src="baseUrl + '/images/logo.png'" style="opacity: .9">
            <span class="brand-text font-weight-light">
                {{ getAppName() }}
            </span>
        </b-link>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image img-rounded-circle">
                    <img alt="User Image" class="bg-white" :src="user.thumbnail">
                </div>
                <div class="info">
                    <b-link class="d-block inertia-link" :href="route('profile.show')">
                        {{ user.name }}
                    </b-link>
                </div>
            </div> -->

            <!-- Sidebar Menu -->
            <nav class="my-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-accordion="false" data-widget="treeview" role="menu">

                    <li class="nav-item">
                        <b-link :href="route('dashboard')" class="nav-link inertia-link" :class="{ 'active': route().current('dashboard') }">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </b-link>
                    </li>
                    <!-- <li class="nav-item" v-if="route().has('dashboard.information-requests.create')">
                        <b-link :href="route('dashboard.information-requests.create')" class="nav-link inertia-link" :class="checkActivePaths(['dashboard/information-requests/create']) ? 'active' : '' ">
                            <i class="nav-icon fa fa-plus"></i>
                            <p>Request Information</p>
                        </b-link>
                    </li> -->



                    <template>
                        <li class="nav-item" v-if="route().has('dashboard.information-requests.index')">
                            <b-link :href="route('dashboard.information-requests.index')" class="nav-link inertia-link" :class="checkActivePaths(['dashboard/information-requests']) ? 'active' : '' ">
                                <i class="nav-icon fa fa-file-alt text-warning"></i>
                                <p>Information Request</p>
                            </b-link>
                        </li>
                        <li class="nav-item" v-if="route().has('dashboard.cases.index')">
                            <b-link :href="route('dashboard.cases.index')" class="nav-link inertia-link" :class="checkActivePaths(['dashboard/cases']) ? 'active' : '' ">
                                <i class="nav-icon fa fa-gavel text-success"></i>
                                <p>Case Coordination</p>
                            </b-link>
                        </li>
                        <li class="nav-item" v-if="route().has('dashboard.contact-points.index')">
                            <b-link :href="route('dashboard.contact-points.index')" class="nav-link inertia-link" :class="checkActivePaths(['dashboard/contact-points']) ? 'active' : '' ">
                                <i class="nav-icon fa fa-user text-danger"></i>
                                <p>Contact Points</p>
                            </b-link>
                        </li>


                        
                        <li class="nav-item" v-if="route().has('dashboard.organizations.index')">
                            <b-link :href="route('dashboard.organizations.index')" class="nav-link inertia-link" :class="checkActivePaths(['dashboard/organizations']) ? 'active' : '' ">
                                <i class="nav-icon fa fa-building text-primary"></i>
                                <p>Organizations</p>
                            </b-link>
                        </li>
                        <li class="nav-item" v-if="route().has('dashboard.member-states.index')">
                            <b-link :href="route('dashboard.member-states.index')" class="nav-link inertia-link" :class="checkActivePaths(['dashboard/member-states']) ? 'active' : '' ">
                                <i class="nav-icon fa fa-globe"></i>
                                <p>Member States</p>
                            </b-link>
                        </li>
                        <li class="nav-item" v-if="route().has('dashboard.forum-topics.index')">
                            <b-link :href="route('dashboard.forum-topics.index')" class="nav-link inertia-link" :class="checkActivePaths(['dashboard/forum-topics']) ? 'active' : '' ">
                                <i class="nav-icon fa fa-comments text-info"></i>
                                <p>Discussion Board</p>
                            </b-link>
                        </li>
                        <li class="nav-item" v-if="route().has('dashboard.internal-communications.index')">
                            <b-link :href="route('dashboard.internal-communications.index')" class="nav-link inertia-link" :class="checkActivePaths(['dashboard/internal-communications']) ? 'active' : '' ">
                                <i class="nav-icon fa fa-arrows-alt-h text-primary"></i>
                                <p>Internal Communication</p>
                            </b-link>
                        </li>
                        
                    </template>
                    
                    <template>
                        <li class="nav-header pt-3 pl-3">CONTENT</li>

                        <li class="nav-item" v-if="route().has('dashboard.content')">
                            <b-link :href="route('dashboard.content')" class="nav-link inertia-link" :class="checkActivePaths(['dashboard/content']) ? 'active' : '' ">
                                <i class="nav-icon fa fa-list-ul"></i>
                                <p>Content</p>
                            </b-link>
                        </li>
                        <li class="nav-item" v-if="route().has('dashboard.job-adverts.index')">
                            <b-link :href="route('dashboard.job-adverts.index')" class="nav-link inertia-link" :class="checkActivePaths(['dashboard/job-adverts']) ? 'active' : '' ">
                                <i class="nav-icon fa fa-briefcase"></i>
                                <p>Job Adverts</p>
                            </b-link>
                        </li>
                        <li class="nav-item" v-if="route().has('dashboard.emails.index')">
                            <b-link :href="route('dashboard.emails.index')" class="nav-link inertia-link" :class="checkActivePaths(['dashboard/email']) ? 'active' : '' ">
                                <i class="nav-icon fa fa-envelope"></i>
                                <p>Emails</p>
                            </b-link>
                        </li>
                        <li class="nav-item" v-if="route().has('dashboard.comments.index') && (checkPermission('manage.system') || checkPermission('manage.comments'))">
                            <b-link :href="route('dashboard.comments.index')" class="nav-link inertia-link" :class="checkActivePaths(['dashboard/comments']) ? 'active' : '' ">
                                <i class="nav-icon fa fa-comments"></i>
                                <p>Comments</p>
                            </b-link>
                        </li>
                    </template>
                    
                    <!-- <template v-if="checkPermission('manage.content')">
                        <li class="nav-header pt-2 pl-3">CONTENT</li>

                        <li class="nav-item has-treeview" :class="checkActivePaths(['dashboard/content']) ? 'menu-open' : '' ">
                            <a href="#" class="nav-link" :class="checkActivePaths(['dashboard/content']) ? 'active' : '' ">
                                <i class="nav-icon fa fa-list-ul"></i>
                                <p>
                                    Content
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item" v-if="route().has('dashboard.content')">
                                    <b-link :href="route('dashboard.content')" class="nav-link inertia-link" :class="{ 'active': route().current('dashboard.content') }">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Overview</p>
                                    </b-link>
                                </li>
                                <li class="nav-item" v-if="route().has('dashboard.pages.index')">
                                    <b-link :href="route('dashboard.pages.index')" class="nav-link inertia-link" :class="checkActivePaths(['content/pages']) ? 'active' : '' ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Pages</p>
                                    </b-link>
                                </li>
                                <li class="nav-item" v-if="route().has('dashboard.news.index')">
                                    <b-link :href="route('dashboard.news.index')" class="nav-link inertia-link" :class="checkActivePaths(['content/news']) ? 'active' : '' ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>News</p>
                                    </b-link>
                                </li>
                                <li class="nav-item" v-if="route().has('dashboard.events.index')">
                                    <b-link :href="route('dashboard.events.index')" class="nav-link inertia-link" :class="checkActivePaths(['content/events']) ? 'active' : '' ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Events</p>
                                    </b-link>
                                </li>
                                <li class="nav-item" v-if="route().has('dashboard.publications.index')">
                                    <b-link :href="route('dashboard.publications.index')" class="nav-link inertia-link" :class="checkActivePaths(['content/publications']) ? 'active' : '' ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Publications</p>
                                    </b-link>
                                </li>
                                <li class="nav-item" v-if="route().has('dashboard.blog-posts.index')">
                                    <b-link :href="route('dashboard.blog-posts.index')" class="nav-link inertia-link" :class="checkActivePaths(['content/blog-posts']) ? 'active' : '' ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Blog Posts</p>
                                    </b-link>
                                </li>
                                <li class="nav-item" v-if="route().has('dashboard.featured.index')">
                                    <b-link :href="route('dashboard.featured.index')" class="nav-link inertia-link" :class="checkActivePaths(['content/featured']) ? 'active' : '' ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Featured</p>
                                    </b-link>
                                </li>
                            </ul>
                        </li>
                    </template> -->

                    <template v-if="checkPermission('manage.system')">
                        <li class="nav-header pt-3">ADMINISTRATION</li>

                        <li class="nav-item" v-if="route().has('dashboard.settings') && checkPermission('manage.system')">
                            <b-link :href="route('dashboard.settings')" class="nav-link inertia-link" :class="checkActivePath('dashboard/settings') ? 'active' : '' ">
                                <i class="nav-icon fas fa-fw fa-cog"></i>
                                <p>Settings</p>
                            </b-link>
                        </li>
                        <li class="nav-item" v-if="route().has('dashboard.administration') && checkPermission('manage.system')">
                            <b-link :href="route('dashboard.administration')" class="nav-link inertia-link" :class="checkActivePath('dashboard/administration') ? 'active' : '' ">
                                <i class="nav-icon fas fa-fw fa-user"></i>
                                <p>Administration</p>
                            </b-link>
                        </li>
                        <li class="nav-item" v-if="route().has('dashboard.system') && checkPermission('manage.system')">
                            <b-link :href="route('dashboard.system')" class="nav-link inertia-link" :class="checkActivePath('dashboard/system') ? 'active' : '' ">
                                <i class="nav-icon fas fa-fw fa-server"></i>
                                <p>System</p>
                            </b-link>
                        </li>
                    </template>

                    <!-- <li v-if="route().has('dashboard.system') && checkPermission('manage.system')" class="nav-header pt-3">SYSTEM</li> -->

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->

    </aside>

</template>

<script>
    import FunctionsMixin from '@/Mixins/Functions'

    export default {
        mixins: [FunctionsMixin],
        props: {},
        components: {
        },
        data() {
            return {
                baseUrl: route().t.url,
                user: this.$page.props.user,
                auth: this.$page.props.auth,
                organization: this.$page.props.user.organization_id,
                // organization: this.getOrganization(),
            }
        },
        methods: {
            getAppName() {
                if (this.$page.props.app.name_short) {
                    return this.$page.props.app.name_short
                }
                return this.$page.props.app.name
            },

            getOrganization() {
                if (this.$page.props.auth.organization_id) {
                    return this.$page.props.auth.organization_id
                }

                return null;
            },
        },
        // created() {
        //     console.log( this.auth )
        // }
    }
</script>
