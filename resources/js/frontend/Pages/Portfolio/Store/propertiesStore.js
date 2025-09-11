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

      try {
        const params = {
          page,
          limit: 10,
          property_category_id: this.property_category_id,
        };
        if (search) {
          params.search = search;
          params.limit = 100;
        }

        const response = await axios.get("properties", { params });
        console.log("clicked", response.data);

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
        this.properties = result;
      } catch (error) {
        this.error = error;
      } finally {
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
            limit: 1000,
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
  },
});
