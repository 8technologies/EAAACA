<template>
    <div>
        <b-form @submit="destroy" :action="route('dashboard.case-investigations.destroy', data.id)" method="POST">

            <div class="row">
                <div class="col-md-12">
                    <p>Once deleted, the operation can not be un-done</p>
                </div>
                <div class="col-md-12">
                    <!-- Team Owner Information -->
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <b-button id="submit" class="float-right" type="submit" variant="danger">
                        <span v-if="showSpinner" :class="spinnerClasses" role="status" aria-hidden="true"></span>
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
                form: this.$inertia.form(),
            }
        },
    }
</script>