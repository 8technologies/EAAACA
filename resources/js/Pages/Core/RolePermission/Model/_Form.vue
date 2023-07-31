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
                <label>Description</label>
            </b-col>
            <b-col sm="9">
                <b-form-textarea id="description" rows="3" max-rows="5" v-model="form.description" :class="[errors.description ? 'is-invalid' : '']">
                </b-form-textarea>
                <span v-if="errors.description" :class="['label text-danger small']">{{ errors.description }}</span>
            </b-col>
        </b-row>

        <b-row class="form-group">
            <b-col sm="3">
                <label for="model_permissions">Enabled default permissions</label>
            </b-col>
            <b-col sm="9">
                <div class="form-group">
                    <div class="">
                        <b-form-group
                            v-slot="{ ariaDescribedby }"
                            >
                            <b-form-checkbox
                                v-for="option in permissionTypeOptions"
                                v-model="form.permissions"
                                :key="option.name"
                                :value="option.id"
                                :aria-describedby="ariaDescribedby"
                            >
                            {{ option.name }}
                            </b-form-checkbox>
                        </b-form-group>
                    </div>
                </div>
                <span v-if="errors.permissions" :class="['label text-danger small']">{{ errors.permissions }}</span>
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
                    description: this.data.description,
                    permissions: this.data.permissions ? this.data.permissions.map(item => {return item.id}) : [],
                }),
                permissionTypeOptions: this.data.permission_types,
            }
        },
        // created() {
        //     console.log( this.data )
        // },
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