<template>
    <div>
        <b-form @submit="create" :action="route('dashboard.testimonies.store')" method="post">

            <entityForm ref="entityForm" :data="data" @updateParentFormValues="updateFormValues"/>
            
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
    import entityForm from './_Form'
    
    export default {
        mixins: [MessagesMixin, DBOperationsMixin],
        props: ['data'],
        components: {
            entityForm,
        },
        data() {
          return {
                form: null,
            }
        },
    }
</script>