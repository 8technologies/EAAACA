<template>
    <div :class="data.width ? data.width : 'col-md-12'" :id="'column-' + data.id">
    <div :class="'field-wrapper ' + attributeClass" :style="_styles">
        <template v-for="item in data.fields">
            <fieldTitle v-if="item.model_name === 'FieldTitle'" :key="item.uuid" :data="item">
            </fieldTitle>

            <fieldText v-else-if="item.model_name === 'FieldText'" :key="item.uuid" :data="item">
            </fieldText>

            <fieldLink v-else-if="item.model_name === 'FieldLink'" :key="item.uuid" :data="item">
            </fieldLink>

            <fieldImage v-else-if="item.model_name === 'FieldImage'" :key="item.uuid" :data="item">
            </fieldImage>

            <fieldHtml v-else-if="item.model_name === 'FieldHtml'" :key="item.uuid" :data="item">
            </fieldHtml>

            <fieldBlock v-else-if="item.model_name === 'FieldBlock'" :key="item.uuid" :data="item">
            </fieldBlock>

            <div v-else :key="item.uuid">
                Not preview
            </div>
        </template>
    </div>
    </div>
</template>

<script>
    import JarallaxMixins from '@/Mixins/Plugins/Jarallax'
    import DynamicStyles from '@/Mixins/DynamicStyles'

    import fieldTitle from '@/Pages/Core/Field/FieldTitle/_FormShow'
    import fieldText from '@/Pages/Core/Field/FieldText/_FormShow'
    import fieldLink from '@/Pages/Core/Field/FieldLink/_FormShow'
    import fieldImage from '@/Pages/Core/Field/FieldImage/_FormShow'
    import fieldHtml from '@/Pages/Core/Field/FieldHtml/_FormShow'
    import fieldBlock from '@/Pages/Core/Field/FieldBlock/_FormShow'

    export default {
        mixins: [DynamicStyles, JarallaxMixins],
        props: [
            'data',
        ],
        components: {
            fieldTitle,
            fieldText,
            fieldLink,
            fieldImage,
            fieldHtml,
            fieldBlock,
        },
    }
</script>
