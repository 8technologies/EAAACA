<template>
    <div>
        <b-form @submit="create" :action="route('dashboard.services.store')" method="post">

            <div class="">
                <p>Please fill in all required fields and click Continue</p>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <b-form-input id="title" placeholder="Enter Title" required="" v-model="form.title" :class="[errors.title ? 'is-invalid' : '']">
                        </b-form-input>
                        <span v-if="errors.title" :class="['label text-danger small']">{{ errors.title }}</span>
                    </div>
                </div>
            </div>
            
            <div class="row no-gutters justify-content-end mt-3 form-btns-wrapper">
                <b-button class="" id="submit" type="submit" variant="primary">
                    <span class="" role="status" aria-hidden="true"></span>
                    Continue
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
    import ContentSidebar from './../_Partials/Sidebar'
    
    export default {
        mixins: [MessagesMixin, DBOperationsMixin, bootstrapTableMixin, Select2Mixin],
        props: ['data'],

        components: {
            ContentSidebar,
        },
        
        data() {
          return {
                form: this.$inertia.form({
                    title: this.data && this.data.title ? this.data.title : '',
                    body: this.data && this.data.body ? this.data.body : '',
                    user_id: this.data && this.data.user_id ? this.data.user_id : this.$page.props.user.id,
                    status_id: this.data && this.data.status_id ? this.data.status_id : '',
                    slug: this.data && this.data.slug ? this.data.slug : '',
                }),
            }
        },
        mounted() {
            var data = {
                id: 1,
                text: this.$page.props.user.name,
                // icon: 'fa fa-star',
                thumbnail: this.$page.props.user.thumbnail
            };

            var authorSelect = $('#user_id')
            var option = new Option(data.text, data.id, true, true)
            // SET CUSTOM DATA
            option.dataset.thumbnail = data.thumbnail
            authorSelect.append(option).trigger('change');
        }
    }
</script>