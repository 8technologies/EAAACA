<template>
    <div>
        <b-form @submit="update" :action="route('dashboard.notifications.update', data.id)" method="PUT">

            <div class="">
                <p>Modify a Notification</p>
            </div>

            <div class="">
                <b-row class="form-group">
                    <b-col sm="3">
                        <label for="type">Type</label>
                    </b-col>
                    <b-col sm="9">
                        <b-form-input id="type" placeholder="" required="" autofocus v-model="form.type" :class="[errors.type ? 'is-invalid' : '']">
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
                <b-row class="form-group">
                    <b-col sm="3">
                        <label for="notifiable_id">Notifiable Id</label>
                    </b-col>
                    <b-col sm="9">
                        <b-form-input id="notifiable_id" placeholder="" required="" v-model="form.notifiable_id" :class="[errors.notifiable_id ? 'is-invalid' : '']">
                        </b-form-input>
                        <span v-if="errors.notifiable_id" :class="['label text-danger small']">{{ errors.notifiable_id }}</span>
                    </b-col>
                </b-row>
                <b-row class="form-group">
                    <b-col sm="3">
                        <label for="data">Data</label>
                    </b-col>
                    <b-col sm="9">
                        <b-form-textarea
                            id="data"
                            v-model="form.data_"
                            placeholder="Enter data details..."
                            rows="3"
                            max-rows="6" :class="[errors.data ? 'is-invalid' : '']">
                        </b-form-textarea>
                        <span v-if="errors.data" :class="['label text-danger small']">{{ errors.data }}</span>
                    </b-col>
                </b-row>
            </div>

            <div class="row no-gutters justify-content-end mt-3 form-btns-wrapper">
                <b-button class="" id="submit" type="submit" variant="primary">
                    <span class="" role="status" aria-hidden="true"></span>
                    Update
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
                    type: this.data.type,
                    notifiable_type: this.data.notifiable_type,
                    notifiable_id: this.data.notifiable_id,
                    data_: this.data.data,
                }),
            }
        },

        // created: function() {
        //     // console.log(this.data)
        // }
    }
</script>