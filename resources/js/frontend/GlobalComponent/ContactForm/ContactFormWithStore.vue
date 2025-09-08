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
              <form @submit.prevent="handleSubmit" class="ajax-contact">
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
                    Let's Talk Your Property Goal
                  </h2>
                </div>
                <div class="row">
                  <div class="form-group col-lg-6 col-md-6">
                    <label for="name">Name<span>*</span></label>
                    <input
                      type="text"
                      class="form-control"
                      :class="{ 'is-invalid': contactStore.errors.name }"
                      name="name"
                      id="name"
                      placeholder="Your Name"
                      v-model="contactStore.form.name"
                    />
                  </div>
                  <div class="form-group col-lg-6 col-md-6">
                    <label for="email">Email<span>*</span></label>
                    <input
                      type="email"
                      class="form-control"
                      :class="{ 'is-invalid': contactStore.errors.email }"
                      name="email"
                      id="email"
                      placeholder="Email Address"
                      v-model="contactStore.form.email"
                    />
                  </div>
                  <div class="form-group col-lg-6 col-md-6">
                    <label for="service_types">Service Types</label>
                    <select
                      class="form-control"
                      :class="{
                        'is-invalid': contactStore.errors.service_types,
                      }"
                      name="service_types"
                      id="service_types"
                      v-model="contactStore.form.service_types"
                    >
                      <option value="" disabled="" selected="" hidden="">
                        Select Service Type
                      </option>
                      <option
                        v-for="serviceType in contactStore.serviceTypes"
                        :key="serviceType.value"
                        :value="serviceType.value"
                      >
                        {{ serviceType.label }}
                      </option>
                    </select>
                  </div>
                  <div class="form-group col-lg-6 col-md-6">
                    <label for="phone_number">Phone Number</label>
                    <input
                      type="text"
                      class="form-control"
                      :class="{
                        'is-invalid': contactStore.errors.phone_number,
                      }"
                      name="phone_number"
                      id="phone_number"
                      placeholder="Phone Number"
                      v-model="contactStore.form.phone_number"
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
                      :class="{ 'is-invalid': contactStore.errors.message }"
                      placeholder="Please write any note here..."
                      v-model="contactStore.form.message"
                    ></textarea>
                  </div>
                  <div class="form-btn col-12 text-end">
                    <button
                      type="submit"
                      class="th-btn bg-theme radius"
                      :disabled="contactStore.loading"
                    >
                      {{
                        contactStore.loading ? "Submitting..." : "Submit Now"
                      }}
                    </button>
                  </div>
                </div>
                <p
                  class="form-messages mb-0 mt-3"
                  v-if="contactStore.successMessage"
                  style="color: green"
                >
                  {{ contactStore.successMessage }}
                </p>
                <p
                  class="form-messages mb-0 mt-3"
                  v-if="contactStore.errorMessage"
                  style="color: red"
                >
                  {{ contactStore.errorMessage }}
                </p>
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
import { useContactStore } from "./Store/contactStore.js";
import Marquee from "../Marquee/Marquee.vue";

export default {
  components: {
    Marquee,
  },
  setup() {
    const contactStore = useContactStore();

    const handleSubmit = async () => {
      const result = await contactStore.submitForm();
      if (result.success) {
        console.log("Form submitted successfully");
      }
    };

    return {
      contactStore,
      handleSubmit,
    };
  },
};
</script>

<style lang="scss" scoped></style>
