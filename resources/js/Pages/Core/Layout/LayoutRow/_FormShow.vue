<template>
    <div :class="attributeClass" :style="_styles" class="row" :id="'row-' + data.id">
        <layout-column v-for="item in data.layout_columns" :key="'column' + item.id" :data="item">
        </layout-column>
    </div>
</template>

<script>
    import JarallaxMixins from '@/Mixins/Plugins/Jarallax'
    import DynamicStyles from '@/Mixins/DynamicStyles'

    import layoutColumn from '@/Pages/Core/Layout/LayoutColumn/_FormShow'

    export default {
        mixins: [DynamicStyles, JarallaxMixins],
        props: [
            'data',
        ],
        components: {
            layoutColumn
        },
    }
</script>
