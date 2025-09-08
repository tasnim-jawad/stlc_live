<template>
  <div class="download-sec-3 space-top">
    <div
      class="download-3-bg-inner"
      :style="{
        backgroundImage: `url(/assets/frontend/img/bg/download-bg-3.jpg)`,
      }"
    >
      <div class="container">
        <div class="row gy-4 align-items-center">
          <div class="col-lg-5 col-xl-5 col-xxl-6">
            <div class="download-3-left">
              <div class="map-icon-box">
                <a href="property.html"
                  ><img
                    src="assets/frontend/img/download/download-3-map.png"
                    alt="img"
                /></a>
              </div>
              <div class="content-box">
                <img
                  src="assets/frontend/img/download/download-3-icon.png"
                  alt="img"
                />
                <h4 class="box-title">Find Fast Our Latest Properties</h4>
              </div>
            </div>
          </div>
          <div class="col-lg-7 col-xl-7 col-xxl-6">
            <div class="download-get-in-touch">
              <form
                action="https://html.themeholy.com/piller/demo/mail.php"
                method="POST"
                class="ajax-contact"
              >
                <div class="title-area text-left mb-70">
                  <p
                    class="sub-title fadeinup wow"
                    data-wow-duration="1.5s"
                    data-wow-delay="0.1s"
                  >
                    <span class="double-line"></span> Get In Touch
                  </p>
                  <h2
                    class="sec-title fadeinup wow"
                    data-wow-duration="1.5s"
                    data-wow-delay="0.3s"
                  >
                    Let’s Talk Your Property Goal
                  </h2>
                </div>
                <div class="row">
                  <div class="form-group col-lg-6 col-md-6">
                    <label for="name">Name*</label>
                    <input
                      type="text"
                      class="form-control"
                      name="name"
                      id="name"
                      placeholder="Your Name"
                    />
                  </div>
                  <div class="form-group col-lg-6 col-md-6">
                    <label for="email">Email*</label>
                    <input
                      type="email"
                      class="form-control"
                      name="email"
                      id="email"
                      placeholder="Email Address"
                    />
                  </div>
                  <div class="form-group col-lg-6 col-md-6">
                    <label for="date">Desired Date*</label>
                    <input
                      type="date"
                      class="form-control"
                      name="date"
                      id="date"
                    />
                  </div>
                  <div class="form-group col-lg-6 col-md-6">
                    <label for="desired_time">Desired Date*</label>
                    <input
                      type="text"
                      class="form-control"
                      name="desired_time"
                      id="desired_time"
                      placeholder="Desired Time"
                    />
                  </div>
                  <div class="form-group col-lg-12">
                    <label>Additional Message</label>
                    <textarea
                      name="message"
                      id="message"
                      cols="30"
                      rows="3"
                      class="form-control"
                      placeholder="Please write any note here..."
                    ></textarea>
                  </div>
                  <div class="form-btn col-12 text-end">
                    <button class="th-btn bg-theme radius">Submit Now</button>
                  </div>
                </div>
                <p class="form-messages mb-0 mt-3"></p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- --------------------------------------- -->
  <!-- ----------Marquee----------------- -->
  <!-- --------------------------------------- -->
  <Marquee />
  <!-- --------------------------------------- -->
  <!-- ----------Marquee----------------- -->
  <!-- --------------------------------------- -->
  

</template>

<script>
import Marquee from "./Marquee.vue";
export default {
  components: {
    Marquee,
  },
};
</script>

<style lang="scss" scoped></style>
