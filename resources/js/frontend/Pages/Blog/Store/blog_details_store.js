import { defineStore } from "pinia";
import axios from "axios";

export const store = defineStore("blog_details_store", {
  state: () => ({
    single_blog: null,
    loading: false,
    error: null,
  }),

  actions: {
    async fetch_single_blog(slug) {
      this.loading = true;
      this.error = null;

      try {
        const response = await axios.get(`blogs/${slug}`);
        this.single_blog = response?.data?.data;
        console.log("single blog", this.single_blog);
      } catch (error) {
        this.error = error;
      } finally {
        this.loading = false;
      }
    },

    getTagsArray(tagsString) {
      if (!tagsString) return [];
      return tagsString
        .split(",")
        .map((tag) => tag.trim())
        .filter((tag) => tag.length > 0);
    },
  },
});
