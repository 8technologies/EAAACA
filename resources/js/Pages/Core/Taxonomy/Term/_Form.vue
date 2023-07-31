<template>
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <label for="name">Name</label>
                <b-form-input id="name" placeholder="Enter name" v-model="form.name" :class="[errors.name ? 'is-invalid' : '']">
                </b-form-input>
                <span v-if="errors.name" :class="['label text-danger small']">{{ errors.name }}</span>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <ckeditor :editor="editor" 
                    v-model="form.description" 
                    :config="editorConfig" 
                    :class="[errors.description ? 'is-invalid' : '']"></ckeditor>
                <span v-if="errors.description" :class="['label text-danger small']">{{ errors.description }}</span>
            </div>

            <div class="form-group">
                <label for="taxonomy_type_id">Taxonomy type</label>
                <select2 id="taxonomy_type_id" 
                    :name="route('dashboard.taxonomy_types.index')" 
                    :options="ajaxOptions" 
                    :settings="{ placeholder: 'Choose a Taxonomy type', ajax: ajax, templateResult: formatState, templateSelection: formatState, allowClear: true }" 
                    v-model="form.taxonomy_type_id" 
                    :class="[errors.taxonomy_type_id ? 'is-invalid' : '']">
                </select2>
                <span v-if="errors.taxonomy_type_id" :class="['label text-danger small']">{{ errors.taxonomy_type_id }}</span>
            </div>

        <div class="form-group">
            <label for="parent_id">Parent</label>
            <select2 id="parent_id" :name="route('dashboard.taxonomy_terms.index')" :options="ajaxOptions" :settings="{ placeholder: 'Choose a Parent term', ajax: ajax, templateResult: formatState, templateSelection: formatState, allowClear: true }" v-model="form.parent_id" :class="[errors.parent_id ? 'is-invalid' : '']">
            </select2>
            <span v-if="errors.parent_id" :class="['label text-danger small']">{{ errors.parent_id }}</span>
        </div>

        </div>
        <div class="col-md-4">
            <content-sidebar :data="data"/>
        </div>
    </div>
</template>
<script>
    import MessagesMixin from '@/Mixins/Messages'
    import DBOperationsMixin from '@/Mixins/DBOperations'
    import EntityComponentsMixin from '@/Mixins/EntityComponents'
    import Select2Mixin from '@/Mixins/Plugins/Select2'
    import ContentSidebar from '@/Pages/Core/Content/_Partials/Sidebar'

    export default {
        mixins: [MessagesMixin, DBOperationsMixin, EntityComponentsMixin, Select2Mixin],
        props: ['data'],
        components: {
            ContentSidebar,
        },
        data() {
          return {
                form: this.$inertia.form({
                    name: this.data.name,
                    description: this.data.description,
                    taxonomy_type_id: this.data.taxonomy_type_id ? this.data.taxonomy_type_id : '',
                    parent_id: this.data.parent_id ? this.data.parent_id : '',

                    user_id: this.data && this.data.user_id ? this.data.user_id : '',
                    slug: this.data && this.data.slug ? this.data.slug : '',
                    created_at: this.data.created_at ? this.data.created_at : '',
                }),
            }
        },
        mounted() {
            // Select: taxonomy_type_id
            if (this.data.taxonomy_type_id != null || this.data.taxonomy_type) {
                var selectElement = $('#taxonomy_type_id')
                var data = {
                    id: this.data.taxonomy_type_id ? this.data.taxonomy_type_id : this.data.taxonomy_type.id,
                    text: !!this.data.taxonomy_type ? this.data.taxonomy_type.name : '',
                    // thumbnail: !!this.data.head_of_department ? this.data.head_of_department.thumbnail : '',
                };
                var option = new Option(data.text, data.id, true, true)
                // option.dataset.thumbnail = data.thumbnail
                selectElement.append(option).trigger('change');
            }

            // Select: parent_id
            if (this.data.parent_id != null || this.data.parent_id) {
                var selectElement = $('#parent_id')
                var data = {
                    id: this.data.parent_id ? this.data.parent_id : this.data.parent.id,
                    text: !!this.data.parent ? this.data.parent.name : '',
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
                    // console.log( newVal )
                    this.$emit('updateParentFormValues', newVal)
                }
            }
        },
    }
</script>