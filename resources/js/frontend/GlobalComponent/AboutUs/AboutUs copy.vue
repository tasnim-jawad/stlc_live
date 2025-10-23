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
            <div class="about-left">
              <div class="img-box">
                <div
                  class="skeleton-image skeleton-image-large skeleton-shimmer"
                ></div>
              </div>
              <div class="img-box small">
                <div
                  class="skeleton-image skeleton-image-small skeleton-shimmer"
                ></div>
              </div>
            </div>
            <div class="about-middle">
              <div
                class="skeleton-image skeleton-image-middle skeleton-shimmer"
              ></div>
            </div>
            <div class="about-right">
              <div class="img-box small">
                <div
                  class="skeleton-image skeleton-image-small skeleton-shimmer"
                ></div>
              </div>
              <div class="img-box big">
                <div
                  class="skeleton-image skeleton-image-large skeleton-shimmer"
                ></div>
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
        <div class="col-xl-7">
          <div
            class="img-box1 about-1 fadeinup wow"
            data-wow-duration="1.5s"
            data-wow-delay="0.3s"
          >
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
            <div class="about-left">
              <div class="img-box">
                <img :src="getSequentialImage(0)" alt="Image" />
              </div>
              <div class="img-box small">
                <img :src="getSequentialImage(1)" alt="Image" />
              </div>
            </div>
            <div class="about-middle">
              <img
                class="tilt-active"
                :src="getSequentialImage(2)"
                alt="Image"
              />
            </div>
            <div class="about-right">
              <div class="img-box small">
                <img :src="getSequentialImage(3)" alt="Image" />
              </div>
              <div class="img-box big">
                <img :src="getSequentialImage(4)" alt="Image" />
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
              Discover Our Luxury Property, with Full Amenities
            </h2>
            <p
              class="sec-text fadeinup wow"
              data-wow-duration="1.5s"
              data-wow-delay="0.5s"
            >
              {{ about_us?.description }}
            </p>
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
            <!-- <div class="col-lg-6 col-md-6 fadeinup wow">
              <div class="about-1-item">
                <div class="icon">
                  <img
                    src="/assets/frontend/img/icon/about-1-1.svg"
                    alt="icon"
                  />
                </div>
                <div class="content">
                  <h3 class="box-title">Quality Services</h3>
                  <p class="box-text">
                    Deals with issues in the exhaust system, ensuring
                  </p>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 fadeinup wow">
              <div class="about-1-item">
                <div class="icon">
                  <img
                    src="/assets/frontend/img/icon/about-1-2.svg"
                    alt="icon"
                  />
                </div>
                <div class="content">
                  <h3 class="box-title">Clients Feedback</h3>
                  <p class="box-text">
                    Ensuring the exhaust system deals issues properly.
                  </p>
                  <p class="box-text"></p>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 fadeinup wow">
              <div class="about-1-item">
                <div class="icon">
                  <img
                    src="/assets/frontend/img/icon/about-1-3.svg"
                    alt="icon"
                  />
                </div>
                <div class="content">
                  <h3 class="box-title">Space Belongings</h3>
                  <p class="box-text">
                    Ensuring that issues in the system are dealt with.
                  </p>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 fadeinup wow">
              <div class="about-1-item">
                <div class="icon">
                  <img
                    src="/assets/frontend/img/icon/about-1-4.svg"
                    alt="icon"
                  />
                </div>
                <div class="content">
                  <h3 class="box-title">Personal Liability</h3>
                  <p class="box-text">
                    Exhaust system deals with all issues efficiency.
                  </p>
                </div>
              </div>
            </div> -->
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

    return {
      isLoading,
    };
  },

  created() {
    this.isLoading = true;
    this.fetch_about_us_data();
  },

  watch: {
    about_us: {
      handler(newData) {
        if (newData && Object.keys(newData).length > 0) {
          // Add a small delay for smooth transition
          setTimeout(() => {
            this.isLoading = false;
          }, 800);
        } else {
          this.isLoading = true;
        }
      },
      immediate: true,
      deep: true,
    },
  },

  methods: {
    ...mapActions(about_us_store, ["fetch_about_us_data"]),

    getSequentialImage(position) {
      // Default fallback images for each position
      const fallbackImages = [
        "/assets/frontend/img/about/about-1-left-1.jpg", // position 0
        "/assets/frontend/img/about/about-1-left-2.jpg", // position 1
        "/assets/frontend/img/about/about-1-middle.jpg", // position 2
        "/assets/frontend/img/about/about-1-right-1.jpg", // position 3
        "/assets/frontend/img/about/about-1-right-2.jpg", // position 4
      ];

      // Check if we have dynamic images
      if (
        this.about_us?.primary_image &&
        Array.isArray(this.about_us.primary_image) &&
        this.about_us.primary_image.length > 0
      ) {
        const images = this.about_us.primary_image;

        // If we have enough images, use them in order
        if (images[position]) {
          const imageUrl = images[position];
          return imageUrl &&
            !imageUrl.startsWith("http") &&
            !imageUrl.startsWith("/")
            ? `/${imageUrl}`
            : imageUrl;
        }

        // If not enough images, use sequential cycling (not random)
        const sequentialIndex = position % images.length;
        const sequentialImage = images[sequentialIndex];
        return sequentialImage &&
          !sequentialImage.startsWith("http") &&
          !sequentialImage.startsWith("/")
          ? `/${sequentialImage}`
          : sequentialImage;
      }

      // Return fallback image for this position
      return fallbackImages[position] || fallbackImages[0];
    },

    getImageUrl(imageArray, index, fallbackUrl) {
      // Check if imageArray exists and has the required index
      if (imageArray && Array.isArray(imageArray) && imageArray[index]) {
        const imageUrl = imageArray[index];
        // If it's a relative path, add leading slash
        if (
          imageUrl &&
          !imageUrl.startsWith("http") &&
          !imageUrl.startsWith("/")
        ) {
          return `/${imageUrl}`;
        }
        return imageUrl;
      }
      // Return fallback image if no dynamic image is available
      return fallbackUrl;
    },
  },

  computed: {
    ...mapState(about_us_store, ["about_us"]),

    showSkeleton() {
      return (
        this.isLoading ||
        !this.about_us ||
        Object.keys(this.about_us || {}).length === 0
      );
    },

    showContent() {
      return (
        !this.isLoading &&
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
[v-if="showSkeleton"] .about-left .img-box,
[v-if="showSkeleton"] .about-right .img-box,
[v-if="showSkeleton"] .about-middle {
  position: relative;
  display: block;
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
.img-box1.about-1 {
  animation: pulse 3s ease-in-out infinite;
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

/* Mobile responsive styles for About Us logo section */
@media (max-width: 768px) {
  .about-logo-wrap-2 {
    display: block !important;
    visibility: visible !important;
    opacity: 1 !important;
    position: relative !important;
    z-index: 10 !important;
    margin-bottom: 20px !important;
  }

  .logo-icon-wrap {
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    flex-direction: column !important;
    gap: 15px !important;
    position: relative !important;
  }

  .logo-icon {
    display: block !important;
    visibility: visible !important;
    opacity: 1 !important;
    width: 60px !important;
    height: 60px !important;
    margin: 0 auto !important;
  }

  .logo-icon img {
    width: 100% !important;
    height: 100% !important;
    object-fit: contain !important;
  }

  /* Ensure the entire about section is visible */
  .img-box1.about-1 {
    position: relative !important;
    display: block !important;
    width: 100% !important;
  }
}

@media (max-width: 576px) {
  .about-logo-wrap-2 {
    margin-bottom: 15px !important;
  }

  .logo-icon {
    width: 50px !important;
    height: 50px !important;
  }

  .logo-icon-wrap {
    gap: 10px !important;
  }
}

/* Very small screens */
@media (max-width: 480px) {
  .about-logo-wrap-2 {
    margin-bottom: 10px !important;
  }

  .logo-icon {
    width: 40px !important;
    height: 40px !important;
  }

  .logo-icon-wrap {
    gap: 8px !important;
  }
}
</style>
