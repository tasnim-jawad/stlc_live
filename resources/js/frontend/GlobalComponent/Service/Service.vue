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
              <span class="double-line"></span> Signature Features
            </p>
            <h2
              class="sec-title fadeinup wow"
              data-wow-duration="1.5s"
              data-wow-delay="0.3s"
            >
              See how Pillar can Help
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
        <!-- <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 fadeinup wow">
          <div class="why-card-1 style-2 style-4">
            <h4 class="count">01</h4>
            <div class="why-card-1__icon">
              <img
                src="assets/frontend/img/icon/why-icon-1-1.svg"
                alt="image"
              />
            </div>
            <div class="why-card-1__content">
              <h3 class="box-title">
                <a href="service.html">Easty To Rent</a>
              </h3>
              <p class="box-text">
                Velox surgo clarus confido carus video lumen virtus spes
                decerno..
              </p>
            </div>
            <div class="why-card-1__bottom">
              <a
                class="th-btn style3 radius bg-white"
                href="property-details.html"
                >Find a Home</a
              >
            </div>
          </div>
        </div>
        <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 fadeinup wow">
          <div class="why-card-1 style-2 style-4">
            <h4 class="count">02</h4>
            <div class="why-card-1__icon">
              <img
                src="assets/frontend/img/icon/why-icon-1-2.svg"
                alt="image"
              />
            </div>
            <div class="why-card-1__content">
              <h3 class="box-title">
                <a href="service.html">Carefully Crafted</a>
              </h3>
              <p class="box-text">
                Altus cedo tantillus video patrocinor valeo vestrum credo
                virtus.
              </p>
            </div>
            <div class="why-card-1__bottom">
              <a
                class="th-btn style3 radius bg-white"
                href="property-details.html"
                >Sell a Home</a
              >
            </div>
          </div>
        </div>
        <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 fadeinup wow">
          <div class="why-card-1 style-2 style-4">
            <h4 class="count">03</h4>
            <div class="why-card-1__icon">
              <img
                src="assets/frontend/img/icon/why-icon-1-3.svg"
                alt="image"
              />
            </div>
            <div class="why-card-1__content">
              <h3 class="box-title">
                <a href="service.html">Eco-Friendly & Green</a>
              </h3>
              <p class="box-text">
                Technology is revolutionizing the other legal Technology the
                legal
              </p>
            </div>
            <div class="why-card-1__bottom">
              <a
                class="th-btn style3 radius bg-white"
                href="property-details.html"
                >Rent a Home</a
              >
            </div>
          </div>
        </div>
        <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 fadeinup wow">
          <div class="why-card-1 style-2 style-4">
            <h4 class="count">04</h4>
            <div class="why-card-1__icon">
              <img
                src="assets/frontend/img/icon/why-icon-1-4.svg"
                alt="image"
              />
            </div>
            <div class="why-card-1__content">
              <h3 class="box-title">
                <a href="service.html">Lavish Greenary</a>
              </h3>
              <p class="box-text">
                Confido carus video lumen Velox surgo ok virtus spes decerno.
              </p>
            </div>
            <div class="why-card-1__bottom">
              <a
                class="th-btn style3 radius bg-white"
                href="property-details.html"
                >Find a Home</a
              >
            </div>
          </div>
        </div>
        <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 fadeinup wow">
          <div class="why-card-1 style-2 style-4">
            <h4 class="count">05</h4>
            <div class="why-card-1__icon">
              <img
                src="assets/frontend/img/icon/why-icon-1-1.svg"
                alt="image"
              />
            </div>
            <div class="why-card-1__content">
              <h3 class="box-title">
                <a href="service.html">In-built Wardrobe</a>
              </h3>
              <p class="box-text">
                Velox surgo clarus home of other the cedo virtus spes decerno.
              </p>
            </div>
            <div class="why-card-1__bottom">
              <a
                class="th-btn style3 radius bg-white"
                href="property-details.html"
                >Sell a Home</a
              >
            </div>
          </div>
        </div>
        <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 fadeinup wow">
          <div class="why-card-1 style-2 style-4">
            <h4 class="count">06</h4>
            <div class="why-card-1__icon">
              <img
                src="assets/frontend/img/icon/why-icon-1-2.svg"
                alt="image"
              />
            </div>
            <div class="why-card-1__content">
              <h3 class="box-title">
                <a href="service.html">Planned Construction</a>
              </h3>
              <p class="box-text">
                Altus cedo tantillus video patrocinor subseco vestrum credo
                virtus.
              </p>
            </div>
            <div class="why-card-1__bottom">
              <a
                class="th-btn style3 radius bg-white"
                href="property-details.html"
                >Rent a Home</a
              >
            </div>
          </div>
        </div>
        <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 fadeinup wow">
          <div class="why-card-1 style-2 style-4">
            <h4 class="count">07</h4>
            <div class="why-card-1__icon">
              <img
                src="assets/frontend/img/icon/why-icon-1-3.svg"
                alt="image"
              />
            </div>
            <div class="why-card-1__content">
              <h3 class="box-title">
                <a href="service.html">Family & Community</a>
              </h3>
              <p class="box-text">
                Technology is revolutionizing the legal tantillus Technology the
                legal
              </p>
            </div>
            <div class="why-card-1__bottom">
              <a
                class="th-btn style3 radius bg-white"
                href="property-details.html"
                >Find a Home</a
              >
            </div>
          </div>
        </div>
        <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 fadeinup wow">
          <div class="why-card-1 style-2 style-4">
            <h4 class="count">08</h4>
            <div class="why-card-1__icon">
              <img
                src="assets/frontend/img/icon/why-icon-1-4.svg"
                alt="image"
              />
            </div>
            <div class="why-card-1__content">
              <h3 class="box-title">
                <a href="service.html">Tech & Security</a>
              </h3>
              <p class="box-text">
                Confido carus video lumen Velox clarus tantillus virtus spes
                decerno.
              </p>
            </div>
            <div class="why-card-1__bottom">
              <a
                class="th-btn style3 radius bg-white"
                href="property-details.html"
                >Rent a Home</a
              >
            </div>
          </div>
        </div> -->
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
            ServiceSingleItem
        },
        methods: {
            ...mapActions(service_store, ["fetch_services"]),
        },
        computed: {
            ...mapState(service_store, ["services"]),
        },
        created: async function () {
            await this.fetch_services();
            console.log("Services:", this.services);
        },
    }
</script>

<style scoped>

</style>