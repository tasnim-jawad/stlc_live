import { defineStore } from "pinia";
import axios from "axios";
import { get } from "jquery";

export const store = defineStore("properties_main_store", {
  state: () => ({
    properties: {
      data: [],
      current_page: 1,
      last_page: 1,
      total: 0,
      per_page: 10,
    },
    property_category_id: null,
    property_categories: [],
    random_properties: [],
    searched_properties: {
      data: [],
    },
    loading: false,
    error: null,
  }),

  actions: {
    set_property_category_id(id) {
      this.property_category_id = id;
      console.log("id", this.property_category_id);
      if (
        this.property_category_id === "all" ||
        this.property_category_id === null ||
        this.property_category_id === undefined ||
        this.property_category_id === ""
      ) {
        this.property_category_id = null;
        this.fetch_properties({ page: 1 });
      } else {
        this.fetch_properties({ page: 1 });
      }
    },
    async fetch_properties({ page = 1, search = null } = {}) {
      this.loading = true;
      this.error = null;

      // Add minimum loading time to show skeleton
      const startTime = Date.now();
      const minLoadingTime = 800; // 800ms minimum loading

      try {
        const params = {
          page,
          limit: 10,
          property_category_id: this.property_category_id,
        };
        if (search) {
          params.search = search;
          params.limit = 10;
        }

        const response = await axios.get("properties", { params });
        console.log("API Response:", response.data);
        console.log("Requested page:", page);

        let result = response?.data?.data;
        if (!result.data) {
          // If data is not present, fallback to array
          result = {
            data: Array.isArray(response.data) ? response.data : [],
            current_page: page, // Use the requested page, not hardcoded 1
            last_page: 1,
            total: Array.isArray(response.data) ? response.data.length : 0,
            per_page: 6,
          };
        } else {
          // Ensure current_page matches the requested page if API doesn't return it correctly
          result.current_page = result.current_page || page;
        }

        console.log("Setting properties:", result);
        this.properties = result;
      } catch (error) {
        this.error = error;
      } finally {
        // Ensure minimum loading time for better skeleton visibility
        const elapsedTime = Date.now() - startTime;
        const remainingTime = Math.max(0, minLoadingTime - elapsedTime);

        if (remainingTime > 0) {
          await new Promise((resolve) => setTimeout(resolve, remainingTime));
        }

        this.loading = false;
      }
    },
    async fetch_property_categories() {
      this.loading = true;
      this.error = null;

      try {
        const response = await axios.get("property-categories", {
          params: {
            get_all: 1,
            limit: 10,
          },
        });

        this.property_categories = response?.data;
      } catch (error) {
        this.error = error;
      } finally {
        this.loading = false;
      }
    },
    async fetch_random_properties() {
      this.loading = true;
      this.error = null;

      try {
        const response = await axios.get("properties", {
          params: {
            random_data: 1,
            limit: 5,
          },
        });

        this.random_properties = response?.data;
      } catch (error) {
        this.error = error;
      } finally {
        this.loading = false;
      }
    },

    async search_properties(searchTerm) {
      // Don't set loading to true for search to avoid disrupting the main view
      this.error = null;

      try {
        const params = {
          search: searchTerm,
          limit: 100,
          fields: [
            "property_name",
            "slug",
            "property_address",
            "price",
            "property_category_id",
          ],
        };

        const response = await axios.get("/properties", { params });
        let result = response?.data?.data;

        // Ensure we have a proper structure
        if (!result) {
          this.searched_properties = { data: [] };
        } else {
          this.searched_properties = result;
        }
        
      } catch (error) {
        this.error = error;
        this.searched_properties = { data: [] };
      }
    },
  },
});
