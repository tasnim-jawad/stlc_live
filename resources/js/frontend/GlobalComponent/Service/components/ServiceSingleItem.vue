<template>
  <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 fadeinup wow">
    <div class="why-card-1 style-2 style-4">
    <h4 class="count">{{ (index + 1).toString().padStart(2, '0') }}</h4>
      <div class="why-card-1__icon">
        <img :src="'/' + service?.image" alt="image" />
      </div>
      <div class="why-card-1__content">
        <h3 class="box-title">
          <a href="service.html">{{ service?.title }}</a>
        </h3>
        <p class="box-text">
          {{ service?.description }}
        </p>
      </div>
      <div class="why-card-1__bottom">
        <Link class="th-btn style3 radius bg-white" href="/portfolio"
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
            required: true
        },
        index: {
            type: Number,
            required: true
        }
    }
};
</script>

<style lang="scss" scoped></style>
