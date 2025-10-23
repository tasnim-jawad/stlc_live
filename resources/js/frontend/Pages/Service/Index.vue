<template>
  <div
    class="breadcumb-wrapper"
    data-bg-src="assets/frontend/img/common/2.jpeg"
    style="background-image: url('assets/frontend/img/common/2.jpeg')"
  >
    <div class="container">
      <div class="breadcumb-content">
        <h1 class="breadcumb-title mt-5">Our Services</h1>
        <ul class="breadcumb-menu">
          <li><Link href="/">Home</Link></li>
          <li>Our Services</li>
        </ul>
      </div>
    </div>
  </div>
  <section class="overflow-hidden space space-extra-bottom" id="service-sec">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-7">
          <div class="title-area text-center mb-2">
            <p
              class="sub-title fadeinup wow"
              data-wow-duration="1.5s"
              data-wow-delay="0.1s"
            >
              <span class="double-line"></span> Services
            </p>
            <h2
              class="sec-title mb-4 fadeinup wow"
              data-wow-duration="1.5s"
              data-wow-delay="0.3s"
            >
              Welcome to Our Services
            </h2>
            <p
              class="chat-text-wrap text-center pe-xl-5 ps-xl-5 mb-5 fadeinup wow"
            >
              We provide premium real estate and construction solutions, along
              with project management, accounting, and trading services. Our STC
              Bricks ensure durable, high-quality materials, and our sister
              concerns support end-to-end project delivery. Quality,
              reliability, and client satisfaction are at the core of everything
              we do.
            </p>
            <div
              class="filter-menu style-2 indicator-active filter-menu-active mt-2 justify-content-center fadeinup wow"
              data-wow-duration="1.5s"
              data-wow-delay="0.5s"
            ></div>
          </div>
        </div>
      </div>
      <div class="row gy-40 justify-content-center">
        <!-- Skeleton loading state -->
        <template v-if="showSkeleton">
          <service-single-item
            v-for="n in 6"
            :key="`skeleton-${n}`"
            :isLoading="true"
            :index="n - 1"
          />
        </template>

        <!-- Actual services -->
        <template v-else-if="hasServices">
          <service-single-item
            v-for="(service, index) in services.data"
            :key="`service-item-${index}`"
            :service="service"
            :index="index"
            :isLoading="false"
          />
        </template>

        <!-- No services message -->
        <template v-else>
          <div class="col-12 text-center">
            <p class="text-muted">No services available at the moment.</p>
          </div>
        </template>
      </div>
    </div>
  </section>
</template>

<script>
import { Link } from "@inertiajs/vue3";
import ServiceSingleItem from "./components/ServiceSingleItem.vue";
import Pagination from "../../GlobalComponent/Pagination/Pagination.vue";
import { store as service_store } from "./Store/service_store.js";
import { mapState, mapActions } from "pinia";

export default {
  components: {
    Link,
    ServiceSingleItem,
    Pagination,
  },
  created: function () {
    console.log("Services page created, fetching services data...");
    this.fetch_services({ page: 1 });
  },
  methods: {
    ...mapActions(service_store, ["fetch_services"]),
    goToPage(page) {
      console.log("Going to page:", page);
      if (page < 1 || page > (this.services.last_page || 1)) return;
      this.fetch_services({ page });
    },
  },
  computed: {
    ...mapState(service_store, ["services", "loading", "error"]),

    // Check if we should show skeleton
    showSkeleton() {
      return (
        this.loading &&
        (!this.services?.data || this.services.data.length === 0)
      );
    },

    // Check if we have valid services
    hasServices() {
      return this.services?.data && this.services.data.length > 0;
    },
  },
  watch: {
    loading(newVal, oldVal) {
      console.log("Services loading state changed from", oldVal, "to", newVal);
    },
    "services.data"(newVal, oldVal) {
      console.log("Services data changed:", newVal?.length || 0, "services");
    },
  },
};
</script>

<style scoped></style>
