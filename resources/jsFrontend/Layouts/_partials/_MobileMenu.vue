<template>
    <ul class="">
        <li class="">
            <b-link class="nav-link inertia-link" :href="route('front')" :active="checkIfCurrentUrl(route('front')+'/')">
                Home
            </b-link>
        </li>
        <li class="">
            <span class="">About us</span>
            <ul class="">
                <b-link class="inertia-link" :href="route('about-us')" :active="checkIfCurrentUrl(route('front')+'/about-us')">
                    About us
                </b-link>
            </ul>
        </li>
        <li class="nav-item">
            <b-link class="nav-link inertia-link" :href="route('contact')" :active="checkIfCurrentUrl(route('contact'))">
                Contact Us
            </b-link>
        </li>


        <li class="">
            <span class="">Media Center</span>
            <ul class="">
                <b-link class="nav-link inertia-link" :href="route('news')" :active="checkActivePath('news')">
                    News
                </b-link>
                <b-link class="nav-link inertia-link" :href="route('events')" :active="checkActivePath('events')">
                    Events
                </b-link>
                <b-link class="nav-link inertia-link" :href="route('blog')" :active="checkActivePath('blog')">
                    Blog
                </b-link>
                <b-link class="nav-link inertia-link" :href="route('publications')" :active="checkActivePath('publications')">
                    Publications
                </b-link>
                <b-link class="nav-link inertia-link" :href="route('gallery')" :active="checkActivePath('gallery')">
                    Gallery
                </b-link>
            </ul>
        </li>
        <li class="nav-item">
            <b-link class="nav-link inertia-link" :href="route('contact')" :active="checkIfCurrentUrl(route('contact'))">
                Contact Us
            </b-link>
        </li>

        <template v-if="$page.props.user" class="">
            <li class="nav-item">
                <a class="nav-link inertia-link" :href="route('dashboard')">
                    Dashboard
                </a>
            </li>
        </template>
        <template v-else class="">
            <li class="nav-item">
                <a class="nav-link inertia-link" :href="route('login')">
                    Login
                </a>
            </li>
            <li v-if="route().has('register')" class="nav-item">
                <a class="nav-link inertia-link" :href="route('register')">
                    Register
                </a>
            </li>
        </template>

    </ul>
</template>

<script>

    import FrontEndMixin from '@frontend/Mixins/FrontEnd'
    import FunctionsMixin from '@/Mixins/Functions'

    export default {
        mixins: [FrontEndMixin, FunctionsMixin],
        data() {
            return {

            }
        },
    }
</script>