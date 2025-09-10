<template>
  <section class="th-blog-wrapper space-top overflow-hidden mission">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-7">
          <div class="title-area text-center">
            <p
              class="sub-title fadeinup wow"
              data-wow-duration="1.5s"
              data-wow-delay="0.1s"
            >
              <span class="double-line"></span>Our Mission
            </p>
            <h2
              class="sec-title fadeinup wow"
              data-wow-duration="1.5s"
              data-wow-delay="0.3s"
            >
              Our Mission
            </h2>
          </div>
        </div>
      </div>
      <div class="row gx-60">
        <div class="col-xxl-12 col-lg-12">
          <div class="row gy-30 gx-30 justify-content-center mb-60">
            <div class="col-xxl-6 col-xl-12">
              <div
                class="team-card style-2 me-xxl-4 background-image"
                :style="{ backgroundImage: `url(/assets/frontend/img/shape/team-2-bg-shape.png)` }"
              >
                <div class="team-img">
                  <img
                    :src="'/' + our_mission?.secondary_image"
                    alt="Team"
                  />
                </div>
              </div>
            </div>
            <div class="col-xxl-6 col-xl-12">
              <div class="team-wrap">
                <!-- <div class="top-wrap">
                  <div class="title-wrap">
                    <h3 class="team-about_title">Our Mission</h3>
                  </div>
                </div> -->
                <p class="team-about_text mt-5" v-html="our_mission?.description"></p>
                <Link href="/about-us" class="th-btn radius bg-theme"
                  >About us</Link
                >
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="th-blog-wrapper space-top overflow-hidden mission">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-7">
          <div class="title-area text-center">
            <p
              class="sub-title fadeinup wow"
              data-wow-duration="1.5s"
              data-wow-delay="0.1s"
            >
              <span class="double-line"></span>Our Vision
            </p>
            <h2
              class="sec-title fadeinup wow"
              data-wow-duration="1.5s"
              data-wow-delay="0.3s"
            >
              Our Vision
            </h2>
          </div>
        </div>
      </div>
      <div class="row gx-60">
        <div class="col-xxl-12 col-lg-12">
          <div class="row gy-30 gx-30 justify-content-center mb-60">
            <div class="col-xxl-6 col-xl-12 order-2 order-xxl-1">
              <div class="team-wrap">
                <!-- <div class="top-wrap">
                  <div class="title-wrap">
                    <h3 class="team-about_title">Our Mission</h3>
                  </div>
                </div> -->
                <p
                  class="team-about_text mt-5"
                  v-html="our_vision?.description"
                ></p>
                <Link href="/about-us" class="th-btn radius bg-theme"
                  >About us</Link
                >
              </div>
            </div>
            <div class="col-xxl-6 col-xl-12 order-1 order-xxl-2">
              <div
                class="team-card style-2 me-xxl-4 background-image"
                :style="{ backgroundImage: `url(/assets/frontend/img/shape/team-2-bg-shape.png)` }"
              >
                <div class="team-img">
                  <img
                    :src="'/' + our_vision?.secondary_image"
                    alt="Team"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section
    class="th-blog-wrapper space-top overflow-hidden space-extra-bottom mission"
  >
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-7">
          <div class="title-area text-center">
            <p
              class="sub-title fadeinup wow"
              data-wow-duration="1.5s"
              data-wow-delay="0.1s"
            >
              <span class="double-line"></span>Our Core Values
            </p>
            <h2
              class="sec-title fadeinup wow"
              data-wow-duration="1.5s"
              data-wow-delay="0.3s"
            >
              Core Values
            </h2>
          </div>
        </div>
      </div>
      <div class="row gx-60">
        <div class="col-xxl-12 col-lg-12">
          <div class="row gy-30 gx-30 justify-content-center mb-60">
            <div class="col-xxl-6 col-xl-12">
              <div
                class="team-card style-2 me-xxl-4 background-image"
                :style="{ backgroundImage: `url(/assets/frontend/img/shape/team-2-bg-shape.png)` }"
              >
                <div class="team-img">
                  <img
                    :src="'/' + core_values?.secondary_image"
                    alt="Team"
                  />
                </div>
              </div>
            </div>
            <div class="col-xxl-6 col-xl-12">
              <div class="team-wrap">
                <!-- <div class="top-wrap">
                  <div class="title-wrap">
                    <h3 class="team-about_title">Our Mission</h3>
                  </div>
                </div> -->
                <p class="team-about_text mt-5" v-html="core_values?.description"></p>
                <Link href="/about-us" class="th-btn radius bg-theme"
                  >About us</Link
                >
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { store as mission_vision_store } from "./Store/mission_vision_store.js";
import { mapActions, mapState } from "pinia";
export default {
  created:async function () {
    await this.fetch_mission();
    await this.fetch_vision();
    await this.fetch_core_values();
    console.log("Mission:", this.our_mission);
  },
  methods: {
    ...mapActions(mission_vision_store, [
      "fetch_mission",
      "fetch_vision",
      "fetch_core_values",
    ]),
  },
  computed: {
    ...mapState(mission_vision_store, ["our_mission", "our_vision", "core_values"]),
    
  },

};
</script>

<style scoped>
.mission .team-card.style-2 {
  padding: 0 0 0 0;
  max-width: 700px;
  margin: 0 auto;
}
.mission .team-card.style-2 .team-img {
  padding: 0 0 0 0;
  max-height: 450px;
  max-width: 700px;
}
.mission .team-card.style-2 img {
  padding: 0 0 0 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center center;
}
</style>
