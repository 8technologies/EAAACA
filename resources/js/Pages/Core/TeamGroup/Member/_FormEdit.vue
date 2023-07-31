<template>
    <div>
        <b-form @submit="update" :action="route('dashboard.teams.update', data.id)" method="PUT">

            <div class="row">
                <div class="col-md-12">
                    <h5 class="">Team Name</h5>
                </div>
                <div class="col-md-4">
                    <p>The team's name and owner information.</p>
                </div>
                <div class="col-md-8">
                    <!-- Team Owner Information -->
                    <div class="col-span-6">
                        <div>Team Owner</div>

                        <div class="flex items-center mt-2">
                            <img class="w-12 h-12 rounded-full object-cover" :src="data.owner.thumbnail" :alt="data.owner.name">
                            <div class="ml-4 leading-tight">
                                <div>{{ data.owner.name }}</div>
                                <div class="text-gray-700 text-sm">{{ data.owner.email }}</div>
                            </div>
                        </div>
                    </div>

                    <b-form-group id="input-group-name" label="Team Name:" label-for="input-name">
                        <b-form-input id="input-name" placeholder="Enter Name of Team" required="" autofocus v-model="form.name" :class="[errors.name ? 'is-invalid' : '']">
                        </b-form-input>
                        <span v-if="errors.name" :class="['invalid-feedback']">{{ errors.name }}</span>
                    </b-form-group>
                </div>
                <div class="col-md-12">
                    <b-button class="" id="submit" type="submit" variant="primary">
                        <span class="" role="status" aria-hidden="true"></span>
                        Update
                    </b-button>
                </div>
            </div>

        </b-form>
    </div>
</template>
<script>
    import MessagesMixin from '@/Mixins/Messages'
    import DBOperationsMixin from '@/Mixins/DBOperations'
    import bootstrapTableMixin from '@/Mixins/Plugins/BootstrapTable'

    export default {
        mixins: [MessagesMixin, DBOperationsMixin, bootstrapTableMixin],
        props: ['data'],
        data() {
          return {
                form: this.$inertia.form({
                    name: this.data.name,
                }),
            }
        },

        created: function() {
            // console.log(this)
        }
    }
</script>