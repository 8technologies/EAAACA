<template>
    <div class="entity-modal-delete-wrapper" id="entity-modal-delete-wrapper-id">
        <b-modal :id="modalAttributes.uuid + '-modal-delete'" size="md" :title="modalAttributes.title"
            v-model="show"
        	:body-bg-variant="bodyBgVariant" 
        	:body-text-variant="bodyTextVariant" 
        	:header-bg-variant="headerBgVariant" 
        	:header-text-variant="headerTextVariant" 
        	centered
            :no-enforce-focus="true"
            hide-footer>

            <slot>
                <div class="py-3 text-center text-danger">
                    <i class="fa fa-spinner fa-spin fa-fw fa-2x"></i>
                </div>
            </slot>

        </b-modal>
    </div>
</template>
<script>
    export default {
        props: {
            modalAttributes: Object,
        },
        data() {
            return {
                show: false,
                headerBgVariant: 'danger',
                headerTextVariant: 'light',
                bodyBgVariant: 'light',
                bodyTextVariant: 'dark',
            }
        }
    }
</script>