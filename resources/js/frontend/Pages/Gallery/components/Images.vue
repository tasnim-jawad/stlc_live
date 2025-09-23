<template>
  <div class="modern-gallery">
    <div
      v-for="(item, index) in images"
      :key="index"
      :class="`gallery-item ${getItemSize(
        index
      )} filter-item fadeinup wow animated`"
      :style="{ animationDelay: `${index * 0.1}s` }"
    >
      <div class="gallery-card">
        <div class="gallery-img-wrapper">
          <img
            :src="'/' + item?.image"
            :alt="item?.title || 'Gallery image'"
            loading="lazy"
          />
          <div class="overlay">
            <div class="overlay-content">
              <a class="popup-image" :href="'/' + item?.image">
                <i class="fa-solid fa-expand"></i>
              </a>
              <div class="image-info" v-if="item?.title || item?.description">
                <h4 v-if="item?.title">{{ item.title }}</h4>
                <p v-if="item?.description">{{ item.description }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import "magnific-popup/dist/magnific-popup.css";
import "magnific-popup/dist/jquery.magnific-popup.min.js";

export default {
  props: {
    images: {
      type: Array,
      required: true,
    },
  },
  methods: {
    getItemSize(index) {
      // Create varied sizes for masonry layout
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
  },
  mounted() {
    this.$nextTick(() => {
      $(".popup-image").magnificPopup({
        type: "image",
        gallery: {
          enabled: true,
        },
        image: {
          titleSrc: function (item) {
            return (
              item.el.closest(".gallery-item").querySelector(".image-info h4")
                ?.textContent || ""
            );
          },
        },
      });
    });
  },
  created: function () {
    console.log("Images in gallery images:", this.images);
  },
};
</script>

<style lang="scss" scoped>
.modern-gallery {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 15px;
  padding: 15px;
  max-width: 1400px;
  margin: 0 auto;

  @media (min-width: 768px) {
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
  }

  @media (min-width: 1024px) {
    grid-template-columns: repeat(4, 1fr);
    gap: 25px;
  }

  @media (min-width: 1400px) {
    grid-template-columns: repeat(5, 1fr);
    gap: 30px;
  }
}

.gallery-item {
  position: relative;
  border-radius: 15px;
  overflow: hidden;
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
  transition: all 0.4s ease;
  background: #fff;

  &:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
  }

  // Masonry-style sizing
  &.small {
    grid-row: span 1;
    min-height: 220px;
  }

  &.medium {
    grid-row: span 1;
    min-height: 280px;
  }

  &.large {
    grid-row: span 2;
    min-height: 350px;

    @media (min-width: 1024px) {
      grid-column: span 2;
    }
  }
}

.gallery-card {
  height: 100%;
  position: relative;
}

.gallery-img-wrapper {
  position: relative;
  height: 100%;
  overflow: hidden;

  img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s ease;
  }

  &:hover img {
    transform: scale(1.08);
  }
}

.overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: linear-gradient(
    135deg,
    rgba(0, 0, 0, 0.1) 0%,
    rgba(0, 0, 0, 0.3) 50%,
    rgba(0, 0, 0, 0.6) 100%
  );
  opacity: 0;
  transition: all 0.4s ease;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
}

.gallery-item:hover .overlay {
  opacity: 1;
}

.overlay-content {
  text-align: center;
  color: white;
  padding: 20px;
}

.popup-image {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 60px;
  height: 60px;
  background: rgba(255, 255, 255, 0.2);
  backdrop-filter: blur(10px);
  border-radius: 50%;
  color: white;
  text-decoration: none;
  transition: all 0.3s ease;
  margin-bottom: 15px;
  border: 2px solid rgba(255, 255, 255, 0.3);

  &:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: scale(1.1);
    color: white;
    text-decoration: none;
  }

  i {
    font-size: 20px;
  }
}

.image-info {
  h4 {
    font-size: 18px;
    font-weight: 600;
    margin: 0 0 8px 0;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
  }

  p {
    font-size: 14px;
    margin: 0;
    opacity: 0.9;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
    line-height: 1.4;
  }
}

// Animation
.fadeinup {
  opacity: 0;
  transform: translateY(30px);
  animation: fadeInUp 0.8s ease forwards;
}

@keyframes fadeInUp {
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

// Responsive adjustments
@media (max-width: 768px) {
  .modern-gallery {
    grid-template-columns: repeat(2, 1fr);
    padding: 15px;
    gap: 15px;
  }

  .gallery-item {
    &.large {
      grid-column: span 1;
      min-height: 300px;
    }

    &.medium {
      min-height: 280px;
    }

    &.small {
      min-height: 220px;
    }
  }

  .popup-image {
    width: 50px;
    height: 50px;

    i {
      font-size: 18px;
    }
  }

  .image-info {
    h4 {
      font-size: 16px;
    }

    p {
      font-size: 13px;
    }
  }
}

@media (max-width: 480px) {
  .modern-gallery {
    grid-template-columns: 1fr;
    padding: 10px;
    gap: 10px;
  }

  .overlay-content {
    padding: 15px;
  }
}
</style>
