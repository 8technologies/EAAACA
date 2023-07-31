<template>
    <div class="entity-modal-wrapper" id="entity-modal-wrapper-id">
        <b-modal :id="modalAttributes.uuid + '-modal'" size="lg" :title="modalAttributes.title"
            header-bg-variant="dark" 
            header-text-variant="white" 
            centered 
            scrollable 
            no-close-on-backdrop 
            :no-enforce-focus="true"
            hide-footer>

            <slot>
                <div class="py-3 text-center">
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
    }
</script>