<template>
  <div
    class="why-sec-1 space"
    id="why-sec"
    :style="{
      backgroundImage: 'url(/assets/frontend/img/common/1.jpeg)',
      backgroundSize: 'cover',
      backgroundPosition: 'center',
      backgroundRepeat: 'no-repeat',
    }"
  >
    <div class="container">
      <div
        class="row justify-content-xl-between justify-content-center align-items-start mb-5"
      >
        <div class="col-xl-6">
          <div
            class="title-area text-center text-xl-start text-left white mb-4"
          >
            <p
              class="sub-title fadeinup wow"
              data-wow-duration="1.5s"
              data-wow-delay="0.1s"
            >
              <span class="double-line"></span> Why Choose Us
            </p>
          </div>
        </div>
      </div>
      <div class="row gy-30 align-items-center justify-content-center">
        <!-- Show skeleton if loading or no services -->
        <template v-if="isLoading">
          <ServiceSingleItem
            v-for="n in 6"
            :key="'skeleton-' + n"
            :service="null"
            :isLoading="true"
          />
        </template>

        <!-- Show actual services when loaded -->
        <template v-else>
          <ServiceSingleItem
            v-for="(service, index) in services"
            :key="'service-' + (service.id || index)"
            :service="service"
            :isLoading="false"
          />
        </template>
      </div>
    </div>
  </div>
</template>

<script>
import { store as why_choose_us_store } from "./Store/why_choose_us.js";
import { mapActions, mapState } from "pinia";
import ServiceSingleItem from "./components/ServiceSingleItem.vue";

export default {
  name: "WhyChooseUs",
  components: { ServiceSingleItem },

  async created() {
    await this.fetch_services();
    // console.log("Services:", this.services);
  },

  computed: {
    ...mapState(why_choose_us_store, ["services", "loading", "error"]),

    // Check if we have valid services data
    hasServices() {
      return this.services && this.services.length > 0;
    },

    // Loading state for skeleton display
    isLoading() {
      return this.loading || !this.hasServices;
    },
  },

  methods: {
    ...mapActions(why_choose_us_store, ["fetch_services"]),
  },
};
</script>

<style lang="scss" scoped>
/* Container level optimizations for smooth transitions */
.row {
  transition: opacity 0.3s ease;
}

/* Ensure proper spacing and alignment for both skeleton and real content */
.gy-30 > * {
  animation: slideInUp 0.4s ease-out;
}

@keyframes slideInUp {
  from {
    opacity: 0;
    transform: translateY(15px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* Stagger animation for better visual effect */
.gy-30 > *:nth-child(1) {
  animation-delay: 0.1s;
}
.gy-30 > *:nth-child(2) {
  animation-delay: 0.2s;
}
.gy-30 > *:nth-child(3) {
  animation-delay: 0.3s;
}
.gy-30 > *:nth-child(4) {
  animation-delay: 0.4s;
}
.gy-30 > *:nth-child(5) {
  animation-delay: 0.5s;
}
.gy-30 > *:nth-child(6) {
  animation-delay: 0.6s;
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .gy-30 > * {
    animation-delay: 0s !important;
  }
}
</style>
