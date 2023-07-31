<template>
    <div>
        <b-form @submit="create" :action="route('dashboard.notifications.store')" method="post">

            <div class="">
                <p>Add a new Role</p>
            </div>

            <div class="">
                <b-row class="form-group">
                    <b-col sm="3">
                        <label for="id">Id</label>
                    </b-col>
                    <b-col sm="9">
                        <b-form-input id="id" placeholder="" required="" autofocus v-model="form.id" :class="[errors.id ? 'is-invalid' : '']">
                        </b-form-input>
                        <span v-if="errors.id" :class="['label text-danger small']">{{ errors.id }}</span>
                    </b-col>
                </b-row>
                <b-row class="form-group">
                    <b-col sm="3">
                        <label for="type">Type</label>
                    </b-col>
                    <b-col sm="9">
                        <b-form-input id="type" placeholder="" required="" v-model="form.type" :class="[errors.type ? 'is-invalid' : '']">
                        </b-form-input>
                        <span v-if="errors.type" :class="['label text-danger small']">{{ errors.type }}</span>
                    </b-col>
                </b-row>
                <b-row class="form-group">
                    <b-col sm="3">
                        <label for="notifiable_type">Notifiable Type</label>
                    </b-col>
                    <b-col sm="9">
                        <b-form-input id="notifiable_type" placeholder="" required="" v-model="form.notifiable_type" :class="[errors.notifiable_type ? 'is-invalid' : '']">
                        </b-form-input>
                        <span v-if="errors.notifiable_type" :class="['label text-danger small']">{{ errors.notifiable_type }}</span>
                    </b-col>
                </b-row>
            </div>

            <div class="row no-gutters justify-content-end mt-3 form-btns-wrapper">
                <b-button class="" id="submit" type="submit" variant="primary">
                    <span class="" role="status" aria-hidden="true"></span>
                    Submit
                </b-button>
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
                    id: '',
                    type: '',
                    notifiable_type: '',
                    notifiable_id: '',
                    data_: '',
                }),
            }
        },
    }
</script>