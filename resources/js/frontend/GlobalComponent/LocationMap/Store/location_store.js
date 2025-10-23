import { defineStore } from "pinia";
import axios from "axios";
import { get } from "jquery";

export const store = defineStore("location_store", {
  state: () => ({
    addresses: [],
    loading: false,
    error: null,
  }),

  actions: {
    async fetch_addresses() {
      this.loading = true;
      this.error = null;
      try {
        const res = await axios.get("contacts", {
          params: {
            get_latest: 1,
            latest_limit: 3,
          },
        });
        this.addresses = res.data;
      } catch (error) {
        this.error = error;
      } finally {
        this.loading = false;
      }
    },
    firstAddressMapLink() {
      if (
        this.addresses?.data &&
        Array.isArray(this.addresses.data) &&
        this.addresses.data.length > 0
      ) {
        return this.addresses.data[0].map_link || "";
      }
      return "";
    },
  },
});
