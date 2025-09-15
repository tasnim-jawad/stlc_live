import { defineStore } from "pinia";
import axios from "axios";

export const store = defineStore("property_details_store", {
  state: () => ({
    single_property: null,
    loading: false,
    error: null,
  }),

  actions: {
    async fetch_single_property(slug) {
      this.loading = true;
      this.error = null;

      try {
        const response = await axios.get(`properties/${slug}`);
        this.single_property = response?.data?.data;
        console.log("single property", this.single_property);
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
