import { defineStore } from "pinia";
import axios from "axios";

export const store = defineStore("testimonials", {
  state: () => ({
    testimonials: [],
    loading: false,
    error: null,
    swiperInstance: null,
    autoplay: true,
    slidesPerView: {
      mobile: 1,
      tablet: 2,
      desktop: 3,
    },
  }),

  actions: {
    async fetch_testimonials() {
      this.loading = true;
      this.error = null;

      try {
        const response = await axios.get("/testimonials",{
          params: { 
            get_all: 1,
            limit: 100
          }
        });

        this.testimonials = response.data.data || response.data;

        console.log("Testimonials fetched successfully:", this.testimonials);
        return { success: true, data: this.testimonials };
      } catch (error) {
        this.error = "Failed to fetch testimonials";
        console.error("Error fetching testimonials:", error);
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
        console.log("Testimonials slider destroyed");
      }
    },

    toggleAutoplay() {
      this.autoplay = !this.autoplay;
      if (this.swiperInstance) {
        if (this.autoplay) {
          this.swiperInstance.autoplay.start();
        } else {
          this.swiperInstance.autoplay.stop();
        }
      }
    },

    clearError() {
      this.error = null;
    },
  },


});
