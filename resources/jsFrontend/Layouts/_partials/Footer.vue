<template>
<footer class="footer bg-black">
    <div class="footer-bottom pt-5 pb-3">
        <div class="py-2">
            <div class="container py-2">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-md-6 col-lg-6 pb-2">
                                <h4 class="title">
                                    About us
                                </h4>
                                <ul class="navbar-nav ml-auto">
                                    <li class="nav-item">
                                        <b-link class="nav-link inertia-link" :href="route('about-us')" :active="checkIfCurrentUrl(route('about-us'))">
                                            About Us
                                        </b-link>
                                    </li>
                                    <li class="nav-item">
                                        <b-link class="nav-link inertia-link" :href="route('about-us')" :active="checkIfCurrentUrl(route('about-us'))">
                                            Webmail
                                        </b-link>
                                    </li>
                                    <li class="nav-item">
                                        <b-link class="nav-link inertia-link" :href="route('about-us')" :active="checkIfCurrentUrl(route('about-us'))">
                                            FAQs
                                        </b-link>
                                    </li>
                                    <li class="nav-item">
                                        <b-link class="nav-link inertia-link" :href="route('about-us')" :active="checkIfCurrentUrl(route('about-us'))">
                                            Job Adverts
                                        </b-link>
                                    </li>
                                    <li class="">
                                        <b-link class="nav-link inertia-link" :href="route('contact')" :active="checkActivePath('contact')">
                                            Contact Us
                                        </b-link>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6 col-lg-6 pb-2">
                                <h4 class="title">
                                    What's Latest
                                </h4>
                                <ul class="navbar-nav ml-auto">
                                    <li class="nav-item">
                                        <b-link class="nav-link inertia-link" :href="route('news')" :active="checkActivePath('news')">
                                            News
                                        </b-link>
                                    </li>
                                    <li class="nav-item">
                                        <b-link class="nav-link inertia-link" :href="route('events')" :active="checkActivePath('events')">
                                            Events
                                        </b-link>
                                    </li>
                                    <li class="">
                                        <b-link class="nav-link inertia-link" :href="route('blog')" :active="checkActivePath('blog')">
                                            Blog
                                        </b-link>
                                    </li>
                                    <li class="">
                                        <b-link class="nav-link inertia-link" :href="route('publications')" :active="checkActivePath('publications')">
                                            Publications
                                        </b-link>
                                    </li>
                                    <!-- <li class="">
                                        <b-link class="nav-link inertia-link" :href="route('gallery')" :active="checkActivePath('gallery')">
                                            Gallery
                                        </b-link>
                                    </li> -->
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <ShowBlock v-if="footerContacts" :data="footerContacts"></ShowBlock>
                    </div>
                </div>
            </div>

            <div class="border-top border-secondary pb-3 mt-5"></div>

            <div class="container pt-1">
                <div class="row no-gutters py-2">
                    <div class="col-lg-6">
                        © {{ $page.props.app.year }} {{ $page.props.app.name }} | All rights reserved
                    </div>
                    <div class="col-lg-6">
                        <ul class="nav justify-content-lg-end">
                            <li class="nav-item">
                                <b-link class="nav-link pl-0 py-0 inertia-link" :href="route('terms')" :active="checkIfCurrentUrl(route('terms'))">
                                    Terms of Service
                                </b-link>
                            </li>
                            <li class="nav-item">
                                <b-link class="nav-link py-0 inertia-link" :href="route('policy')" :active="checkIfCurrentUrl(route('terms'))">
                                    Privacy Policy
                                </b-link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
</template>

<script>
    import FunctionsMixin from '@/Mixins/Functions'
    import FrontEndMixin from '@frontend/Mixins/FrontEnd'
    import ShowBlock from '@frontend/Pages/Core/Block/Block/_FormShow'

    export default {
        mixins: [FunctionsMixin, FrontEndMixin],
        data() {
            return {
                footerContacts: this.getObjectWithPropValue(this.$page.props.blocks, 'uuid', 'Block1'),
                // ourServices: this.getObjectWithPropValue(this.$page.props.blocks, 'uuid', 'Block3'),
            }
        },
        components: {
            ShowBlock,
        },
    }
</script>