import { defineStore } from "pinia";
import axios from "axios";
import { get } from "jquery";

export const store = defineStore("team_main_store", {
  state: () => ({
    team: {
      data: [],
      current_page: 1,
      last_page: 1,
      total: 0,
      per_page: 6,
    },
    loading: false,
    error: null,
  }),

  actions: {
    async fetch_team({  page = 1 } = {}) {
      this.loading = true;
      this.error = null;

      try {
        const params = {
          page,
          limit: 6,
        };

        const response = await axios.get("properties", { params });
        console.log('clicked',response.data);

        let result = response?.data?.data;
        if (!result.data) {
          // If data is not present, fallback to array
          result = {
            data: Array.isArray(response.data) ? response.data : [],
            current_page: 1,
            last_page: 1,
            total: Array.isArray(response.data) ? response.data.length : 0,
            per_page: 6,
          };
        }
        this.team = result;
      } catch (error) {
        this.error = error;
      } finally {
        this.loading = false;
      }
    },

  },
});
