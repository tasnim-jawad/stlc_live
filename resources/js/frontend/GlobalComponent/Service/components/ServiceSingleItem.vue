<template>
  <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 fadeinup wow">
    <div class="why-card-1 style-2 style-4">
      <h4 class="count">{{ (index + 1).toString().padStart(2, "0") }}</h4>
      <div class="why-card-1__icon">
        <img :src="'/' + service?.image" alt="image" />
      </div>
      <div class="why-card-1__content service_content">
        <h3 class="box-title">
          <a href="/service">{{ service?.title }}</a>
        </h3>
        <p class="box-text">
          {{ service?.url }}
        </p>
      </div>
      <div class="why-card-1__bottom">
        <Link
          class="th-btn style3 radius bg-white"
          :href="`/service/details?slug=${service?.slug}`"
        >
          Read More
        </Link>
      </div>
    </div>
  </div>
</template>

<script>
import { Link } from "@inertiajs/vue3";

export default {
  props: {
    service: {
      type: Object,
      required: true,
    },
    index: {
      type: Number,
      required: true,
    },
  },
};
</script>

<style lang="scss" scoped>
.why-card-1__content.service_content {
    margin-bottom: 40px;
    height: 220px;
    overflow: hidden;
    position: relative;
}
.why-card-1__content.service_content::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 50px; /* height of fade */
    pointer-events: none;
    background: linear-gradient(to bottom, rgba(255,255,255,0), rgba(255,255,255,1)); /* adjust color to your background */
}
</style>
