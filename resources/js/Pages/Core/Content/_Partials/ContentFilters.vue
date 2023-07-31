<template>

    <b-dropdown id="dropdown-filters" variant="outline-secondary" ref="dropdown" class="dropdown-filters" no-caret>
        <template #button-content>
            <i class="fa fa-filter"></i>
        </template>
        <b-dropdown-form>
        <div class="row">
            <div class="col-md-3 form-group">
                <label>Author</label>
                <select2 id="user" @change="$parent.refreshBootstrapTable()" :name="route('dashboard.users.index')" :settings="{ placeholder: 'Author', ajax: ajax, templateResult: formatState, templateSelection: formatState }">
                </select2>
            </div>
        </div>
        </b-dropdown-form>
        <b-dropdown-divider></b-dropdown-divider>
        <div class="px-2">
            <b-link href="#" class="btn btn-default clear-Filters w-100 d-block">
                Reset Filters
            </b-link>
        </div>
    </b-dropdown>

</template>

<script>
    import Select2Mixin from '@/Mixins/Plugins/Select2'

    export default {
        mixins: [Select2Mixin],
        props: ['data'],
        data() {
            return {

            }
        },

    }
</script>
