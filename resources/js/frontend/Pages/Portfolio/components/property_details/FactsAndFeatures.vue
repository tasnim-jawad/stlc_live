<template>
  <div class="hightlighes-title-wrap mb-25 fadeinup wow mt-50">
    <h2 class="page-title mb-2">Facts And Features</h2>
  </div>
  <ul class="property-grid-list fadeinup wow">
    <li v-for="(fact, index) in facts_and_features" :key="index">
      <div class="property-grid-list-icon">
        <!-- <img src="assets/img/icon/property-single-icon1-1.svg" alt="img" /> -->
        <i :class="fact?.icon"></i>
      </div>
      <div class="property-grid-list-details">
        <h4 class="property-grid-list-title">{{ fact?.title }}</h4>
        <p class="property-grid-list-text">{{ fact?.description }}</p>
      </div>
    </li>
  </ul>
</template>

<script>
export default {
    props: {
        facts_and_features: {
            type: Array,
            required: true
        }
    }
};
</script>

<style lang="scss" scoped></style>
