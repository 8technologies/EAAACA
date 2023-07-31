<template>
    <div class="">
        <b-alert v-if="$page.props.status" show variant="success">
            {{ this.$page.props.status }}
        </b-alert>

        <b-alert v-if="$page.props.flash.success" show variant="success">
            {{ this.$page.props.flash.success }}
        </b-alert>

        <b-alert v-if="$page.props.flash.message" show variant="info">
            {{ this.$page.props.flash.message }}
        </b-alert>

        <b-alert v-if="$page.props.flash.error && !hasErrors" show variant="danger">
            {{ this.$page.props.flash.error }}
        </b-alert>

        <b-alert v-if="hasErrors" show variant="danger">
            <strong class="alert-heading">Something went wrong.</strong>
            <hr class="mt-1">
            <ul class="my-0 pl-4">
                <li v-for="(error, key) in errors" :key="key">{{ error }}</li>
            </ul>
        </b-alert>
    </div>
</template>

<script>
    export default {
        computed: {
            errors() {
                return this.$page.props.errors
            },

            hasErrors() {
                return Object.keys(this.errors).length > 0;
            },
        }
    }
</script>
