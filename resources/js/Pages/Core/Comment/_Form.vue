<template>
    <div>
        <b-row class="form-group">
            <b-col sm="12">
                <b-form-textarea id="body" rows="4" max-rows="6" v-model="form.body" :class="[errors.body ? 'is-invalid' : '']">
                </b-form-textarea>
                <span v-if="errors.body" :class="['label text-danger small']">{{ errors.body }}</span>
            </b-col>
        </b-row>

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
                    body: this.data.body,
                }),
            }
        },

        watch: {
            form: {
                deep: true,
                immediate: true,
                handler: function(newVal, oldVal) {
                    this.$emit('updateParentFormValues', newVal)
                }
            }
        },
    }
</script>