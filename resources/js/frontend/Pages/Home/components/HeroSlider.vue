<template>
  <div class="th-hero-wrapper hero-1" id="hero">
    <div class="hero-img-shape-1">
      <div class="logo-icon-wrap border">
        <a href="javascript:void(0)" class="logo-icon popup-video fs-3"
          ><i class="fa-solid fa-people-roof"></i
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
        <!-- Skeleton Loader -->
        <template v-if="showSkeleton">
          <div class="swiper-slide skeleton-slide">
            <div class="hero-skeleton">
              <div class="skeleton-background">
                <div class="skeleton-gradient"></div>
              </div>
              <div class="container">
                <div class="row gy-50 gx-40 align-items-center">
                  <div class="col-xxl-7 col-xl-7 col-lg-8">
                    <div class="hero-1-content pe-xl-4">
                      <!-- Title Skeleton -->
                      <div class="skeleton-title">
                        <div
                          class="skeleton-line skeleton-line-lg skeleton-shimmer"
                        ></div>
                        <div
                          class="skeleton-line skeleton-line-md skeleton-shimmer"
                          style="margin-top: 12px"
                        ></div>
                      </div>

                      <!-- Description Skeleton -->
                      <div
                        class="skeleton-description"
                        style="margin-top: 24px"
                      >
                        <div
                          class="skeleton-line skeleton-line-sm skeleton-shimmer"
                        ></div>
                        <div
                          class="skeleton-line skeleton-line-sm skeleton-shimmer"
                          style="margin-top: 8px"
                        ></div>
                        <div
                          class="skeleton-line skeleton-line-xs skeleton-shimmer"
                          style="margin-top: 8px"
                        ></div>
                      </div>

                      <!-- Button Skeleton -->
                      <div
                        class="skeleton-button-group"
                        style="margin-top: 32px"
                      >
                        <div class="skeleton-button skeleton-shimmer"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Skeleton for navigation elements -->
              <div class="skeleton-navigation">
                <div class="skeleton-nav-button skeleton-shimmer"></div>
                <div class="skeleton-nav-dots">
                  <div class="skeleton-dot skeleton-shimmer"></div>
                </div>
                <div class="skeleton-nav-button skeleton-shimmer"></div>
              </div>
            </div>
          </div>
        </template>

        <!-- Actual Banner Content -->
        <template v-if="showContent">
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
                      <p class="banner_description">
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
          @click="handlePrevClick"
        >
          Prev
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
          @click="handleNextClick"
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
                {{ getFirstSettingValueByTitle("short_intro") }}
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
import { store as header_store } from "../../../Shared/Store/header_store.js";
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
    const isLoading = ref(true);
    const componentMounted = ref(false);
    const initializationAttempts = ref(0);
    const maxInitializationAttempts = 5;

    const waitForSwiper = () => {
      return new Promise((resolve, reject) => {
        let attempts = 0;
        const maxAttempts = 10; // Reduced from 20 for faster failure

        const checkSwiper = () => {
          console.log(`Checking for Swiper library, attempt ${attempts + 1}`);

          if (window.Swiper) {
            console.log("Swiper library found!");
            resolve(true);
          } else if (attempts < maxAttempts) {
            attempts++;
            setTimeout(checkSwiper, 100); // Reduced from 200ms to 100ms
          } else {
            console.error("Swiper library not loaded after maximum attempts");
            reject(new Error("Swiper library not loaded"));
          }
        };
        checkSwiper();
      });
    };

    // Manual navigation handlers
    const handleNextClick = (e) => {
      e.preventDefault();
      e.stopPropagation();

      console.log("Next button clicked");
      console.log("Swiper instance:", swiperInstance.value);

      // Add more debugging
      if (swiperInstance.value) {
        console.log("Before slideNext - Current state:", {
          realIndex: swiperInstance.value.realIndex,
          activeIndex: swiperInstance.value.activeIndex,
          isEnd: swiperInstance.value.isEnd,
          allowSlideNext: swiperInstance.value.allowSlideNext,
          totalSlides: swiperInstance.value.slides?.length,
          loop: swiperInstance.value.params?.loop,
        });
      }

      if (
        swiperInstance.value &&
        typeof swiperInstance.value.slideNext === "function"
      ) {
        try {
          // Try multiple approaches immediately

          // Method 1: Standard slideNext
          swiperInstance.value.slideNext();
          console.log("slideNext called successfully");

          // Method 2: If we have banners data, force slide to next index
          setTimeout(() => {
            const banners = swiperInstance.value.slides || [];
            if (banners.length > 1) {
              const currentReal = swiperInstance.value.realIndex;
              const nextIndex = (currentReal + 1) % banners.length;
              console.log(`Forcing slide from ${currentReal} to ${nextIndex}`);
              swiperInstance.value.slideTo(nextIndex, 800);
            }
          }, 100);

          // Method 3: DOM fallback if nothing changes
          setTimeout(() => {
            const currentRealIndex = swiperInstance.value.realIndex;
            console.log(
              "Checking if slide changed after slideNext:",
              currentRealIndex
            );

            // If we're still at the same index after trying slideNext, use fallback
            if (
              currentRealIndex === 0 ||
              currentRealIndex === swiperInstance.value.previousIndex
            ) {
              console.log("Slide didn't change, using DOM fallback");
              fallbackNext();
            }
          }, 300);
        } catch (error) {
          console.error("Error calling slideNext:", error);
          fallbackNext();
        }
      } else if (swiperInstance.value && !swiperInstance.value.destroyed) {
        console.warn(
          "slideNext method not available, attempting to reinitialize..."
        );
        setTimeout(() => {
          destroySlider();
          initializeHeroSlider();
        }, 100);
      } else {
        console.error("Swiper instance not available or destroyed");
        setTimeout(() => {
          initializeHeroSlider();
        }, 100);
      }
    };

    const handlePrevClick = (e) => {
      e.preventDefault();
      e.stopPropagation();

      console.log("Prev button clicked");

      // Add more debugging
      if (swiperInstance.value) {
        console.log("Before slidePrev - Current state:", {
          realIndex: swiperInstance.value.realIndex,
          activeIndex: swiperInstance.value.activeIndex,
          isBeginning: swiperInstance.value.isBeginning,
          allowSlidePrev: swiperInstance.value.allowSlidePrev,
          totalSlides: swiperInstance.value.slides?.length,
          loop: swiperInstance.value.params?.loop,
        });
      }

      if (
        swiperInstance.value &&
        typeof swiperInstance.value.slidePrev === "function"
      ) {
        try {
          // Try multiple approaches immediately

          // Method 1: Standard slidePrev
          swiperInstance.value.slidePrev();
          console.log("slidePrev called successfully");

          // Method 2: If we have banners data, force slide to prev index
          setTimeout(() => {
            const banners = swiperInstance.value.slides || [];
            if (banners.length > 1) {
              const currentReal = swiperInstance.value.realIndex;
              const prevIndex =
                currentReal === 0 ? banners.length - 1 : currentReal - 1;
              console.log(`Forcing slide from ${currentReal} to ${prevIndex}`);
              swiperInstance.value.slideTo(prevIndex, 800);
            }
          }, 100);

          // Method 3: DOM fallback if nothing changes
          setTimeout(() => {
            const currentRealIndex = swiperInstance.value.realIndex;
            console.log(
              "Checking if slide changed after slidePrev:",
              currentRealIndex
            );

            // If we're still at the same index after trying slidePrev, use fallback
            if (
              currentRealIndex === swiperInstance.value.previousIndex ||
              (currentRealIndex === 1 &&
                swiperInstance.value.slides?.length === 2)
            ) {
              console.log("Slide didn't change, using DOM fallback");
              fallbackPrev();
            }
          }, 300);
        } catch (error) {
          console.error("Error calling slidePrev:", error);
          fallbackPrev();
        }
      } else if (swiperInstance.value && !swiperInstance.value.destroyed) {
        console.warn(
          "slidePrev method not available, attempting to reinitialize..."
        );
        setTimeout(() => {
          destroySlider();
          initializeHeroSlider();
        }, 100);
      } else {
        console.error("Swiper instance not available or destroyed");
        setTimeout(() => {
          initializeHeroSlider();
        }, 100);
      }
    };

    // Fallback navigation using DOM manipulation
    const fallbackNext = () => {
      console.log("Using fallback next navigation");
      const slider = document.querySelector("#heroSlider1");
      if (slider) {
        const slides = slider.querySelectorAll(
          ".swiper-slide:not(.skeleton-slide)"
        );
        const activeSlide = slider.querySelector(
          ".swiper-slide-active:not(.skeleton-slide)"
        );

        console.log("Fallback debug:", {
          totalSlides: slides.length,
          activeSlide: !!activeSlide,
          currentSlide: currentSlide.value,
        });

        if (slides.length > 1) {
          let currentIndex = 0;

          if (activeSlide) {
            currentIndex = Array.from(slides).indexOf(activeSlide);
          }

          const nextIndex = (currentIndex + 1) % slides.length;

          console.log(
            `Fallback: Moving from slide ${currentIndex} to ${nextIndex}`
          );

          // Remove active class from all slides
          slides.forEach((slide, index) => {
            slide.classList.remove("swiper-slide-active");
            slide.style.opacity = "0";

            // Also update Swiper's internal slide classes
            slide.classList.remove("swiper-slide-prev", "swiper-slide-next");
            if (index === nextIndex) {
              slide.classList.add("swiper-slide-active");
              slide.style.opacity = "1";
            } else if (
              index ===
              (nextIndex - 1 + slides.length) % slides.length
            ) {
              slide.classList.add("swiper-slide-prev");
            } else if (index === (nextIndex + 1) % slides.length) {
              slide.classList.add("swiper-slide-next");
            }
          });

          // Update current slide number
          currentSlide.value = nextIndex + 1;

          // Try to update Swiper's internal state if possible
          if (swiperInstance.value) {
            try {
              // Update Swiper's realIndex to match our fallback
              swiperInstance.value.realIndex = nextIndex;
              swiperInstance.value.activeIndex = nextIndex;

              // Trigger slide change event manually
              swiperInstance.value.emit("slideChange");
            } catch (error) {
              console.warn("Could not update Swiper state:", error);
            }
          }

          console.log(
            "Fallback navigation completed, new slide:",
            currentSlide.value
          );
        } else {
          console.log("Not enough slides for fallback navigation");
        }
      }
    };

    const fallbackPrev = () => {
      console.log("Using fallback prev navigation");
      const slider = document.querySelector("#heroSlider1");
      if (slider) {
        const slides = slider.querySelectorAll(
          ".swiper-slide:not(.skeleton-slide)"
        );
        const activeSlide = slider.querySelector(
          ".swiper-slide-active:not(.skeleton-slide)"
        );

        if (slides.length > 1) {
          let currentIndex = 0;

          if (activeSlide) {
            currentIndex = Array.from(slides).indexOf(activeSlide);
          }

          const prevIndex =
            currentIndex === 0 ? slides.length - 1 : currentIndex - 1;

          // Remove active class from all slides and update classes
          slides.forEach((slide, index) => {
            slide.classList.remove(
              "swiper-slide-active",
              "swiper-slide-prev",
              "swiper-slide-next"
            );
            slide.style.opacity = "0";

            if (index === prevIndex) {
              slide.classList.add("swiper-slide-active");
              slide.style.opacity = "1";
            } else if (
              index ===
              (prevIndex - 1 + slides.length) % slides.length
            ) {
              slide.classList.add("swiper-slide-prev");
            } else if (index === (prevIndex + 1) % slides.length) {
              slide.classList.add("swiper-slide-next");
            }
          });

          // Update current slide number
          currentSlide.value = prevIndex + 1;

          // Try to update Swiper's internal state if possible
          if (swiperInstance.value) {
            try {
              swiperInstance.value.realIndex = prevIndex;
              swiperInstance.value.activeIndex = prevIndex;
              swiperInstance.value.emit("slideChange");
            } catch (error) {
              console.warn("Could not update Swiper state:", error);
            }
          }
        }
      }
    };

    const initializeHeroSlider = async () => {
      console.log("Attempting to initialize slider...");
      console.log("Current state:", {
        initializationAttempts: initializationAttempts.value,
        isInitialized: isInitialized.value,
        componentMounted: componentMounted.value,
        bannersLoaded: bannersLoaded.value,
      });

      // Prevent excessive initialization attempts
      if (initializationAttempts.value >= maxInitializationAttempts) {
        console.warn("Maximum initialization attempts reached");
        return;
      }

      // Prevent multiple initializations
      if (isInitialized.value && swiperInstance.value) {
        console.log("Slider already initialized");
        return;
      }

      // Check if component is mounted and banners are loaded
      if (!componentMounted.value || !bannersLoaded.value) {
        console.log("Component not ready for initialization");
        return;
      }

      initializationAttempts.value++;

      const heroSlider = document.querySelector("#heroSlider1");
      if (!heroSlider) {
        console.warn(
          "Hero slider element not found, attempt:",
          initializationAttempts.value
        );
        // Faster retry for better user experience
        if (initializationAttempts.value < maxInitializationAttempts) {
          setTimeout(() => initializeHeroSlider(), 200); // Reduced from 500ms
        }
        return;
      }

      // Check if slides exist
      const slides = heroSlider.querySelectorAll(".swiper-slide");
      if (!slides || slides.length === 0) {
        console.warn("No slides found, retrying...");
        if (initializationAttempts.value < maxInitializationAttempts) {
          setTimeout(() => initializeHeroSlider(), 200); // Reduced from 500ms
        }
        return;
      }

      console.log(
        `Found ${slides.length} slides, proceeding with initialization`
      );

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
          speed: 600, // Reduced from 800 for faster transitions
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
          // Optimize for faster loading
          preloadImages: true,
          updateOnImagesReady: true,
          lazy: {
            loadPrevNext: true,
            loadOnTransitionStart: true,
          },
          // Fix navigation by ensuring proper button binding
          allowTouchMove: true,
          touchRatio: 1,
          touchAngle: 45,
          simulateTouch: true,
          grabCursor: true,
          // Add these options for better loop handling
          loopFillGroupWithBlank: false,
          loopPreventsSlide: false,
          // Ensure slide changes are detected
          updateOnWindowResize: true,
          resizeObserver: true,
          // Force recreation if needed
          passiveListeners: false,
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
            disabledClass: "swiper-button-disabled",
            hiddenClass: "swiper-button-hidden",
          };
        }

        // Initialize slider
        swiperInstance.value = new window.Swiper(heroSlider, options);

        // Verify the instance was created properly
        if (!swiperInstance.value) {
          throw new Error("Failed to create Swiper instance");
        }

        console.log("Swiper initialized with methods:", {
          slideNext: typeof swiperInstance.value.slideNext,
          slidePrev: typeof swiperInstance.value.slidePrev,
          slideTo: typeof swiperInstance.value.slideTo,
          update: typeof swiperInstance.value.update,
        });

        // Log slider details for debugging
        setTimeout(() => {
          console.log("Slider details after initialization:", {
            totalSlides: swiperInstance.value.slides?.length,
            realIndex: swiperInstance.value.realIndex,
            activeIndex: swiperInstance.value.activeIndex,
            isEnd: swiperInstance.value.isEnd,
            isBeginning: swiperInstance.value.isBeginning,
            allowSlideNext: swiperInstance.value.allowSlideNext,
            allowSlidePrev: swiperInstance.value.allowSlidePrev,
            loopedSlides: swiperInstance.value.loopedSlides,
            params: {
              loop: swiperInstance.value.params.loop,
              effect: swiperInstance.value.params.effect,
            },
          });
        }, 100);

        // Update current slide number on slide change
        swiperInstance.value.on("slideChange", () => {
          const realIndex = swiperInstance.value.realIndex;
          const activeIndex = swiperInstance.value.activeIndex;
          currentSlide.value = realIndex + 1;
          console.log("Slide changed to:", currentSlide.value);
          console.log("Real Index:", realIndex, "Active Index:", activeIndex);
          console.log("Total slides:", swiperInstance.value.slides?.length);
        });

        // Add manual event listeners as backup for navigation
        if (nextBtn) {
          nextBtn.removeEventListener("click", handleNextClick);
          nextBtn.addEventListener("click", handleNextClick);
        }

        if (prevBtn) {
          prevBtn.removeEventListener("click", handlePrevClick);
          prevBtn.addEventListener("click", handlePrevClick);
        }

        // Enable autoplay restart after user interaction
        swiperInstance.value.on("touchEnd", () => {
          if (swiperInstance.value.autoplay) {
            swiperInstance.value.autoplay.start();
          }
        });

        // Add error handling for navigation
        swiperInstance.value.on("navigationNext", () => {
          console.log("Navigation next triggered");
        });

        swiperInstance.value.on("navigationPrev", () => {
          console.log("Navigation prev triggered");
        });

        // Ensure slider is properly updated
        setTimeout(() => {
          if (
            swiperInstance.value &&
            typeof swiperInstance.value.update === "function"
          ) {
            swiperInstance.value.update();
          }
        }, 100);

        // Reset initialization attempts on success
        initializationAttempts.value = 0;

        // console.log("Hero slider initialized successfully");
      } catch (error) {
        console.error("Error initializing hero slider:", error);
        isInitialized.value = false;

        // Retry initialization if within attempts limit
        if (initializationAttempts.value < maxInitializationAttempts) {
          setTimeout(() => initializeHeroSlider(), 200); // Reduced retry delay
        }
      }
    };

    const destroySlider = () => {
      // Remove manual event listeners
      const nextBtn = document.querySelector(
        '[data-slider-next="#heroSlider1"]'
      );
      const prevBtn = document.querySelector(
        '[data-slider-prev="#heroSlider1"]'
      );

      if (nextBtn) {
        nextBtn.removeEventListener("click", handleNextClick);
      }

      if (prevBtn) {
        prevBtn.removeEventListener("click", handlePrevClick);
      }

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
          initializeHeroSlider(); // Remove delay for immediate initialization
        }
      });

      // Very fast global retry mechanism
      const globalRetry = () => {
        setTimeout(() => {
          if (!swiperInstance.value && bannersLoaded.value) {
            console.log("Global retry: Attempting slider initialization");
            initializeHeroSlider();
          }
        }, 1000); // Further reduced for faster experience
      };

      // Set up the global retry
      globalRetry();

      // Also retry when the page is fully loaded
      if (document.readyState !== "complete") {
        window.addEventListener("load", () => {
          if (!swiperInstance.value && bannersLoaded.value) {
            console.log("Window load retry: Attempting slider initialization");
            initializeHeroSlider();
          }
        });
      }
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
          initializeHeroSlider(); // Immediate initialization
        }
      });
    });

    onActivated(() => {
      // console.log("HeroSlider: onActivated");
      // Reinitialize when component is activated (keep-alive)
      if (componentMounted.value && bannersLoaded.value) {
        initializeHeroSlider(); // Immediate initialization
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
      handleNextClick,
      handlePrevClick,
      fallbackNext,
      fallbackPrev,
      currentSlide,
      bannersLoaded,
      isLoading,
      componentMounted,
      // Add debug method
      testSliderMethods: () => {
        console.log("Testing slider methods...");
        console.log("Instance:", swiperInstance.value);
        console.log(
          "slideNext available:",
          typeof swiperInstance.value?.slideNext
        );
        console.log(
          "slidePrev available:",
          typeof swiperInstance.value?.slidePrev
        );
        console.log("Active index:", swiperInstance.value?.activeIndex);
        console.log("Real index:", swiperInstance.value?.realIndex);
        console.log("Slides length:", swiperInstance.value?.slides?.length);
      },
      // Force reinitialize method
      forceReinit: () => {
        console.log("Force reinitializing slider...");
        destroySlider();
        setTimeout(() => {
          initializeHeroSlider();
        }, 200);
      },
    };
  },

  created() {
    this.isLoading = true;
    this.fetch_banners();
    this.fetch_website_settings();

    // Immediate initialization after DOM is ready
    if (document.readyState === "loading") {
      document.addEventListener("DOMContentLoaded", () => {
        if (this.bannersLoaded && !this.swiperInstance) {
          this.initializeHeroSlider();
        }
      });
    } else {
      // DOM is already loaded - immediate attempt
      this.$nextTick(() => {
        if (this.bannersLoaded && !this.swiperInstance) {
          this.initializeHeroSlider();
        }
      });
    }
  },

  mounted() {
    // Banner loading will be handled by the watcher and lifecycle hooks
    // console.log("Component mounted, banners:", this.banners?.length || 0);

    // Immediate initialization check
    this.$nextTick(() => {
      if (this.banners && this.banners.length > 0 && !this.swiperInstance) {
        console.log("Mounted: Immediate initialization attempt");
        this.initializeHeroSlider();
      }
    });

    // Fast fallback for edge cases
    setTimeout(() => {
      if (this.banners && this.banners.length > 0 && !this.swiperInstance) {
        console.log("Mounted: Fast fallback initialization");
        this.initializeHeroSlider();
      }
    }, 100);

    // Final window load event listener
    if (document.readyState !== "complete") {
      window.addEventListener("load", () => {
        this.$nextTick(() => {
          if (this.banners && this.banners.length > 0 && !this.swiperInstance) {
            console.log("Window load: Attempting initialization");
            this.initializeHeroSlider();
          }
        });
      });
    }
  },

  watch: {
    banners: {
      handler(newBanners, oldBanners) {
        console.log("Banners watcher triggered:", newBanners?.length || 0);

        if (newBanners && newBanners.length > 0) {
          this.bannersLoaded = true;

          // Show content immediately without skeleton delay
          this.isLoading = false;

          // Immediate initialization attempt
          this.$nextTick(() => {
            if (!this.swiperInstance) {
              console.log("First initialization attempt");
              this.initializeHeroSlider();
            }
          });

          // Quick second attempt if first fails
          setTimeout(() => {
            if (!this.swiperInstance) {
              console.log("Second initialization attempt");
              this.initializeHeroSlider();
            }
          }, 200); // Further reduced for faster loading

          // Final fallback attempt
          setTimeout(() => {
            if (!this.swiperInstance) {
              console.log("Final initialization attempt");
              this.initializeHeroSlider();
            }
          }, 800); // Reduced for faster overall experience
        } else {
          this.bannersLoaded = false;
          this.isLoading = true;
          this.destroySlider();
        }
      },
      immediate: true, // Watch immediately on component creation
      deep: true, // Watch for deep changes in the banners array
    },
  },
  methods: {
    ...mapActions(home_store, ["fetch_banners"]),
    ...mapActions(header_store, [
      "getFirstSettingValueByTitle",
      "fetch_website_settings",
    ]),

    // Manual initialization method for debugging
    manualInit() {
      console.log("Manual initialization triggered");
      this.destroySlider();
      setTimeout(() => {
        this.initializeHeroSlider();
      }, 500);
    },

    // Force next slide manually
    forceNext() {
      console.log("Force next slide triggered");
      if (this.swiperInstance) {
        console.log("Current state before force:", {
          realIndex: this.swiperInstance.realIndex,
          activeIndex: this.swiperInstance.activeIndex,
          totalSlides: this.swiperInstance.slides?.length,
          bannerCount: this.banners?.length,
        });

        // Try multiple methods
        try {
          // Method 1: slideNext
          this.swiperInstance.slideNext();

          // Method 2: slideTo with next index
          setTimeout(() => {
            const nextIndex =
              (this.swiperInstance.realIndex + 1) % (this.banners?.length || 1);
            console.log("Trying slideTo:", nextIndex);
            this.swiperInstance.slideTo(nextIndex);
          }, 100);

          // Method 3: Manual DOM manipulation
          setTimeout(() => {
            this.fallbackNext();
          }, 200);
        } catch (error) {
          console.error("Error in forceNext:", error);
        }
      }
    },

    // Check slider status
    checkSliderStatus() {
      console.log("Slider Status:", {
        swiperInstance: !!this.swiperInstance,
        isInitialized: this.isInitialized,
        bannersLoaded: this.bannersLoaded,
        bannersCount: this.banners?.length || 0,
        bannersData: this.banners,
        componentMounted: this.componentMounted,
        domElement: !!document.querySelector("#heroSlider1"),
        swiperLibrary: !!window.Swiper,
        domSlides: document.querySelectorAll("#heroSlider1 .swiper-slide")
          .length,
      });

      // If slider exists, log its current state
      if (this.swiperInstance) {
        console.log("Swiper Instance Details:", {
          realIndex: this.swiperInstance.realIndex,
          activeIndex: this.swiperInstance.activeIndex,
          slidesLength: this.swiperInstance.slides?.length,
          isEnd: this.swiperInstance.isEnd,
          isBeginning: this.swiperInstance.isBeginning,
          allowSlideNext: this.swiperInstance.allowSlideNext,
          allowSlidePrev: this.swiperInstance.allowSlidePrev,
          loop: this.swiperInstance.params?.loop,
          effect: this.swiperInstance.params?.effect,
        });
      }
    },
  },
  computed: {
    ...mapState(home_store, ["banners"]),
    ...mapState(header_store, ["website_settings"]),

    showSkeleton() {
      return (
        this.isLoading ||
        !this.banners ||
        !this.banners.length ||
        !this.bannersLoaded
      );
    },

    showContent() {
      return (
        !this.isLoading &&
        this.banners &&
        this.banners.length &&
        this.bannersLoaded
      );
    },
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
  transition-duration: 0.8s;
  opacity: 0;
}

.swiper-fade .swiper-slide-active {
  pointer-events: auto;
  opacity: 1 !important;
}

/* Ensure manual fallback works */
.swiper-slide {
  transition: opacity 0.8s ease-in-out;
}

.swiper-slide:not(.swiper-slide-active) {
  opacity: 0;
}

.swiper-slide.swiper-slide-active {
  opacity: 1;
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
  color: var(--smoke-color);
}
.banner_description {
  font-size: 18px;
  color: var(--smoke-color);
  max-width: 600px;
}

/* Professional Skeleton Loader Styles */
.swiper-wrapper {
  transition: opacity 0.3s ease-in-out;
}

.skeleton-slide {
  height: 100vh;
  max-height: 800px;
  min-height: 600px;
  position: relative;
  overflow: hidden;
}

.hero-skeleton {
  width: 100%;
  height: 100%;
  position: relative;
  display: flex;
  align-items: center;
  animation: fadeIn 0.3s ease-in-out;
}

@keyframes fadeIn {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}

.skeleton-background {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
  z-index: 1;
}

.skeleton-gradient {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: linear-gradient(
    135deg,
    rgb(133 130 130 / 80%) 0%,
    rgb(143 135 135 / 58%) 50%,
    rgb(133 129 129 / 51%) 100%
  );
  animation: gradientShift 3s ease-in-out infinite;
}

@keyframes gradientShift {
  0%,
  100% {
    opacity: 0.3;
  }
  50% {
    opacity: 0.6;
  }
}

.hero-1-content {
  position: relative;
  z-index: 2;
}

/* Skeleton Lines and Elements */
.skeleton-line {
  border-radius: 8px;
  background: linear-gradient(90deg, #e2e8f0 25%, #f1f5f9 50%, #e2e8f0 75%);
  background-size: 200% 100%;
  position: relative;
  overflow: hidden;
}

.skeleton-line-lg {
  height: 48px;
  width: 85%;
}

.skeleton-line-md {
  height: 40px;
  width: 65%;
}

.skeleton-line-sm {
  height: 20px;
  width: 90%;
}

.skeleton-line-xs {
  height: 20px;
  width: 60%;
}

.skeleton-button {
  height: 48px;
  width: 220px;
  border-radius: 25px;
  background: linear-gradient(90deg, #e2e8f0 25%, #f1f5f9 50%, #e2e8f0 75%);
  background-size: 200% 100%;
  position: relative;
  overflow: hidden;
}

/* Shimmer Animation */
.skeleton-shimmer {
  animation: shimmer 2s infinite linear;
}

@keyframes shimmer {
  0% {
    background-position: -200% 0;
  }
  100% {
    background-position: 200% 0;
  }
}

/* Enhanced shimmer effect with pseudo-element */
.skeleton-shimmer::before {
  content: "";
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(
    90deg,
    transparent,
    rgba(255, 255, 255, 0.4),
    transparent
  );
  animation: shimmerWave 2s infinite;
}

@keyframes shimmerWave {
  0% {
    left: -100%;
  }
  100% {
    left: 100%;
  }
}

/* Skeleton Navigation */
.skeleton-navigation {
  position: absolute;
  bottom: 40px;
  right: 50px;
  z-index: 10;
  display: flex;
  align-items: center;
  gap: 15px;
}

.skeleton-nav-button {
  width: 60px;
  height: 32px;
  border-radius: 16px;
  background: linear-gradient(90deg, #e2e8f0 25%, #f1f5f9 50%, #e2e8f0 75%);
  background-size: 200% 100%;
  position: relative;
  overflow: hidden;
}

.skeleton-nav-dots {
  display: flex;
  gap: 8px;
  align-items: center;
}

.skeleton-dot {
  width: 12px;
  height: 12px;
  border-radius: 50%;
  background: linear-gradient(90deg, #e2e8f0 25%, #f1f5f9 50%, #e2e8f0 75%);
  background-size: 200% 100%;
  position: relative;
  overflow: hidden;
}

/* Responsive adjustments for skeleton */
@media (max-width: 768px) {
  .skeleton-slide {
    min-height: 500px;
    max-height: 600px;
  }

  .skeleton-line-lg {
    height: 36px;
    width: 95%;
  }

  .skeleton-line-md {
    height: 32px;
    width: 75%;
  }

  .skeleton-button {
    height: 44px;
    width: 200px;
  }

  .skeleton-navigation {
    bottom: 20px;
    right: 20px;
    gap: 10px;
  }

  .skeleton-nav-button {
    width: 50px;
    height: 28px;
  }
}

/* Pulse animation for additional visual interest */
.skeleton-title,
.skeleton-description,
.skeleton-button-group {
  animation: pulse 2s ease-in-out infinite;
}

@keyframes pulse {
  0%,
  100% {
    opacity: 1;
  }
  50% {
    opacity: 0.7;
  }
}

/* Staggered animation delays for natural feel */
.skeleton-title {
  animation-delay: 0s;
}

.skeleton-description {
  animation-delay: 0.2s;
}

.skeleton-button-group {
  animation-delay: 0.4s;
}

.skeleton-navigation {
  animation: pulse 2s ease-in-out infinite;
  animation-delay: 0.6s;
}

/* Hero Logo Section Responsive Visibility */
.hero-img-shape-1 {
  /* Show on desktop and large tablets */
  display: block;
  visibility: visible;
}

/* Hide on mobile and small tablets */
@media (max-width: 991px) {
  .hero-img-shape-1 {
    display: none !important;
    visibility: hidden !important;
  }
}

/* Show only on large devices (desktop and large tablets) */
@media (min-width: 992px) {
  .hero-img-shape-1 {
    display: block !important;
    visibility: visible !important;
    opacity: 1 !important;
  }
}

/* Optional: Hide on tablets in portrait mode */
@media (max-width: 768px) {
  .hero-img-shape-1 {
    display: none !important;
    visibility: hidden !important;
  }
}

/* Optional: Show on tablets in landscape mode */
@media (min-width: 769px) and (max-width: 991px) and (orientation: landscape) {
  .hero-img-shape-1 {
    display: block !important;
    visibility: visible !important;
    opacity: 1 !important;
  }
}
</style>
