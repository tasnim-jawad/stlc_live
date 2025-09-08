import { defineStore } from "pinia";
import axios from "axios";

export const usePropertiesStore = defineStore("properties", {
  state: () => ({
    properties: [],
    loading: false,
    error: null,
    pagination: {
      current_page: 1,
      total: 0,
      per_page: 10,
      last_page: 1,
    },
    filters: {
      category: "",
      price_range: "",
      location: "",
      status: "all",
    },
  }),

  actions: {
    async fetchProperties(page = 1) {
      this.loading = true;
      this.error = null;

      try {
        const params = {
          page,
          per_page: this.pagination.per_page,
          ...this.filters,
        };

        const response = await axios.get("/api/properties", { params });

        this.properties = response.data.data || response.data;

        if (response.data.meta) {
          this.pagination = {
            ...this.pagination,
            ...response.data.meta,
          };
        }

        console.log("Properties fetched successfully:", this.properties);
        return { success: true, data: this.properties };
      } catch (error) {
        this.error = "Failed to fetch properties";
        console.error("Error fetching properties:", error);
        return { success: false, error };
      } finally {
        this.loading = false;
      }
    },

    async fetchPopularProperties(limit = 6) {
      this.loading = true;
      this.error = null;

      try {
        const response = await axios.get(
          `/api/properties/popular?limit=${limit}`
        );
        this.properties = response.data.data || response.data;

        console.log(
          "Popular properties fetched successfully:",
          this.properties
        );
        return { success: true, data: this.properties };
      } catch (error) {
        this.error = "Failed to fetch popular properties";
        console.error("Error fetching popular properties:", error);
        return { success: false, error };
      } finally {
        this.loading = false;
      }
    },

    setFilter(key, value) {
      this.filters[key] = value;
    },

    resetFilters() {
      this.filters = {
        category: "",
        price_range: "",
        location: "",
        status: "all",
      };
    },

    clearError() {
      this.error = null;
    },

    setPage(page) {
      this.pagination.current_page = page;
    },
  },

  getters: {
    getPropertyById: (state) => (id) => {
      return state.properties.find((property) => property.id === id);
    },

    hasProperties: (state) => state.properties.length > 0,

    propertiesCount: (state) => state.properties.length,

    hasNextPage: (state) =>
      state.pagination.current_page < state.pagination.last_page,

    hasPrevPage: (state) => state.pagination.current_page > 1,

    filteredPropertiesCount: (state) =>
      state.pagination.total || state.properties.length,
  },
});
