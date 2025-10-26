/**
 * Composable for PropertySlider functionality
 * Provides reusable slider logic and utilities
 */

import { ref, onMounted, onUnmounted } from "vue";
import { Swiper } from "swiper";
import type { Slide, SwiperConfig, MainSwiperConfig } from "./types";

export function usePropertySlider(
  slides: Slide[],
  options: {
    showNavigation?: boolean;
    autoplay?: boolean;
    autoplayDelay?: number;
  } = {}
) {
  const mainSliderRef = ref<HTMLElement | null>(null);
  const thumbSliderRef = ref<HTMLElement | null>(null);

  let mainSlider: Swiper | null = null;
  let thumbSlider: Swiper | null = null;

  const isInitialized = ref(false);
  const currentSlide = ref(0);
  const isLoading = ref(true);

  const defaultOptions = {
    showNavigation: true,
    autoplay: false,
    autoplayDelay: 3000,
    ...options,
  };

  /**
   * Format date string for display
   */
  const formatDate = (dateString: string): string => {
    try {
      const options: Intl.DateTimeFormatOptions = {
        year: "numeric",
        month: "long",
        day: "numeric",
      };
      return new Date(dateString).toLocaleDateString(undefined, options);
    } catch (error) {
      console.warn("Invalid date format:", dateString);
      return dateString;
    }
  };

  /**
   * Get responsive breakpoints for thumbnail slider
   */
  const getThumbBreakpoints = () => ({
    0: { slidesPerView: 2 },
    768: { slidesPerView: 3 },
    1024: { slidesPerView: 3 },
  });

  /**
   * Create thumbnail slider configuration
   */
  const createThumbConfig = (): SwiperConfig => ({
    direction: "horizontal",
    speed: 400,
    touchRatio: 0.2,
    slideToClickedSlide: true,
    loop: true,
    loopedSlides: slides.length,
    navigation: defaultOptions.showNavigation
      ? {
          nextEl: ".button-next",
          prevEl: ".button-prev",
        }
      : undefined,
    breakpoints: getThumbBreakpoints(),
    watchSlidesProgress: true,
  });

  /**
   * Create main slider configuration
   */
  const createMainConfig = (thumbSwiper?: Swiper): MainSwiperConfig => ({
    parallax: true,
    effect: "fade",
    speed: 400,
    loop: true,
    loopedSlides: slides.length,
    autoplay: defaultOptions.autoplay
      ? {
          delay: defaultOptions.autoplayDelay,
          disableOnInteraction: false,
        }
      : undefined,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
      renderBullet: (index: number, className: string) => {
        return `<span class="${className}" role="tab" aria-label="Go to slide ${
          index + 1
        }"></span>`;
      },
    },
    thumbs: thumbSwiper ? { swiper: thumbSwiper } : undefined,
  });

  /**
   * Initialize both sliders
   */
  const initializeSliders = async (): Promise<void> => {
    if (!mainSliderRef.value || !thumbSliderRef.value || isInitialized.value) {
      return;
    }

    try {
      isLoading.value = true;

      // Initialize thumbnail slider first
      thumbSlider = new Swiper(thumbSliderRef.value, createThumbConfig());

      // Wait for thumb slider to be ready
      await new Promise((resolve) => {
        if (thumbSlider) {
          thumbSlider.on("init", resolve);
          if (thumbSlider.initialized) resolve(undefined);
        }
      });

      // Initialize main slider with thumb connection
      mainSlider = new Swiper(
        mainSliderRef.value,
        createMainConfig(thumbSlider)
      );

      // Set up controller connection
      if (mainSlider && thumbSlider) {
        mainSlider.controller.control = thumbSlider;
        thumbSlider.controller.control = mainSlider;

        // Track current slide
        mainSlider.on("slideChange", () => {
          currentSlide.value = mainSlider?.realIndex || 0;
        });
      }

      isInitialized.value = true;

      // Emit ready event
      setTimeout(() => {
        isLoading.value = false;
      }, 100);
    } catch (error) {
      console.error("Failed to initialize sliders:", error);
      isLoading.value = false;
    }
  };

  /**
   * Destroy sliders and clean up
   */
  const destroySliders = (): void => {
    if (mainSlider) {
      mainSlider.destroy(true, true);
      mainSlider = null;
    }
    if (thumbSlider) {
      thumbSlider.destroy(true, true);
      thumbSlider = null;
    }
    isInitialized.value = false;
  };

  /**
   * Go to specific slide
   */
  const goToSlide = (index: number): void => {
    if (mainSlider && index >= 0 && index < slides.length) {
      mainSlider.slideToLoop(index);
    }
  };

  /**
   * Go to next slide
   */
  const nextSlide = (): void => {
    if (mainSlider) {
      mainSlider.slideNext();
    }
  };

  /**
   * Go to previous slide
   */
  const prevSlide = (): void => {
    if (mainSlider) {
      mainSlider.slidePrev();
    }
  };

  /**
   * Update slider when slides change
   */
  const updateSlides = (newSlides: Slide[]): void => {
    if (isInitialized.value) {
      destroySliders();
      // Re-initialize with new slides
      setTimeout(initializeSliders, 100);
    }
  };

  /**
   * Get current slide data
   */
  const getCurrentSlide = (): Slide | null => {
    return slides[currentSlide.value] || null;
  };

  // Lifecycle management
  onMounted(() => {
    // Use timeout to ensure DOM is fully rendered
    setTimeout(initializeSliders, 100);
  });

  onUnmounted(() => {
    destroySliders();
  });

  // Return reactive properties and methods
  return {
    // Refs
    mainSliderRef,
    thumbSliderRef,

    // State
    isInitialized,
    currentSlide,
    isLoading,

    // Methods
    formatDate,
    goToSlide,
    nextSlide,
    prevSlide,
    updateSlides,
    getCurrentSlide,
    initializeSliders,
    destroySliders,

    // Computed
    currentSlideData: getCurrentSlide,
  };
}

/**
 * Utility composable for image handling
 */
export function useImageLoader() {
  const loadedImages = ref(new Set<string>());
  const failedImages = ref(new Set<string>());

  const isImageLoaded = (src: string): boolean => {
    return loadedImages.value.has(src);
  };

  const isImageFailed = (src: string): boolean => {
    return failedImages.value.has(src);
  };

  const markImageLoaded = (src: string): void => {
    loadedImages.value.add(src);
    failedImages.value.delete(src);
  };

  const markImageFailed = (src: string): void => {
    failedImages.value.add(src);
    loadedImages.value.delete(src);
  };

  const preloadImage = (src: string): Promise<void> => {
    return new Promise((resolve, reject) => {
      if (isImageLoaded(src)) {
        resolve();
        return;
      }

      const img = new Image();
      img.onload = () => {
        markImageLoaded(src);
        resolve();
      };
      img.onerror = () => {
        markImageFailed(src);
        reject(new Error(`Failed to load image: ${src}`));
      };
      img.src = src;
    });
  };

  const preloadSlideImages = async (slides: Slide[]): Promise<void> => {
    const imagePromises = slides.flatMap((slide) => [
      preloadImage(slide.image),
      preloadImage(slide.author.avatar),
    ]);

    try {
      await Promise.allSettled(imagePromises);
    } catch (error) {
      console.warn("Some images failed to preload:", error);
    }
  };

  return {
    isImageLoaded,
    isImageFailed,
    markImageLoaded,
    markImageFailed,
    preloadImage,
    preloadSlideImages,
  };
}
