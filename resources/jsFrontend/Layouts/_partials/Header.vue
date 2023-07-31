<template>
<header class="py-0 header-wrapper border-bottom">

    <nav class="navbar p-0 navbar-expand-lg navbar">
        <div class="container">
            <a class="navbar-brand inertia-link my-1" :href="route('front')" rel="home" title="Home">
                <img alt="Home" :src="route('front') + '/images/logo.png'" class="logo">
            </a>

            <div class="collapse navbar-collapse dropdown-on-hover" id="navbarsMain">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <b-link class="nav-link inertia-link" :href="route('front')" :active="checkIfCurrentUrl(route('front')+'/')">
                            Home
                        </b-link>
                    </li>
                    <li class="nav-item">
                        <b-link class="nav-link inertia-link" :href="route('about-us')" :active="checkIfCurrentUrl(route('about-us'))">
                            About ARIN-EA
                        </b-link>
                    </li>
                    <li class="nav-item">
                        <b-link class="nav-link inertia-link" :href="route('about-us')" :active="checkIfCurrentUrl(route('about-us'))">
                            What's New
                        </b-link>
                    </li>
                    <li class="nav-item">
                        <b-link class="nav-link inertia-link" :href="route('about-us')" :active="checkIfCurrentUrl(route('about-us'))">
                            Discussion Board
                        </b-link>
                    </li>
                    <li class="nav-item">
                        <b-link class="nav-link inertia-link" :href="route('about-us')" :active="checkIfCurrentUrl(route('about-us'))">
                            My Resources
                        </b-link>
                    </li>
                    <li class="nav-item">
                        <b-link class="nav-link inertia-link" :href="route('contact')" :active="checkIfCurrentUrl(route('contact'))">
                            Contact Us
                        </b-link>
                    </li>
                </ul>

                <ul v-if="$page.props.user" class="navbar-nav ml-auto mr-0">
                    <li class="nav-item">
                        <a class="nav-link inertia-link" :href="route('dashboard')">
                            Dashboard
                        </a>
                    </li>
                </ul>
                <ul v-else class="navbar-nav ml-auto mr-0">
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
                </ul>
                
            </div>

            <div class="navbar-toggler-wrapper navbar-toggler p-0 bg-dark">
                <a href="#mobileMenu" class="navbar-dark px-2 py-1 d-block rounded">
                    <span class="navbar-toggler-icon"></span>
                </a>
                <!-- <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#navbarsMain" aria-controls="navbarsMain" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button> -->
            </div>

        </div>
    </nav>

    <div style="display:none;">
        <nav id="mobileMenu">
            <MobileMenu></MobileMenu>
        </nav>
    </div>

</header>
</template>

<script>
    import FunctionsMixin from '@/Mixins/Functions'

    import MobileMenu from './_MobileMenu.vue'

    export default {
        mixins: [FunctionsMixin],
        components: {
            MobileMenu,
        },
    }
</script>