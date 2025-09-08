import { defineStore } from "pinia";
import axios from "axios";

export const store = defineStore("about_store", {
  state: () => ({
    aboutData: {
      title: "",
      description: "",
      features: [],
      quotation: "",
      video_url: "",
      primary_image: "",
      secondery_image: "",
    },
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
          },
        });
        this.aboutData = response.data.data || response.data;

        console.log("About data fetched successfully:", this.aboutData);
        return { success: true, data: this.aboutData };
      } catch (error) {
        this.error = "Failed to fetch about data";
        console.error("Error fetching about data:", error);
        return { success: false, error };
      } finally {
        this.loading = false;
      }
    },

    updateAboutData(data) {
      this.aboutData = { ...this.aboutData, ...data };
    },

    clearError() {
      this.error = null;
    },
  },


});
