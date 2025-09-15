<template>
  <div class="slider-area property-slider1">
    <div class="swiper th-slider panoramaSlide2 mb-4" id="panoramaSlide2">
      <div class="swiper-wrapper">
        <div
          class="swiper-slide"
          v-for="(image, index) in banner_images"
          :key="index"
        >
          <div
            class="property-slider-img propery-single-slide"
            :id="`panorama${index + 1}`"
          >
            <img :src="'/' + image" alt="img" />
          </div>
        </div>
      </div>
    </div>
    <div class="swiper th-slider property-thumb-slider slider-tab">
      <div class="swiper-wrapper">
        <div
          class="swiper-slide"
          data-bg-src=""
          v-for="(image, index) in banner_images"
          :key="index"
        >
          <div class="tab-btn property-slider-img">
            <img :src="'/' + image" alt="img" />
          </div>
        </div>
      </div>
    </div>
    <button data-slider-prev="#panoramaSlide2" class="slider-arrow slider-prev">
      <i class="fa fa-arrow-left"></i>
    </button>
    <button data-slider-next="#panoramaSlide2" class="slider-arrow slider-next">
      <i class="fa fa-arrow-right"></i>
    </button>
  </div>
</template>

<script>
export default {
  props: {
    banner_images: {
      type: Array,
      required: true,
    },
  },
  data() {
    return {
      mainSlider: null,
      thumbSlider: null,
      isSliderInitialized: false,
      initTimeout: null,
    };
  },
  mounted() {
    this.initializeSliderSafely();
  },
  updated() {
    // Reinitialize slider if banner_images prop changes
    if (
      !this.isSliderInitialized &&
      this.banner_images &&
      this.banner_images.length > 0
    ) {
      this.initializeSliderSafely();
    }
  },
  beforeUnmount() {
    this.destroySliders();
  },
  beforeDestroy() {
    // For Vue 2 compatibility
    this.destroySliders();
  },
  watch: {
    banner_images: {
      handler(newImages, oldImages) {
        if (
          newImages &&
          newImages.length > 0 &&
          JSON.stringify(newImages) !== JSON.stringify(oldImages)
        ) {
          this.reinitializeSliders();
        }
      },
      deep: true,
    },
  },
  methods: {
    initializeSliderSafely() {
      // Clear any existing timeout
      if (this.initTimeout) {
        clearTimeout(this.initTimeout);
      }

      // Destroy existing sliders first
      this.destroySliders();

      this.$nextTick(() => {
        this.initTimeout = setTimeout(() => {
          if (this.canInitializeSlider()) {
            this.initializeSlider();
          } else {
            // Retry after a longer delay
            this.initTimeout = setTimeout(() => {
              if (this.canInitializeSlider()) {
                this.initializeSlider();
              }
            }, 500);
          }
        }, 200);
      });
    },

    canInitializeSlider() {
      return (
        window.Swiper &&
        this.banner_images &&
        this.banner_images.length > 0 &&
        document.getElementById("panoramaSlide2") &&
        document.querySelector(".property-thumb-slider") &&
        !this.isSliderInitialized
      );
    },

    initializeSlider() {
      try {
        // Initialize the thumbnail slider first
        this.thumbSlider = new window.Swiper(".property-thumb-slider", {
          effect: "slide",
          loop: this.banner_images.length > 1,
          simulateTouch: true,
          spaceBetween: 10,
          slidesPerView: 4,
          freeMode: true,
          watchSlidesProgress: true,
          allowTouchMove: true,
          breakpoints: {
            0: { slidesPerView: 2 },
            576: { slidesPerView: 2 },
            768: { slidesPerView: 3 },
            992: { slidesPerView: 3 },
            1200: { slidesPerView: 4 },
          },
        });

        // Initialize the main slider
        this.mainSlider = new window.Swiper("#panoramaSlide2", {
          autoplay: false,
          effect: "fade",
          fadeEffect: {
            crossFade: true,
          },
          loop: this.banner_images.length > 1,
          simulateTouch: false,
          spaceBetween: 0,
          allowTouchMove: false,
          navigation: {
            nextEl: "[data-slider-next='#panoramaSlide2']",
            prevEl: "[data-slider-prev='#panoramaSlide2']",
          },
          thumbs: {
            swiper: this.thumbSlider,
          },
          on: {
            init: () => {
              this.isSliderInitialized = true;
            },
          },
        });

        console.log("Swiper sliders initialized successfully");
      } catch (error) {
        console.error("Error initializing Swiper sliders:", error);
        this.isSliderInitialized = false;
      }
    },

    destroySliders() {
      if (this.initTimeout) {
        clearTimeout(this.initTimeout);
        this.initTimeout = null;
      }

      if (this.mainSlider) {
        try {
          this.mainSlider.destroy(true, true);
        } catch (e) {
          console.warn("Error destroying main slider:", e);
        }
        this.mainSlider = null;
      }

      if (this.thumbSlider) {
        try {
          this.thumbSlider.destroy(true, true);
        } catch (e) {
          console.warn("Error destroying thumb slider:", e);
        }
        this.thumbSlider = null;
      }

      this.isSliderInitialized = false;
    },

    reinitializeSliders() {
      this.destroySliders();
      this.$nextTick(() => {
        this.initializeSliderSafely();
      });
    },
  },
};
</script>

<style lang="scss" scoped></style>
