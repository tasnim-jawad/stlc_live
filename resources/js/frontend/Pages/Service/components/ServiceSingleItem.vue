<template>
  <div class="col-xl-4 col-md-12 fadeinup wow">
    <div class="service-card" :class="{ 'skeleton-service': isLoading }">
      <!-- Skeleton State -->
      <template v-if="isLoading">
        <div class="box-thumb">
          <div class="skeleton-element skeleton-service-thumb"></div>
        </div>
        <div class="box-content">
          <div class="icon-wrap">
            <div class="icon">
              <div class="skeleton-element skeleton-service-icon"></div>
            </div>
            <div class="number">
              <div class="skeleton-element skeleton-service-number"></div>
            </div>
          </div>
          <div class="skeleton-element skeleton-service-title"></div>
          <div class="skeleton-element skeleton-service-text"></div>
          <div class="skeleton-element skeleton-service-text short"></div>
        </div>
        <div class="box-thumb mt-3">
          <div class="skeleton-element skeleton-service-thumb"></div>
        </div>
        <div class="box-content">
          <div class="icon-wrap">
            <div class="icon">
              <div class="skeleton-element skeleton-service-icon"></div>
            </div>
            <div class="number">
              <div class="skeleton-element skeleton-service-number"></div>
            </div>
          </div>
          <div class="skeleton-element skeleton-service-title"></div>
          <div class="skeleton-element skeleton-service-text"></div>
          <div class="skeleton-element skeleton-service-text short"></div>
        </div>
      </template>

      <!-- Actual Content -->
      <template v-else>
        <div class="box-thumb">
          <Link :href="`/service/details?slug=${service?.slug}`">
            <img
              :src="'/' + service?.primary_image"
              alt="thumb"
              @error="handleImageError"
            />
          </Link>
        </div>
        <div class="box-content service_content">
          <div class="icon-wrap">
            <div class="icon">
              <img
                :src="'/' + service?.image"
                alt="img"
                @error="handleIconError"
              />
            </div>
            <div class="number">
              <h3>{{ (index + 1).toString().padStart(2, "0") }}</h3>
            </div>
          </div>
          <h3 class="box-title">
            <Link :href="`/service/details?slug=${service?.slug}`">{{ service?.title?.slice(0, 40) }}</Link>
          </h3>
          <p class="box-text">
            {{ service?.url?.slice(0, 200)}}
          </p>
        </div>
      </template>
    </div>
  </div>
</template>

<script>
export default {
  name: "ServiceSingleItem",
  props: {
    service: {
      type: Object,
      required: false,
      default: null,
    },
    index: {
      type: Number,
      required: false,
      default: 0,
    },
    isLoading: {
      type: Boolean,
      default: false,
    },
  },
  methods: {
    handleImageError(event) {
      event.target.src = "/uploads/default_service.jpg";
    },
    handleIconError(event) {
      event.target.src = "/uploads/default_icon.png";
    },
  },
};
</script>

<style scoped>
.service-card .box-content.service_content {
    height: 420px;
    overflow: hidden;
}
.service-card .box-content .icon-wrap .icon {
  background: none;
}
.service-card .box-content .icon-wrap .icon img {
  object-fit: cover;
}

/* Service Skeleton Styles */
.skeleton-service {
  opacity: 0.9;
}

.skeleton-service .skeleton-element {
  background: linear-gradient(90deg, #f1f5f9 0%, #ffffff 50%, #f1f5f9 100%);
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

/* Skeleton element dimensions */
.skeleton-service-thumb {
  width: 100%;
  height: 280px;
  border-radius: 10px;
  margin-bottom: 0;
}

.skeleton-service-icon {
  width: 70px;
  height: 70px;
  border-radius: 50%;
}

.skeleton-service-number {
  width: 40px;
  height: 30px;
  border-radius: 6px;
}

.skeleton-service-title {
  width: 75%;
  height: 28px;
  margin-bottom: 15px;
  margin-top: 20px;
  border-radius: 4px;
}

.skeleton-service-text {
  width: 100%;
  height: 16px;
  margin-bottom: 12px;
  border-radius: 4px;
}

.skeleton-service-text.short {
  width: 60%;
}

/* Maintain original layout structure for skeleton */
.skeleton-service .box-content {
  padding: 30px 40px 40px 40px;
}

.skeleton-service .icon-wrap {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 25px;
}

/* Responsive skeleton adjustments */
@media (max-width: 991px) {
  .skeleton-service-thumb {
    height: 250px;
  }

  .skeleton-service .box-content {
    padding: 25px 30px 30px 30px;
  }
}

@media (max-width: 767px) {
  .skeleton-service-thumb {
    height: 220px;
  }

  .skeleton-service-icon {
    width: 60px;
    height: 60px;
  }

  .skeleton-service .box-content {
    padding: 20px 25px 25px 25px;
  }
}

/* Fade-in animation for loaded content */
.service-card:not(.skeleton-service) {
  animation: fadeInService 0.5s ease-out;
}

@keyframes fadeInService {
  from {
    opacity: 0;
    transform: translateY(15px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* Ensure skeleton maintains hover effects structure */
.skeleton-service:hover {
  transform: none;
}
</style>
