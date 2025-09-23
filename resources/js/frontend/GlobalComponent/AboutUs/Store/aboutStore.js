import { defineStore } from "pinia";
import axios from "axios";

export const store = defineStore("about_us_store", {
  state: () => ({
    about_us: null,
    loading: false,
    error: null,
  }),

  actions: {
    async fetch_about_us_data() {
      this.loading = true;
      this.error = null;

      try {
        const response = await axios.get("/about-uses",{
          params: {
            latest_data: 1,
            page_type: 'about_us'
          },
        });
        this.about_us = response.data.data || response.data;

        // console.log("About data fetched successfully:", this.about_us);
        return { success: true, data: this.about_us };
      } catch (error) {
        this.error = "Failed to fetch about data";
        console.error("Error fetching about data:", error);
        return { success: false, error };
      } finally {
        this.loading = false;
      }
    },
  },


});
