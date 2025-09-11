import { defineStore } from "pinia";
import axios from "axios";

export const store = defineStore("at_a_glance", {
  state: () => ({
    at_a_glances: [],
    loading: false,
    error: null,
  }),

  actions: {
    async fetch_at_a_glance() {
      this.loading = true;
      this.error = null;

      try {
        const response = await axios.get("at-a-glances", {
          params: {
            get_all: 1,
            limit: 4,
          },
        });

        this.at_a_glances = response.data.data || response.data;
        return { success: true, data: this.at_a_glances };
      } catch (error) {
        this.error = "Failed to fetch at a glance";
        console.error("Error fetching at a glance:", error);
        return { success: false, error };
      } finally {
        this.loading = false;
      }
    },
  },
});
