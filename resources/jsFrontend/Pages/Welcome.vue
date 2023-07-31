<template>
    <app-layout-auth>
        <template #title>
            Welcome
        </template>

        <StatusMessages class="mb-4" />

        <nav class="navbar p-0 navbar-expand-md navbar">
            <div class="container">
                <ul class="navbar-nav m-auto">
                    <template v-if="$page.props.user">
                        <li class="nav-item">
                            <a class="nav-link inertia-link" :href="route('dashboard')">
                                Dashboard
                            </a>
                        </li>
                    </template>
                    <template v-else>
                        <li class="nav-item">
                            <a class="nav-link inertia-link" :href="route('login')">
                                Login
                            </a>
                        </li>
                        <li v-if="route().has('register')" class="nav-item">
                            <a class="active nav-link inertia-link" :href="route('register')">
                                Register
                            </a>
                        </li>
                    </template>
                </ul>
            </div>
        </nav>
    </app-layout-auth>
</template>

<script>
    import AppLayoutAuth from '@frontend/Layouts/AppLayoutAuth'
    import SeoMixin from '@/Mixins/SEO'

    import MessagesMixin from '@frontend/Mixins/Messages'
    import DBOperationsMixin from '@frontend/Mixins/DBOperations'

    export default {
        mixins: [MessagesMixin, DBOperationsMixin, SeoMixin],
        components: {
            AppLayoutAuth,
        },

        props: {
            canResetPassword: Boolean,
            status: String
        },

        data() {
            return {
                pageTitle: 'Welcome',
            }
        },
    }
</script>
