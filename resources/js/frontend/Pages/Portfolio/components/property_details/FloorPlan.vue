<template>
  <div
    class="row gy-30 align-items-center justify-content-center justify-content-between fadeinup wow mb-40 mt-40"
  >
    <div class="col-lg-auto">
      <h3 class="page-title mb-0">Floor Plan</h3>
    </div>
    <div class="col-lg-auto">
      <ul class="nav nav-tabs property-tab mb-0" role="tablist">
        <li
          v-for="(floor, index) in floor_plan"
          :key="index"
          class="nav-item"
          role="presentation"
        >
          <button
            :class="['nav-link', { active: index === 0 }]"
            :id="`floor-tab${index + 1}`"
            data-bs-toggle="tab"
            :data-bs-target="`#floor-tab${index + 1}-pane`"
            type="button"
            role="tab"
            :aria-controls="`floor-tab${index + 1}-pane`"
            :aria-selected="index === 0 ? 'true' : 'false'"
          >
            {{ floor.floor_number }}
          </button>
        </li>
      </ul>
    </div>
  </div>
  <div class="tab-content">
    <div
      v-for="(floor, index) in floor_plan"
      :key="index"
      :class="['tab-pane', 'fade', { 'show active': index === 0 }]"
      :id="`floor-tab${index + 1}-pane`"
      role="tabpanel"
      :aria-labelledby="`floor-tab${index + 1}`"
      tabindex="0"
    >
      <div class="property-grid-plan fadeinup wow">
        <div class="property-grid-thumb">
          <a
            :href="`/${floor.image}`"
            class="image-popup"
            :title="floor.floor_number"
          >
            <img :src="`/${floor.image}`" alt="Floor plan image" />
          </a>
        </div>
        <div class="property-grid-details">
          <h4 class="property-grid-title">{{ floor.floor_number }}</h4>
          <p class="property-grid-text mb-25">
            {{ floor.description }}
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    floor_plan: {
      type: Array,
      required: true,
    },
  },
  mounted() {
    this.initMagnificPopup();
  },
  updated() {
    this.initMagnificPopup();
  },
  methods: {
    initMagnificPopup() {
      this.$nextTick(() => {
        if (window.$ && window.$.fn.magnificPopup) {
          $(".image-popup").magnificPopup({
            type: "image",
            gallery: {
              enabled: true,
              navigateByImgClick: true,
              preload: [0, 1],
            },
            image: {
              titleSrc: "title",
            },
            zoom: {
              enabled: true,
              duration: 300,
            },
          });
        }
      });
    },
  },
};
</script>

<style lang="scss" scoped></style>
