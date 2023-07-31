<template>
    <b-nav tabs class="mb-4">
        <b-nav-item :href="data.entity_links.url" :class="'inertia-link'" :active="checkIfCurrentUrl(data.entity_links.url) || checkIfCurrentUrl(data.entity_links.url_view)">
            View
        </b-nav-item>
        <b-nav-item :href="data.entity_links.url_edit" :class="'inertia-link'" :active="checkIfCurrentUrl(data.entity_links.url_edit)">
            Edit
        </b-nav-item>
        <li class="nav-item">
            <b-link :href="data.entity_links.url_view" class="nav-link text-danger" v-on:click="showEntityDelete($event)">
                Delete
            </b-link>
        </li>
    </b-nav>
</template>

<script>
    import FunctionsMixin from '@/Mixins/Functions'

    export default {
        mixins: [FunctionsMixin],
        props: [
            'data',
        ],
        methods: {
            showEntityDelete(event) {
                var vueInstance = this.getParentWithMethod('showEntityDelete')
                vueInstance.showEntityDelete(event)
            },
        },
    }
</script>

