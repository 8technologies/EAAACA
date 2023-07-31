<template>
    <nav v-if="data.links.length > 3" aria-label="...">
        <ul class="pagination">
            <template v-for="(item, key) in data.links">
                <li v-if="item.url" v-bind:key="'pagination-'+key" :class="!item.active ? 'page-item' : 'page-item active'">
                    <a v-if="!item.active" class="page-link inertia-link" :href="item.url" v-html="item.label">
                        {{ item.label }}
                    </a>
                    <span v-else class="page-link">
                        {{ item.label }} <span class="sr-only">(current)</span>
                    </span>
                </li>
                <template v-else>
                    <li v-bind:key="'pagination-'+key" class="page-item disabled">
                        <span class="page-link" v-html="item.label">
                            {{ item.label }} <span class="sr-only">(current)</span>
                        </span>
                    </li>
                </template>
            </template>
        </ul>
    </nav>
</template>

<script>
    export default {
        props: ['data'],
    }
</script>
