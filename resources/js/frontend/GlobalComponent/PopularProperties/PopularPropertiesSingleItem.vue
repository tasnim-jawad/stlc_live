<template>
  <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 filter-item cat3 cat1">
    <!-- Skeleton Loader -->
    <div class="popular-list-1" v-if="showSkeleton">
      <div class="thumb-wrapper">
        <!-- Skeleton Image Slider -->
        <div class="skeleton-slider">
          <div
            class="skeleton-image skeleton-property-image skeleton-shimmer"
          ></div>
          <!-- Skeleton Navigation -->
          <div class="icon-wrap">
            <div class="skeleton-nav-btn skeleton-shimmer"></div>
            <div class="skeleton-nav-btn skeleton-shimmer"></div>
          </div>
          <!-- Skeleton Actions -->
          <div class="actions-style-2-wrapper">
            <div class="actions style-2">
              <div class="skeleton-action-btn skeleton-shimmer"></div>
            </div>
          </div>
          <!-- Skeleton Badge -->
          <div class="popular-badge skeleton-badge">
            <div class="skeleton-badge-icon skeleton-shimmer"></div>
            <div class="skeleton-badge-text skeleton-shimmer"></div>
          </div>
        </div>
      </div>

      <!-- Skeleton Content -->
      <div class="property-content">
        <div class="media-body">
          <!-- Skeleton Title -->
          <div class="skeleton-title">
            <div class="skeleton-line skeleton-line-lg skeleton-shimmer"></div>
          </div>

          <!-- Skeleton Address -->
          <div class="skeleton-address" style="margin-top: 12px">
            <div class="skeleton-icon skeleton-shimmer"></div>
            <div class="skeleton-line skeleton-line-md skeleton-shimmer"></div>
          </div>
        </div>

        <!-- Skeleton Features -->
        <ul class="property-featured skeleton-features">
          <li v-for="n in 3" :key="n" class="skeleton-feature-item">
            <div class="skeleton-feature-icon skeleton-shimmer"></div>
            <div class="skeleton-line skeleton-line-sm skeleton-shimmer"></div>
          </li>
        </ul>

        <!-- Skeleton Bottom Section -->
        <div class="property-bottom skeleton-bottom">
          <div class="skeleton-price">
            <div class="skeleton-line skeleton-line-md skeleton-shimmer"></div>
          </div>
          <div class="skeleton-view-btn skeleton-shimmer"></div>
        </div>
      </div>
    </div>

    <!-- Actual Content -->
    <div class="popular-list-1" v-if="showContent">
      <div class="thumb-wrapper">
        <div
          class="th-slider h-100"
          :id="`property-slider-${property?.id || Math.random()}`"
          data-slider-options='{"loop":false, "autoplay": false,"autoHeight": true, "effect":"fade"}'
        >
          <div class="swiper-wrapper h-100">
            <div
              class="swiper-slide h-100"
              v-for="(image, index) in property?.banner_image || [
                '/assets/frontend/img/popular/popular-1-1.jpg',
                '/assets/frontend/img/popular/popular-1-2.jpg',
              ]"
              :key="index"
            >
              <a class="popular-popup-image" :href="image"
                ><img :src="image" alt="Property Image"
              /></a>
            </div>
          </div>
          <div class="icon-wrap">
            <button class="slider-arrow slider-prev">
              <i class="fa fa-arrow-left"></i>
            </button>
            <button class="slider-arrow slider-next">
              <i class="fa fa-arrow-right"></i>
            </button>
          </div>
        </div>
        <!-- <div class="actions">
          <a href="wishlist.html" class="icon-btn"
            ><i class="fas fa-heart"></i
          ></a>
        </div> -->
        <div class="actions-style-2-wrapper">
          <div class="actions style-2">
            <a
              href="#"
              class="icon-btn view-all-images-btn"
              @click.prevent="openImageGallery"
              ><span class="action-text">View all img</span>
              <i class="fa-solid fa-camera"></i
            ></a>
          </div>
        </div>
        <div class="popular-badge">
          <img src="/assets/frontend/img/icon/sell_rent_icon.svg" alt="icon" />
          <p>
            {{ property?.property_status == "sale" ? "For Sale" : "For Rent" }}
          </p>
        </div>
      </div>
      <div class="property-content">
        <div class="media-body">
          <h3 class="box-title">
            <Link
              :href="`/portfolio/property-details?slug=${property?.slug}`"
              >{{
                property?.property_name
                  ? property.property_name.length > 40
                    ? property.property_name.slice(0, 40) + ".."
                    : property.property_name
                  : "Property Name"
              }}</Link
            >
          </h3>
          <div class="box-text">
            <div class="icon">
              <img
                src="/assets/frontend/img/icon/popular-location.svg"
                alt="icon"
              />
            </div>
            {{
              property?.property_address
                ? property.property_address.length > 50
                  ? property.property_address.slice(0, 50) + ".."
                  : property.property_address
                : "39581 Rohan Estates, New York"
            }}
          </div>
        </div>
        <ul class="property-featured">
          <li
            v-for="(feature, index) in (
              property?.facts_and_features || []
            ).slice(0, 3)"
            :key="index"
          >
            <div class="icon mr-1">
              <!-- <img src="/assets/frontend/img/icon/bed.svg" alt="icon" /> -->
              <span><i :class="feature?.icon"></i></span>
            </div>
            {{
              feature?.title?.length > 8
                ? feature?.title?.slice(0, 8) + ".."
                : feature?.title
            }}
          </li>
        </ul>
        <div class="property-bottom">
          <h6 class="box-title">৳ {{ property?.price?.toLocaleString() }}</h6>
          <Link
            class="th-btn sm style3 pill"
            :href="`/portfolio/property-details?slug=${property?.slug}`"
            >View More</Link
          >
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { onMounted, onUpdated, nextTick, ref, onBeforeUnmount } from "vue";

export default {
  name: "PopularPropertiesSingleItem",
  props: {
    property: {
      type: Object,
      required: false,
      default: null,
    },
    isLoading: {
      type: Boolean,
      default: false,
    },
  },

  computed: {
    showSkeleton() {
      return this.isLoading || !this.property;
    },

    showContent() {
      return !this.isLoading && this.property;
    },
  },
  setup(props) {
    const swiperInstance = ref(null);
    const initializationAttempts = ref(0);
    const maxAttempts = 10;

    const openImageGallery = () => {
      // Get all banner images from the property
      const images = props.property?.banner_image || [
        "/assets/frontend/img/popular/popular-1-1.jpg",
        "/assets/frontend/img/popular/popular-1-2.jpg",
      ];

      // Check if Magnific Popup is available
      if (!window.$ || !$.magnificPopup) {
        console.error("Magnific Popup library not available");
        return;
      }

      // Prepare gallery items
      const galleryItems = images.map((image, index) => ({
        src: image,
        type: "image",
        title: `Property Image ${index + 1}`,
      }));

      // Open Magnific Popup gallery
      $.magnificPopup.open({
        items: galleryItems,
        gallery: {
          enabled: true,
          navigateByImgClick: true,
          preload: [0, 1],
        },
        type: "image",
        mainClass: "mfp-img-mobile",
        image: {
          verticalFit: true,
          titleSrc: function (item) {
            return item.el.attr("title") || "Property Image";
          },
        },
      });
    };

    const initializeSlider = () => {
      const sliderElements = document.querySelectorAll(".th-slider");

      sliderElements.forEach((sliderElement) => {
        // Skip if already initialized
        if (sliderElement.swiper) {
          return;
        }

        if (!window.Swiper) {
          initializationAttempts.value++;
          if (initializationAttempts.value < maxAttempts) {
            setTimeout(() => initializeSlider(), 200);
          } else {
            console.error(
              "Swiper library not available after multiple attempts"
            );
          }
          return;
        }

        try {
          // Parse data-slider-options if present
          let options = {};
          const optionsAttr = sliderElement.getAttribute("data-slider-options");
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
          const nextBtn = sliderElement.querySelector(".slider-next");
          const prevBtn = sliderElement.querySelector(".slider-prev");
          if (nextBtn && prevBtn) {
            options.navigation = {
              nextEl: nextBtn,
              prevEl: prevBtn,
            };
          }

          // Initialize slider with merged options
          new window.Swiper(sliderElement, {
            autoplay: false,
            autoHeight: true,
            loop: false,
            spaceBetween: 0,
            ...options,
          });

          // console.log("Popular property slider initialized successfully");
        } catch (error) {
          console.error("Error initializing popular property slider:", error);
          // Retry on error
          initializationAttempts.value++;
          if (initializationAttempts.value < maxAttempts) {
            setTimeout(() => initializeSlider(), 500);
          }
        }
      });
    };

    const destroySliders = () => {
      const sliderElements = document.querySelectorAll(".th-slider");
      sliderElements.forEach((sliderElement) => {
        if (
          sliderElement.swiper &&
          typeof sliderElement.swiper.destroy === "function"
        ) {
          sliderElement.swiper.destroy(true, true);
          // console.log("Popular property slider destroyed");
        }
      });
    };

    // Initialize on mount
    onMounted(async () => {
      await nextTick();
      // Multiple initialization attempts with different delays
      setTimeout(() => initializeSlider(), 100);
      setTimeout(() => initializeSlider(), 300);
      setTimeout(() => initializeSlider(), 600);
    });

    // Reinitialize on updates if needed
    onUpdated(async () => {
      await nextTick();
      setTimeout(() => initializeSlider(), 100);
    });

    // Cleanup on unmount
    onBeforeUnmount(() => {
      destroySliders();
    });

    return {
      swiperInstance,
      openImageGallery,
    };
  },
};
</script>

<style lang="scss" scoped>
/* Professional Property Card Skeleton Loader Styles */

/* Base skeleton elements */
.skeleton-line {
  border-radius: 6px;
  background: linear-gradient(90deg, #e2e8f0 25%, #f1f5f9 50%, #e2e8f0 75%);
  background-size: 200% 100%;
  position: relative;
  overflow: hidden;
}

/* Skeleton line sizes */
.skeleton-line-sm {
  height: 14px;
  width: 80px;
}

.skeleton-line-md {
  height: 16px;
  width: 140px;
}

.skeleton-line-lg {
  height: 20px;
  width: 200px;
}

/* Property image skeleton - maintain original slider structure */
.skeleton-slider {
  position: relative;
  height: 250px;
  border-radius: 0;
  overflow: hidden;
  background: transparent;
}

.skeleton-property-image {
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, #e2e8f0 25%, #f1f5f9 50%, #e2e8f0 75%);
  background-size: 200% 100%;
  border-radius: 0;
  position: relative;
  overflow: hidden;
}

/* Navigation buttons skeleton - use original positioning */
.skeleton-nav-btn {
  width: 36px;
  height: 36px;
  border-radius: 50%;
  background: linear-gradient(90deg, #e2e8f0 25%, #f1f5f9 50%, #e2e8f0 75%);
  background-size: 200% 100%;
  position: relative;
  overflow: hidden;
}

/* Action button skeleton - maintain original size and position */
.skeleton-action-btn {
  width: 100px;
  height: 32px;
  border-radius: 16px;
  background: linear-gradient(90deg, #e2e8f0 25%, #f1f5f9 50%, #e2e8f0 75%);
  background-size: 200% 100%;
  position: relative;
  overflow: hidden;
}

/* Badge skeleton - keep original badge structure */
.skeleton-badge {
  display: flex;
  align-items: center;
  gap: 8px;
  /* Remove custom padding and background to maintain original badge styling */
}

.skeleton-badge-icon {
  width: 20px;
  height: 20px;
  border-radius: 4px;
  background: linear-gradient(90deg, #e2e8f0 25%, #f1f5f9 50%, #e2e8f0 75%);
  background-size: 200% 100%;
}

.skeleton-badge-text {
  width: 60px;
  height: 12px;
  background: linear-gradient(90deg, #e2e8f0 25%, #f1f5f9 50%, #e2e8f0 75%);
  background-size: 200% 100%;
  border-radius: 6px;
}

/* Content area skeleton - maintain original spacing */
.skeleton-title {
  margin-bottom: 0; /* Use original margin */
}

.skeleton-address {
  display: flex;
  align-items: center;
  gap: 8px;
  margin-top: 0; /* Remove custom margin */
}

.skeleton-icon {
  width: 16px;
  height: 16px;
  border-radius: 50%;
  background: linear-gradient(90deg, #e2e8f0 25%, #f1f5f9 50%, #e2e8f0 75%);
  background-size: 200% 100%;
  flex-shrink: 0;
}

/* Features skeleton - maintain original ul structure */
.skeleton-features {
  display: flex;
  gap: 16px;
  margin: 0; /* Remove custom margins */
  list-style: none;
  padding: 0;
}

.skeleton-feature-item {
  display: flex;
  align-items: center;
  gap: 6px;
}

.skeleton-feature-icon {
  width: 18px;
  height: 18px;
  border-radius: 50%;
  background: linear-gradient(90deg, #e2e8f0 25%, #f1f5f9 50%, #e2e8f0 75%);
  background-size: 200% 100%;
  flex-shrink: 0;
}

/* Bottom section skeleton - maintain original layout */
.skeleton-bottom {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 0; /* Use original margin */
}

.skeleton-price {
  flex: 1;
}

.skeleton-view-btn {
  width: 90px;
  height: 32px;
  border-radius: 16px;
  background: linear-gradient(90deg, #e2e8f0 25%, #f1f5f9 50%, #e2e8f0 75%);
  background-size: 200% 100%;
}

/* Shimmer animation */
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

/* Enhanced shimmer effect */
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

/* Skeleton content animations with staggered delays */
.skeleton-property-image {
  animation: scaleIn 0.8s ease-out;
  animation-delay: 0.1s;
  animation-fill-mode: both;
}

.skeleton-title {
  animation: fadeInUp 0.6s ease-out;
  animation-delay: 0.2s;
  animation-fill-mode: both;
}

.skeleton-address {
  animation: fadeInUp 0.6s ease-out;
  animation-delay: 0.3s;
  animation-fill-mode: both;
}

.skeleton-features {
  animation: fadeInUp 0.6s ease-out;
  animation-delay: 0.4s;
  animation-fill-mode: both;
}

.skeleton-feature-item:nth-child(1) {
  animation-delay: 0.5s;
}

.skeleton-feature-item:nth-child(2) {
  animation-delay: 0.6s;
}

.skeleton-feature-item:nth-child(3) {
  animation-delay: 0.7s;
}

.skeleton-bottom {
  animation: fadeInUp 0.6s ease-out;
  animation-delay: 0.8s;
  animation-fill-mode: both;
}

@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes scaleIn {
  from {
    opacity: 0;
    transform: scale(0.95);
  }
  to {
    opacity: 1;
    transform: scale(1);
  }
}

/* Card hover effects */
.popular-list-1:hover .skeleton-property-image {
  animation: pulse 2s ease-in-out infinite;
}

@keyframes pulse {
  0%,
  100% {
    opacity: 1;
  }
  50% {
    opacity: 0.8;
  }
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .skeleton-slider {
    height: 200px;
  }

  .skeleton-line-lg {
    width: 160px;
  }

  .skeleton-line-md {
    width: 120px;
  }

  .skeleton-features {
    flex-wrap: wrap;
    gap: 12px;
  }

  .skeleton-nav-btn {
    width: 32px;
    height: 32px;
  }

  .skeleton-action-btn {
    width: 80px;
    height: 28px;
  }
}

@media (max-width: 576px) {
  .skeleton-slider {
    height: 180px;
  }

  .skeleton-features {
    flex-direction: column;
    align-items: flex-start;
    gap: 8px;
  }

  .skeleton-bottom {
    flex-direction: column;
    align-items: flex-start;
    gap: 12px;
  }

  .skeleton-view-btn {
    width: 100%;
  }
}

/* Remove custom card styling to maintain original design */
.popular-list-1 {
  transition: opacity 0.3s ease-in-out;
}

/* Breathing animation for interactive elements */
.skeleton-nav-btn,
.skeleton-action-btn,
.skeleton-view-btn {
  animation: breathe 3s ease-in-out infinite;
}

.skeleton-nav-btn:first-child {
  animation-delay: 0s;
}

.skeleton-nav-btn:last-child {
  animation-delay: 0.5s;
}

.skeleton-action-btn {
  animation-delay: 1s;
}

.skeleton-view-btn {
  animation-delay: 1.5s;
}

@keyframes breathe {
  0%,
  100% {
    transform: scale(1);
    opacity: 0.8;
  }
  50% {
    transform: scale(1.05);
    opacity: 1;
  }
}
</style>
