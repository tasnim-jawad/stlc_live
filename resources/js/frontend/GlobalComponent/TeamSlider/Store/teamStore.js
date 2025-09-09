import { defineStore } from "pinia";
import axios from "axios";

export const store = defineStore("team", {
  state: () => ({
    team_members: [],
    loading: false,
    error: null,
    swiperInstance: null,
    initializationAttempts: 0,
    maxAttempts: 10,
  }),

  actions: {
    async fetch_team_members() {
      this.loading = true;
      this.error = null;

      try {
        const response = await axios.get("our-teams",{
          params: { 
            get_all: 1,
            limmit: 999
          }
        });

        this.team_members = response.data.data || response.data;

        console.log("Team members fetched successfully:", this.team_members);
        return { success: true, data: this.team_members };
      } catch (error) {
        this.error = "Failed to fetch team members";
        console.error("Error fetching team members:", error);
        return { success: false, error };
      } finally {
        this.loading = false;
      }
    },

    setSwiperInstance(instance) {
      this.swiperInstance = instance;
    },

    destroySwiper() {
      if (
        this.swiperInstance &&
        typeof this.swiperInstance.destroy === "function"
      ) {
        this.swiperInstance.destroy(true, true);
        this.swiperInstance = null;
        console.log("Team slider destroyed");
      }
    },

    resetInitializationAttempts() {
      this.initializationAttempts = 0;
    },

    incrementInitializationAttempts() {
      this.initializationAttempts++;
    },

    clearError() {
      this.error = null;
    },
  },

  getters: {
    canRetryInitialization: (state) =>
      state.initializationAttempts < state.maxAttempts,
  },
});
