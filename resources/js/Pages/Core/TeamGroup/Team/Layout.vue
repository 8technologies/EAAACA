<template>
    <app-layout>

        <template #header>
        </template>

        <template #breadcrumb>
            <li class="breadcrumb-item">
                <inertia-link :href="route('dashboard')">
                    Dashboard
                </inertia-link>
            </li>
            <li class="breadcrumb-item">
                <inertia-link :href="route('dashboard.teams-groups')">
                    Teams & Groups
                </inertia-link>
            </li>
            <li class="breadcrumb-item">
                <inertia-link :href="route('dashboard.teams.index')">
                    Teams
                </inertia-link>
            </li>
        </template>

        <div class="row">

            <div class="col-md-12">
                <h3 class="">
                    {{ data.name }}
                </h3>
            </div>

            <div class="col-md-9">
                <div class="border-right h-100">
                <table class="table table-sm table-borderless">
                    <tbody>
                        <tr>
                            <td width="120px">Owner: </td>
                            <td>
                                {{ data.owner.name }}
                            </td>
                        </tr>
                        <tr>
                            <td>Created at: </td>
                            <td>{{ data.created_at }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <button type="button" class="btn btn-sm btn-dark px-5">
                                    <i class="nav-icon fas fa-fw fa-users"></i>
                                    JOIN TEAM
                                </button>
                            </td>
                        </tr>
                        
                    </tbody>
                </table>
                </div>
            </div>
            <div class="col-md-3">
                <div class="h-100">
                    <div class="py-4">
                        <b-link :href="route('dashboard.teams.invites.create', data)" class="invite-a-member btn btn-sm btn-primary w-100">
                            <i class="fa fa-user"></i> INVITE A MEMBER
                        </b-link>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="my-3">
                    <b-nav tabs>
                        <b-nav-item :href="route('dashboard.teams.show', data.id)" :class="'inertia-link'" :active="route().current('dashboard.teams.show', data.id)">
                            Overview
                        </b-nav-item>

                        <b-nav-item :href="route('dashboard.teams.members.index', data.id)" :class="'inertia-link'" :active="checkActivePath('/members')">
                            Team Members <b-badge variant="secondary">{{ data.users_count }}</b-badge>
                        </b-nav-item>
                        <b-nav-item :href="route('dashboard.teams.invites.index', data.id)" :class="'inertia-link'" :active="checkActivePath('/invites')">
                            Team Invites <b-badge variant="secondary">{{ data.team_invitations_count }}</b-badge>
                        </b-nav-item>

                        <b-nav-item :href="route('dashboard.teams.edit', data.id)" :class="'inertia-link'" :active="route().current('dashboard.teams.edit', data.id)">
                            Edit
                        </b-nav-item>
                        <li class="nav-item">
                            <b-link :href="route('dashboard.teams.show', data.id)" class="nav-link text-danger" v-on:click="showEntityDelete($event)">
                                Delete
                            </b-link>
                        </li>
                    </b-nav>
                </div>
                    
            </div>
        </div>

        <slot></slot>

        <entity-modal-delete v-bind:modalAttributes="modalAttributes">
            <component :is="deleteComponent" v-bind="deleteComponentParams"></component>
        </entity-modal-delete>

        <custom-modal v-bind:modalAttributes="modalAttributes">
            <dynamic-component :is="modalComponent" v-bind="modalComponentParams"></dynamic-component>
        </custom-modal>

    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import FunctionsMixin from '@/Mixins/Functions'
    import EntityComponentsMixin from '@/Mixins/EntityComponents'
    import EntityDelete from './_FormDelete'

    import InviteAMember from '../Invite/_FormCreate'
    import CustomModal from '@/Components/CustomModal'

    export default {
        props: [
            'data',
        ],
        mixins: [FunctionsMixin, EntityComponentsMixin],
        components: {
            AppLayout,
            InviteAMember,
            CustomModal,
            EntityDelete,
        },
        data() {
            return {
                pageTitle: this.data.name + ' - Team ',
            }
        },
        mounted() {
            $('body').on('click', 'a.invite-a-member', (e) => {
                e.preventDefault()

                var el = $(e.currentTarget)
                var dataArray = {
                    'url':  el.attr('href'),
                }
                this.showInvite(dataArray)
            });
        },
        methods: {
            // Override 'showAddEntityAsync' method in 'EntityComponentsMixin'
            showInvite: function(data) {
                // Use axios to edit in Modal, otherwise inertia will Redirect to a full page
                this.clearComponent()
                this.$bvModal.show("custom-modal")
                this.modalAttributes.title = '#Invite a Member'
                // console.log(data.url)
                axios.get(data.url)
                    .then(response => {
                        // console.log(response)
                        this.modalComponent = 'InviteAMember'
                        this.modalComponentParams = response
                    })
                    .catch(error => {
                        // Handle validation errors
                        this.errors = errors;
                        this.success = false;
                        this.showErrorMessages(this.errors)
                    });
            },

        }

    }
</script>