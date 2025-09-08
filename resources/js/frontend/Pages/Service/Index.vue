<template>
  <div class="breadcumb-wrapper" data-bg-src="assets/frontend/img/bg/breadcrumb-bg.jpg"
  
    style="background-image: url(&quot;assets/frontend/img/bg/breadcrumb-bg.jpg&quot;)">
    <div class="container">
      <div class="breadcumb-content">
        <h1 class="breadcumb-title mt-5">Our Services</h1>
        <ul class="breadcumb-menu">
          <li><a href="index.html">Home</a></li>
          <li>Our Services</li>
        </ul>
      </div>
    </div>
  </div>
  <section class="overflow-hidden space space-extra-bottom" id="service-sec">
    <div class="container">
      <div class="row gy-40 justify-content-center">
        <template v-for="i in 9" :key="`service-item-${i}`">
          <service-single-item />
        </template>
      </div>
    </div>
  </section>
</template>

<script>
import ServiceSingleItem from "./components/ServiceSingleItem.vue";

export default {
  components: {
    ServiceSingleItem,
  },
};
</script>

<style scoped>
</style>
