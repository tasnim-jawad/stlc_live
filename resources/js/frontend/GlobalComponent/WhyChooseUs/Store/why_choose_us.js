import { defineStore } from "pinia";
import axios from "axios";

export const store = defineStore("why_choose_us_store", {
  state: () => ({
    services: [],
    loading: false,
    error: null,
    swiperInstance: null,
    initializationAttempts: 0,
    maxAttempts: 10,
  }),

  actions: {
    async fetch_services() {
      this.loading = true;
      this.error = null;

      try {
        const response = await axios.get("/our-services", {
          params: {
            get_all: 1,
            limit: 6,
          },
        });

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
  },
});
