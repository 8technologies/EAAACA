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
                <label for="permission">Permissions</label>
            </b-col>
            <b-col sm="9">
                <div class="form-group" :key="'permission' + index" v-for="(groupedOption, index) in groupedOptions">
                    <p class="mb-1">{{ groupedOption[0].model.description }} ({{ groupedOption[0].model.name }})</p>
                    <div class="">
                        <b-form-group
                            v-slot="{ ariaDescribedby }"
                            >
                            <b-form-checkbox
                                v-for="option in groupedOption"
                                v-model="form.permission"
                                :key="option.name"
                                :value="option.id"
                                :aria-describedby="ariaDescribedby"
                            >
                            {{ option.name }}
                            </b-form-checkbox>
                        </b-form-group>
                    </div>
                </div>
                <span v-if="errors.permission" :class="['label text-danger small']">{{ errors.permission }}</span>
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
                    name: this.data.name ? this.data.name : '',
                    permission: this.data.permissions ? this.data.permissions.map(item => {return item.id}) : [],
                }),
                groupedOptions: _.mapValues(
                    _.groupBy(this.data.model_permissions, 'model_id'), items => items.map(item => item)
                ),
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