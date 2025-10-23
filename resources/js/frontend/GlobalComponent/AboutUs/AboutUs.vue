<template>
  <!-- Skeleton Loader -->
  <div
    class="about-1-wrapper space overflow-hidden position-relative"
    id="about-sec"
    v-if="showSkeleton"
  >
    <div class="shape-mockup" data-bottom="0" data-left="0">
      <div class="skeleton-shape skeleton-shimmer"></div>
    </div>
    <div
      class="shape-mockup bird jump d-none d-lg-block"
      data-bottom="11%"
      data-left="5%"
    >
      <div class="skeleton-shape skeleton-shimmer"></div>
    </div>
    <div class="container">
      <div class="row gy-40 gx-70 justify-content-center">
        <div class="col-xl-7">
          <div class="img-box1 about-1">
            <!-- Skeleton Logo Section -->
            <div class="about-logo-wrap-2">
              <div class="logo-icon-wrap">
                <div class="logo-icon skeleton-circle skeleton-shimmer"></div>
                <div class="skeleton-circle-text">
                  <div class="skeleton-circle-ring skeleton-shimmer"></div>
                </div>
              </div>
            </div>

            <!-- Skeleton Image Gallery -->
            <div class="skeleton-image-gallery">
              <div class="about-left">
                <div class="img-box large">
                  <div
                    class="skeleton-placeholder w-100 d-flex justify-content-center align-items-center"
                  >
                    <div
                      class="skeleton-image skeleton-image-large skeleton-shimmer"
                    ></div>
                  </div>
                </div>
                <div class="img-box small">
                  <div
                    class="skeleton-placeholder w-100 d-flex justify-content-center align-items-center"
                  >
                    <div
                      class="skeleton-image skeleton-image-small skeleton-shimmer"
                    ></div>
                  </div>
                </div>
              </div>

              <div class="about-middle">
                <div
                  class="skeleton-main-placeholder w-100 d-flex justify-content-center align-items-center"
                >
                  <div
                    class="skeleton-image skeleton-image-middle skeleton-shimmer"
                  ></div>
                </div>
              </div>

              <div class="about-right">
                <div class="img-box small">
                  <div
                    class="skeleton-placeholder w-100 d-flex justify-content-center align-items-center"
                  >
                    <div
                      class="skeleton-image skeleton-image-small skeleton-shimmer"
                    ></div>
                  </div>
                </div>
                <div class="img-box big">
                  <div
                    class="skeleton-placeholder w-100 d-flex justify-content-center align-items-center"
                  >
                    <div
                      class="skeleton-image skeleton-image-large skeleton-shimmer"
                    ></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-5">
          <!-- Skeleton Title Area -->
          <div class="title-area text-left mb-50">
            <div class="skeleton-subtitle">
              <div
                class="skeleton-line skeleton-line-xs skeleton-shimmer"
              ></div>
            </div>
            <div class="skeleton-title" style="margin-top: 16px">
              <div
                class="skeleton-line skeleton-line-xl skeleton-shimmer"
              ></div>
              <div
                class="skeleton-line skeleton-line-lg skeleton-shimmer"
                style="margin-top: 8px"
              ></div>
            </div>
            <div class="skeleton-description" style="margin-top: 20px">
              <div
                class="skeleton-line skeleton-line-md skeleton-shimmer"
              ></div>
              <div
                class="skeleton-line skeleton-line-md skeleton-shimmer"
                style="margin-top: 8px"
              ></div>
              <div
                class="skeleton-line skeleton-line-sm skeleton-shimmer"
                style="margin-top: 8px"
              ></div>
            </div>
          </div>

          <!-- Skeleton Feature Items -->
          <div class="row gy-4 gx-60 mb-4">
            <div class="col-lg-6 col-md-6" v-for="n in 4" :key="n">
              <div class="about-1-item">
                <div class="icon">
                  <div class="skeleton-icon skeleton-shimmer"></div>
                </div>
                <div class="content">
                  <div class="skeleton-feature-title">
                    <div
                      class="skeleton-line skeleton-line-sm skeleton-shimmer"
                    ></div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Skeleton Button -->
          <div class="row">
            <div class="col-lg-12">
              <div class="about-bottom-wrap">
                <div class="skeleton-button skeleton-shimmer"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Actual Content -->
  <div
    class="about-1-wrapper space overflow-hidden position-relative"
    id="about-sec"
    v-if="showContent"
  >
    <div class="shape-mockup" data-bottom="0" data-left="0">
      <img src="/assets/frontend/img/icon/about-2-shape.png" alt="img" />
    </div>
    <div
      class="shape-mockup bird jump d-none d-lg-block"
      data-bottom="11%"
      data-left="5%"
    >
      <img src="/assets/frontend/img/icon/about-inner-shape.png" alt="img" />
    </div>
    <div class="container">
      <div class="row gy-40 gx-70 justify-content-center">
        <div class="col-xl-7 mx-0 px-0">
          <div class="img-box1 about-1 fadeinup wow justify-content-center">
            <div class="about-logo-wrap-2">
              <div class="logo-icon-wrap">
                <div class="logo-icon">
                  <img :src="'/' + about_us?.secondary_image" alt="img" />
                </div>
                <!-- <div class="logo-icon-wrap__text">
                  <span class="logo-animation"
                    >PILLAR REAL ESTATE HOME * REAL ESTATE</span
                  >
                </div> -->
                <CircleText :text="about_us?.quotation" />
              </div>
            </div>
            <div class="about-main-image w-100">
              <div
                class="w-100 d-flex justify-content-center align-items-center position-relative"
              >
                <!-- Image skeleton loader - shows while image is loading -->
                <div
                  v-if="!isImageLoaded && about_us?.primary_image?.[0]"
                  class="image-skeleton-placeholder w-100 d-flex justify-content-center align-items-center"
                >
                  <div
                    class="skeleton-image skeleton-image-main skeleton-shimmer"
                  ></div>
                </div>
                <!-- Actual image - only show when loaded -->
                <img
                  v-if="about_us?.primary_image?.[0]"
                  v-show="isImageLoaded"
                  class="img-fluid rounded w-100 fade-in"
                  :src="about_us.primary_image[0]"
                  alt="About Us Main Image"
                  @load="handleImageLoad"
                  @error="handleImageError"
                  ref="aboutMainImage"
                />
                <!-- Fallback when no image -->
                <div
                  v-if="!about_us?.primary_image?.[0]"
                  class="no-image-placeholder w-100 d-flex justify-content-center align-items-center"
                >
                  <div
                    class="skeleton-image skeleton-image-main skeleton-shimmer"
                  ></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-5">
          <div class="title-area text-left mb-50">
            <p
              class="sub-title fadeinup wow"
              data-wow-duration="1.5s"
              data-wow-delay="0.1s"
            >
              <span class="double-line"></span> About Us
            </p>
            <h2
              class="sec-title fadeinup wow"
              data-wow-duration="1.5s"
              data-wow-delay="0.3s"
            >
              {{ about_us?.title }}
            </h2>
            <p
              class="sec-text fadeinup wow"
              data-wow-duration="1.5s"
              data-wow-delay="0.5s"
            >
             <div v-html="about_us?.description?.slice(0, 285 * 6) + '...'" ></div>
            </p>
            <div class="about-bottom-wrap fadeinup wow">
               <Link class="th-btn pill bg-black mb-5"
                href="/about-us"
                data-wow-duration="1.5s"
                data-wow-delay="0.7s"
              >
                Read More
              </Link>
            </div>
          </div>
          <div class="row gy-4 gx-60 mb-4">
            <div
              class="col-lg-6 col-md-6 fadeinup wow"
              v-for="(item, index) in about_us?.features"
              :key="index"
            >
              <div class="about-1-item">
                <div class="icon">
                  <span><i :class="item?.icon"></i></span>
                </div>
                <div class="content">
                  <h3 class="box-title">{{ item?.title }}</h3>
                  <!-- <p class="box-text">
                    {{ item?.description }}
                  </p> -->
                </div>
              </div>
            </div>
          
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, computed } from "vue";
import CircleText from "../../Pages/Home/components/CircleText.vue";
import { store as about_us_store } from "./Store/aboutStore.js";
import { mapActions, mapState } from "pinia";

export default {
  components: {
    CircleText,
  },

  setup() {
    const isLoading = ref(true);
    const isImageLoaded = ref(false);
    const imageLoadTimeout = ref(null);

    return {
      isLoading,
      isImageLoaded,
      imageLoadTimeout,
    };
  },

  created() {
    this.isLoading = true;
    this.isImageLoaded = false;
    this.fetch_about_us_data();
  },

  mounted() {
    // Check if images are already loaded when component mounts
    this.$nextTick(() => {
      this.checkImageLoadingState();
    });
  },

  activated() {
    // Handle keep-alive component activation (when navigating back)
    console.log("AboutUs component activated");
    this.$nextTick(() => {
      // If we have data but image isn't marked as loaded, check again
      if (this.about_us?.primary_image?.[0] && !this.isImageLoaded) {
        this.checkImageLoadingState();
      }
    });
  },

  watch: {
    about_us: {
      handler(newData) {
        if (newData && Object.keys(newData).length > 0) {
          // Reset image loading state when new data arrives
          this.isImageLoaded = false;
          // Add a small delay for smooth transition
          setTimeout(() => {
            this.isLoading = false;
            // Check if image is already cached and loaded
            this.$nextTick(() => {
              this.checkImageLoadingState();
            });
          }, 300);
        } else {
          this.isLoading = true;
          this.isImageLoaded = false;
        }
      },
      immediate: true,
      deep: true,
    },
  },

  methods: {
    ...mapActions(about_us_store, ["fetch_about_us_data"]),

    handleImageLoad() {
      console.log("Image loaded successfully");
      // Add a small delay for smooth transition
      setTimeout(() => {
        this.isImageLoaded = true;
      }, 100);
    },

    handleImageError(event) {
      console.error("Failed to load about us image:", event);
      // Still show the image area even if there's an error
      setTimeout(() => {
        this.isImageLoaded = true;
      }, 100);
    },

    resetImageLoadingState() {
      console.log("Resetting image loading state");
      this.isImageLoaded = false;
    },

    checkImageLoadingState() {
      // Check if the main image exists and is complete (already loaded)
      const imgElement = this.$refs.aboutMainImage;
      if (imgElement) {
        if (imgElement.complete && imgElement.naturalHeight !== 0) {
          console.log("Image already loaded (cached)");
          this.isImageLoaded = true;
        } else {
          console.log("Image not yet loaded, waiting for load event");
          // For server environments, give it a bit more time
          setTimeout(() => {
            if (imgElement.complete && imgElement.naturalHeight !== 0) {
              this.isImageLoaded = true;
            }
          }, 500);
        }
      } else if (this.about_us?.primary_image?.[0]) {
        // If we have image data but no DOM element yet, wait a bit more
        setTimeout(() => {
          this.checkImageLoadingState();
        }, 200);
      }
    },

    // Handle component unmount/cleanup
    beforeUnmount() {
      // Clear any pending timeouts to prevent memory leaks
      if (this.imageLoadTimeout) {
        clearTimeout(this.imageLoadTimeout);
      }
    },
  },

  computed: {
    ...mapState(about_us_store, ["about_us", "loading"]),

    showSkeleton() {
      return (
        this.isLoading ||
        this.loading ||
        !this.about_us ||
        Object.keys(this.about_us || {}).length === 0
      );
    },

    showContent() {
      return (
        !this.isLoading &&
        !this.loading &&
        this.about_us &&
        Object.keys(this.about_us || {}).length > 0
      );
    },
  },
};
</script>

<style scoped>
/* Professional AboutUs Skeleton Loader Styles */

/* Base skeleton elements */
.skeleton-line {
  border-radius: 8px;
  background: linear-gradient(90deg, #e2e8f0 25%, #f1f5f9 50%, #e2e8f0 75%);
  background-size: 200% 100%;
  position: relative;
  overflow: hidden;
}

/* Skeleton line sizes */
.skeleton-line-xs {
  height: 16px;
  width: 120px;
}

.skeleton-line-sm {
  height: 18px;
  width: 160px;
}

.skeleton-line-md {
  height: 20px;
  width: 100%;
}

.skeleton-line-lg {
  height: 32px;
  width: 90%;
}

.skeleton-line-xl {
  height: 40px;
  width: 100%;
}

/* Skeleton images */
.skeleton-image {
  background: linear-gradient(90deg, #e2e8f0 25%, #f1f5f9 50%, #e2e8f0 75%);
  background-size: 200% 100%;
  border-radius: 12px;
  position: relative;
  overflow: hidden;
}

.skeleton-image-small {
  width: 100%;
  height: 120px;
  min-height: 120px;
}

.skeleton-image-large {
  width: 100%;
  height: 200px;
  min-height: 200px;
}

.skeleton-image-middle {
  width: 100%;
  height: 300px;
  min-height: 300px;
  border-radius: 20px;
}

/* Ensure skeleton containers are visible only when skeleton is active */
.skeleton-image-gallery {
  width: 100%;
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.skeleton-placeholder,
.skeleton-main-placeholder {
  position: relative;
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 120px;
}

.skeleton-main-placeholder {
  min-height: 300px;
}

[v-if="showSkeleton"] .about-left .img-box,
[v-if="showSkeleton"] .about-right .img-box,
[v-if="showSkeleton"] .about-middle {
  position: relative;
  display: block;
}

[v-if="showSkeleton"] .about-left .img-box.large {
  min-height: 200px;
}

[v-if="showSkeleton"] .about-left .img-box.small,
[v-if="showSkeleton"] .about-right .img-box.small {
  min-height: 120px;
}

[v-if="showSkeleton"] .about-right .img-box.big {
  min-height: 200px;
}

/* Force skeleton visibility in image containers only during loading */
[v-if="showSkeleton"] .about-left .skeleton-image,
[v-if="showSkeleton"] .about-right .skeleton-image,
[v-if="showSkeleton"] .about-middle .skeleton-image {
  display: block;
  opacity: 1;
  visibility: visible;
}

/* Skeleton shapes */
.skeleton-shape {
  width: 80px;
  height: 80px;
  background: linear-gradient(90deg, #e2e8f0 25%, #f1f5f9 50%, #e2e8f0 75%);
  background-size: 200% 100%;
  border-radius: 50%;
  opacity: 0.3;
}

/* Skeleton logo/circle elements */
.skeleton-circle {
  width: 60px;
  height: 60px;
  background: linear-gradient(90deg, #e2e8f0 25%, #f1f5f9 50%, #e2e8f0 75%);
  background-size: 200% 100%;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
}

.skeleton-circle-ring {
  width: 120px;
  height: 120px;
  border: 3px solid #e2e8f0;
  border-radius: 50%;
  background: transparent;
  animation: rotate 3s linear infinite;
}

@keyframes rotate {
  from {
    transform: rotate(0deg);
  }
  to {
    transform: rotate(360deg);
  }
}

/* Skeleton icon */
.skeleton-icon {
  width: 50px;
  height: 50px;
  background: linear-gradient(90deg, #e2e8f0 25%, #f1f5f9 50%, #e2e8f0 75%);
  background-size: 200% 100%;
  border-radius: 12px;
}

/* Skeleton button */
.skeleton-button {
  height: 48px;
  width: 180px;
  border-radius: 25px;
  background: linear-gradient(90deg, #e2e8f0 25%, #f1f5f9 50%, #e2e8f0 75%);
  background-size: 200% 100%;
  position: relative;
  overflow: hidden;
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

/* Skeleton section animations with staggered delays */
.skeleton-subtitle {
  animation: fadeInUp 0.6s ease-out;
  animation-delay: 0.1s;
  animation-fill-mode: both;
}

.skeleton-title {
  animation: fadeInUp 0.6s ease-out;
  animation-delay: 0.2s;
  animation-fill-mode: both;
}

.skeleton-description {
  animation: fadeInUp 0.6s ease-out;
  animation-delay: 0.3s;
  animation-fill-mode: both;
}

.about-1-item {
  animation: fadeInUp 0.6s ease-out;
  animation-fill-mode: both;
}

.about-1-item:nth-child(1) {
  animation-delay: 0.4s;
}

.about-1-item:nth-child(2) {
  animation-delay: 0.5s;
}

.about-1-item:nth-child(3) {
  animation-delay: 0.6s;
}

.about-1-item:nth-child(4) {
  animation-delay: 0.7s;
}

@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* Skeleton image gallery animations */
.about-left {
  animation: slideInLeft 0.8s ease-out;
  animation-delay: 0.2s;
  animation-fill-mode: both;
}

.about-middle {
  animation: fadeIn 0.8s ease-out;
  animation-delay: 0.4s;
  animation-fill-mode: both;
}

.about-right {
  animation: slideInRight 0.8s ease-out;
  animation-delay: 0.6s;
  animation-fill-mode: both;
}

@keyframes slideInLeft {
  from {
    opacity: 0;
    transform: translateX(-50px);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

@keyframes slideInRight {
  from {
    opacity: 0;
    transform: translateX(50px);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

@keyframes fadeIn {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}

/* Pulse effect for overall engagement */

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
  .skeleton-image-middle {
    height: 200px;
  }

  .skeleton-image-large {
    height: 150px;
  }

  .skeleton-image-small {
    height: 100px;
  }

  .skeleton-line-xl {
    height: 32px;
  }

  .skeleton-line-lg {
    height: 28px;
  }

  .skeleton-button {
    width: 160px;
    height: 44px;
  }

  .skeleton-main-placeholder {
    min-height: 200px;
  }

  [v-if="showSkeleton"] .about-left .img-box.large,
  [v-if="showSkeleton"] .about-right .img-box.big {
    min-height: 150px;
  }

  [v-if="showSkeleton"] .about-left .img-box.small,
  [v-if="showSkeleton"] .about-right .img-box.small {
    min-height: 100px;
  }
}

@media (max-width: 576px) {
  .skeleton-circle-ring {
    width: 80px;
    height: 80px;
  }

  .skeleton-circle {
    width: 40px;
    height: 40px;
  }

  .skeleton-icon {
    width: 40px;
    height: 40px;
  }

  .skeleton-main-placeholder {
    min-height: 180px;
  }

  [v-if="showSkeleton"] .about-left .img-box.large,
  [v-if="showSkeleton"] .about-right .img-box.big {
    min-height: 120px;
  }

  [v-if="showSkeleton"] .about-left .img-box.small,
  [v-if="showSkeleton"] .about-right .img-box.small {
    min-height: 80px;
  }
}

/* Loading transition effect */
.about-1-wrapper {
  transition: opacity 0.3s ease-in-out;
}

/* Skeleton content spacing adjustments */
.skeleton-feature-title {
  margin-top: 8px;
}

.skeleton-circle-text {
  margin-left: 15px;
}

/* About Us Main Image Styling */
.about-main-image .w-100 {
  max-width: 100%;
  height: auto;
  min-height: 300px; /* Ensure consistent height during loading */
}

.about-main-image img {
  max-width: 100%;
  height: auto;
  object-fit: cover;
  border-radius: 15px;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s ease, box-shadow 0.3s ease, opacity 0.5s ease;
}

.about-main-image img:hover {
  transform: translateY(-5px);
  box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
}

/* Image loading animations */
.fade-in {
  animation: fadeInImage 0.6s ease-in-out;
}

@keyframes fadeInImage {
  from {
    opacity: 0;
    transform: scale(0.95);
  }
  to {
    opacity: 1;
    transform: scale(1);
  }
}
p.sec-text.fadeinup.wow {
  text-align: justify;
}
/* Image skeleton placeholder */
.image-skeleton-placeholder,
.no-image-placeholder {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  min-height: 300px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.skeleton-image-main {
  width: 100%;
  height: 300px;
  min-height: 500px;
  border-radius: 15px;
  background: linear-gradient(90deg, #e2e8f0 25%, #f1f5f9 50%, #e2e8f0 75%);
  background-size: 200% 100%;
  position: relative;
  overflow: hidden;
}

/* Enhanced image skeleton shimmer */
.skeleton-image-main.skeleton-shimmer {
  animation: shimmer 2s infinite linear;
}

.skeleton-image-main.skeleton-shimmer::before {
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

/* Ensure proper layering */
.about-main-image {
  position: relative;
  z-index: 1;
}

/* Make sure the container has proper height */
.about-main-image .w-100 {
  position: relative;
}

/* Hide skeleton when image is loaded */
.about-main-image img[v-show="isImageLoaded"] ~ .image-skeleton-placeholder {
  display: none;
}

/* Responsive adjustments for about main image */
@media (max-width: 768px) {
  .about-main-image {
    margin-top: 20px;
    padding: 15px;
  }

  .about-main-image img {
    border-radius: 10px;
  }

  .about-main-image .w-100 {
    min-height: 200px;
  }

  .skeleton-image-main {
    height: 200px;
    min-height: 200px;
    border-radius: 10px;
  }

  .image-skeleton-placeholder,
  .no-image-placeholder {
    min-height: 200px;
  }
}

@media (max-width: 576px) {
  .about-main-image .w-100 {
    min-height: 180px;
  }

  .skeleton-image-main {
    height: 180px;
    min-height: 180px;
  }

  .image-skeleton-placeholder,
  .no-image-placeholder {
    min-height: 180px;
  }
}
</style>
