<template>

    <div class="wrapper">

        <!-- Navbar -->
        <layout-navbar />
        <!-- /.navbar -->
        
        <!-- Main Sidebar Container -->
        <layout-main-sidebar />
        
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <header class="">
            <!-- Content Header (Page header) -->
            <div class="content-header pb-0 px-3">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-8">
                            <h1 class="m-0 text-dark">
                                <slot name="header">
                                    <div class="small">
                                    <span class="small text-dark">
                                        <b-button variant="link" @click="$router.go(-1)" class="small pl-0" style="font-weight: normal;">
                                            <i class="fa fa-chevron-left"></i> Go Back
                                        </b-button>
                                    </span>
                                    </div>
                                </slot>
                            </h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4">
                            <ol class="breadcrumb float-sm-right">
                                <slot name="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <inertia-link :href="route('dashboard')">
                                            Dashboard
                                        </inertia-link>
                                    </li>
                                    <li class="breadcrumb-item active">
                                    </li>
                                </slot>
                            </ol>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            </header>

            <!-- Main content -->
            <main>
                <div class="container-fluid">
                    <div class="pl-3 pb-3 pr-3">
                        <slot></slot>
                    </div>
                </div>
            </main>
            <!-- /.content -->

        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <layout-control-sidebar />
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <layout-footer />

    </div>

</template>

<script>
    import MessagesMixin from '@/Mixins/Messages'

    import LayoutNavbar from "@/Layouts/Partials/Navbar"
    import LayoutMainSidebar from "@/Layouts/Partials/MainSidebar"
    import LayoutControlSidebar from "@/Layouts/Partials/ControlSidebar"
    import LayoutFooter from "@/Layouts/Partials/Footer"

    export default {
        mixins: [MessagesMixin],
        props: {
            title: String,
        },
        components: {
            LayoutNavbar,
            LayoutMainSidebar,
            LayoutControlSidebar,
            LayoutFooter,
        },
        data() {
            return {
                
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

            logout() {
                this.$inertia.post(route('logout'));
            },

            inertiaVisit: function(data) {
                this.$inertia.get(data.url, [], [])
            },
            
        },
        mounted() {

            this.$inertia.on('exception', (event) => {
                this.showErrorMessages(event.detail.exception.message)
            })

            $('body').on('click', 'a.inertia-link', (e) => {
                e.preventDefault()

                var el = $(e.currentTarget)
                var dataArray = {
                    'url':  el.attr('href'),
                }
                this.inertiaVisit(dataArray)
            });

            $('body').on('click', '.inertia-link a', (e) => {
                e.preventDefault()

                var el = $(e.currentTarget)
                var dataArray = {
                    'url':  el.attr('href'),
                }
                this.inertiaVisit(dataArray)
            });
        },

    }
</script>