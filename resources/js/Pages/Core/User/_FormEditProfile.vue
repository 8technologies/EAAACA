<template>
    <div>
        <b-form @submit="update" :action="route('dashboard.users.update-profile', data.id)" method="PUT">

            <entityForm ref="entityForm" :data="data" @updateParentFormValues="updateFormValues"/>

            <div class="row no-gutters justify-content-end mt-3 form-btns-wrapper">
                <b-button class="float-right" id="submit" type="submit" variant="primary">
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

    import entityForm from './_FormProfile'

    export default {
        mixins: [MessagesMixin, DBOperationsMixin, bootstrapTableMixin],
        props: ['data'],
        data() {
            return {
                form: null,
            }
        },
        components: {
            entityForm,
        },
    }
</script>
