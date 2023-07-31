<template>
    <div>
        <b-form @submit="destroyWithAjax" :action="route('dashboard.field_titles.destroy', data)" method="POST">

            <div class="row">
                <div class="col-md-12">
                    <p>Once a Title is deleted, it can not be recovered</p>
                </div>
                <div class="col-md-12">
                    <!-- Team Owner Information -->
                </div>
            </div>

            <div class="mt-3">
                <b-button id="submit" class="float-right" type="submit" variant="danger">
                    <span v-if="showSpinner" :class="spinnerClasses" role="status" aria-hidden="true"></span>
                    <i class="fa fa-trash"></i>
                    Confirm Delete
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
                form: this.$inertia.form(),
                returnJson: true,
            }
        },
    }
</script>