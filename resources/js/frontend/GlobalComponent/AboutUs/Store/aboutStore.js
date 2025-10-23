import { defineStore } from "pinia";
import axios from "axios";

export const store = defineStore("about_us_store", {
  state: () => ({
    about_us: null,
    loading: false,
    error: null,
    lastFetched: null,
  }),

  actions: {
    async fetch_about_us_data(forceRefresh = false) {
      // If we already have data and it's fresh (less than 5 minutes old), don't refetch
      if (!forceRefresh && this.about_us && this.lastFetched) {
        const fiveMinutesAgo = Date.now() - (5 * 60 * 1000);
        if (this.lastFetched > fiveMinutesAgo) {
          console.log("Using cached about us data");
          return { success: true, data: this.about_us };
        }
      }

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
        this.lastFetched = Date.now();

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

    clearData() {
      this.about_us = null;
      this.lastFetched = null;
      this.error = null;
    },
  },


});
