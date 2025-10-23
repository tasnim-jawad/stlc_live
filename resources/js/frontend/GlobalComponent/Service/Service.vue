<template>
  <div
    class="why-sec-2 bg-smoke space"
    id="why-sec"
    data-bg-src="assets/img/shape/what-we-do-3-bg.png"
  >
    <div class="container">
      <div
        class="row justify-content-lg-between gy-4 justify-content-center align-items-center mb-40"
      >
        <div class="col-lg-6">
          <div class="title-area text-left mb-2">
            <p
              class="sub-title fadeinup wow"
              data-wow-duration="1.5s"
              data-wow-delay="0.1s"
            >
              <span class="double-line"></span> Key Services
            </p>
            <h2
              class="sec-title fadeinup wow"
              data-wow-duration="1.5s"
              data-wow-delay="0.3s"
            >
              See how STC can Help
            </h2>
          </div>
        </div>
        <div class="col-lg-auto">
          <Link
            href="/service"
            class="th-btn style3 radius fadeinup wow"
            data-wow-duration="1.5s"
            data-wow-delay="0.1s"
            >View All Services</Link
          >
        </div>
      </div>
      <div class="row gy-30 justify-content-center">
        <template v-for="(service, index) in services" :key="index">
          <ServiceSingleItem :service="service" :index="index" />
        </template>
      </div>
    </div>
  </div>
</template>

<script>
import { store as service_store } from "./Store/services_store.js";
import { mapActions, mapState } from "pinia";
import ServiceSingleItem from "./components/ServiceSingleItem.vue";
export default {
  components: {
    ServiceSingleItem,
  },
  methods: {
    ...mapActions(service_store, ["fetch_services"]),
  },
  computed: {
    ...mapState(service_store, ["services"]),
  },
  created: async function () {
    await this.fetch_services();
    // console.log("Services:", this.services);
  },
};
</script>

<style scoped>
</style>
