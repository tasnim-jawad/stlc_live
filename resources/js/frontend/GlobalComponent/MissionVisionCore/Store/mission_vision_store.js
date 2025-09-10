import { defineStore } from "pinia";
import axios from "axios";

export const store = defineStore("mission_vision_store", {
  state: () => ({
    our_mission: null,
    our_vision: null,
    core_values: null,
    loading: false,
    error: null,
  }),

  actions: {
    async fetchData(type) {
      this.loading = true;
      this.error = null;

      try {
        const response = await axios.get("/about-uses", {
          params: {
            latest_data: 1,
            page_type: type,
          },
        });

        this[type] = response.data.data;

        return { success: true, data: this[type] };
      } catch (error) {
        this.error = `Failed to fetch ${type} data`;
        console.error(`Error fetching ${type} data:`, error);
        return { success: false, error };
      } finally {
        this.loading = false;
      }
    },

    async fetch_mission() {
      return this.fetchData("our_mission");
    },

    async fetch_vision() {
      return this.fetchData("our_vision");
    },

    async fetch_core_values() {
      return this.fetchData("core_values");
    },
  },
});
