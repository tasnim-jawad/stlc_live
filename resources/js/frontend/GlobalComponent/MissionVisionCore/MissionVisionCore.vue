<template>
  <!-- Mission Section -->
  <section class="mission-vision-section mission-section">
    <div class="container">
      <div class="row justify-content-center mb-5">
        <div class="col-xl-8">
          <div class="section-title-area text-center">
            <!-- Mission Title Skeleton -->
            <div v-if="isMissionLoading" class="skeleton-subtitle-badge">
              <div class="skeleton-badge-content"></div>
            </div>
            <div v-else class="subtitle-badge">
              <span class="badge-icon"></span>
              Our Mission
            </div>

            <div v-if="isMissionLoading" class="skeleton-title">
              <div class="skeleton-title-line"></div>
              <div class="skeleton-title-line short"></div>
            </div>
            <h2 v-else class="section-title">
              Empowering Real Estate Excellence
            </h2>

            <div class="title-underline"></div>
          </div>
        </div>
      </div>

      <div class="content-wrapper">
        <div class="row align-items-center g-5">
          <div class="col-lg-6">
            <!-- Mission Image Skeleton -->
            <div v-if="isMissionLoading" class="skeleton-image-card">
              <div class="skeleton-image"></div>
              <div class="skeleton-decoration"></div>
            </div>
            <div v-else class="content-image-card">
              <div class="image-overlay"></div>
              <img
                :src="'/' + our_mission?.secondary_image"
                alt="Our Mission"
                class="content-image"
                @error="
                  $event.target.src = '/assets/frontend/img/placeholder.jpg'
                "
              />
              <div class="image-decoration"></div>
            </div>
          </div>
          <div class="col-lg-6 px-lg-5">
            <!-- Mission Content Skeleton -->
            <div v-if="isMissionLoading" class="skeleton-content-area">
              <div class="skeleton-icon"></div>
              <div class="skeleton-subtitle"></div>
              <div class="skeleton-description">
                <div class="skeleton-text-line"></div>
                <div class="skeleton-text-line"></div>
                <div class="skeleton-text-line"></div>
                <div class="skeleton-text-line short"></div>
              </div>
              <div class="skeleton-button"></div>
            </div>
            <div v-else class="content-text-area">
              <div class="content-icon">
                <i class="fas fa-bullseye"></i>
              </div>
              <h3 class="content-subtitle">Our Mission</h3>
              <div class="content-description">
                <div v-html="our_mission?.description"></div>
              </div>
              <div class="content-action">
                <Link href="/about-us" class="modern-btn primary-btn">
                  <span>Learn More</span>
                  <i class="fas fa-arrow-right"></i>
                </Link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Vision Section -->
  <section class="mission-vision-section vision-section">
    <div class="container">
      <div class="row justify-content-center mb-5">
        <div class="col-xl-8">
          <div class="section-title-area text-center">
            <!-- Vision Title Skeleton -->
            <div v-if="isVisionLoading" class="skeleton-subtitle-badge">
              <div class="skeleton-badge-content"></div>
            </div>
            <div v-else class="subtitle-badge">
              <span class="badge-icon"></span>
              Our Vision
            </div>

            <div v-if="isVisionLoading" class="skeleton-title">
              <div class="skeleton-title-line"></div>
              <div class="skeleton-title-line short"></div>
            </div>
            <h2 v-else class="section-title">Shaping Tomorrow's Real Estate</h2>

            <div class="title-underline"></div>
          </div>
        </div>
      </div>

      <div class="content-wrapper">
        <div class="row align-items-center g-5">
          <div class="col-lg-6 order-lg-2">
            <!-- Vision Image Skeleton -->
            <div v-if="isVisionLoading" class="skeleton-image-card">
              <div class="skeleton-image"></div>
              <div class="skeleton-decoration vision"></div>
            </div>
            <div v-else class="content-image-card">
              <div class="image-overlay"></div>
              <img
                :src="'/' + our_vision?.secondary_image"
                alt="Our Vision"
                class="content-image"
                @error="
                  $event.target.src = '/assets/frontend/img/placeholder.jpg'
                "
              />
              <div class="image-decoration vision-decoration"></div>
            </div>
          </div>
          <div class="col-lg-6 order-lg-1">
            <!-- Vision Content Skeleton -->
            <div v-if="isVisionLoading" class="skeleton-content-area">
              <div class="skeleton-icon vision"></div>
              <div class="skeleton-subtitle"></div>
              <div class="skeleton-description">
                <div class="skeleton-text-line"></div>
                <div class="skeleton-text-line"></div>
                <div class="skeleton-text-line"></div>
                <div class="skeleton-text-line short"></div>
              </div>
              <div class="skeleton-button vision"></div>
            </div>
            <div v-else class="content-text-area">
              <div class="content-icon vision-icon">
                <i class="fas fa-eye"></i>
              </div>
              <h3 class="content-subtitle">Our Vision</h3>
              <div class="content-description">
                <div v-html="our_vision?.description"></div>
              </div>
              <div class="content-action">
                <Link href="/about-us" class="modern-btn secondary-btn">
                  <span>Discover More</span>
                  <i class="fas fa-arrow-right"></i>
                </Link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Core Values Section -->
  <section class="mission-vision-section core-values-section">
    <div class="container">
      <div class="row justify-content-center mb-5">
        <div class="col-xl-8">
          <div class="section-title-area text-center">
            <!-- Core Values Title Skeleton -->
            <div v-if="isCoreValuesLoading" class="skeleton-subtitle-badge">
              <div class="skeleton-badge-content"></div>
            </div>
            <div v-else class="subtitle-badge">
              <span class="badge-icon"></span>
              Our Core Values
            </div>

            <div v-if="isCoreValuesLoading" class="skeleton-title">
              <div class="skeleton-title-line"></div>
              <div class="skeleton-title-line short"></div>
            </div>
            <h2 v-else class="section-title">Values That Drive Excellence</h2>

            <div class="title-underline"></div>
          </div>
        </div>
      </div>

      <div class="content-wrapper">
        <div class="row align-items-center g-5">
          <div class="col-lg-6">
            <!-- Core Values Image Skeleton -->
            <div v-if="isCoreValuesLoading" class="skeleton-image-card">
              <div class="skeleton-image"></div>
              <div class="skeleton-decoration core-values"></div>
            </div>
            <div v-else class="content-image-card">
              <div class="image-overlay"></div>
              <img
                :src="'/' + core_values?.secondary_image"
                alt="Our Core Values"
                class="content-image"
                @error="
                  $event.target.src = '/assets/frontend/img/placeholder.jpg'
                "
              />
              <div class="image-decoration core-values-decoration"></div>
            </div>
          </div>
          <div class="col-lg-6 px-lg-5">
            <!-- Core Values Content Skeleton -->
            <div v-if="isCoreValuesLoading" class="skeleton-content-area">
              <div class="skeleton-icon core-values"></div>
              <div class="skeleton-subtitle"></div>
              <div class="skeleton-description">
                <div class="skeleton-text-line"></div>
                <div class="skeleton-text-line"></div>
                <div class="skeleton-text-line"></div>
                <div class="skeleton-text-line short"></div>
              </div>
              <div class="skeleton-button core-values"></div>
            </div>
            <div v-else class="content-text-area">
              <div class="content-icon core-values-icon">
                <i class="fas fa-gem"></i>
              </div>
              <h3 class="content-subtitle">Core Values</h3>
              <div class="content-description">
                <div v-html="core_values?.description"></div>
              </div>
              <div class="content-action">
                <Link href="/about-us" class="modern-btn accent-btn">
                  <span>Explore Values</span>
                  <i class="fas fa-arrow-right"></i>
                </Link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { store as mission_vision_store } from "./Store/mission_vision_store.js";
import { mapActions, mapState } from "pinia";

export default {
  name: "MissionVisionCore",

  async created() {
    // Fetch all data concurrently for better performance
    await Promise.all([
      this.fetch_mission(),
      this.fetch_vision(),
      this.fetch_core_values(),
    ]);
  },

  methods: {
    ...mapActions(mission_vision_store, [
      "fetch_mission",
      "fetch_vision",
      "fetch_core_values",
    ]),
  },

  computed: {
    ...mapState(mission_vision_store, [
      "our_mission",
      "our_vision",
      "core_values",
      "loading",
      "error",
    ]),

    // Individual loading states for better UX
    isMissionLoading() {
      return this.loading || !this.our_mission;
    },

    isVisionLoading() {
      return this.loading || !this.our_vision;
    },

    isCoreValuesLoading() {
      return this.loading || !this.core_values;
    },

    // Check if any data is available
    hasAnyData() {
      return this.our_mission || this.our_vision || this.core_values;
    },
  },
};
</script>

<style scoped>
/* Main Section Styling */
.mission-vision-section {
  padding: 100px 0;
  position: relative;
  background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
  overflow: hidden;
}

.mission-vision-section::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="%23e9ecef" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
  opacity: 0.3;
  z-index: 1;
}

.vision-section {
  background: linear-gradient(135deg, #ffffff 0%, #f1f5f9 100%);
}

.core-values-section {
  background: linear-gradient(135deg, #f8f9fa 0%, #e8f4f8 100%);
}

.container {
  position: relative;
  z-index: 2;
}

/* Section Title Area */
.section-title-area {
  margin-bottom: 60px;
}

.subtitle-badge {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: linear-gradient(135deg, #af212f, #ff4136);
  color: white;
  padding: 8px 20px;
  border-radius: 25px;
  font-size: 14px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  margin-bottom: 20px;
  box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
}

.badge-icon::before {
  content: "";
  width: 6px;
  height: 6px;
  background: rgba(255, 255, 255, 0.8);
  border-radius: 50%;
  display: block;
}

.section-title {
  font-size: clamp(28px, 4vw, 42px);
  font-weight: 700;
  color: #1e293b;
  line-height: 1.2;
  margin-bottom: 15px;
  background: linear-gradient(135deg, #1e293b, #3b82f6);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.title-underline {
  width: 80px;
  height: 4px;
  background: linear-gradient(135deg, #af212f, #ff4136);
  margin: 0 auto;
  border-radius: 2px;
}

/* Content Wrapper */
.content-wrapper {
  background: rgba(255, 255, 255, 0.8);
  backdrop-filter: blur(10px);
  border-radius: 20px;
  padding: 40px;
  box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1), 0 0 0 1px rgba(255, 255, 255, 0.5);
  border: 1px solid rgba(255, 255, 255, 0.2);
  transition: all 0.3s ease;
}

.content-wrapper:hover {
  transform: translateY(-2px);
  box-shadow: 0 30px 60px rgba(0, 0, 0, 0.15),
    0 0 0 1px rgba(255, 255, 255, 0.5);
}

/* Image Card Styling */
.content-image-card {
  position: relative;
  border-radius: 20px;
  overflow: hidden;
  box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15),
    0 0 0 1px rgba(255, 255, 255, 0.1);
  transform: perspective(1000px) rotateY(-5deg);
  transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
}

.vision-section .content-image-card {
  transform: perspective(1000px) rotateY(5deg);
}

.content-image-card:hover {
  transform: perspective(1000px) rotateY(0deg) scale(1.02);
  box-shadow: 0 35px 70px rgba(0, 0, 0, 0.2), 0 0 0 1px rgba(255, 255, 255, 0.1);
}

.content-image {
  width: 100%;
  height: 400px;
  object-fit: cover;
  object-position: center;
  transition: transform 0.6s ease;
}

.content-image-card:hover .content-image {
  transform: scale(1.05);
}

.image-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: linear-gradient(
    135deg,
    rgba(59, 130, 246, 0.1) 0%,
    rgba(29, 78, 216, 0.2) 100%
  );
  z-index: 1;
  transition: opacity 0.4s ease;
}

.content-image-card:hover .image-overlay {
  opacity: 0.7;
}

.image-decoration {
  position: absolute;
  top: -10px;
  right: -10px;
  width: 80px;
  height: 80px;
  background: linear-gradient(135deg, #af212f, #ff4136);
  border-radius: 50%;
  z-index: 2;
  opacity: 0.9;
  animation: pulse 2s infinite;
}

.vision-decoration {
  background: linear-gradient(135deg, #af212f, #ff4136);
  top: -10px;
  left: -10px;
}

.core-values-decoration {
  background: linear-gradient(135deg, #af212f, #ff4136);
}

@keyframes pulse {
  0%,
  100% {
    transform: scale(1);
    opacity: 0.9;
  }
  50% {
    transform: scale(1.1);
    opacity: 0.7;
  }
}

/* Text Area Styling */
.content-text-area {
  padding: 20px 0;
  opacity: 0;
  animation: fadeInUp 0.6s ease forwards;
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

.content-icon {
  width: 70px;
  height: 70px;
  background: linear-gradient(135deg, #af212f, #ff4136);
  border-radius: 18px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 25px;
  box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3);
  position: relative;
}

.content-icon::before {
  content: "";
  position: absolute;
  inset: -2px;
  background: linear-gradient(135deg, #af212f, #ff4136);
  border-radius: 20px;
  z-index: -1;
  filter: blur(10px);
  opacity: 0.7;
}

.vision-icon {
  background: linear-gradient(135deg, #af212f, #ff4136);
  box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
}

.vision-icon::before {
  background: linear-gradient(135deg, #af212f, #ff4136);
}

.core-values-icon {
  background: linear-gradient(135deg, #af212f, #ff4136);
  box-shadow: 0 10px 25px rgba(245, 158, 11, 0.3);
}

.core-values-icon::before {
  background: linear-gradient(135deg, #af212f, #ff4136);
}

.content-icon i {
  font-size: 28px;
  color: white;
}

.content-subtitle {
  font-size: 24px;
  font-weight: 700;
  color: #1e293b;
  margin-bottom: 20px;
  position: relative;
}

.content-subtitle::after {
  content: "";
  position: absolute;
  bottom: -8px;
  left: 0;
  width: 50px;
  height: 3px;
  background: linear-gradient(135deg, #af212f, #ff4136);
  border-radius: 2px;
}

.vision-section .content-subtitle::after {
  background: linear-gradient(135deg, #af212f, #ff4136);
}

.core-values-section .content-subtitle::after {
  background: linear-gradient(135deg, #af212f, #ff4136);
}

.content-description {
  font-size: 16px;
  line-height: 1.7;
  color: #64748b;
  margin-bottom: 30px;
  white-space: pre-line;
}

/* Modern Button Styling */
.modern-btn {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  padding: 15px 30px;
  border-radius: 50px;
  font-weight: 600;
  text-decoration: none;
  transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
  position: relative;
  overflow: hidden;
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.primary-btn {
  background: linear-gradient(135deg, #af212f, #ff4136);
  color: white;
  border: 2px solid transparent;
}

.secondary-btn {
  background: linear-gradient(135deg, #af212f, #ff4136);
  color: white;
  border: 2px solid transparent;
}

.accent-btn {
  background: linear-gradient(135deg, #af212f, #ff4136);
  color: white;
  border: 2px solid transparent;
}

.modern-btn::before {
  content: "";
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(
    90deg,
    transparent,
    rgba(255, 255, 255, 0.2),
    transparent
  );
  transition: left 0.6s ease;
}

.modern-btn:hover::before {
  left: 100%;
}

.modern-btn:hover {
  transform: translateY(-3px);
  box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
}

.modern-btn i {
  transition: transform 0.3s ease;
}

.modern-btn:hover i {
  transform: translateX(5px);
}

/* Responsive Design */
@media (max-width: 991px) {
  .mission-vision-section {
    padding: 60px 0;
  }

  .content-wrapper {
    padding: 30px 20px;
  }

  .content-image-card {
    transform: none;
    margin-bottom: 30px;
  }

  .vision-section .content-image-card {
    transform: none;
  }

  .content-image {
    height: 300px;
  }
}

@media (max-width: 576px) {
  .mission-vision-section {
    padding: 40px 0;
  }

  .content-wrapper {
    padding: 20px 15px;
  }

  .subtitle-badge {
    font-size: 12px;
    padding: 6px 15px;
  }

  .content-image {
    height: 250px;
  }

  .modern-btn {
    padding: 12px 24px;
    font-size: 14px;
  }
}

/* Skeleton Loading Styles */
.skeleton-shimmer {
  background: linear-gradient(
    90deg,
    rgba(240, 240, 240, 0.8) 0%,
    rgba(255, 255, 255, 0.9) 50%,
    rgba(240, 240, 240, 0.8) 100%
  );
  background-size: 200% 100%;
  animation: shimmer 1.5s infinite;
}

@keyframes shimmer {
  0% {
    background-position: -200% 0;
  }
  100% {
    background-position: 200% 0;
  }
}

/* Skeleton Badge */
.skeleton-subtitle-badge {
  display: inline-block;
  margin-bottom: 20px;
}

.skeleton-badge-content {
  width: 140px;
  height: 32px;
  background: #e2e8f0;
  border-radius: 25px;
  position: relative;
  overflow: hidden;
}

.skeleton-badge-content::after {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(
    90deg,
    transparent 0%,
    rgba(255, 255, 255, 0.4) 50%,
    transparent 100%
  );
  background-size: 200% 100%;
  animation: shimmer 1.5s infinite;
}

/* Skeleton Title */
.skeleton-title {
  margin-bottom: 15px;
}

.skeleton-title-line {
  height: 40px;
  background: #e2e8f0;
  border-radius: 8px;
  margin-bottom: 10px;
  position: relative;
  overflow: hidden;
}

.skeleton-title-line.short {
  width: 70%;
  margin: 0 auto;
}

.skeleton-title-line::after {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(
    90deg,
    transparent 0%,
    rgba(255, 255, 255, 0.4) 50%,
    transparent 100%
  );
  background-size: 200% 100%;
  animation: shimmer 1.5s infinite;
}

/* Skeleton Image Card */
.skeleton-image-card {
  position: relative;
  border-radius: 20px;
  overflow: hidden;
  box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1), 0 0 0 1px rgba(255, 255, 255, 0.1);
}

.skeleton-image {
  width: 100%;
  height: 400px;
  background: #e2e8f0;
  position: relative;
  overflow: hidden;
}

.skeleton-image::after {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(
    90deg,
    transparent 0%,
    rgba(255, 255, 255, 0.4) 50%,
    transparent 100%
  );
  background-size: 200% 100%;
  animation: shimmer 2s infinite;
}

.skeleton-decoration {
  position: absolute;
  top: -10px;
  right: -10px;
  width: 80px;
  height: 80px;
  background: #cbd5e1;
  border-radius: 50%;
  z-index: 2;
}

.skeleton-decoration.vision {
  left: -10px;
  background: #a7f3d0;
}

.skeleton-decoration.core-values {
  background: #fed7aa;
}

/* Skeleton Content Area */
.skeleton-content-area {
  padding: 20px 0;
}

.skeleton-icon {
  width: 70px;
  height: 70px;
  background: #e2e8f0;
  border-radius: 18px;
  margin-bottom: 25px;
  position: relative;
  overflow: hidden;
}

.skeleton-icon.vision {
  background: #a7f3d0;
}

.skeleton-icon.core-values {
  background: #fed7aa;
}

.skeleton-icon::after {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(
    90deg,
    transparent 0%,
    rgba(255, 255, 255, 0.4) 50%,
    transparent 100%
  );
  background-size: 200% 100%;
  animation: shimmer 1.5s infinite;
}

.skeleton-subtitle {
  width: 180px;
  height: 32px;
  background: #e2e8f0;
  border-radius: 6px;
  margin-bottom: 20px;
  position: relative;
  overflow: hidden;
}

.skeleton-subtitle::after {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(
    90deg,
    transparent 0%,
    rgba(255, 255, 255, 0.4) 50%,
    transparent 100%
  );
  background-size: 200% 100%;
  animation: shimmer 1.5s infinite;
}

.skeleton-description {
  margin-bottom: 30px;
}

.skeleton-text-line {
  height: 20px;
  background: #e2e8f0;
  border-radius: 4px;
  margin-bottom: 12px;
  position: relative;
  overflow: hidden;
}

.skeleton-text-line.short {
  width: 80%;
}

.skeleton-text-line::after {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(
    90deg,
    transparent 0%,
    rgba(255, 255, 255, 0.4) 50%,
    transparent 100%
  );
  background-size: 200% 100%;
  animation: shimmer 1.5s infinite;
}

.skeleton-button {
  width: 160px;
  height: 50px;
  background: #e2e8f0;
  border-radius: 25px;
  position: relative;
  overflow: hidden;
}

.skeleton-button.vision {
  background: #a7f3d0;
}

.skeleton-button.core-values {
  background: #fed7aa;
}

.skeleton-button::after {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(
    90deg,
    transparent 0%,
    rgba(255, 255, 255, 0.4) 50%,
    transparent 100%
  );
  background-size: 200% 100%;
  animation: shimmer 1.5s infinite;
}

/* Skeleton Responsive */
@media (max-width: 991px) {
  .skeleton-image {
    height: 300px;
  }
}

@media (max-width: 576px) {
  .skeleton-image {
    height: 250px;
  }

  .skeleton-button {
    width: 140px;
    height: 44px;
  }
}
</style>
