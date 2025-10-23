<template>
  <div class="professional-gallery-container">
    <div class="modern-gallery">
      <div
        v-for="(item, index) in images"
        :key="index"
        :class="`gallery-item  filter-item`"
        :style="{
          animationDelay: `${index * 0.08}s`,
          '--item-index': index,
        }"
      >
        <div class="gallery-card">
          <div class="gallery-img-wrapper">
            <!-- Skeleton Loader -->
            <div class="skeleton-loader" v-if="!imageLoaded?.[index]">
              <div class="skeleton-shimmer"></div>
              <div class="skeleton-pulse"></div>
            </div>

            <img
              :src="'/' + item?.image"
              :alt="item?.title || 'Gallery image'"
              loading="lazy"
              @load="onImageLoad($event, index)"
              @error="onImageError"
              :style="{ opacity: imageLoaded?.[index] ? 1 : 0 }"
            />

            <!-- Professional Overlay -->
            <div class="professional-overlay">
              <!-- Gradient Overlay -->
              <div class="gradient-overlay"></div>

              <!-- Action Buttons -->
              <div class="action-buttons">
                <button
                  class="action-btn preview-btn"
                  @click="openImageModal(item, index)"
                  title="Preview Image"
                >
                  <i class="fas fa-eye"></i>
                </button>
                <button
                  class="action-btn expand-btn"
                  @click="openImageModal(item, index)"
                  title="View Full Size"
                >
                  <i class="fas fa-expand-arrows-alt"></i>
                </button>
              </div>

              <!-- Image Information -->
              <div
                class="image-details"
                v-if="item?.title || item?.description"
              >
                <div class="image-category" v-if="item?.category">
                  {{ item.category }}
                </div>
                <h3 class="image-title" v-if="item?.title">{{ item.title }}</h3>
                <p class="image-description" v-if="item?.description">
                  {{ truncateText(item.description, 60) }}
                </p>
                <div class="image-meta">
                  <span class="image-number">{{
                    String(index + 1).padStart(2, "0")
                  }}</span>
                  <span class="total-images"
                    >/ {{ String(images.length).padStart(2, "0") }}</span
                  >
                </div>
              </div>

              <!-- Creative Geometric Elements -->
              <div class="geometric-elements">
                <div class="geometric-shape shape-1"></div>
                <div class="geometric-shape shape-2"></div>
              </div>
            </div>

            <!-- Loading Progress Indicator -->
            <div class="loading-progress" v-if="!imageLoaded?.[index]">
              <div class="progress-bar"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Image Modal -->
    <div
      :class="['image-modal', { active: showModal }]"
      @click="closeModal"
      v-if="showModal"
    >
      <div class="modal-content" @click.stop>
        <img :src="'/' + currentImage?.image" :alt="currentImage?.title" />
        <button class="modal-close" @click="closeModal">
          <i class="fas fa-times"></i>
        </button>
        <button
          class="modal-nav prev"
          @click="prevImage"
          v-if="images.length > 1"
        >
          <i class="fas fa-chevron-left"></i>
        </button>
        <button
          class="modal-nav next"
          @click="nextImage"
          v-if="images.length > 1"
        >
          <i class="fas fa-chevron-right"></i>
        </button>
      </div>
      <div
        class="modal-info"
        v-if="currentImage?.title || currentImage?.description"
      >
        <h3 v-if="currentImage?.title">{{ currentImage.title }}</h3>
        <p v-if="currentImage?.description">{{ currentImage.description }}</p>
        <div class="image-counter">
          {{ currentIndex + 1 }} / {{ images.length }}
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "GalleryImages",
  props: {
    images: {
      type: Array,
      required: true,
      default: () => [],
    },
  },
  data() {
    return {
      showModal: false,
      currentImage: null,
      currentIndex: 0,
      imageLoaded: [],
    };
  },
  methods: {
    getItemSize(index) {
      const patterns = [
        "large",
        "medium",
        "small",
        "medium",
        "large",
        "small",
        "small",
        "large",
        "medium",
        "large",
        "small",
        "medium",
      ];
      return patterns[index % patterns.length];
    },

    truncateText(text, length = 100) {
      if (!text) return "";
      return text.length > length ? text.substring(0, length) + "..." : text;
    },

    onImageLoad(event, index) {
      this.imageLoaded[index] = true;
    },

    onImageError(event) {
      event.target.src = "/assets/frontend/img/placeholder.jpg";
    },

    openImageModal(item, index) {
      this.currentImage = item;
      this.currentIndex = index;
      this.showModal = true;
      document.body.style.overflow = "hidden";
    },

    closeModal() {
      this.showModal = false;
      this.currentImage = null;
      document.body.style.overflow = "auto";
    },

    nextImage() {
      this.currentIndex = (this.currentIndex + 1) % this.images.length;
      this.currentImage = this.images[this.currentIndex];
    },

    prevImage() {
      this.currentIndex =
        this.currentIndex === 0
          ? this.images.length - 1
          : this.currentIndex - 1;
      this.currentImage = this.images[this.currentIndex];
    },
  },

  mounted() {
    document.addEventListener("keydown", (e) => {
      if (this.showModal) {
        if (e.key === "Escape") {
          this.closeModal();
        } else if (e.key === "ArrowLeft") {
          this.prevImage();
        } else if (e.key === "ArrowRight") {
          this.nextImage();
        }
      }
    });
  },

  beforeUnmount() {
    document.body.style.overflow = "auto";
  },

  created: function () {
    console.log("Images in gallery images:", this.images);
  },
};
</script>

<style lang="scss" scoped>
// Professional Gallery Container
.professional-gallery-container {
  width: 100%;
  padding: 2rem 1rem;
  background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
  min-height: 100vh;
  position: relative;

  &::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 200px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    opacity: 0.1;
    z-index: 0;
  }
}

// Modern Gallery Grid
.modern-gallery {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 2rem;
  max-width: 1400px;
  margin: 0 auto;
  position: relative;
  z-index: 1;

  @media (min-width: 768px) {
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 2.5rem;
  }

  @media (min-width: 1024px) {
    grid-template-columns: repeat(auto-fit, minmax(380px, 1fr));
    gap: 3rem;
  }
}

// Enhanced Gallery Items
.gallery-item {
  opacity: 0;
  transform: translateY(30px);
  animation: fadeInUp 0.8s ease-out forwards;
  transition: all 0.3s ease;
  height: 300px;

  &.large {
    grid-row: span 2;
  }

  &.medium {
    grid-row: span 1;
  }

  &.small {
    grid-row: span 1;
  }
}

// Professional Gallery Card
.gallery-card {
  width: 100%;
  height: 100%;
  border-radius: 20px;
  overflow: hidden;
  background: #ffffff;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
  transition: box-shadow 0.3s ease;
  position: relative;
  border: 1px solid rgba(255, 255, 255, 0.8);

  &::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: linear-gradient(90deg, #667eea, #764ba2, #f093fb);
    z-index: 10;
  }

  &:hover {
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);

    .professional-overlay {
      opacity: 1;
      visibility: visible;
    }

    .geometric-elements {
      .geometric-shape {
        opacity: 0.4;
        transform: scale(1.02) rotate(5deg);
      }
    }
  }
}

// Gallery Image Wrapper
.gallery-img-wrapper {
  position: relative;
  width: 100%;
  height: 300px;
  overflow: hidden;
  background: #f1f5f9;

  img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: filter 0.3s ease;
    filter: brightness(0.95) contrast(1.05);
  }
}

// Enhanced Skeleton Loader
.skeleton-loader {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
  background-size: 200% 100%;
  animation: shimmer 2s infinite linear;
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 5;

  .skeleton-shimmer {
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
    animation: shimmerMove 2s infinite;
  }

  .skeleton-pulse {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: rgba(102, 126, 234, 0.2);
    animation: pulse 1.5s ease-in-out infinite;
  }
}

// Professional Overlay System
.professional-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  opacity: 0;
  visibility: hidden;
  transition: opacity 0.3s ease, visibility 0.3s ease;
  z-index: 8;
}

.gradient-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(
    135deg,
    rgba(102, 126, 234, 0.9) 0%,
    rgba(118, 75, 162, 0.8) 50%,
    rgba(240, 147, 251, 0.7) 100%
  );
}
// .gradient-overlay {
//   position: absolute;
//   top: 0;
//   left: 0;
//   width: 100%;
//   height: 100%;
//   background: linear-gradient(
//     135deg,
//     rgba(102, 126, 234, 0.9) 0%,
//     rgba(118, 75, 162, 0.8) 50%,
//     rgba(240, 147, 251, 0.7) 100%
//   );
// }

// Action Buttons
.action-buttons {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  display: flex;
  gap: 1rem;
  z-index: 10;
}

.action-btn {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  border: 2px solid rgba(255, 255, 255, 0.9);
  background: rgba(255, 255, 255, 0.2);
  backdrop-filter: blur(10px);
  color: #ffffff;
  font-size: 1.2rem;
  cursor: pointer;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  justify-content: center;

  &:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: scale(1.1);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
  }
}

// Image Details
.image-details {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  padding: 1.5rem;
  background: linear-gradient(transparent, rgba(0, 0, 0, 0.8));
  color: #ffffff;
  z-index: 10;
}

.image-category {
  font-size: 0.75rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 1px;
  color: #f093fb;
  margin-bottom: 0.5rem;
}

.image-title {
  font-size: 1.1rem;
  font-weight: 700;
  margin-bottom: 0.5rem;
  line-height: 1.3;
}

.image-description {
  font-size: 0.9rem;
  opacity: 0.9;
  line-height: 1.4;
  margin-bottom: 1rem;
}

.image-meta {
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 0.8rem;
  font-weight: 600;
  opacity: 0.8;

  .image-number {
    color: #f093fb;
  }
}

// Creative Geometric Elements
.geometric-elements {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  pointer-events: none;
  z-index: 5;
}

.geometric-shape {
  position: absolute;
  opacity: 0;
  transition: opacity 0.3s ease, transform 0.3s ease;

  &.shape-1 {
    top: 20px;
    right: 20px;
    width: 60px;
    height: 60px;
    background: linear-gradient(
      45deg,
      rgba(255, 255, 255, 0.2),
      rgba(240, 147, 251, 0.3)
    );
    border-radius: 10px;
    transform: rotate(-15deg);
  }

  &.shape-2 {
    bottom: 20px;
    left: 20px;
    width: 40px;
    height: 40px;
    background: linear-gradient(
      135deg,
      rgba(102, 126, 234, 0.3),
      rgba(255, 255, 255, 0.2)
    );
    border-radius: 50%;
  }
}

// Loading Progress Indicator
.loading-progress {
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 3px;
  background: rgba(0, 0, 0, 0.1);
  z-index: 6;

  .progress-bar {
    height: 100%;
    background: linear-gradient(90deg, #667eea, #764ba2);
    width: 0;
    animation: loadingProgress 2s ease-in-out infinite;
  }
}

// Modal styles
.image-modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.95);
  z-index: 9999;
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0;
  visibility: hidden;
  transition: all 0.3s ease;

  &.active {
    opacity: 1;
    visibility: visible;
  }
}

.modal-content {
  position: relative;
  max-width: 90%;
  max-height: 90%;
  display: flex;
  align-items: center;
  justify-content: center;

  img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    border-radius: 10px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
  }
}

.modal-close {
  position: absolute;
  top: -50px;
  right: 0;
  background: rgba(255, 255, 255, 0.2);
  border: none;
  color: white;
  font-size: 30px;
  width: 50px;
  height: 50px;
  border-radius: 50%;
  cursor: pointer;
  transition: all 0.3s ease;

  &:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: scale(1.1);
  }
}

.modal-nav {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background: rgba(255, 255, 255, 0.2);
  border: none;
  color: white;
  font-size: 24px;
  width: 50px;
  height: 50px;
  border-radius: 50%;
  cursor: pointer;
  transition: all 0.3s ease;

  &:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: translateY(-50%) scale(1.1);
  }

  &.prev {
    left: -70px;
  }

  &.next {
    right: -70px;
  }
}

.modal-info {
  position: absolute;
  bottom: -80px;
  left: 0;
  right: 0;
  text-align: center;
  color: white;

  h3 {
    font-size: 1.5em;
    margin: 10px 0 5px;
    font-weight: 600;
  }

  p {
    opacity: 0.8;
    margin: 0;
  }

  .image-counter {
    margin-top: 10px;
    font-size: 0.9em;
    opacity: 0.7;
  }
}

// Animations
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

@keyframes shimmer {
  0% {
    background-position: -200% 0;
  }
  100% {
    background-position: 200% 0;
  }
}

@keyframes shimmerMove {
  0% {
    left: -100%;
  }
  100% {
    left: 100%;
  }
}

@keyframes pulse {
  0%,
  100% {
    transform: scale(1);
    opacity: 0.5;
  }
  50% {
    transform: scale(1.2);
    opacity: 0.8;
  }
}

@keyframes loadingProgress {
  0% {
    width: 0;
  }
  50% {
    width: 70%;
  }
  100% {
    width: 100%;
  }
}

// Responsive Design
@media (max-width: 768px) {
  .professional-gallery-container {
    padding: 1rem 0.5rem;
  }

  .modern-gallery {
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
  }

  .gallery-img-wrapper {
    height: 250px;
  }

  .action-btn {
    width: 45px;
    height: 45px;
    font-size: 1rem;
  }

  .image-details {
    padding: 1rem;
  }

  .modal-nav {
    &.prev {
      left: -50px;
    }

    &.next {
      right: -50px;
    }
  }
}

@media (max-width: 480px) {
  .modern-gallery {
    grid-template-columns: 1fr;
    gap: 1rem;
  }

  .gallery-img-wrapper {
    height: 200px;
  }

  .modal-nav {
    display: none;
  }

  .modal-info {
    bottom: -60px;

    h3 {
      font-size: 1.2em;
    }
  }
}
</style>
