<template>
  <div
    class="why-sec-1 space"
    id="why-sec"
    :style="{
      backgroundImage: 'url(/assets/frontend/img/why/why-choose-1-bg.jpg)',
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
            <h2
              class="sec-title text-white mb-0 fadeinup wow"
              data-wow-duration="1.5s"
              data-wow-delay="0.3s"
            >
              Trusted by 100+ Million Buyers
            </h2>
          </div>
        </div>
        <!-- <div class="col-xl-auto">
          <div
            class="why-right-review-wrap sec-btn fadeinup wow"
            data-wow-duration="1.5s"
            data-wow-delay="0.3s"
          >
            <div class="trust-content">
              <div class="icon">
                <img src="/assets/frontend/img/icon/star-icon.svg" alt="img" />
              </div>
              <h4 class="box-title">Trustipilot</h4>
            </div>
            <div class="client">
              <div class="avatar">
                <img
                  src="/assets/frontend/img/hero/heror-1-avator-group.png"
                  alt="img"
                />
              </div>
              <div class="content">
                <div class="th-social">
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                </div>
                <h4 class="review-title">
                  <span class="number"
                    ><span class="counter-number">19</span>k+</span
                  >
                  clients
                </h4>
              </div>
            </div>
          </div>
        </div> -->
      </div>
      <div class="row gy-30 align-items-center justify-content-center">
        <template v-for="(service, index) in services" :key="index">
          <ServiceSingleItem :service="service" />
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
  components: { ServiceSingleItem },
  created: async function () {
    await this.fetch_services();
    console.log("Services:", this.services);
  },
  computed: {
    ...mapState(why_choose_us_store, ["services"]),
  },
  methods: {
    ...mapActions(why_choose_us_store, ["fetch_services"]),
  },
};
</script>

<style lang="scss" scoped></style>
