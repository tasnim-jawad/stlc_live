import { defineStore } from "pinia";
import axios from "axios";

export const useTestimonialsStore = defineStore("testimonials", {
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
    async fetchTestimonials() {
      this.loading = true;
      this.error = null;

      try {
        const response = await axios.get("/api/testimonials");
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

    async fetchFeaturedTestimonials(limit = 6) {
      this.loading = true;
      this.error = null;

      try {
        const response = await axios.get(
          `/api/testimonials/featured?limit=${limit}`
        );
        this.testimonials = response.data.data || response.data;

        console.log(
          "Featured testimonials fetched successfully:",
          this.testimonials
        );
        return { success: true, data: this.testimonials };
      } catch (error) {
        this.error = "Failed to fetch featured testimonials";
        console.error("Error fetching featured testimonials:", error);
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

  getters: {
    getTestimonialById: (state) => (id) => {
      return state.testimonials.find((testimonial) => testimonial.id === id);
    },

    hasTestimonials: (state) => state.testimonials.length > 0,

    testimonialsCount: (state) => state.testimonials.length,

    featuredTestimonials: (state) => {
      return state.testimonials.filter(
        (testimonial) => testimonial.is_featured
      );
    },

    ratingAverage: (state) => {
      if (state.testimonials.length === 0) return 0;

      const total = state.testimonials.reduce((sum, testimonial) => {
        return sum + (testimonial.rating || 5);
      }, 0);

      return (total / state.testimonials.length).toFixed(1);
    },
  },
});
