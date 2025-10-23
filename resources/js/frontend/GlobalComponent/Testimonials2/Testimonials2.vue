<template>
  <section
    class="testi-card-area-2 space-top overflow-hidden testimonial-isolation-wrapper"
  >
    <div
      class="shape-mockup spin d-none d-xxl-block"
      data-left="7%"
      data-top="14%"
    >
      <img src="assets/frontend/img/shape/hero-3-left-shape.png" alt="img" />
    </div>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-7">
          <div class="title-area text-center">
            <p
              class="sub-title fadeinup wow"
              data-wow-duration="1.5s"
              data-wow-delay="0.1s"
            >
              <span class="double-line"></span>Testimonials
            </p>
            <h2
              class="sec-title fadeinup wow"
              data-wow-duration="1.5s"
              data-wow-delay="0.3s"
            >
              What Clients Say About STC
            </h2>
          </div>
        </div>
      </div>
      <div class="row gy-4 justify-content-center mb-40">
        <div class="testi-card-slide">
          <div
            ref="testimonialsSlider"
            class="swiper has-shadow th-slider testimonial-slider-isolated"
            id="testiSlide1"
          >
            <div class="swiper-wrapper">
              <template
                v-for="(testimonial, index) in testimonials"
                :key="`testimonial-${index}-${testimonial.id || index}`"
              >
                <TestimonialsSingleItem :testimonial="testimonial" />
              </template>
            </div>
            <div class="slider-controller container-width">
              <button
                ref="prevBtn"
                class="slider-arrow default slider-prev testimonial-prev-btn"
                @click.stop="goToPrev"
              >
                <i class="fa fa-arrow-left"></i>
              </button>
              <div
                ref="paginationEl"
                class="slider-pagination style-2 testimonial-pagination"
              ></div>
              <button
                ref="nextBtn"
                class="slider-arrow default slider-next testimonial-next-btn"
                @click.stop="goToNext"
              >
                <i class="fa fa-arrow-right"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { mapActions, mapState } from "pinia";
import { store as testimonials_store } from "./Store/testimonialsStore.js";
import TestimonialsSingleItem from "./components/TestimonialsSingleItem.vue";

export default {
  components: {
    TestimonialsSingleItem,
  },
  data() {
    return {
      swiperInstance: null,
      isSliderReady: false,
      initRetries: 0,
      maxRetries: 5,
    };
  },
  async created() {
    await this.fetch_testimonials();
  },
  mounted() {
    // Use a more reliable initialization
    this.$nextTick(() => {
      setTimeout(() => {
        this.initSlider();
      }, 1200); // Increased delay to ensure everything is ready
    });
  },
  beforeUnmount() {
    this.cleanupSlider();
  },
  methods: {
    ...mapActions(testimonials_store, ["fetch_testimonials"]),

    initSlider() {
      // Only initialize if we have testimonials and slider isn't already ready
      if (
        this.isSliderReady ||
        !this.testimonials ||
        this.testimonials.length === 0
      ) {
        return;
      }

      const sliderEl = this.$refs.testimonialsSlider;

      if (!sliderEl) {
        if (this.initRetries < this.maxRetries) {
          this.initRetries++;
          setTimeout(() => this.initSlider(), 500);
        }
        return;
      }

      if (!window.Swiper) {
        if (this.initRetries < this.maxRetries) {
          this.initRetries++;
          setTimeout(() => this.initSlider(), 500);
        }
        return;
      }

      try {
        // Clean up any existing instance first
        this.cleanupSlider();

        // Create new Swiper instance with minimal, stable configuration
        this.swiperInstance = new window.Swiper(sliderEl, {
          // Basic settings
          loop: true,
          centeredSlides: true,
          slidesPerView: 1,
          spaceBetween: 20,
          autoHeight: false, // Set to false for stability

          // Autoplay
          autoplay: {
            delay: 4000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true,
          },

          // Navigation using refs instead of global selectors
          navigation: {
            nextEl: this.$refs.nextBtn,
            prevEl: this.$refs.prevBtn,
          },

          // Pagination
          pagination: {
            el: this.$refs.paginationEl,
            type: "progressbar",
            clickable: false,
          },

          // Stability settings
          observer: true,
          observeParents: true,
          watchOverflow: true,

          // Performance
          speed: 600,
          effect: "slide",

          // Resistance to external interference
          resistance: false,
          preventInteractionOnTransition: false,

          // Event handlers
          on: {
            init: () => {
              console.log("✅ Testimonial slider initialized");
              this.isSliderReady = true;
            },
            destroy: () => {
              console.log("🔄 Testimonial slider destroyed");
              this.isSliderReady = false;
            },
            slideChange: () => {
              // Prevent external interference during slide changes
              if (this.swiperInstance && this.swiperInstance.autoplay) {
                this.swiperInstance.autoplay.start();
              }
            },
          },
        });
      } catch (error) {
        console.error("❌ Error initializing testimonial slider:", error);
        this.isSliderReady = false;

        // Retry with exponential backoff
        if (this.initRetries < this.maxRetries) {
          this.initRetries++;
          const delay = Math.min(1000 * this.initRetries, 5000);
          setTimeout(() => this.initSlider(), delay);
        }
      }
    },

    cleanupSlider() {
      if (this.swiperInstance) {
        try {
          this.swiperInstance.destroy(true, true);
          this.swiperInstance = null;
          this.isSliderReady = false;
        } catch (error) {
          console.error("Error destroying slider:", error);
        }
      }
    },

    // Manual navigation methods
    goToNext() {
      if (this.swiperInstance && this.isSliderReady) {
        this.swiperInstance.slideNext();
      }
    },

    goToPrev() {
      if (this.swiperInstance && this.isSliderReady) {
        this.swiperInstance.slidePrev();
      }
    },

    // Reinitialize if needed
    forceReinit() {
      this.cleanupSlider();
      this.initRetries = 0;
      setTimeout(() => this.initSlider(), 300);
    },
  },
  computed: {
    ...mapState(testimonials_store, ["testimonials"]),
  },
  watch: {
    testimonials: {
      handler(newVal, oldVal) {
        // Only reinitialize if we now have data and didn't before
        if (newVal && newVal.length > 0 && (!oldVal || oldVal.length === 0)) {
          this.$nextTick(() => {
            setTimeout(() => {
              if (!this.isSliderReady) {
                this.initSlider();
              }
            }, 600);
          });
        }
      },
      deep: true,
      immediate: false,
    },
  },
};
</script>

<style lang="scss" scoped>
/* Complete isolation for testimonial component */
.testimonial-isolation-wrapper {
  /* Create a new stacking context */
  position: relative;
  z-index: 1;
  isolation: isolate;

  /* Prevent external interference */
  * {
    pointer-events: auto !important;
  }
}

.testimonial-slider-isolated {
  /* Ensure slider stability */
  position: relative !important;
  overflow: hidden !important;

  .swiper-wrapper {
    position: relative !important;
    transition-timing-function: cubic-bezier(0.25, 0.46, 0.45, 0.94) !important;
  }

  .swiper-slide {
    flex-shrink: 0 !important;
    width: 100% !important;
  }
}

/* Isolate navigation controls */
.testimonial-prev-btn,
.testimonial-next-btn {
  position: relative !important;
  z-index: 10 !important;
  pointer-events: auto !important;
  background: rgba(255, 255, 255, 0.9) !important;
  border: 1px solid rgba(0, 0, 0, 0.1) !important;
  border-radius: 50% !important;
  width: 50px !important;
  height: 50px !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  transition: all 0.3s ease !important;

  &:hover {
    background: rgba(255, 255, 255, 1) !important;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
  }

  i {
    font-size: 16px !important;
    color: #333 !important;
  }
}

/* Isolate pagination */
.testimonial-pagination {
  position: relative !important;
  z-index: 5 !important;
  margin: 20px 0 !important;

  .swiper-pagination-progressbar {
    background: rgba(0, 0, 0, 0.2) !important;
    height: 4px !important;
    border-radius: 2px !important;

    .swiper-pagination-progressbar-fill {
      background: #007bff !important;
      border-radius: 2px !important;
    }
  }
}

/* Prevent external filter interference */
.testi-card-area-2 {
  /* Reset any filter effects that might be applied globally */
  filter: none !important;

  /* Ensure proper layout */
  .container {
    position: relative !important;
  }

  .testi-card-slide {
    position: relative !important;
    z-index: 2 !important;
  }
}

/* Force override any external active states */
.testimonial-isolation-wrapper .active,
.testimonial-isolation-wrapper .tab-btn,
.testimonial-isolation-wrapper [data-filter] {
  /* Prevent external CSS from affecting this component */
  all: unset !important;
  display: initial !important;
  position: initial !important;
}
</style>
