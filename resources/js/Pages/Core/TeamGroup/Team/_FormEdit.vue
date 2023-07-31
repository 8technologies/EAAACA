<template>
    <div>
        <b-form @submit="update" :action="route('dashboard.teams.update', data)" method="PUT">

            <div class="">
                <p>Team name and owner information</p>
            </div>

            <div class="">
                <b-row class="form-group">
                    <b-col sm="3">
                        <label for="name">Owner</label>
                    </b-col>
                    <b-col sm="9">
                        <b-media>
                            <template #aside>
                                <div style="width: 60px">
                                    <b-img :src="data.owner.thumbnail" thumbnail :alt="data.owner.name"></b-img>
                                </div>
                            </template>
                            <div class="font-weight-bold">{{ data.owner.name }}</div>
                            <p class="mb-0">
                                {{ data.owner.email }}
                            </p>
                        </b-media>
                    </b-col>
                </b-row>
                <b-row class="form-group">
                    <b-col sm="3">
                        <label for="name">Name</label>
                    </b-col>
                    <b-col sm="9">
                        <b-form-input id="name" placeholder="" required="" autofocus v-model="form.name" :class="[errors.name ? 'is-invalid' : '']">
                        </b-form-input>
                        <span v-if="errors.name" :class="['label text-danger small']">{{ errors.name }}</span>
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
                    name: this.data.name,
                }),
            }
        },

        // created: function() {
        //     console.log(this)
        // }
    }
</script>