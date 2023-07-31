<template>
    <div class="">
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
                <b-form-textarea id="description" placeholder="Enter video description" rows="2" max-rows="6" v-model="form.description" :class="[errors.description ? 'is-invalid' : '']">
                </b-form-textarea>
                <span v-if="errors.description" :class="['label text-danger small']">{{ errors.description }}</span>
            </b-col>
        </b-row>

        <b-row class="form-group">
            <b-col sm="3">
                <label for="provider_id">Provider</label>
            </b-col>
            <b-col sm="9">
                <b-form-radio-group
                    v-model="form.provider_id"
                    :options="providerOptions"
                    value-field="id"
                    text-field="name"
                ></b-form-radio-group>
                <span v-if="errors.provider_id" :class="['label text-danger small']">{{ errors.provider_id }}</span>
            </b-col>
        </b-row>

        <b-row class="form-group">
            <b-col sm="3">
                <label>Video</label>
            </b-col>
            <b-col sm="9">
                <div class="p-3 rounded border bg-white">                    
                    <div class="">
                        <div class="form-group">
                            <label>Cover Image</label>
                            <field-image ref="coverImage" :data="data"/>
                        </div>
                        <div v-show="form.provider_id != 1" class="form-group">
                            <label>{{ selectedProvider }} URL</label>
                            <b-form-input 
                                id="provider_url" 
                                placeholder="Enter Provider URL" 
                                v-model="form.provider_url" 
                                :class="[errors.provider_url ? 'is-invalid' : '']">
                            </b-form-input>
                            <span v-if="errors.provider_url" :class="['label text-danger small']">{{ errors.provider_url }}</span>
                        </div>
                        <div v-show="form.provider_id == 1" class="form-group">
                            <label>Video file</label>
                            <FieldVideoFile :data="data"/>
                        </div>
                    </div>
                </div>
            </b-col>
        </b-row>

    </div>
</template>
<script>
    import MessagesMixin from '@/Mixins/Messages'
    import DBOperationsMixin from '@/Mixins/DBOperations'
    import bootstrapTableMixin from '@/Mixins/Plugins/BootstrapTable'
    import FieldImage from '@/Pages/Core/Field/fieldImage'
    import FieldVideoFile from '@/Pages/Core/Field/fieldVideoFile'

    export default {
        mixins: [MessagesMixin, DBOperationsMixin, bootstrapTableMixin],
        props: ['data'],
        data() {
          return {
                form: this.$inertia.form({
                    name: this.data ? this.data.name : '',
                    provider_id: this.data && this.data.provider_id ? this.data.provider_id : 1,
                    provider_url: this.data ? this.data.provider_url : '',
                    description: this.data ? this.data.description : '',
                    image: null,
                    image_id: null,
                    video: null,
                    video_id: null,
                }),
                providerOptions: this.data.providers,
                // providerImage: null,
            }
        },
        computed: {
            selectedProvider() {
                return this.providerOptions.find(obj => {
                    return obj.id === this.form.provider_id
                }).name
            },
        },
        components: {
            FieldImage,
            FieldVideoFile,
        },
        methods: {
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