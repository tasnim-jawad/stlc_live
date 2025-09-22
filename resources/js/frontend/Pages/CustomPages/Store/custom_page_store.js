import { defineStore } from "pinia";
import axios from "axios";

export const store = defineStore("custom_page_store", {
  state: () => ({
    custom_page_data: null,
    loading: false,
    error: null,
  }),

  actions: {
    async fetch_custom_page(permalink) {
      this.loading = true;
      this.error = null;
      console.log("Fetching custom page with permalink:", permalink);

      try {
        const response = await axios.get("custom-pages", {
          params: { permalink: permalink },
        });
        this.custom_page_data = response?.data?.data;
        console.log("custom page", this.custom_page_data);
      } catch (error) {
        this.error = error;
      } finally {
        this.loading = false;
      }
    },
  },
});
