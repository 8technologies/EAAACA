<template>
    <div>
        <b-form @submit="destroy" :action="route('dashboard.internal-communications.destroy', data.id)" method="POST">

            <div class="row">
                <div class="col-md-12">
                    <p>Once deleted, this operation can not be reversed!</p>
                </div>
                <div class="col-md-12">
                    <!-- Team Owner Information -->
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <b-button id="submit" class="float-right" type="submit" variant="danger">
                        <span class="" role="status" aria-hidden="true"></span>
                        <i class="fa fa-trash"></i>
                        Confirm Delete
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
                form: this.$inertia.form()
            }
        },
    }
</script>