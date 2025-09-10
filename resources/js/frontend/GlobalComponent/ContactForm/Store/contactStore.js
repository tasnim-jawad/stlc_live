import { defineStore } from "pinia";
import axios from "axios";

export const useContactStore = defineStore("contact", {
  state: () => ({
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
    serviceTypes: [
      { value: "buying", label: "Buying" },
      { value: "selling", label: "Selling" },
      { value: "renting", label: "Renting" },
      { value: "consultation", label: "Consultation" },
    ],
  }),

  actions: {
    resetForm() {
      this.form = {
        name: "",
        email: "",
        service_types: "",
        phone_number: "",
        message: "",
      };
      this.errors = {};
      this.successMessage = "";
      this.errorMessage = "";
    },

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

        if (window.s_alert) {
          window.s_alert(successMsg, "success");
        }

        // Set the success message for template display
        this.successMessage = successMsg;

        // Clear success message after 5 seconds
        setTimeout(() => {
          this.successMessage = "";
        }, 5000);

        // Reset form
        this.resetForm();

        console.log("Form submitted successfully:", response.data);
        return { success: true, data: response.data };
      } catch (error) {
        console.error("Form submission error:", error);

        if (error.response && error.response.status === 422) {
          this.errors = error.response.data.errors;

          // Show validation errors using SweetAlert
          let errorMessages = Object.values(this.errors).flat().join("<br>");
          if (window.s_warning) {
            window.s_warning(errorMessages);
          }
        } else {
          this.errorMessage = "An error occurred. Please try again.";
          if (window.s_error) {
            window.s_error("An error occurred. Please try again.");
          }
        }

        return { success: false, error };
      } finally {
        this.loading = false;
      }
    },

    async fetchServiceTypes() {
      try {
        const response = await axios.get("/service-types");
        this.serviceTypes = response.data;
      } catch (error) {
        console.error("Error fetching service types:", error);
      }
    },

    setFormField(field, value) {
      this.form[field] = value;
    },

    clearErrors() {
      this.errors = {};
    },
  },

  getters: {
    hasErrors: (state) => Object.keys(state.errors).length > 0,
    isFormValid: (state) => {
      return state.form.name && state.form.email && state.form.service_types;
    },
  },
});
