<template>
    <div>
        <b-row class="form-group">
            <b-col sm="3">
                <label>Name</label>
            </b-col>
            <b-col sm="9">
                <b-form-input id="name" placeholder="Enter name" v-model="form.name" :class="[errors.name ? 'is-invalid' : '']">
                </b-form-input>
                <span v-if="errors.name" :class="['label text-danger small']">{{ errors.name }}</span>
            </b-col>
        </b-row>

        <b-row class="form-group">
            <b-col sm="3">
                <label>Sort Position</label>
            </b-col>
            <b-col sm="9">
                <b-form-input id="position" placeholder="Enter position" v-model="form.position" :class="[errors.position ? 'is-invalid' : '']">
                </b-form-input>
                <span v-if="errors.position" :class="['label text-danger small']">{{ errors.position }}</span>
            </b-col>
        </b-row>

        <b-row class="form-group">
            <b-col sm="3">
                <label>Description</label>
            </b-col>
            <b-col sm="9">
                <b-form-textarea id="description" rows="4" max-rows="6" v-model="form.description" :class="[errors.description ? 'is-invalid' : '']">
                </b-form-textarea>
                <span v-if="errors.description" :class="['label text-danger small']">{{ errors.description }}</span>
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
                    name: this.data.name,
                    position: this.data.position,
                    description: this.data.description,
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