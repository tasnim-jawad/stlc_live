import { defineStore } from "pinia";
import axios from "axios";
import { get } from "jquery";

export const store = defineStore("footer_main_store", {
  state: () => ({
    website_settings: [],
    addresses: [],
    images: [],
    custom_pages: [],
    property_categories: [],
    loading: false,
    error: null,
  }),

  actions: {
    async fetch_website_settings() {
      this.loading = true;
      this.error = null;
      try {
        const res = await axios.get("website-settings", {
          params: {
            get_all: 1,
            limit: 1000,
          },
        });
        this.website_settings = res.data;
      } catch (error) {
        this.error = error;
      } finally {
        this.loading = false;
      }
    },
   

    getSettingValuesByTitle(title) {
      if (
        !this.website_settings?.data ||
        typeof this.website_settings.data !== "object"
      ) {
        return [];
      }
      // console.log("2nd title:", title);
      // Find the setting item with matching title in the object
      const settingItem = Object.values(this.website_settings.data).find(
        (item) => item.title === title
      );
      if (
        !settingItem ||
        !settingItem.setting_values ||
        !Array.isArray(settingItem.setting_values)
      ) {
        return [];
      }

      // Extract all values from setting_values array
      return settingItem.setting_values.map((setting) => setting.value);
    },

    getFirstSettingValueByTitle(title) {
      const values = this.getSettingValuesByTitle(title);
      return values.length > 0 ? values[0] : "";
    },


    async fetch_addresses() {
      this.loading = true;
      this.error = null;
      try {
        const res = await axios.get("contact-addresses", {
          params: {
            get_latest: 1,
            latest_limit: 3,
          }
        });
        this.addresses = res.data;
      } catch (error) {
        this.error = error;
      } finally {
        this.loading = false;
      }
    },
    firstAddressMapLink() {
      if (this.addresses?.data && Array.isArray(this.addresses.data) && this.addresses.data.length > 0) {
        return this.addresses.data[0].map_link || '';
      }
      return '';
    },

    async fetch_images() {
      this.loading = true;
      this.error = null;

      try {
        const params = {
          get_all: 1,
          limit: 7,
        };

        const response = await axios.get("image-galleries", { params });
        let result = response?.data?.data;
        if (!result?.data?.data) {
          // If data is not present, fallback to array
          this.images = Array.isArray(response.data.data) ? response.data.data : [];
        }

        this.images = result;
      } catch (error) {
        this.error = error;
      } finally {
        this.loading = false;
      }
    },
    async fetch_custom_pages(){
      this.loading = true;
      this.error = null;
      try {
        const res = await axios.get("custom-pages", {
          params: {
            get_all: 1,
            limit: 1000,
          },
        });
        this.custom_pages = res?.data?.data || [];
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
  },
});
