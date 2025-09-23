import { defineStore } from "pinia";
import axios from "axios";
import { get } from "jquery";

export const store = defineStore("contact_main_store", {
  state: () => ({
    website_settings: [],
    addresses: [],
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
  },
});
