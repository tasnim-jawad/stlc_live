<template>
  <h3 class="page-title mt-50 mb-25 fadeinup wow">Features & amenities</h3>
  <div class="fea-anim-checklist fadeinup wow">
    <div class="checklist style2 list-six-column">
      <ul>
        <li
          v-for="(amenity, index) in amenities"
          :key="index"
          :class="{ available: isAvailable(amenity?.available) }"
        >
          {{ amenity?.title }}
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    amenities: {
      type: Array,
      required: true,
    },
  },
  methods: {
    isAvailable(available) {
      // Handle different data types that might come from backend
      if (
        available === true ||
        available === 1 ||
        available === "1" ||
        available === "true"
      ) {
        return true;
      }
      return false;
    },
  },
};
</script>

<style lang="scss" scoped>
.fea-anim-checklist .checklist.list-six-column li::before {
  content: "\f096"; /* Default unchecked box - fa-square-o */
  font-family: "Font Awesome 6 Free", "FontAwesome";
  font-weight: 400;
  color: var(--body-color);
}

.fea-anim-checklist .checklist.list-six-column li.available::before {
  content: "\f14a"; /* Checked circle - fa-check-circle */
  font-family: "Font Awesome 6 Free", "FontAwesome";
  font-weight: 400;
  color: var(--theme-color); /* Green color for checked items */
}
</style>
