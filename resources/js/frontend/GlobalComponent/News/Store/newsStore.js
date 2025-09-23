import { defineStore } from "pinia";
import axios from "axios";

export const store = defineStore("news", {
  state: () => ({
    news: [],
    loading: false,
    error: null,
  }),

  actions: {
    async fetch_news() {
      this.loading = true;
      this.error = null;

      try {
        const response = await axios.get("/blogs",{
          params: { 
            random_data: 1,
            limit: 10
          }
        });

        this.news = response.data.data || response.data;
        // console.log("News fetched successfully:", this.news);
        return { success: true, data: this.news };
      } catch (error) {
        this.error = "Failed to fetch news";
        console.error("Error fetching news:", error);
        return { success: false, error };
      } finally {
        this.loading = false;
      }
    },
  },
});
