<template>

    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                    <i class="fas fa-bars">
                    </i>
                </a>
            </li>

            <!-- Team Feature Dropdown Menu -->
            <!-- <li class="nav-item dropdown" v-if="$page.props.jetstream.hasTeamFeatures">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <span class="">
                        {{ $page.props.user.current_team ? $page.props.user.current_team.name : 'My Teams'}}
                    </span>
                </a>
            </li> -->


            <!-- <li class="nav-item d-none d-sm-inline-block">
                <a class="nav-link" href="index3.html">
                    Home
                </a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a class="nav-link" href="#">
                    Contact
                </a>
            </li> -->
        </ul>
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Navbar Search -->
            <li class="nav-item">
                <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                    <i class="fas fa-search">
                    </i>
                </a>
                <div class="navbar-search-block">
                    <form class="form-inline">
                        <div class="input-group input-group-sm">
                            <input aria-label="Search" class="form-control form-control-navbar" placeholder="Search" type="search">
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search">
                                    </i>
                                </button>
                                <button class="btn btn-navbar" data-widget="navbar-search" type="button">
                                    <i class="fas fa-times">
                                    </i>
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
            </li>
            <!-- Messages Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fa fa-envelope"></i>
                    <span class="badge badge-danger navbar-badge">{{ contact_messages.total }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-header">
                        {{ contact_messages.total }} Unread Contact Messages
                    </span>
                    <div class="dropdown-divider">
                    </div>

                    <template v-for="item in contact_messages.data">
                        <b-link :key="'contact_messages'+item.id" class="dropdown-item" href="#">
                            <div class="media">
                                <!-- <img alt="User Avatar" class="img-size-50 mr-3 img-circle" :src="baseUrl+'/dist/img/user1-128x128.jpg'"> -->
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        {{ item.name }} ({{ item.email }})
                                    </h3>
                                    <p class="text-sm">
                                        {{ item.message }}
                                    </p>
                                    <p class="text-sm text-muted">
                                        <i class="far fa-clock mr-1">
                                        </i>
                                        {{ timeAgo(item.created_at) }} Ago
                                    </p>
                                </div>
                            </div>
                        </b-link>
                        <div :key="'divider'+item.id" class="dropdown-divider"></div>
                    </template>

                    <inertia-link class="dropdown-item dropdown-footer" :href="route('dashboard.contact_messages.index')">
                        See All Messages
                    </inertia-link>
                </div>
            </li>


            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell">
                    </i>
                    <span class="badge badge-warning navbar-badge">
                        {{ notifications.unread }}
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-header">
                        {{ notifications.unread }} Unread Notifications
                    </span>
                    <div class="dropdown-divider">
                    </div>

                    <template v-if="notifications.unreadNotifications[0]">
                        <b-link v-for="item in notifications.unreadNotifications" :key="item.text" class="dropdown-item" href="#">
                            <div class="row no-gutters">
                                <div class="col-9">
                                    <div class="row no-gutters align-items-start">
                                        <i class="fas col-" :class="notificationIcon(item.text)"></i>
                                        <span class="d-inline-block text-wrap col pl-2 ml-1 line-height-sm">
                                            {{ item.count }} {{ item.text }}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <span class="float-right text-muted text-sm text-wrap line-height-sm text-right">
                                        {{ timeAgo(item.date) }}
                                    </span>
                                </div>
                            </div>
                        </b-link>
                        <div class="dropdown-divider"></div>
                        <div class="row no-gutters text-center">
                            <div class="col">
                                <inertia-link class="text-success p-1 d-block" :href="route('user.notifications.markasread')">
                                    <i class="fa fa-check-circle"></i>
                                    Mark as read
                                </inertia-link>
                            </div>
                            <div class="col">
                                <inertia-link class="border-left text-danger p-1 d-block" :href="route('user.notifications.deleteall')">
                                    <i class="fa fa-trash"></i>
                                    Delete all
                                </inertia-link>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                    </template>

                    <inertia-link class="dropdown-item dropdown-footer" :href="route('profile.notifications')">
                        See All Notifications
                    </inertia-link>
                </div>
            </li>


            <!-- User Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link px-2 img-rounded-circle" data-toggle="dropdown" href="#">
                    <span class="">
                        {{ user.name }}
                    </span>
                    <img class="d-inline-block ml-1 border" :src="user.thumbnail" :alt="user.name" width="35px" height="35px" style="margin-top: -5px;"/>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                    <div class="block px-4 py-2 text-xs text-gray-400">
                        Manage Account
                    </div>

                    <div class="dropdown-divider"></div>

                    <inertia-link :href="route('profile.show')" class="dropdown-item" :active="route().current('profile.show')">
                        Profile
                    </inertia-link>

                    <inertia-link :href="route('profile.notifications')" class="dropdown-item" :active="route().current('profile.notifications')">
                        Notifications
                    </inertia-link>

                    <!-- <inertia-link :href="route('profile.teams')" class="dropdown-item" :active="route().current('profile.teams')">
                        Teams
                    </inertia-link> -->

                    <inertia-link :href="route('profile.files')" class="dropdown-item" :active="route().current('profile.files')">
                        Files
                    </inertia-link>

                    <inertia-link :href="route('profile.sessions')" class="dropdown-item" :active="route().current('profile.sessions')">
                        Sessions
                    </inertia-link>

                    <inertia-link :href="route('api-tokens.index')" class="dropdown-item" :active="route().current('api-tokens.index')" v-if="$page.props.jetstream.hasApiFeatures">
                        API Tokens
                    </inertia-link>

                    <!-- Authentication -->
                    <div class="dropdown-divider"></div>
                    <form method="POST" @submit.prevent="logout">
                        <b-button type="submit" variant="link">
                            Log out
                        </b-button>
                    </form>

                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link px-2" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt">
                    </i>
                </a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link px-2" data-slide="true" data-widget="control-sidebar" href="#" role="button">
                    <i class="fas fa-th-large">
                    </i>
                </a>
            </li> -->
        </ul>
    </nav>

</template>

<script>
    import moment from 'moment'

    export default {
        props: {},
        components: {
        },
        data() {
            return {
                baseUrl: route().t.url,
                showingNavigationDropdown: false,
                user: this.$page.props.user,
            }
        },
        computed: {
            notifications() {
                return this.$page.props.notifications
            },
            contact_messages() {
                return this.$page.props.contact_messages
            }
        },
        methods: {
            switchToTeam(team) {
                this.$inertia.put(route('current-team.update'), {
                    'team_id': team.id
                }, {
                    preserveState: false
                })
            },

            timeAgo: function(value) {
                return moment(value).fromNow(true);
            },

            notificationIcon: function(value) {
                if (value.includes('User')) {
                    return 'fa-user'
                }
                if (value.includes('Team')) {
                    return 'fa-users'
                }
                if (value.includes('Message')) {
                    return 'fa-envelope'
                }

                return 'fa-bell'
            },
            logout() {
                this.$inertia.post(route('logout'));
            },
        }
    }
</script>

<style type="text/css">
    
    .teams-dropdown-menu {
        max-height: calc(100vh - (3.5rem + 1px));
        overflow-y: scroll;
    }

</style>