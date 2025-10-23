<template>
  <div class="col-xl-4 col-lg-6 col-md-6">
    <!-- Skeleton State -->
    <div v-if="!service || isLoading" class="why-card-1 skeleton-card">
      <div class="skeleton-hover-icon">
        <div class="skeleton-element skeleton-hover-img"></div>
      </div>
      <div class="skeleton-icon">
        <div class="skeleton-element skeleton-service-icon"></div>
      </div>
      <div class="skeleton-content">
        <div class="skeleton-element skeleton-title"></div>
        <div class="skeleton-element skeleton-text-line"></div>
        <div class="skeleton-element skeleton-text-line short"></div>
      </div>
      <div class="skeleton-bottom">
        <div class="skeleton-element skeleton-button"></div>
      </div>
    </div>

    <!-- Actual Content -->
    <div v-else class="why-card-1">
      <div class="hover-icon">
        <img src="/assets/frontend/img/icon/why-hover-icon-1.png" alt="img" />
      </div>
      <div class="why-card-1__icon">
        <img
          :src="'/' + service?.image"
          alt="image"
          @error="handleImageError"
        />
      </div>
      <div class="why-card-1__content">
        <h3 class="box-title">
          {{
            service?.title?.length > 40
              ? service.title.substring(0, 40) + "..."
              : service?.title
          }}
        </h3>
        <p class="box-text">
          {{
            service?.description?.length > 200
              ? service.description.substring(0, 200) + "..."
              : service?.description
          }}
        </p>
      </div>
      <div class="why-card-1__bottom">
        <Link class="th-btn style3 pill bg-white" href="/portfolio">
          Find a Home
        </Link>
      </div>
    </div>
  </div>
</template>

<script>
import { Link } from "@inertiajs/vue3";

export default {
  name: "ServiceSingleItem",
  components: {
    Link,
  },

  props: {
    service: {
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
    // Check if service has required data
    hasValidService() {
      return this.service && this.service.title && this.service.description;
    },
  },

  methods: {
    handleImageError(event) {
      // Set a fallback image if the original fails to load
      event.target.src = "/assets/frontend/img/icon/default-service-icon.png";
    },
  },
};
</script>

<style scoped>
/* Skeleton Loading Styles for Individual Service Item */
.skeleton-card {
  position: relative;
  opacity: 0.8;
}

/* Base skeleton element with shimmer animation */
.skeleton-element {
  background: linear-gradient(90deg, #e2e8f0 0%, #f8fafc 50%, #e2e8f0 100%);
  background-size: 200% 100%;
  animation: shimmer 1.8s infinite;
  border-radius: 6px;
}

@keyframes shimmer {
  0% {
    background-position: -200% 0;
  }
  100% {
    background-position: 200% 0;
  }
}

/* Skeleton hover icon */
.skeleton-hover-icon {
  position: absolute;
  top: 25px;
  right: 25px;
  z-index: 2;
}

.skeleton-hover-img {
  width: 45px;
  height: 45px;
  border-radius: 50%;
  opacity: 0.6;
}

/* Skeleton service icon */
.skeleton-icon {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-bottom: 30px;
  height: 100px;
}

.skeleton-service-icon {
  width: 85px;
  height: 85px;
  border-radius: 15px;
}

/* Skeleton content area */
.skeleton-content {
  text-align: center;
  margin-bottom: 35px;
  padding: 0 25px;
}

.skeleton-title {
  width: 75%;
  height: 26px;
  margin: 0 auto 22px auto;
  border-radius: 8px;
}

.skeleton-text-line {
  width: 100%;
  height: 18px;
  margin-bottom: 14px;
  border-radius: 5px;
}

.skeleton-text-line.short {
  width: 85%;
  margin: 0 auto;
}

/* Skeleton bottom section */
.skeleton-bottom {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top: auto;
}

.skeleton-button {
  width: 145px;
  height: 48px;
  border-radius: 25px;
}

/* Ensure skeleton maintains original card structure */
.skeleton-card.why-card-1 {
  min-height: 320px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  padding: 35px 25px;
  background: rgba(255, 255, 255, 0.05);
  border-radius: 12px;
  backdrop-filter: blur(10px);
}

/* Staggered animation for multiple skeletons */
.skeleton-card:nth-child(1) .skeleton-element {
  animation-delay: 0s;
}

.skeleton-card:nth-child(2) .skeleton-element {
  animation-delay: 0.1s;
}

.skeleton-card:nth-child(3) .skeleton-element {
  animation-delay: 0.2s;
}

.skeleton-card:nth-child(4) .skeleton-element {
  animation-delay: 0.3s;
}

.skeleton-card:nth-child(5) .skeleton-element {
  animation-delay: 0.4s;
}

.skeleton-card:nth-child(6) .skeleton-element {
  animation-delay: 0.5s;
}

/* Responsive adjustments */
@media (max-width: 1199px) {
  .skeleton-service-icon {
    width: 75px;
    height: 75px;
  }

  .skeleton-card.why-card-1 {
    min-height: 300px;
    padding: 30px 20px;
  }
}

@media (max-width: 767px) {
  .skeleton-service-icon {
    width: 65px;
    height: 65px;
  }

  .skeleton-title {
    height: 22px;
    width: 80%;
  }

  .skeleton-text-line {
    height: 16px;
  }

  .skeleton-button {
    width: 130px;
    height: 42px;
  }

  .skeleton-card.why-card-1 {
    min-height: 280px;
    padding: 25px 20px;
  }
}

/* Smooth transition when content loads */
.why-card-1 {
  transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

/* Ensure skeleton doesn't interfere with original hover effects */
.skeleton-card:hover {
  transform: none !important;
}

/* Fade-in animation for loaded content */
.why-card-1:not(.skeleton-card) {
  animation: fadeInContent 0.6s ease-out;
}

@keyframes fadeInContent {
  from {
    opacity: 0;
    transform: translateY(10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>
