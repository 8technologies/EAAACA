<template>
    <div :class="'frontend ' +currentRouteName">
        <!-- Heading -->
        <app-header/>

        <!-- Content Header -->
        <slot name="content-header" class="page-content-header">
        </slot>

        <!-- Page Content -->
        <div :class="'page-content-wrapper' + hasImage()">
            <slot></slot>
        </div>

        <!-- footer -->
        <app-footer/>
    </div>
</template>

<script>
    import MessagesMixin from '@/Mixins/Messages'

    import AppHeaderTop from "@frontend/Layouts/_partials/HeaderTop";
    import AppHeader from "@frontend/Layouts/_partials/Header";
    import AppFooter from "@frontend/Layouts/_partials/Footer";

    import Vue from 'vue';
    // mmenu
    import '@frontend/Libraries/mmenu-js-8.5.24/dist/mmenu.css';
    import '@frontend/Libraries/mmenu-js-8.5.24/dist/mmenu.polyfills.js';
    import '@frontend/Libraries/mmenu-js-8.5.24/dist/mmenu.js';

    export default {
        mixins: [MessagesMixin],
        components: {
            AppHeaderTop,
            AppHeader,
            AppFooter,
        },
        data() {
            return {
            }
        },
        computed: {
            currentRouteName() {
                return this.$page.props.route.name;
            }
        },
        methods: {
            hasImage() {
                var classes = ''

                if (this.$page.props.data && this.$page.props.data.thumbnail) {
                    classes = classes + ' has-image'
                }
                return classes
            },
            switchToTeam(team) {
                this.$inertia.put(route('current-team.update'), {
                    'team_id': team.id
                }, {
                    preserveState: false
                })
            },
            logout() {
                this.$inertia.post(route('logout'));
            },
            inertiaVisit: function(data) {
                this.$inertia.get(data.url, [], [])
            },
        },
        mounted() {
            if (this.$page.props.user == null) {
                window.scrollTo({
                    top: 0, 
                    behavior: 'smooth',
                })   
            }

            this.$inertia.on('exception', (event) => {
                this.showErrorMessages(event.detail.exception.message)
            })

            $('body .frontend').on('click', 'a.inertia-link', (e) => {
                e.preventDefault()

                var el = $(e.currentTarget)
                var dataArray = {
                    'url':  el.attr('href'),
                }
                this.inertiaVisit(dataArray)
            });
            

            // Dropdown Hover very simple to use!
            $(document).ready(function() {
                // KEEP MENU OPEN ON CLICKS
                $(document).on('click', '.dropdown-on-hover .dropdown-menu', function (e) {
                e.stopPropagation();
                });

                $('.dropdown-on-hover .dropdown').hover(function() {
                    if (!($(this).hasClass('show'))) {
                        $('.dropdown-toggle', this).trigger('click');
                    }
                }, function() {
                    if ($(this).hasClass('show')) {
                        $('.dropdown-toggle', this).trigger('click');
                    }
                });
            });

            // 
            $('body').on('click', '.mm-menu a.inertia-link', (e) => {
                e.preventDefault()

                // Close the mmenu
                if (typeof(this.$globalMmenu && this.$globalMmenu.API) == 'object') {
                    this.$globalMmenu.API.close()
                }

                var el = $(e.currentTarget)
                var dataArray = {
                    'url':  el.attr('href'),
                }
                this.inertiaVisit(dataArray)
            });

            $('body .frontend').on('click', '.inertia-link a', (e) => {
                e.preventDefault()

                var el = $(e.currentTarget)
                var dataArray = {
                    'url':  el.attr('href'),
                }
                this.inertiaVisit(dataArray)
            });
        },

    }

    document.addEventListener("DOMContentLoaded", function (event) {
        Vue.prototype.$globalMmenu = new Mmenu(
            document.querySelector('#mobileMenu'),
            {
                extensions: [
                    'theme-black', 
                    'shadow-page', 
                    'position-front', 
                    'pagedim-black',
                    // 'position-right',
                ],
                // wrappers: ['bootstrap'],
                // clone: true,
                setSelected: true,
                counters: false,
                searchfield: {
                    placeholder: 'Search menu items',
                },
                offCanvas: {
                    position: "right"
                },
                navbars: [
                    {
                        content: [
                            `<div class="bg-white" style="padding: 10px 0;">
                                <a class="m-auto dnavbar-brand inertia-link my-1" href="${route('front')}" rel="home" title="Home">
                                    <img alt="Home" src="${route('front') + '/images/logo.png'}" class="logo" style="width:auto;">
                                </a>
                            </div>
                            `,
                            // 'close'
                        ],
                    },
                    // {
                    //     content: ['searchfield'],
                    // },
                    {
                        content: ['prev', 'breadcrumbs', ],
                    },
                    {
                        position: 'bottom',
                        content: [
                            `
                                <div class="text-left d-block p-3">
                                    © ${ window.app.$page.props.app.year } ${ window.app.$page.props.app.name } | All rights reserved
                                </div>
                            `
                        ],
                    },
                ],
            },
            {
                searchfield: {
                    clear: true,
                },
                navbars: {
                    breadcrumbs: {
                        removeFirst: true,
                    },
                },
            }
        );
    });

</script>
