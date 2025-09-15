<template>
  <div class="hightlighes-title-wrap mb-25 fadeinup wow">
    <h2 class="page-title mb-2">Property Hightlights</h2>
    <h5 class="house-sell">House for sale</h5>
  </div>
  <div class="fadeinup wow mb-40">
    <p v-html="property_detail"></p>
  </div>
</template>

<script>
export default {
    props: {
        property_detail: {
            type: Object,
            required: true
        }
    }
};
</script>

<style lang="scss" scoped></style>
