<template>
  <div class="swiper-slide">
    <!-- Skeleton Loader -->
    <div class="team-card" v-if="showSkeleton">
      <div class="team-img skeleton-team-img">
        <div class="skeleton-image skeleton-team-image skeleton-shimmer"></div>
      </div>
      <div class="team-content">
        <!-- Skeleton Name -->
        <div class="skeleton-name">
          <div class="skeleton-line skeleton-line-md skeleton-shimmer"></div>
        </div>

        <!-- Skeleton Designation -->
        <div class="skeleton-designation" style="margin-top: 8px">
          <div class="skeleton-line skeleton-line-sm skeleton-shimmer"></div>
        </div>

        <!-- Skeleton Social Links -->
        <div class="team-social" style="margin-top: 16px">
          <div class="th-social skeleton-social">
            <div
              class="skeleton-social-link skeleton-shimmer"
              v-for="n in 3"
              :key="n"
            ></div>
          </div>
        </div>
      </div>
    </div>

    <!-- Actual Content -->
    <div class="team-card" v-if="showContent">
      <div
        class="team-img"
        :style="{
          backgroundImage: `url(/assets/frontend/img/shape/team-bg-pattern.png)`,
        }"
      >
        <img :src="member?.image" alt="Team" />
      </div>
      <div class="team-content">
        <h3 class="box-title">
          <a href="javascript:void(0)">{{ member?.name }}</a>
        </h3>
        <span class="team-desig">{{ member?.designation }}</span>
        <div class="team-social">
          <div class="th-social">
            <a
              v-for="(link, index) in member?.social_link"
              :key="index"
              target="_blank"
              :href="link?.title"
              ><i :class="link?.icon"></i
            ></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    member: {
      type: Object,
      required: false,
      default: null,
    },
    isLoading: {
      type: Boolean,
      default: false, // Changed default to false
    },
  },

  computed: {
    showSkeleton() {
      // Show skeleton if explicitly loading or if no member data
      return this.isLoading || !this.member;
    },

    showContent() {
      // Show content only when not loading AND member data exists
      return !this.isLoading && this.member;
    },
  },
};
</script>

<style scoped>
/* Professional Team Card Skeleton Loader Styles */

/* Base skeleton elements */
.skeleton-line {
  border-radius: 6px;
  background: linear-gradient(90deg, #e2e8f0 25%, #f1f5f9 50%, #e2e8f0 75%);
  background-size: 200% 100%;
  position: relative;
  overflow: hidden;
}

/* Skeleton line sizes for team cards */
.skeleton-line-sm {
  height: 16px;
  width: 80px;
}

.skeleton-line-md {
  height: 20px;
  width: 120px;
}

/* Team image skeleton */
.skeleton-team-img {
  background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
  border-radius: 12px 12px 0 0;
  position: relative;
  overflow: hidden;
}

.skeleton-team-image {
  width: 100%;
  height: 200px;
  background: linear-gradient(90deg, #e2e8f0 25%, #f1f5f9 50%, #e2e8f0 75%);
  background-size: 200% 100%;
  border-radius: 12px 12px 0 0;
  position: relative;
  overflow: hidden;
}

/* Team card skeleton structure */
.team-card {
  transition: all 0.3s ease;
}

/* Social links skeleton */
.skeleton-social {
  display: flex;
  gap: 8px;
  justify-content: center;
}

.skeleton-social-link {
  width: 32px;
  height: 32px;
  border-radius: 50%;
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

/* Skeleton content animations with staggered delays */
.skeleton-name {
  animation: fadeInUp 0.6s ease-out;
  animation-delay: 0.2s;
  animation-fill-mode: both;
}

.skeleton-designation {
  animation: fadeInUp 0.6s ease-out;
  animation-delay: 0.3s;
  animation-fill-mode: both;
}

.skeleton-social {
  animation: fadeInUp 0.6s ease-out;
  animation-delay: 0.4s;
  animation-fill-mode: both;
}

.skeleton-social-link:nth-child(1) {
  animation-delay: 0.5s;
}

.skeleton-social-link:nth-child(2) {
  animation-delay: 0.6s;
}

.skeleton-social-link:nth-child(3) {
  animation-delay: 0.7s;
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

/* Team image skeleton entrance */
.skeleton-team-image {
  animation: scaleIn 0.8s ease-out;
  animation-delay: 0.1s;
  animation-fill-mode: both;
}

@keyframes scaleIn {
  from {
    opacity: 0;
    transform: scale(0.9);
  }
  to {
    opacity: 1;
    transform: scale(1);
  }
}

/* Hover effect for skeleton team card */
.team-card:hover .skeleton-team-image {
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

/* Breathing animation for social icons */
.skeleton-social-link {
  animation: breathe 3s ease-in-out infinite;
}

.skeleton-social-link:nth-child(1) {
  animation-delay: 0s;
}

.skeleton-social-link:nth-child(2) {
  animation-delay: 0.5s;
}

.skeleton-social-link:nth-child(3) {
  animation-delay: 1s;
}

@keyframes breathe {
  0%,
  100% {
    transform: scale(1);
    opacity: 0.8;
  }
  50% {
    transform: scale(1.1);
    opacity: 1;
  }
}

/* Content sections spacing */
.skeleton-name {
  margin-bottom: 8px;
}

.skeleton-designation {
  margin-bottom: 16px;
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .skeleton-team-image {
    height: 180px;
  }

  .skeleton-line-md {
    width: 100px;
  }

  .skeleton-line-sm {
    width: 70px;
  }

  .skeleton-social-link {
    width: 28px;
    height: 28px;
  }
}

@media (max-width: 576px) {
  .skeleton-team-image {
    height: 160px;
  }

  .skeleton-social {
    gap: 6px;
  }

  .skeleton-social-link {
    width: 24px;
    height: 24px;
  }
}

/* Loading transition effect */
.team-card {
  transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out;
}

/* Add subtle card elevation for skeleton */
.team-card {
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
  border-radius: 12px;
  overflow: hidden;
  background: #ffffff;
}

/* Team content padding for skeleton */
.team-content {
  padding: 20px;
  text-align: center;
}
</style>
