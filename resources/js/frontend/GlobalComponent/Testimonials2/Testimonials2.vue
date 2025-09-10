<template>
  <section class="testi-card-area-2 space-top overflow-hidden">
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
              What Clients Say About Pillar
            </h2>
          </div>
        </div>
      </div>
      <div class="row gy-4 justify-content-center mb-40">
        <div class="testi-card-slide">
          <div
            class="swiper has-shadow th-slider"
            id="testiSlide1"
            data-slider-options='{"centeredSlides":true,"paginationType": "progressbar","loop":true,"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"1"},"992":{"slidesPerView":"1"},"1200":{"slidesPerView":"1"}}}'
          >
            <div class="swiper-wrapper">
              <template v-for="(testimonial , index) in testimonials" :key="index">
                <TestimonialsSingleItem :testimonial="testimonial" />
              </template>
            </div>
            <div class="slider-controller container-width">
              <button
                data-slider-prev="#testiSlide1"
                class="slider-arrow default slider-prev"
              >
                <i class="fa fa-arrow-left"></i>
              </button>
              <div
                class="slider-pagination style-2"
                data-slider-id="#testiSlide1"
              ></div>
              <button
                data-slider-next="#testiSlide1"
                class="slider-arrow default slider-next"
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
import { mapActions , mapState} from "pinia";
import { onMounted, onUpdated, nextTick, ref, onBeforeUnmount } from "vue";
import { store as testimonials_store } from "./Store/testimonialsStore.js";
import TestimonialsSingleItem from "./components/TestimonialsSingleItem.vue";

export default {
  components: {
    TestimonialsSingleItem
  },
  setup() {
    const swiperInstance = ref(null);
    const initializationAttempts = ref(0);
    const maxAttempts = 10;

    const initializeTestiSlider = () => {
      const testiSlider = document.querySelector("#testiSlide1");

      // If slider already exists, don't reinitialize
      if (swiperInstance.value) {
        return;
      }

      if (!testiSlider) {
        console.warn("Testimonials slider element not found");
        return;
      }

      if (!window.Swiper) {
        initializationAttempts.value++;
        if (initializationAttempts.value < maxAttempts) {
          // Wait for Swiper to load and try again
          setTimeout(() => initializeTestiSlider(), 200);
        } else {
          console.error("Swiper library not available after multiple attempts");
        }
        return;
      }

      try {
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

        // Add navigation
        const nextBtn = document.querySelector(
          '[data-slider-next="#testiSlide1"]'
        );
        const prevBtn = document.querySelector(
          '[data-slider-prev="#testiSlide1"]'
        );
        if (nextBtn && prevBtn) {
          options.navigation = {
            nextEl: nextBtn,
            prevEl: prevBtn,
          };
        }

        // Add pagination
        const paginationEl = document.querySelector(
          '[data-slider-id="#testiSlide1"]'
        );
        if (paginationEl) {
          options.pagination = {
            el: paginationEl,
            type: options.paginationType || "progressbar",
          };
        }

        // Initialize slider with merged options
        swiperInstance.value = new window.Swiper(testiSlider, {
          autoplay: {
            delay: 3000,
            disableOnInteraction: false,
          },
          autoHeight: true,
          loop: true,
          spaceBetween: 20,
          ...options,
        });

        console.log("Testimonials slider initialized successfully");
      } catch (error) {
        console.error("Error initializing testimonials slider:", error);
        // Retry on error
        initializationAttempts.value++;
        if (initializationAttempts.value < maxAttempts) {
          setTimeout(() => initializeTestiSlider(), 500);
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
        console.log("Testimonials slider destroyed");
      }
    };

    // Initialize on mount
    onMounted(async () => {
      await nextTick();
      // Multiple initialization attempts with different delays
      setTimeout(() => initializeTestiSlider(), 100);
      setTimeout(() => initializeTestiSlider(), 300);
      setTimeout(() => initializeTestiSlider(), 600);
    });

    // Reinitialize on updates if needed
    onUpdated(async () => {
      await nextTick();
      if (!swiperInstance.value) {
        setTimeout(() => initializeTestiSlider(), 100);
      }
    });

    // Cleanup on unmount
    onBeforeUnmount(() => {
      destroySlider();
    });

    return {
      swiperInstance,
    };
  },
  methods:{
    ...mapActions(testimonials_store, [
      "fetch_testimonials",
    ])
  },  
  created: async function () {
    await this.fetch_testimonials();
    console.log("Testimonials:", this.testimonials);
  },
  computed: {
    ...mapState(testimonials_store, ["testimonials"]),
  },
};
</script>

<style lang="scss" scoped></style>
