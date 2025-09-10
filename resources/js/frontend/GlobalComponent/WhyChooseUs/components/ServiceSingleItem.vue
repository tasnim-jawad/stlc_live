<template>
  <div class="col-xl-4 col-lg-6 col-md-6">
    <div class="why-card-1">
      <div class="hover-icon">
        <img src="/assets/frontend/img/icon/why-hover-icon-1.png" alt="img" />
      </div>
      <div class="why-card-1__icon">
        <img :src="'/' + service?.image" alt="image" />
      </div>
      <div class="why-card-1__content">
        <h3 class="box-title">{{ service?.title }}</h3>
        <p class="box-text">
          {{ service?.description }}
        </p>
      </div>
      <div class="why-card-1__bottom">
        <Link class="th-btn style3 pill bg-white" href="/portfolio"
          >Find a Home</Link
        >
      </div>
    </div>
  </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';

export default {
  props: {
    service: {
      type: Object,
      required: true,
    },
  },
};
</script>

<style scoped></style>
