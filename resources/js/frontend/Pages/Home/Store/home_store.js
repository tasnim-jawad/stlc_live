import { defineStore } from "pinia";
import axios from "axios";
import { get } from "jquery";

export const store = defineStore("home_main_store", {
  state: () => ({
    banners: [],
    loading: false,
    error: null,
  }),

  actions: {
    async fetch_banners() {
      this.loading = true;
      this.error = null;
      try {
        const res = await axios.get("banners", {
          params: {
            get_all: 1,
            limit: 1000,
          },
        });
        // console.log("from stor hommmmmme" ,res.data);
        this.banners = res?.data?.data ?? [];
        
      } catch (error) {
        this.error = error;
      } finally {
        this.loading = false;
      }
    },
    
  },
});
