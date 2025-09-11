<template>
  <div
    class="breadcumb-wrapper"
    data-bg-src="assets/frontend/img/bg/breadcrumb-bg.jpg"
    style="background-image: url('assets/frontend/img/bg/breadcrumb-bg.jpg')"
  >
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
        <template
          v-for="(service,index) in services?.data"
          :key="`service-item-${index}`"
        >
          <service-single-item :service="service" :index="index" />
        </template>
      </div>
      <div class="col-xxl-12">
        <Pagination
          :currentPage="services.current_page || 1"
          :totalPages="services.last_page || 1"
          @prev="goToPage(services.current_page - 1)"
          @next="goToPage(services.current_page + 1)"
          @change="goToPage"
        />
      </div>
    </div>
  </section>
</template>

<script>
import ServiceSingleItem from "./components/ServiceSingleItem.vue";
import Pagination from "../../GlobalComponent/Pagination/Pagination.vue";
import { store as service_store } from "./Store/service_store.js";
import { mapState, mapActions } from "pinia";

export default {
  components: {
    ServiceSingleItem,
    Pagination,
  },
  created: function () {
    this.fetch_services({ page: 1 });
    console.log("Services:", this.services);
    
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
    ...mapState(service_store, ["services"]),
  },
};
</script>

<style scoped></style>
