<template>
  <div class="th-hero-wrapper hero-1" id="hero">
    <div class="hero-img-shape-1">
      <div class="logo-icon-wrap">
        <a href="javascript:void(0)" class="logo-icon popup-video fs-3"
          ><i class="fa-solid fa-people-roof"></i></a>
        <CircleText />
      </div>
    </div>
    <div
      class="swiper th-slider"
      id="heroSlider1"
      data-slider-options='{"effect":"fade", "loop":true, "autoplay":true, "autoHeight": "false"}'
    >
      <div class="swiper-wrapper">
        <template v-if="banners && banners.length">
          <div
            class="swiper-slide"
            v-for="(banner, index) in banners"
            :key="index"
          >
            <div
              class="hero-inner hero-style1 bg_custom"
              :style="{
                backgroundImage: `url('/${banner.image}')`,
                backgroundSize: 'cover',
                backgroundPosition: 'center center',
                backgroundRepeat: 'no-repeat',
                minHeight: '600px',
                height: '100vh',
                maxHeight: '800px',
              }"
            >
              <div class="container">
                <div class="row gy-50 gx-40 align-items-center">
                  <div class="col-xxl-7 col-xl-7 col-lg-8">
                    <div class="hero-1-content pe-xl-4">
                      <h1
                        class="hero-title"
                        data-ani="slideinup"
                        data-ani-delay="0.2s"
                      >
                        {{ banner?.short_title }}
                        <!-- Constructing
                        <span class="title2 text-theme">Excellence</span> -->
                      </h1>
                      <p>
                        {{ banner?.short_description }}
                      </p>
                      <div
                        class="btn-group justify-content-center"
                        data-ani="slideinup"
                        data-ani-delay="0.4s"
                      >
                        <a
                          :href="banner?.permalink ? banner?.permalink : '/'"
                          class="th-btn style2 pill"
                          >Start Your Journey Today</a
                        >
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </template>
      </div>
      <div class="slider-pagination"></div>
      <div class="slider-pagination-wrapper">
        <button
          data-slider-prev="#heroSlider1"
          class="slider-arrow default slider-prev style-2"
        >
          prev
        </button>
        <div class="slider-pagination2">
          <span class="current_slide_number">
            {{ String(currentSlide).padStart(2, "0") }}
          </span>
        </div>
        <div class="line"></div>
        <button
          data-slider-next="#heroSlider1"
          class="slider-arrow default style-2"
        >
          Next
        </button>
      </div>
    </div>
  </div>
  <div class="search-area">
    <form action="https://html.themeholy.com/submit-form">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-xl-10">
            <div class="search-wrap">
              <h5>
                “Constructing Excellence” – this is not just our slogan, it is
                our promise. Every project we take on is executed with
                precision, dedication, and a commitment to surpass expectations.
              </h5>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import {
  onBeforeMount,
  onMounted,
  onBeforeUpdate,
  onUpdated,
  onBeforeUnmount,
  onUnmounted,
  onActivated,
  onDeactivated,
  onErrorCaptured,
  nextTick,
  ref,
  watch,
} from "vue";
import CircleText from "./CircleText.vue";
import { store as home_store } from "../Store/home_store";
import { mapActions, mapState } from "pinia";

export default {
  name: "HeroSlider",
  components: {
    CircleText,
  },
  setup() {
    const swiperInstance = ref(null);
    const isInitialized = ref(false);
    const currentSlide = ref(1);
    const bannersLoaded = ref(false);
    const componentMounted = ref(false);
    const initializationAttempts = ref(0);
    const maxInitializationAttempts = 5;

    const waitForSwiper = () => {
      return new Promise((resolve, reject) => {
        let attempts = 0;
        const checkSwiper = () => {
          if (window.Swiper) {
            resolve(true);
          } else if (attempts < 10) {
            attempts++;
            setTimeout(checkSwiper, 100);
          } else {
            reject(new Error("Swiper library not loaded"));
          }
        };
        checkSwiper();
      });
    };

    const initializeHeroSlider = async () => {
      // Prevent excessive initialization attempts
      if (initializationAttempts.value >= maxInitializationAttempts) {
        console.warn("Maximum initialization attempts reached");
        return;
      }

      // Prevent multiple initializations
      if (isInitialized.value && swiperInstance.value) {
        return;
      }

      // Check if component is mounted and banners are loaded
      if (!componentMounted.value || !bannersLoaded.value) {
        return;
      }

      initializationAttempts.value++;

      const heroSlider = document.querySelector("#heroSlider1");
      if (!heroSlider) {
        console.warn(
          "Hero slider element not found, attempt:",
          initializationAttempts.value
        );
        // Retry after a delay
        if (initializationAttempts.value < maxInitializationAttempts) {
          setTimeout(() => initializeHeroSlider(), 200);
        }
        return;
      }

      try {
        // Wait for Swiper library to be available
        await waitForSwiper();

        // Destroy existing instance if any
        destroySlider();

        await nextTick();

        isInitialized.value = true;

        // Add pagination and navigation
        const pagination = heroSlider.querySelector(".slider-pagination");
        const nextBtn = document.querySelector(
          '[data-slider-next="#heroSlider1"]'
        );
        const prevBtn = document.querySelector(
          '[data-slider-prev="#heroSlider1"]'
        );

        const options = {
          effect: "fade",
          loop: true,
          autoplay: {
            delay: 5000,
            disableOnInteraction: false,
          },
          speed: 800,
          fadeEffect: {
            crossFade: true,
          },
          height: 600, // Fixed height to prevent size issues
          autoHeight: false,
          initialSlide: 0,
          observer: true,
          observeParents: true,
          watchSlidesProgress: true,
          watchSlidesVisibility: true,
        };

        if (pagination) {
          options.pagination = {
            el: pagination,
            clickable: true,
            type: "bullets",
          };
        }

        if (nextBtn && prevBtn) {
          options.navigation = {
            nextEl: nextBtn,
            prevEl: prevBtn,
          };
        }

        // Initialize slider
        swiperInstance.value = new window.Swiper(heroSlider, options);

        // Update current slide number on slide change
        swiperInstance.value.on("slideChange", () => {
          currentSlide.value = swiperInstance.value.realIndex + 1;
        });

        // Reset initialization attempts on success
        initializationAttempts.value = 0;

        // console.log("Hero slider initialized successfully");
      } catch (error) {
        console.error("Error initializing hero slider:", error);
        isInitialized.value = false;

        // Retry initialization if within attempts limit
        if (initializationAttempts.value < maxInitializationAttempts) {
          setTimeout(() => initializeHeroSlider(), 500);
        }
      }
    };

    const destroySlider = () => {
      if (
        swiperInstance.value &&
        typeof swiperInstance.value.destroy === "function"
      ) {
        try {
          swiperInstance.value.destroy(true, true);
          // console.log("Hero slider destroyed");
        } catch (error) {
          console.warn("Error destroying slider:", error);
        }
      }
      swiperInstance.value = null;
      isInitialized.value = false;
      currentSlide.value = 1;
    };

    // Lifecycle hooks
    onBeforeMount(() => {
      // console.log("HeroSlider: onBeforeMount");
    });

    onMounted(() => {
      // console.log("HeroSlider: onMounted");
      componentMounted.value = true;

      // Try to initialize immediately if banners are already loaded
      nextTick(() => {
        if (bannersLoaded.value) {
          setTimeout(() => initializeHeroSlider(), 100);
        }
      });
    });

    onBeforeUpdate(() => {
      // console.log("HeroSlider: onBeforeUpdate");
    });

    onUpdated(() => {
      // console.log("HeroSlider: onUpdated");
      // Reinitialize slider after updates if needed
      nextTick(() => {
        if (
          componentMounted.value &&
          bannersLoaded.value &&
          !isInitialized.value
        ) {
          setTimeout(() => initializeHeroSlider(), 100);
        }
      });
    });

    onActivated(() => {
      // console.log("HeroSlider: onActivated");
      // Reinitialize when component is activated (keep-alive)
      if (componentMounted.value && bannersLoaded.value) {
        setTimeout(() => initializeHeroSlider(), 100);
      }
    });

    onDeactivated(() => {
      // console.log("HeroSlider: onDeactivated");
      // Destroy slider when component is deactivated
      destroySlider();
    });

    onBeforeUnmount(() => {
      // console.log("HeroSlider: onBeforeUnmount");
      componentMounted.value = false;
      destroySlider();
    });

    onUnmounted(() => {
      // console.log("HeroSlider: onUnmounted");
    });

    onErrorCaptured((error, instance, errorInfo) => {
      console.error("HeroSlider: Error captured", error, errorInfo);
      // Try to recover by reinitializing
      if (componentMounted.value && bannersLoaded.value) {
        setTimeout(() => {
          destroySlider();
          initializeHeroSlider();
        }, 1000);
      }
      return false; // Continue propagating the error
    });

    return {
      swiperInstance,
      initializeHeroSlider,
      destroySlider,
      currentSlide,
      bannersLoaded,
      componentMounted,
    };
  },

  created() {
    this.fetch_banners();
  },

  mounted() {
    // Banner loading will be handled by the watcher and lifecycle hooks
    // console.log("Component mounted, banners:", this.banners?.length || 0);
  },

  watch: {
    banners: {
      handler(newBanners, oldBanners) {
        // console.log("Banners changed:", newBanners?.length || 0);

        if (newBanners && newBanners.length > 0) {
          this.bannersLoaded = true;

          // Small delay to ensure DOM is updated
          this.$nextTick(() => {
            setTimeout(() => {
              this.initializeHeroSlider();
            }, 150);
          });
        } else {
          this.bannersLoaded = false;
          this.destroySlider();
        }
      },
      immediate: true, // Watch immediately on component creation
      deep: true, // Watch for deep changes in the banners array
    },
  },
  methods: {
    ...mapActions(home_store, ["fetch_banners"]),
  },
  computed: {
    ...mapState(home_store, ["banners"]),
  },
};
</script>

<style scoped>
/* Fix slider height and prevent overflow issues */
.th-slider {
  height: 100vh;
  max-height: 800px;
  min-height: 600px;
  overflow: hidden;
}

.swiper-slide {
  height: 100%;
  overflow: hidden;
}

.hero-inner {
  width: 100%;
  height: 100%;
  position: relative;
  overflow: hidden;
}

/* Ensure background images are properly sized */
.bg_custom {
  background-attachment: fixed !important;
}

@media (max-width: 768px) {
  .bg_custom {
    background-attachment: scroll !important;
  }

  .th-slider {
    min-height: 500px;
    max-height: 600px;
  }
}

/* Fix for swiper fade effect */
.swiper-fade .swiper-slide {
  pointer-events: none;
  transition-property: opacity;
}

.swiper-fade .swiper-slide-active {
  pointer-events: auto;
}

/* Ensure proper pagination styling */
/* .slider-pagination {
  position: absolute;
  bottom: 20px;
  left: 50%;
  transform: translateX(-50%);
  z-index: 10;
} */

.slider-pagination-wrapper {
  position: absolute;
  bottom: 40px;
  right: 50px;
  z-index: 10;
  display: flex;
  align-items: center;
  gap: 15px;
}
.current_slide_number {
  font-size: 18px;
  font-weight: bold;
  color: #fff;
}
</style>
