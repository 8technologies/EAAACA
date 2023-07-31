<template>
    <div>
        <b-form @submit="create" :action="route('dashboard.layout_columns.storefieldhtml', data.id)" method="post">

            <entityForm ref="entityForm" :data="data" @updateParentFormValues="updateFormValues"/>
            
            <div class="row no-gutters justify-content-end mt-3 form-btns-wrapper">
                <b-button class="" id="submit" type="submit" variant="primary">
                    <span v-if="showSpinner" :class="spinnerClasses" role="status" aria-hidden="true"></span>
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
    import entityForm from './_Form'
    
    export default {
        mixins: [MessagesMixin, DBOperationsMixin, bootstrapTableMixin],
        props: ['data'],
        data() {
          return {
                form: null,
                returnJson: true,
            }
        },

        components: {
            entityForm,
        },
    }
</script>