<template>
    <div>
        <b-form @submit="update" :action="route('dashboard.media.files.update', data.id)" method="PUT">

            <div class="">
                <p></p>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="bg-light border rounded p-3 h-100">
                        <h6 class="font-weight-bold">#File Preview</h6>
                        <Preview :data="data" class="display-4"></Preview>
                        <table class="table table-sm table-borderless small">
                            <tbody>
                                <tr>
                                    <th width="60px">Title: </th>
                                    <td>
                                        {{ data.name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Desc: </th>
                                    <td>
                                        {{ data.file_description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Owner: </th>
                                    <td>
                                        {{ data.user.name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Usage: </th>
                                    <td>
                                        {{ data.file_usage }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Size: </th>
                                    <td>
                                        {{ data.file_size }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Mime: </th>
                                    <td>
                                        {{ data.mime_type }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-md-8">
                    <b-row class="form-group">
                        <b-col sm="12">
                            <label for="file_name">File Name</label>
                            <b-form-input id="file_name" placeholder="Enter File Name" disabled v-model="data.file_name" :class="[errors.file_name ? 'is-invalid' : '']">
                            </b-form-input>
                            <span v-if="errors.file_name" :class="['label text-danger small']">{{ errors.file_name }}</span>
                        </b-col>
                    </b-row>
                    <b-row class="form-group">
                        <b-col sm="12">
                            <label for="name">Title / Name</label>
                            <b-form-input id="name" placeholder="Enter Name" v-model="form.name" :class="[errors.name ? 'is-invalid' : '']">
                            </b-form-input>
                            <span v-if="errors.name" :class="['label text-danger small']">{{ errors.name }}</span>
                        </b-col>
                    </b-row>
                    <b-row class="form-group">
                        <b-col sm="12">
                            <label for="file_description">File Description</label>
                            <b-form-textarea id="file_description" placeholder="Enter Description" rows="4" max-rows="6" v-model="form.file_description" :class="[errors.file_description ? 'is-invalid' : '']">
                            </b-form-textarea>
                            <span v-if="errors.file_description" :class="['label text-danger small']">{{ errors.file_description }}</span>
                        </b-col>
                    </b-row>
                    <b-row class="form-group mb-0">
                        <b-col sm="12">
                            <label for="user_id">Owner</label>
                            <select2 id="user_id" :name="route('dashboard.users.index')" :options="ajaxOptions" :settings="{ placeholder: 'Select Owner', ajax: ajax, templateResult: formatState, templateSelection: formatState, allowClear: true }" v-model="form.user_id" :class="[errors.user_id ? 'is-invalid' : '']">
                            </select2>
                            <span v-if="errors.user_id" :class="['label text-danger small']">{{ errors.user_id }}</span>
                        </b-col>
                    </b-row>
                </div>
            </div>

            <div class="row no-gutters justify-content-end mt-3 form-btns-wrapper">
                <b-button class="" id="submit" type="submit" variant="primary">
                    <span class="" role="status" aria-hidden="true"></span>
                    Update
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
    import Preview from './_Preview'

    export default {
        mixins: [MessagesMixin, DBOperationsMixin, bootstrapTableMixin, Select2Mixin],
        props: ['data'],
        components: {
            Preview,
        },
        data() {
          return {
                form: this.$inertia.form({
                    name: this.data.name,
                    file_description: this.data.file_description,
                    user_id: this.data.description,
                }),
            }
        },

        mounted() {
            var data = {
                id: this.data.user_id,
                text: !!this.data.user ? this.data.user.name : '',
                // icon: '',
                thumbnail: !!this.data.user ? this.data.user.thumbnail : '',
            };

            if (data.id != null) {
                var selectElement = $('#user_id')
                var option = new Option(data.text, data.id, true, true)
                // SET CUSTOM DATA
                option.dataset.icon = data.icon
                option.dataset.thumbnail = data.thumbnail
                selectElement.append(option).trigger('change');
            }
        },

    }
</script>