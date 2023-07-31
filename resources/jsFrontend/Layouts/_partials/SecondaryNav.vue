<template>
    <div class="secondary-nav-wrapper">
        <div v-if="checkActivePaths(['sectors/aviation-consulting'])" class="container d-flex">
            <div class="identifier-text">
                Aviation Services
            </div>
            <ul class="nav secondary-nav">
                <li class="nav-item">
                    <a class="nav-link inertia-link" :href="'/sectors/aviation-consulting/'">
                        Overview
                    </a>
                </li>
                <li class="nav-item">
                    <a class="active nav-link inertia-link" :href="'/sectors/aviation-consulting/products/'">
                        Case studies
                    </a>
                </li>
            </ul>
        </div>

        <div v-if="checkActivePaths(['sectors/medical'])" class="container d-flex">
            <div class="identifier-text">
                Medical
            </div>
            <ul class="nav secondary-nav">
                <li class="nav-item">
                    <a class="nav-link inertia-link" :href="'/sectors/medical/'">
                        Overview
                    </a>
                </li>
                <li class="nav-item">
                    <a class="active nav-link inertia-link" :href="'/sectors/medical/products/'">
                        Products
                    </a>
                </li>
            </ul>
        </div>

        <div v-if="checkActivePaths(['sectors/agro-business'])" class="container d-flex">
            <div class="identifier-text">
                Agro Business
            </div>
            <ul class="nav secondary-nav">
                <li class="nav-item">
                    <a class="nav-link inertia-link" :href="'/sectors/agro-business/'">
                        Overview
                    </a>
                </li>
                <li class="nav-item">
                    <a class="active nav-link inertia-link" :href="'/sectors/agro-business/products/'">
                        Services
                    </a>
                </li>
            </ul>
        </div>

        <div v-if="checkActivePaths(['sectors/machinery-engineering'])" class="container d-flex">
            <div class="identifier-text">
                Machinery & Engineering
            </div>
            <ul class="nav secondary-nav">
                <li class="nav-item">
                    <a class="nav-link inertia-link" :href="'/sectors/machinery-engineering/'">
                        Overview
                    </a>
                </li>
                <li class="nav-item">
                    <a class="active nav-link inertia-link" :href="'/sectors/machinery-engineering/products/'">
                        Services
                    </a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        methods: {
            checkActivePath(path) {
                if (this.$page.url.includes(path)) {
                    return true
                }
                return false
            },
            checkActivePaths(paths) {
                for (var i = 0; i < paths.length; i++) {
                    if (this.$page.url.includes(paths[i])) {
                        return true
                    }
                }
                return false
            },
        },
    }
</script>