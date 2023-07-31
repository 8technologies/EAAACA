<template>
    <div>
        <b-row class="form-group">
            <b-col sm="3">
                <label>queue</label>
            </b-col>
            <b-col sm="9">
                <b-form-input id="queue" placeholder="Enter queue" v-model="form.queue" :class="[errors.queue ? 'is-invalid' : '']">
                </b-form-input>
                <span v-if="errors.queue" :class="['label text-danger small']">{{ errors.queue }}</span>
            </b-col>
        </b-row>

        <b-row class="form-group">
            <b-col sm="3">
                <label>Payload</label>
            </b-col>
            <b-col sm="9">
                <b-form-textarea id="payload" rows="4" max-rows="6" v-model="form.payload" :class="[errors.payload ? 'is-invalid' : '']">
                </b-form-textarea>
                <span v-if="errors.payload" :class="['label text-danger small']">{{ errors.payload }}</span>
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
                    queue: this.data.queue,
                    payload: this.data.payload,
                }),
                returnJson: true,
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