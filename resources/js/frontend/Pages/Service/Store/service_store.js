import { defineStore } from "pinia";
import axios from "axios";
import { get } from "jquery";

export const store = defineStore("service_main_store", {
  state: () => ({
    services: {
      data: [],
      current_page: 1,
      last_page: 1,
      total: 0,
      per_page: 6,
    },
    single_service: null,
    loading: false,
    error: null,
  }),

  actions: {
    async fetch_services({ page = 1 } = {}) {
      this.loading = true;
      this.error = null;

      try {
        const params = {
          page,
          limit: 9,
        };

        const response = await axios.get("our-services?get_all=true");
        console.log("clicked", response.data);

        let result = response?.data?.data;
        if (!result.data) {
          // If data is not present, fallback to array
          result = {
            data: Array.isArray(response.data) ? response.data : [],
            current_page: 1,
            last_page: 1,
            total: Array.isArray(response.data) ? response.data.length : 0,
            per_page: 9,
          };
        }
        this.services = result;
      } catch (error) {
        this.error = error;
      } finally {
        this.loading = false;
      }
    },
    async fetch_single_service(slug) {
      this.loading = true;
      this.error = null;

      try {
        const response = await axios.get(`our-services/${slug}`);
        this.single_service = response?.data?.data;
        console.log("single service", this.single_service);
      } catch (error) {
        this.error = error;
      } finally {
        this.loading = false;
      }
    },
  },
});
