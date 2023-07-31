<template>
    <div :class="attributeClass" :style="_styles" v-bind="dataJarallaxVideoAttribute">
        <template v-for="item in data.fields">
            <div class="container" v-if="item.model_name === 'LayoutRow'" :key="item.uuid">
                <layoutRow :data="item">
                </layoutRow>
            </div>

            <fieldBlock v-else-if="item.model_name === 'FieldBlock'" :key="item.uuid" :data="item">
            </fieldBlock>

            <div v-else :key="item.uuid">
                Not preview
            </div>
        </template>
    </div>
</template>

<script>
    import JarallaxMixins from '@/Mixins/Plugins/Jarallax'
    import DynamicStyles from '@/Mixins/DynamicStyles'

    import layoutRow from '@/Pages/Core/Layout/LayoutRow/_FormShow'
    import fieldBlock from '@/Pages/Core/Field/FieldBlock/_FormShow'

    export default {
        mixins: [DynamicStyles, JarallaxMixins],
        props: [
            'data',
        ],
        components: {
            layoutRow,
            fieldBlock,
        },
    }
</script>
