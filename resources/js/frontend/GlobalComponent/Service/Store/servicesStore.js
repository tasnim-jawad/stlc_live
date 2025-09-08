import { defineStore } from "pinia";
import axios from "axios";

export const useServicesStore = defineStore("services", {
  state: () => ({
    services: [],
    loading: false,
    error: null,
    categories: [],
    selectedCategory: "all",
  }),

  actions: {
    async fetchServices() {
      this.loading = true;
      this.error = null;

      try {
        const response = await axios.get("/api/services");
        this.services = response.data.data || response.data;

        console.log("Services fetched successfully:", this.services);
        return { success: true, data: this.services };
      } catch (error) {
        this.error = "Failed to fetch services";
        console.error("Error fetching services:", error);
        return { success: false, error };
      } finally {
        this.loading = false;
      }
    },

    async fetchServiceCategories() {
      try {
        const response = await axios.get("/api/services/categories");
        this.categories = response.data.data || response.data;

        console.log(
          "Service categories fetched successfully:",
          this.categories
        );
        return { success: true, data: this.categories };
      } catch (error) {
        console.error("Error fetching service categories:", error);
        return { success: false, error };
      }
    },

    setCategory(category) {
      this.selectedCategory = category;
    },

    clearError() {
      this.error = null;
    },
  },

  getters: {
    getServiceById: (state) => (id) => {
      return state.services.find((service) => service.id === id);
    },

    hasServices: (state) => state.services.length > 0,

    servicesCount: (state) => state.services.length,

    filteredServices: (state) => {
      if (state.selectedCategory === "all") {
        return state.services;
      }
      return state.services.filter(
        (service) => service.category === state.selectedCategory
      );
    },

    featuredServices: (state) => {
      return state.services.filter((service) => service.is_featured);
    },
  },
});
