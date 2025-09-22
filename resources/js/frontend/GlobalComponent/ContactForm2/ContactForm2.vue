<template>
  <div class="contact-form-area">
    <div class="container">
      <div class="row gx-0">
        <div class="col-xl-12">
          <div class="contact-all-wrapper">
            <div class="contact-form-wrap">
              <form
                @submit.prevent="submitForm"
                class="contact-form ajax-contact"
              >
                <h3 class="form-title">Do you have questions? Contact Us</h3>
                <div class="row">
                  <div class="form-group col-md-6">
                    <input
                      type="text"
                      class="form-control"
                      :class="{ 'is-invalid': errors.name }"
                      name="name"
                      id="name"
                      placeholder="Name *"
                      v-model="form.name"
                    />
                  </div>
                  <div class="form-group col-md-6">
                    <input
                      type="tel"
                      class="form-control"
                      :class="{ 'is-invalid': errors.phone_number }"
                      name="phone_number"
                      id="phone_number"
                      placeholder="Phone *"
                      v-model="form.phone_number"
                    />
                  </div>
                  <div class="form-group col-md-12">
                    <input
                      type="email"
                      class="form-control"
                      :class="{ 'is-invalid': errors.email }"
                      name="email"
                      id="email"
                      placeholder="Email Address *"
                      v-model="form.email"
                    />
                  </div>
                  <div class="form-group col-md-12">
                    <select
                      name="service_types"
                      id="service_types"
                      class="orderby form-control"
                      :class="{ 'is-invalid': errors.service_types }"
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
                  <div class="form-group col-12">
                    <textarea
                      name="message"
                      id="message"
                      cols="30"
                      rows="3"
                      class="form-control"
                      :class="{ 'is-invalid': errors.message }"
                      placeholder="Your Message *"
                      v-model="form.message"
                    ></textarea>
                  </div>
                  <div class="form-btn text-start col-12">
                    <button
                      type="submit"
                      class="th-btn radius"
                      :disabled="loading"
                    >
                      {{ loading ? "Submitting..." : "Send message" }}
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
            <div class="contact-form-thumb overflow-hidden">
              <img
                src="/assets/frontend/img/contact/contact_ai.png"
                alt="img"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
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
        console.log("Form Data:", this.form);

        const response = await axios.post("/contacts/store", this.form);

        // Show success message using SweetAlert
        let successMsg =
          response.data?.message || "Your message has been sent successfully!";
        window.s_alert(successMsg, "success");

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

        console.log("Form submitted successfully:", response.data);
      } catch (error) {
        console.error("Form submission error:", error);

        if (error.response && error.response.status === 422) {
          this.errors = error.response.data.errors;

          // Show validation errors using SweetAlert
          let errorMessages = Object.values(this.errors).flat().join("<br>");
          window.s_warning(errorMessages);
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

<style scoped></style>
