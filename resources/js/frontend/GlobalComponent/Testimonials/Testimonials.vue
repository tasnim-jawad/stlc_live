<template>
  <section
    class="testi-card-area-1 bg-smoke space bg-smoke overflow-hidden"
    data-bg-src="/assets/frontend/img/bg/property-values-bg-shape.png"
  >
    <div class="container-fluid">
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
              What Our Client Says
            </h2>
          </div>
        </div>
      </div>
      <div class="row gy-4 justify-content-center">
        <div class="testi-card-slide">
          <div
            class="swiper has-shadow th-slider"
            id="testiSlide1"
            data-slider-options='{"paginationType": "progressbar","loop":true,"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"1"},"992":{"slidesPerView":"2"},"1200":{"slidesPerView":"2"}, "1300":{"slidesPerView":"2.6"},"1500":{"slidesPerView":"3.6"}},"centeredSlides":false}'
          >
            <div class="swiper-wrapper">
              <template
                v-for="(testimonial, index) in testimonials"
                :key="index"
              >
                <TestimonialsSingleItem :testimonial="testimonial" />
              </template>
            </div>
            <div class="slider-controller container-width">
              <button
                data-slider-prev="#testiSlide1"
                class="slider-arrow default slider-prev"
              >
                <i class="fa-solid fa-arrow-left"></i>
              </button>
              <div
                class="slider-pagination"
                data-slider-id="#testiSlide1"
              ></div>
              <button
                data-slider-next="#testiSlide1"
                class="slider-arrow default slider-next"
              >
                <i class="fa-solid fa-arrow-right"></i>
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
import {
  onMounted,
  onUpdated,
  nextTick,
  ref,
  onBeforeUnmount,
  watch,
} from "vue";
import { store as testimonialsStore } from "./Store/testimonialsStore.js";
import TestimonialsSingleItem from "./components/TestimonialsSingleItem.vue";
export default {
  components: {
    TestimonialsSingleItem,
  },
  setup() {
    const swiperInstance = ref(null);
    const initializationAttempts = ref(0);
    const maxAttempts = 10;
    const isInitializing = ref(false);

    const initializeTestimonialSlider = () => {
      // Prevent multiple simultaneous initialization attempts
      if (isInitializing.value) {
        return;
      }

      const testiSlider = document.querySelector("#testiSlide1");

      // If slider already exists, don't reinitialize
      if (swiperInstance.value) {
        return;
      }

      if (!testiSlider) {
        console.warn("Testimonial slider element not found");
        return;
      }

      if (!window.Swiper) {
        initializationAttempts.value++;
        if (initializationAttempts.value < maxAttempts) {
          setTimeout(() => initializeTestimonialSlider(), 200);
        } else {
          console.error("Swiper library not available after multiple attempts");
        }
        return;
      }

      try {
        isInitializing.value = true;

        // Parse data-slider-options if present
        let options = {};
        const optionsAttr = testiSlider.getAttribute("data-slider-options");
        if (optionsAttr) {
          options = JSON.parse(optionsAttr);
        }

        // Normalize string values to proper types
        const normalizeOptions = (obj) => {
          for (const key in obj) {
            if (typeof obj[key] === "string") {
              if (obj[key] === "true") obj[key] = true;
              else if (obj[key] === "false") obj[key] = false;
              else if (!isNaN(obj[key]) && obj[key] !== "")
                obj[key] = Number(obj[key]);
            } else if (typeof obj[key] === "object" && obj[key] !== null) {
              normalizeOptions(obj[key]);
            }
          }
        };
        normalizeOptions(options);

        // Add navigation and pagination
        const nextBtn = document.querySelector(
          '[data-slider-next="#testiSlide1"]'
        );
        const prevBtn = document.querySelector(
          '[data-slider-prev="#testiSlide1"]'
        );
        const pagination = document.querySelector(
          '[data-slider-id="#testiSlide1"]'
        );

        if (nextBtn && prevBtn) {
          options.navigation = {
            nextEl: nextBtn,
            prevEl: prevBtn,
          };
        }

        if (pagination) {
          options.pagination = {
            el: pagination,
            type: "progressbar",
            clickable: true,
          };
        }

        // Initialize slider with proper configuration
        const swiperConfig = {
          // Ensure options from data attribute are applied first
          ...options,
          // Core settings
          direction: "horizontal",
          loop: true,
          slidesPerView: options.breakpoints ? "auto" : 1,
          autoplay: {
            delay: 4000,
            disableOnInteraction: false,
            reverseDirection: false,
          },
          spaceBetween: 20,
          speed: 600,
          // Observer settings
          observer: true,
          observeParents: true,
          observeSlideChildren: true,
          watchOverflow: true,
          watchSlidesProgress: true,
          // Touch/Mouse interaction settings
          grabCursor: true,
          touchRatio: 1,
          touchAngle: 45,
          simulateTouch: true,
          allowTouchMove: true,
          shortSwipes: true,
          longSwipes: true,
          longSwipesRatio: 0.5,
          longSwipesMs: 300,
          followFinger: true,
          threshold: 5,
          touchMoveStopPropagation: false,
          touchStartPreventDefault: false,
          touchStartForcePreventDefault: false,
          touchReleaseOnEdges: false,
          preventInteractionOnTransition: false,
          // Freemode disabled for proper snapping
          freeMode: false,
          // Resistance settings
          resistance: true,
          resistanceRatio: 0.85,
          // Loop settings - critical for bidirectional sliding
          loopedSlides: null,
          loopAdditionalSlides: 2,
          loopPreventsSlide: false,
          loopFillGroupWithBlank: false,
          // Slide settings
          centeredSlides: false,
          slidesOffsetBefore: 0,
          slidesOffsetAfter: 0,
          normalizeSlideIndex: true,
          // Effect
          effect: "slide",
        };

        swiperInstance.value = new window.Swiper(testiSlider, swiperConfig);

        // Force update and recalculate after initialization
        if (swiperInstance.value) {
          setTimeout(() => {
            if (swiperInstance.value) {
              swiperInstance.value.update();
              // Force loop recreation to fix directional issues
              if (
                swiperInstance.value.loopDestroy &&
                swiperInstance.value.loopCreate
              ) {
                swiperInstance.value.loopDestroy();
                swiperInstance.value.loopCreate();
              }
              swiperInstance.value.update();
            }
          }, 100);

          // Additional update after a longer delay
          setTimeout(() => {
            if (swiperInstance.value && swiperInstance.value.update) {
              swiperInstance.value.update();
            }
          }, 500);
        }

        console.log("Testimonial slider initialized successfully", {
          slides: swiperInstance.value.slides?.length,
          loop: swiperInstance.value.params?.loop,
        });
        isInitializing.value = false;
      } catch (error) {
        console.error("Error initializing testimonial slider:", error);
        isInitializing.value = false;
        // Retry on error
        initializationAttempts.value++;
        if (initializationAttempts.value < maxAttempts) {
          setTimeout(() => initializeTestimonialSlider(), 500);
        }
      }
    };

    const destroySlider = () => {
      if (
        swiperInstance.value &&
        typeof swiperInstance.value.destroy === "function"
      ) {
        swiperInstance.value.destroy(true, true);
        swiperInstance.value = null;
        console.log("Testimonial slider destroyed");
      }
    };

    const reinitializeSlider = async () => {
      destroySlider();
      await nextTick();
      initializationAttempts.value = 0;
      setTimeout(() => initializeTestimonialSlider(), 100);
    };

    // Initialize on mount
    onMounted(async () => {
      console.log("Testimonials component mounted");
      await nextTick();
      // Multiple initialization attempts with increasing delays
      setTimeout(() => initializeTestimonialSlider(), 100);
      setTimeout(() => initializeTestimonialSlider(), 300);
      setTimeout(() => initializeTestimonialSlider(), 600);
      setTimeout(() => initializeTestimonialSlider(), 1000);
    });

    // Reinitialize on updates if needed
    onUpdated(async () => {
      console.log("Testimonials component updated");
      await nextTick();
      if (!swiperInstance.value) {
        setTimeout(() => initializeTestimonialSlider(), 100);
      } else {
        // Update the slider if it exists
        if (swiperInstance.value.update) {
          swiperInstance.value.update();
        }
      }
    });

    // Cleanup on unmount
    onBeforeUnmount(() => {
      console.log("Testimonials component about to unmount");
      destroySlider();
    });

    return {
      swiperInstance,
      reinitializeSlider,
    };
  },
  created: async function () {
    await this.fetch_testimonials();
    // console.log("Testimonials:", this.testimonials);
  },
  mounted() {
    // Watch for testimonials data changes
    watch(
      () => this.testimonials,
      async (newVal, oldVal) => {
        if (newVal && newVal.length > 0 && (!oldVal || oldVal.length === 0)) {
          console.log("Testimonials data loaded, reinitializing slider");
          await nextTick();
          if (this.reinitializeSlider) {
            this.reinitializeSlider();
          }
        }
      },
      { immediate: false, deep: true }
    );
  },
  methods: {
    ...mapActions(testimonialsStore, ["fetch_testimonials"]),
  },
  computed: {
    ...mapState(testimonialsStore, ["testimonials"]),
  },
};
</script>

<style lang="scss" scoped></style>
