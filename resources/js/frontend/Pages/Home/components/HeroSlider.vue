<template>
  <div class="th-hero-wrapper hero-1" id="hero">
    <div class="hero-img-shape-1">
      <div class="logo-icon-wrap">
        <a
          href="https://www.youtube.com/watch?v=_sI_Ps7JSEk"
          class="logo-icon popup-video"
          ><i class="fa-sharp fa-solid fa-play"></i
        ></a>
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
          <div class="swiper-slide" v-for="(banner, index) in banners" :key="index">
            <div
              class="hero-inner hero-style1"
              :style="{
                backgroundImage: `url('/${banner.image}')`,
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
                        <a :href="banner?.permalink ? banner?.permalink : '/'" class="th-btn style2 pill"
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
        <div class="slider-pagination2"></div>
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
import { onMounted, onUpdated, nextTick, ref, onBeforeUnmount } from "vue";
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
    const initializationAttempts = ref(0);
    const maxAttempts = 10;

    const initializeHeroSlider = () => {
      const heroSlider = document.querySelector("#heroSlider1");

      // If slider already exists, don't reinitialize
      if (swiperInstance.value) {
        return;
      }

      if (!heroSlider) {
        console.warn("Hero slider element not found");
        return;
      }

      if (!window.Swiper) {
        initializationAttempts.value++;
        if (initializationAttempts.value < maxAttempts) {
          setTimeout(() => initializeHeroSlider(), 200);
        } else {
          console.error("Swiper library not available after multiple attempts");
        }
        return;
      }

      try {
        // Parse data-slider-options if present
        let options = {};
        const optionsAttr = heroSlider.getAttribute("data-slider-options");
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

        // Add pagination and navigation
        const pagination = heroSlider.querySelector(".slider-pagination");
        const nextBtn = document.querySelector(
          '[data-slider-next="#heroSlider1"]'
        );
        const prevBtn = document.querySelector(
          '[data-slider-prev="#heroSlider1"]'
        );

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
        swiperInstance.value = new window.Swiper(heroSlider, {
          effect: "fade",
          loop: true,
          autoplay: {
            delay: 5000,
            disableOnInteraction: false,
          },
          autoHeight: false,
          initialSlide: 0,
          ...options,
        });

        console.log("Hero slider initialized successfully");
      } catch (error) {
        console.error("Error initializing hero slider:", error);
        // Retry on error
        initializationAttempts.value++;
        if (initializationAttempts.value < maxAttempts) {
          setTimeout(() => initializeHeroSlider(), 500);
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
        console.log("Hero slider destroyed");
      }
    };

    // Initialize on mount
    onMounted(async () => {
      await nextTick();
      setTimeout(() => initializeHeroSlider(), 100);
      setTimeout(() => initializeHeroSlider(), 300);
      setTimeout(() => initializeHeroSlider(), 600);
    });

    // Reinitialize on updates if needed
    onUpdated(async () => {
      await nextTick();
      if (!swiperInstance.value) {
        setTimeout(() => initializeHeroSlider(), 100);
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

  created() {
    this.fetch_banners();
    console.log("Banners fetched:", this.banners);
    
  },
  methods: {
    ...mapActions(home_store, ["fetch_banners"]),
  },
  computed: {
    ...mapState(home_store, ["banners"]),
  },
};
</script>
