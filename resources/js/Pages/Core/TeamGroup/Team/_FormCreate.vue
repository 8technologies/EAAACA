<template>
    <div>
        <b-form @submit="create" :action="route('dashboard.teams.store')" method="post">

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
                                    <b-img :src="$page.props.user.thumbnail" thumbnail :alt="$page.props.user.name"></b-img>
                                </div>
                            </template>
                            <div class="font-weight-bold">{{ $page.props.user.name }}</div>
                            <p class="mb-0">
                                {{ $page.props.user.email }}
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
        data() {
          return {
                form: this.$inertia.form({
                    name: '',
                }),
            }
        },
    }
</script>