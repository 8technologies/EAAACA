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
                <label for="model_id">Model</label>
            </b-col>
            <b-col sm="9">
                <select2 id="model_id" :name="route('dashboard.models.index')" :options="ajaxOptions" :settings="{ placeholder: 'Choose a Model/Entity', ajax: ajax, templateResult: formatState, templateSelection: formatState, allowClear: true }" v-model="form.model_id" :class="[errors.model_id ? 'is-invalid' : '']">
                </select2>
                <span v-if="errors.model_id" :class="['label text-danger small']">{{ errors.model_id }}</span>
            </b-col>
        </b-row>

        <b-row class="form-group">
            <b-col sm="3">
                <label for="description">Description</label>
            </b-col>
            <b-col sm="9">
                <b-form-textarea id="description" placeholder="Enter Description" rows="4" max-rows="6" v-model="form.description" :class="[errors.description ? 'is-invalid' : '']">
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
    import Select2Mixin from '@/Mixins/Plugins/Select2'

    export default {
        mixins: [MessagesMixin, DBOperationsMixin, bootstrapTableMixin, Select2Mixin],
        props: ['data'],
        data() {
          return {
                form: this.$inertia.form({
                    name: this.data.name ? this.data.name : '',
                    description: this.data.description ? this.data.description : '',
                    model_id: this.data.model_id ? this.data.model_id : '',
                }),
            }
        },
        mounted() {
            // Select: model_id
            if (this.data.model_id != null || this.data.model) {
                var selectElement = $('#model_id')
                var data = {
                    id: this.data.model_id ? this.data.model_id : this.data.model.id,
                    text: !!this.data.model ? this.data.model.name : '',
                    // thumbnail: !!this.data.head_of_department ? this.data.head_of_department.thumbnail : '',
                };
                var option = new Option(data.text, data.id, true, true)
                // option.dataset.thumbnail = data.thumbnail
                selectElement.append(option).trigger('change');
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