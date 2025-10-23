<template>
  <div class="download-sec-3 space-top">
    <div
      class="download-3-bg-inner"
      :style="{
        backgroundImage: `url(/assets/frontend/img/common/3.jpeg)`,
      }"
    >
      <div class="container">
        <div class="row gy-4 align-items-center">
          <div class="col-lg-5 col-xl-5 col-xxl-6">
            <div class="download-3-left">
              <div class="map-icon-box">
                <Link href="portfolio"
                  ><img
                    src="assets/frontend/img/download/download-3-map.png"
                    alt="img"
                /></Link>
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
              <form @submit.prevent="submitForm" class="ajax-contact">
                <div class="title-area text-left mb-70">
                  <p
                    class="sub-title fadeinup wow"
                    data-wow-duration="1.5s"
                    data-wow-delay="0.1s"
                  >
                    <span class="double-line"></span> Contact Us
                  </p>
                  <h2
                    class="sec-title fadeinup wow"
                    data-wow-duration="1.5s"
                    data-wow-delay="0.3s"
                  >
                    Ready to Build Your Future with Us?
                  </h2>
                </div>
                <div class="row">
                  <div class="form-group col-lg-6 col-md-6">
                    <label for="name">Name<span>*</span></label>
                    <input
                      type="text"
                      class="form-control"
                      :class="{ 'is-invalid': errors.name }"
                      name="name"
                      id="name"
                      placeholder="Your Name"
                      v-model="form.name"
                    />
                  </div>
                  <div class="form-group col-lg-6 col-md-6">
                    <label for="email">Email<span>*</span></label>
                    <input
                      type="email"
                      class="form-control"
                      :class="{ 'is-invalid': errors.email }"
                      name="email"
                      id="email"
                      placeholder="Email Address"
                      v-model="form.email"
                    />
                  </div>
                  <div class="form-group col-lg-6 col-md-6">
                    <label for="service_types">Service Types</label>
                    <select
                      class="form-control"
                      :class="{ 'is-invalid': errors.service_types }"
                      name="service_types"
                      id="service_types"
                      v-model="form.service_types"
                    >
                      <option value="" disabled="" selected="" hidden="">
                        Select Service Type
                      </option>
                      <option value="buying">Buying</option>
                      <option value="selling">Selling</option>
                      <option value="renting">Renting</option>
                      <option value="consultation">Consultation</option>
                    </select>
                  </div>
                  <div class="form-group col-lg-6 col-md-6">
                    <label for="phone_number">Phone Number</label>
                    <input
                      type="text"
                      class="form-control"
                      :class="{ 'is-invalid': errors.phone_number }"
                      name="phone_number"
                      id="phone_number"
                      placeholder="Phone Number"
                      v-model="form.phone_number"
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
                      :class="{ 'is-invalid': errors.message }"
                      placeholder="Please write any note here..."
                      v-model="form.message"
                    ></textarea>
                  </div>
                  <div class="form-btn col-12 text-end">
                    <button
                      type="submit"
                      class="th-btn bg-theme radius"
                      :disabled="loading"
                    >
                      {{ loading ? "Submitting..." : "Submit Now" }}
                    </button>
                  </div>
                </div>
                <p
                  class="form-messages mb-0 mt-3"
                  v-if="successMessage"
                  style="color: green"
                >
                  {{ successMessage }}
                </p>
                <p
                  class="form-messages mb-0 mt-3"
                  v-if="errorMessage"
                  style="color: red"
                >
                  {{ errorMessage }}
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
import Marquee from "../Marquee/Marquee.vue";

export default {
  components: {
    Marquee,
  },
  data() {
    return {
      form: {
        name: "",
        email: "",
        service_types: "",
        phone_number: "",
        message: "",
      },
      errors: {},
      loading: false,
      successMessage: "",
      errorMessage: "",
    };
  },
  methods: {
    async submitForm() {
      this.loading = true;
      this.errors = {};
      this.successMessage = "";
      this.errorMessage = "";

      try {
        console.log("Form Data connnnnn:", this.form);

        const response = await axios.post("/contacts/store", this.form);

        console.log("Form submission response:", response.data);

        // Show success message using SweetAlert
        let successMsg =
          response.data?.message || "Your message has been sent successfully!";

        // Also set the success message for template display
        this.successMessage = successMsg;

        // Clear success message after 5 seconds
        setTimeout(() => {
          this.successMessage = "";
        }, 5000);

        // Reset form
        this.form = {
          name: "",
          email: "",
          service_types: "",
          phone_number: "",
          message: "",
        };

        window.s_alert("Your message has been sent successfully!");
      } catch (error) {
        console.error("Form submission error:", error);

        if (error.response && error.response.status === 422) {
          this.errors = error.response.data.errors;

          // Show validation errors using SweetAlert
          let errorMessages = Object.values(this.errors).flat().join("<br>");
        } else {
          this.errorMessage = "An error occurred. Please try again.";
          window.s_error("An error occurred. Please try again.");
        }
      } finally {
        this.loading = false;
      }
    },
  },
};
</script>

<style lang="scss" scoped></style>
