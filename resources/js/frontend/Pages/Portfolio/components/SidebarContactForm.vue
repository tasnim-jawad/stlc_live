<template>
  <div class="widget sidebar-contact-form">
    <h3 class="widget_title">Contact Us</h3>
    <div class="contact-form-widget">
      <form @submit.prevent="submitForm" class="newsletter-form">
        <div class="form-group">
          <input
            class="form-control"
            :class="{ 'is-invalid': errors.name }"
            type="text"
            placeholder="Your Name"
            name="name"
            v-model="form.name"
            required=""
          />
        </div>
        <div class="form-group">
          <input
            class="form-control"
            :class="{ 'is-invalid': errors.email }"
            type="email"
            placeholder="Your Email"
            name="email"
            v-model="form.email"
            required=""
          />
        </div>
        <div class="form-group">
          <input
            class="form-control"
            :class="{ 'is-invalid': errors.phone_number }"
            type="text"
            placeholder="Your Phone"
            name="phone_number"
            v-model="form.phone_number"
            required=""
          />
        </div>
        <div class="form-group mb-4">
          <select
            class="form-control"
            :class="{ 'is-invalid': errors.service_types }"
            name="service_types"
            v-model="form.service_types"
          >
            <option value="" disabled selected hidden>
              Select Service Type
            </option>
            <option value="buying">Buying</option>
            <option value="selling">Selling</option>
            <option value="renting">Renting</option>
            <option value="consultation">Consultation</option>
          </select>
        </div>
        <div class="form-group mb-4">
          <textarea
            name="message"
            id="message"
            cols="30"
            rows="3"
            class="form-control"
            :class="{ 'is-invalid': errors.message }"
            placeholder="Your Message"
            v-model="form.message"
          ></textarea>
        </div>
        <div class="form-btn pt-2">
          <button type="submit" class="th-btn radius" :disabled="loading">
            {{ loading ? "Submitting..." : "Send Us" }}
          </button>
        </div>
        <p
          class="form-messages mb-0 mt-3"
          v-if="successMessage"
          style="color: green; font-size: 14px"
        >
          {{ successMessage }}
        </p>
        <p
          class="form-messages mb-0 mt-3"
          v-if="errorMessage"
          style="color: red; font-size: 14px"
        >
          {{ errorMessage }}
        </p>
      </form>
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
        console.log("Sidebar Form Data:", this.form);

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

        console.log("Sidebar form submitted successfully:", response.data);
      } catch (error) {
        console.error("Sidebar form submission error:", error);

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

<style lang="scss" scoped></style>
