<template>
    <footer class="main-footer">
        <!-- Default to the left -->
        <strong>
            Copyright © {{ $page.props.app.year }}
            <inertia-link :href="route('front')">
                {{ this.$page.props.config.app.name }}
            </inertia-link>
            .
        </strong>
        All rights reserved.
    </footer>
</template>
