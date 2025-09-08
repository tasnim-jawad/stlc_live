import { defineStore } from "pinia";
import axios from "axios";

export const useTeamStore = defineStore("team", {
  state: () => ({
    teamMembers: [],
    loading: false,
    error: null,
    swiperInstance: null,
    initializationAttempts: 0,
    maxAttempts: 10,
  }),

  actions: {
    async fetchTeamMembers() {
      this.loading = true;
      this.error = null;

      try {
        const response = await axios.get("/api/team-members");
        this.teamMembers = response.data.data || response.data;

        console.log("Team members fetched successfully:", this.teamMembers);
        return { success: true, data: this.teamMembers };
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
    getTeamMemberById: (state) => (id) => {
      return state.teamMembers.find((member) => member.id === id);
    },

    hasTeamMembers: (state) => state.teamMembers.length > 0,

    canRetryInitialization: (state) =>
      state.initializationAttempts < state.maxAttempts,

    teamMembersCount: (state) => state.teamMembers.length,
  },
});
