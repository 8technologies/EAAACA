<template>
    <app-layout>

        <template #header>
            Teams & Groups
        </template>

        <div class="my-3">
            <div class="border rounded bg-light py-2 px-3">
                <span class="">Manage teams & groups</span>
            </div>

            <ul class="admin-list">
                <li class="">
                    <b-link :href="route('dashboard.teams.index')" class="inertia-link">
                        <span class="label">Teams</span>
                        <div class="description">Manage user teams</div>
                    </b-link>
                </li>
                <li class="">
                    <b-link href="#" class="inertia-link">
                        <span class="label">Groups</span>
                        <div class="description">Manage user groups</div>
                    </b-link>
                </li>
            </ul>
        </div>

    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import SeoMixin from '@/Mixins/SEO'

    export default {
        mixins: [SeoMixin],
        components: {
            AppLayout,
        },
        data() {
            return {
                pageTitle: 'Teams & Groups',
            }
        },

    }

</script>
