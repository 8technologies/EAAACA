<template>
    <div>
        <div class="">
            <b-row class="form-group">
                <b-col sm="3">
                    <label>Image</label>
                </b-col>
                <b-col sm="9">
                    <FieldImage :data="data"></FieldImage>
                </b-col>
            </b-row>

            <b-row class="form-group">
                <b-col sm="3">
                    <label for="name">Name</label>
                </b-col>
                <b-col sm="9">
                    <b-form-input id="name" placeholder="" required="" autocomplete="name" v-model="form.name" :class="[errors.name ? 'is-invalid' : '']">
                    </b-form-input>
                    <span v-if="errors.name" :class="['label text-danger small']">{{ errors.name }}</span>
                </b-col>
            </b-row>

            <b-row class="form-group">
                <b-col sm="3">
                    <label for="email">Email</label>
                </b-col>
                <b-col sm="9">
                    <b-form-input id="email" placeholder="" :disabled="data.email ? true : false" v-model="data.email">
                    </b-form-input>
                </b-col>
            </b-row>

            <b-row class="form-group">
                <b-col sm="3">
                    <label for="organization_id">Organization</label>
                </b-col>
                <b-col sm="9">
                    <div class="border rounded bg-light p-2">
                        {{ data && data.organization ? data.organization.name : '' }}, {{ data && data.organization && data.organization.member_state ? data.organization.member_state.name : '' }}
                    </div>
                    <span v-if="errors.organization_id" :class="['label text-danger small']">{{ errors.organization_id }}</span>
                </b-col>
            </b-row>

        </div>

    </div>
</template>
<script>
    import MessagesMixin from '@/Mixins/Messages'
    import DBOperationsMixin from '@/Mixins/DBOperations'
    import bootstrapTableMixin from '@/Mixins/Plugins/BootstrapTable'
    import FieldImage from '@/Pages/Core/Field/fieldImage'
    import Select2Mixin from '@/Mixins/Plugins/Select2'

    export default {
        mixins: [MessagesMixin, DBOperationsMixin, bootstrapTableMixin, Select2Mixin],
        props: ['data'],
        data() {
            return {
                form: this.$inertia.form({
                    name: this.data.name ? this.data.name : '',
                    email: this.data.email ? this.data.email : '',
                    image: null,
                    image_id: null,
                }),
            }
        },
        components: {
            FieldImage,
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
