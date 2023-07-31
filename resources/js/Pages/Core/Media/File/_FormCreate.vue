<template>
    <div>
        <b-form @submit="create" :action="route('dashboard.media.files.store')" method="post">

            <div class="">
                <b-row class="form-group">
                    <b-col sm="3">
                        <label for="name">File</label>
                    </b-col>
                    <b-col sm="9">
                        <!-- Styled -->
                        <b-form-file
                            id="file"
                            v-model="form.file"
                            :class="[errors.file ? 'is-invalid' : '']"
                            placeholder="Choose a file or drop it here..."
                            drop-placeholder="Drop file here...">
                        </b-form-file>
                        <span v-if="errors.file" :class="['label text-danger small']">{{ errors.file }}</span>
                    </b-col>
                </b-row>
                <b-row class="form-group">
                    <b-col sm="3">
                        <label for="name">Title / Name</label>
                    </b-col>
                    <b-col sm="9">
                        <b-form-input id="name" placeholder="Enter Name" v-model="form.name" :class="[errors.name ? 'is-invalid' : '']">
                        </b-form-input>
                        <span v-if="errors.name" :class="['label text-danger small']">{{ errors.name }}</span>
                    </b-col>
                </b-row>
                <b-row class="form-group">
                    <b-col sm="3">
                        <label for="file_description">File Description</label>
                    </b-col>
                    <b-col sm="9">
                        <b-form-textarea id="file_description" placeholder="Enter Description" rows="4" max-rows="6" v-model="form.file_description" :class="[errors.file_description ? 'is-invalid' : '']">
                        </b-form-textarea>
                        <span v-if="errors.file_description" :class="['label text-danger small']">{{ errors.file_description }}</span>
                    </b-col>
                </b-row>
                <b-row class="form-group mb-0">
                    <b-col sm="3">
                        <label for="user_id">Owner</label>
                    </b-col>
                    <b-col sm="9">
                        <select2 id="user_id" :name="route('dashboard.users.index')" :options="ajaxOptions" :settings="{ placeholder: 'Select Owner', ajax: ajax, templateResult: formatState, templateSelection: formatState, allowClear: true }" v-model="form.user_id" :class="[errors.user_id ? 'is-invalid' : '']">
                        </select2>
                        <span v-if="errors.user_id" :class="['label text-danger small']">{{ errors.user_id }}</span>
                    </b-col>
                </b-row>
            </div>
            
            <div class="row no-gutters justify-content-end mt-3 form-btns-wrapper">
                <b-button class="" id="submit" type="submit" variant="primary">
                    <span class="" role="status" aria-hidden="true"></span>
                    Submit
                </b-button>
            </div>

        </b-form>
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
                    file: [],
                    name: '',
                    file_description: '',
                    user_id: '',
                }),
            }
        },
    }
</script>