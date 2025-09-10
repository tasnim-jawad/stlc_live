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
            data-slider-options='{"centeredSlides":true,"paginationType": "progressbar","loop":true,"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"1"},"992":{"slidesPerView":"2"},"1200":{"slidesPerView":"2"}, "1300":{"slidesPerView":"2.6"},"1500":{"slidesPerView":"3.6"}}}'
          >
            <div class="swiper-wrapper">
              <template v-for="(testimonial, index) in testimonials" :key="index">
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
                data-slider-id="#testiSlider1"
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
import { onMounted, onUpdated, nextTick, ref, onBeforeUnmount } from "vue";
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

    const initializeTestimonialSlider = () => {
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
          '[data-slider-id="#testiSlider1"]'
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

        // Initialize slider
        swiperInstance.value = new window.Swiper(testiSlider, {
          centeredSlides: true,
          loop: true,
          autoplay: {
            delay: 4000,
            disableOnInteraction: false,
          },
          spaceBetween: 20,
          ...options,
        });

        console.log("Testimonial slider initialized successfully");
      } catch (error) {
        console.error("Error initializing testimonial slider:", error);
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

    // Initialize on mount
    onMounted(async () => {
      await nextTick();
      setTimeout(() => initializeTestimonialSlider(), 100);
      setTimeout(() => initializeTestimonialSlider(), 300);
      setTimeout(() => initializeTestimonialSlider(), 600);
    });

    // Reinitialize on updates if needed
    onUpdated(async () => {
      await nextTick();
      if (!swiperInstance.value) {
        setTimeout(() => initializeTestimonialSlider(), 100);
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
  created: async function () {
    await this.fetch_testimonials();
    console.log("Testimonials:", this.testimonials);
  },

  methods: {
    ...mapActions(testimonialsStore, [
      "fetch_testimonials",
    ]),
  },
  computed: {
    ...mapState(testimonialsStore, [
      "testimonials",
    ]),
  },
};
</script>

<style lang="scss" scoped></style>
