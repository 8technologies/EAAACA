<template>
    <div>
        <b-form @submit="create" :action="route('team-members.store', data.id)" method="post">

            <div class="row">
                <div class="col-md-12">
                    <h5 class="">Team Name</h5>
                    <p>Add a new team member to your team, allowing them to collaborate with you</p>
                </div>
                <div class="col-md-4">
                    
                </div>
                <div class="col-md-8">
                    <b-form-group id="input-group-email" label="Email:" label-for="email">
                        <b-form-input id="name" placeholder="Enter E-mail address" required="" autofocus v-model="form.email" :class="[errors.email ? 'is-invalid' : '']">
                        </b-form-input>
                        <span v-if="errors.email" :class="['label text-danger small']">{{ errors.email }}</span>
                    </b-form-group>
                </div>
            </div>

            <b-button id="submit" type="submit" variant="primary">
                <span class="" role="status" aria-hidden="true"></span>
                Submit
            </b-button>
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
                    email: '',
                }),
            }
        },
        created: function() {
            // console.log(this.data)
        }
    }
</script>