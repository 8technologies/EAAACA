<template>

    <main class="">
    <div class="row m-auto w-100 min-vh-100">
        <div class="col-lg-6">
            <div class="row align-items-center h-100">
                <div class="mw-400px mx-auto my-2">
                    <div class="bg-white rounded mb-2">
                        <inertia-link :href="'/'" title="Home" rel="home" class="navbar-brand m-auto d-block">
                            <b-img :src="'/images/logo.png'" alt="Home" class="img-fluid d-block m-auto logo">
                            </b-img>
                        </inertia-link>
                    </div>
                    <h4 class="text-center mt-4">
                        <slot name="title"></slot>
                    </h4>
                    <slot></slot>                    
                </div>
            </div>
        </div>
        <div class="col-lg-6 bg-dark">
            <div class="mh-100"></div>
        </div>
    </div>
    </main>

</template>

<script>

    export default {
        components: {

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
        },

    }
</script>

<style>
    .mw-400px {
        width: 100%;
        max-width: 400px;
    }
</style>
