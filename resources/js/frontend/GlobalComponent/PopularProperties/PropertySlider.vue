<template>
  <div class="property-slider-container">
    <div class="slider-wrapper">
      <!-- Main Slider -->
      <div ref="mainSliderRef" class="main-slider-wrap">
        <div class="swiper-wrapper">
          <div
            v-for="slide in slides"
            :key="`main-${slide.id}`"
            class="slide-item swiper-slide"
          >
            <div class="content-wrap">
              <div
                class="slide-meta-top"
                data-swiper-parallax-y="-100"
                data-swiper-parallax-duration="500"
              >
                <span class="slide-category">{{ slide.category.name }}</span>
                <span class="slide-divider">•</span>
                <span class="slide-date">{{ formatDate(slide.date) }}</span>
              </div>
              <h3
                class="slide-title"
                data-swiper-parallax-y="-240"
                data-swiper-parallax-duration="700"
              >
                <router-link
                  :to="slide.link"
                  :aria-label="`Read more about ${slide.title}`"
                >
                  <span class="title-highlight">{{ slide.title }}</span>
                </router-link>
              </h3>
              <div class="meta-box-wrap">
                <div
                  class="author-info"
                  data-swiper-parallax-y="-150"
                  data-swiper-parallax-duration="900"
                >
                  <router-link :to="slide.author.profile" class="author-img">
                    <img
                      :src="slide.author.avatar"
                      :alt="`${slide.author.name} avatar`"
                      loading="lazy"
                      width="48"
                      height="48"
                    />
                    <div class="author-badge"></div>
                  </router-link>
                  <div class="author-text">
                    <router-link :to="slide.author.profile" class="author-name">
                      {{ slide.author.name }}
                    </router-link>
                    <span class="comments-count">
                      <i class="fas fa-comment-dots" aria-hidden="true"></i>
                      {{ slide.commentsCount }}
                      {{ slide.commentsCount === 1 ? "comment" : "comments" }}
                    </span>
                  </div>
                </div>
                <div
                  class="button-wrap"
                  data-swiper-parallax-y="-100"
                  data-swiper-parallax-duration="1000"
                >
                  <router-link
                    :to="slide.link"
                    class="read-more-btn"
                    :aria-label="`Read more about ${slide.title}`"
                  >
                    <span class="btn-text">Explore More</span>
                    <i
                      class="fas fa-arrow-right btn-icon"
                      aria-hidden="true"
                    ></i>
                  </router-link>
                </div>
              </div>
            </div>
            <div class="image-wrap">
              <img
                class="slide-img"
                :src="slide.image"
                :alt="slide.title"
                loading="lazy"
                :width="imageConfig.main.width"
                :height="imageConfig.main.height"
              />
            </div>
          </div>
        </div>
        <div class="pagination-wrap">
          <div class="swiper-pagination" role="tablist"></div>
        </div>
      </div>

      <!-- Thumbnail Slider -->
      <div class="thumb-slide-navi-wrap">
        <div ref="thumbSliderRef" class="thumbs-slide-wrap">
          <div class="swiper-wrapper">
            <div
              v-for="(slide, index) in slides"
              :key="`thumb-${slide.id}`"
              class="slide-item swiper-slide"
              role="button"
              :tabindex="0"
              :aria-label="`Go to slide ${index + 1}: ${slide.title}`"
              @click="goToSlide(index)"
              @keydown.enter="goToSlide(index)"
              @keydown.space.prevent="goToSlide(index)"
            >
              <div class="image-wrap">
                <img
                  class="thumb-img"
                  :src="slide.image"
                  :alt="slide.title"
                  loading="lazy"
                  :width="imageConfig.thumb.width"
                  :height="imageConfig.thumb.height"
                />
              </div>
              <div class="content">
                <div class="category-date">
                  <router-link :to="slide.category.link" class="category">
                    <i class="fas fa-folder" aria-hidden="true"></i>
                    {{ slide.category.name }}
                  </router-link>
                  <div class="date">
                    <i class="fas fa-calendar-alt" aria-hidden="true"></i>
                    {{ formatDate(slide.date) }}
                  </div>
                </div>
                <h3 class="title">
                  <router-link :to="slide.link">{{ slide.title }}</router-link>
                </h3>
                <div class="thumb-overlay">
                  <i
                    class="fas fa-play-circle play-icon"
                    aria-hidden="true"
                  ></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div v-if="showNavigation" class="thumb-navi-wrap">
          <button
            ref="prevButtonRef"
            class="button-prev nav-button"
            :aria-label="navigationLabels.prev"
            type="button"
            @click="prevSlide"
          >
            <i class="fas fa-arrow-left" aria-hidden="true"></i>
            <span>PREV</span>
          </button>
          <button
            ref="nextButtonRef"
            class="button-next nav-button"
            :aria-label="navigationLabels.next"
            type="button"
            @click="nextSlide"
          >
            <span>NEXT</span>
            <i class="fas fa-arrow-right" aria-hidden="true"></i>
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, onMounted, onUnmounted, computed } from "vue";
import { Swiper } from "swiper";
import "swiper/css";
import "swiper/css/effect-fade";
import "swiper/css/pagination";

export default {
  name: "PropertySlider",
  props: {
    slides: {
      type: Array,
      default: () => [
        {
          id: 1,
          title: "Travel Long Journey with Family in This winter season",
          link: "/property/1",
          image: "https://picsum.photos/id/1026/1200/800",
          author: {
            name: "Mohammad Asik",
            avatar: "https://picsum.photos/id/1026/48/48",
            profile: "/author/1",
          },
          commentsCount: 1,
          category: {
            name: "Animals",
            link: "/category/animals",
          },
          date: "2021-07-30",
        },
        {
          id: 2,
          title: "Everything You Need To Know About Living Off The Land",
          link: "/property/2",
          image: "https://picsum.photos/id/158/1200/800",
          author: {
            name: "Una Maria",
            avatar: "https://picsum.photos/id/158/48/48",
            profile: "/author/2",
          },
          commentsCount: 1,
          category: {
            name: "Travel",
            link: "/category/travel",
          },
          date: "2021-07-30",
        },
        {
          id: 3,
          title: "Best Signs Of Good Holiday Rental Accommodation",
          link: "/property/3",
          image: "https://picsum.photos/id/292/1200/800",
          author: {
            name: "Isabella",
            avatar: "https://picsum.photos/id/292/48/48",
            profile: "/author/3",
          },
          commentsCount: 1,
          category: {
            name: "Animals",
            link: "/category/animals",
          },
          date: "2021-07-30",
        },
        {
          id: 4,
          title:
            "Three Business Women Working Together With Requirements For Business",
          link: "/property/4",
          image: "https://picsum.photos/id/477/1200/800",
          author: {
            name: "Mohammad Asik",
            avatar: "https://picsum.photos/id/477/48/48",
            profile: "/author/1",
          },
          commentsCount: 1,
          category: {
            name: "Business",
            link: "/category/business",
          },
          date: "2021-07-30",
        },
      ],
    },
    showNavigation: {
      type: Boolean,
      default: true,
    },
    autoplay: {
      type: Boolean,
      default: false,
    },
    autoplayDelay: {
      type: Number,
      default: 3000,
    },
  },
  setup(props) {
    const mainSliderRef = ref(null);
    const thumbSliderRef = ref(null);
    const nextButtonRef = ref(null);
    const prevButtonRef = ref(null);
    let mainSlider = null;
    let thumbSlider = null;

    const imageConfig = {
      main: { width: 1200, height: 800 },
      thumb: { width: 1200, height: 800 },
    };

    const navigationLabels = {
      next: "Go to next slide",
      prev: "Go to previous slide",
    };

    const formatDate = (dateString) => {
      const options = { year: "numeric", month: "long", day: "numeric" };
      return new Date(dateString).toLocaleDateString(undefined, options);
    };

    const initializeSliders = () => {
      if (!mainSliderRef.value || !thumbSliderRef.value) {
        console.warn("Slider refs not available");
        return;
      }

      console.log("Initializing sliders with", props.slides.length, "slides");

      // Initialize thumbnail slider first
      thumbSlider = new Swiper(thumbSliderRef.value, {
        direction: "horizontal",
        speed: 400,
        touchRatio: 0.2,
        slideToClickedSlide: true,
        loop: true,
        loopedSlides: props.slides.length,
        spaceBetween: 10,
        breakpoints: {
          0: { slidesPerView: 2 },
          768: { slidesPerView: 3 },
          1024: { slidesPerView: 3 },
        },
        watchSlidesProgress: true,
        on: {
          init: function () {
            console.log("Thumbnail slider initialized");
            this.update();
          },
          slideChange: function () {
            // Sync main slider when thumbnail changes
            const activeIndex = this.realIndex;
            console.log("Thumbnail slider changed to index:", activeIndex);
          },
        },
      });

      // Initialize main slider
      mainSlider = new Swiper(mainSliderRef.value, {
        parallax: true,
        effect: "fade",
        speed: 400,
        loop: true,
        loopedSlides: props.slides.length,
        autoplay: props.autoplay
          ? {
              delay: props.autoplayDelay,
              disableOnInteraction: false,
            }
          : false,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
          renderBullet: function (index, className) {
            return `<span class="${className}" role="tab" aria-label="Go to slide ${
              index + 1
            }"></span>`;
          },
        },
        thumbs: {
          swiper: thumbSlider,
        },
        on: {
          init: function () {
            console.log("Main slider initialized");
            this.update();
          },
          slideChange: function () {
            // Sync thumbnail slider when main slider changes
            const activeIndex = this.realIndex;
            console.log("Main slider changed to index:", activeIndex);
            if (thumbSlider) {
              thumbSlider.slideToLoop(activeIndex);
            }
          },
        },
      });

      // Controller connection for synchronized navigation
      if (mainSlider && thumbSlider) {
        mainSlider.controller.control = thumbSlider;
        thumbSlider.controller.control = mainSlider;
        console.log("Sliders connected successfully");
      }
    };

    const destroySliders = () => {
      if (mainSlider) {
        mainSlider.destroy(true, true);
        mainSlider = null;
      }
      if (thumbSlider) {
        thumbSlider.destroy(true, true);
        thumbSlider = null;
      }
    };

    const nextSlide = () => {
      if (mainSlider && thumbSlider) {
        console.log("Moving to next slide");
        mainSlider.slideNext();
        // Force thumbnail slider to sync
        setTimeout(() => {
          if (mainSlider && thumbSlider) {
            const activeIndex = mainSlider.realIndex;
            thumbSlider.slideToLoop(activeIndex);
          }
        }, 50);
      } else {
        console.warn("Sliders not initialized");
      }
    };

    const prevSlide = () => {
      if (mainSlider && thumbSlider) {
        console.log("Moving to previous slide");
        mainSlider.slidePrev();
        // Force thumbnail slider to sync
        setTimeout(() => {
          if (mainSlider && thumbSlider) {
            const activeIndex = mainSlider.realIndex;
            thumbSlider.slideToLoop(activeIndex);
          }
        }, 50);
      } else {
        console.warn("Sliders not initialized");
      }
    };

    const handleKeyboardNavigation = (event) => {
      if (event.key === "ArrowLeft") {
        event.preventDefault();
        prevSlide();
      } else if (event.key === "ArrowRight") {
        event.preventDefault();
        nextSlide();
      }
    };

    const goToSlide = (index) => {
      if (mainSlider && index >= 0 && index < props.slides.length) {
        mainSlider.slideToLoop(index);
      }
    };

    onMounted(() => {
      // Use nextTick to ensure DOM is fully rendered
      setTimeout(initializeSliders, 100);

      // Add keyboard navigation support
      document.addEventListener("keydown", handleKeyboardNavigation);
    });

    onUnmounted(() => {
      destroySliders();
      // Remove keyboard event listener
      document.removeEventListener("keydown", handleKeyboardNavigation);
    });

    return {
      mainSliderRef,
      thumbSliderRef,
      nextButtonRef,
      prevButtonRef,
      imageConfig,
      navigationLabels,
      formatDate,
      nextSlide,
      prevSlide,
      goToSlide,
      handleKeyboardNavigation,
    };
  },
};
</script>

<style scoped lang="scss">
@import url("https://fonts.googleapis.com/css2?family=Lora:wght@400;500;600;700&display=swap");

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  vertical-align: middle;
}

.property-slider-container {
  display: flow-root;
  box-sizing: content-box;
  max-width: 100%;
  margin: 50px auto;
  padding: 0 15px;
  overflow: hidden;
  font-family: "Lora", serif;
  position: relative;

  &::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #ef233c 0%, #d90429 50%, #ef233c 100%);
    background-size: 200% 100%;
    animation: gradientShift 3s ease infinite;
  }
}

@keyframes gradientShift {
  0%,
  100% {
    background-position: 0% 50%;
  }
  50% {
    background-position: 100% 50%;
  }
}

.slider-wrapper {
  background: #2b2d42;
  position: relative;
}

.main-slider-wrap {
  height: 100%;
  width: 100%;

  .slide-item {
    display: flex;
    align-items: center;

    .image-wrap {
      width: 100%;
      height: 100%;
      display: flex;
      flex-direction: row-reverse;
      position: relative;
      overflow: hidden;

      &::before {
        position: absolute;
        content: "";
        height: 80px;
        width: 10px;
        background: linear-gradient(180deg, #ef233c 0%, #d90429 100%);
        left: 35%;
        bottom: 0;
        z-index: 5;
        box-shadow: 0 0 20px rgba(239, 35, 60, 0.6);
      }

      &::after {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(
          135deg,
          rgba(43, 45, 66, 0.7) 0%,
          transparent 50%,
          rgba(239, 35, 60, 0.1) 100%
        );
        z-index: 2;
        pointer-events: none;
      }
    }

    .slide-img {
      width: 100%;
      height: 194px;
      object-fit: cover;
      padding: 0;
      background: linear-gradient(135deg, #ef233c 0%, #d90429 100%);
      transition: transform 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);

      &:hover {
        transform: scale(1.05);
      }
    }

    .content-wrap {
      overflow: hidden;
      padding: 0 20px;
      position: absolute;
      left: 0;
      max-width: 618px;
      z-index: 10;
      animation: fadeInUp 0.8s ease-out;
    }

    .slide-meta-top {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 15px;
      font-size: 12px;
      text-transform: uppercase;
      letter-spacing: 1.5px;
      font-weight: 600;
      animation: slideInLeft 0.6s ease-out;

      .slide-category {
        color: #ef233c;
        background: rgba(239, 35, 60, 0.1);
        padding: 4px 12px;
        border-radius: 20px;
        transition: all 0.3s ease;

        &:hover {
          background: rgba(239, 35, 60, 0.2);
          transform: translateY(-2px);
        }
      }

      .slide-divider {
        color: #8d99ae;
      }

      .slide-date {
        color: #8d99ae;
      }
    }

    .slide-title {
      font-size: 20px;
      font-weight: 700;
      text-transform: capitalize;
      margin-bottom: 30px;
      line-height: 1.4;
      animation: slideInRight 0.8s ease-out;

      a {
        text-decoration: none;
        color: #edf2f4;
        transition: all 0.4s ease;
        display: inline;
        position: relative;

        .title-highlight {
          background: linear-gradient(
            120deg,
            rgba(239, 35, 60, 0.95) 0%,
            rgba(217, 4, 41, 0.95) 100%
          );
          background-repeat: no-repeat;
          background-size: 100% 40%;
          background-position: 0 85%;
          padding: 2px 8px;
          box-decoration-break: clone;
          -webkit-box-decoration-break: clone;
          line-height: 1.6;
          display: inline;
          transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
          position: relative;

          &::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: #fff;
            transform: scaleX(0);
            transform-origin: right;
            transition: transform 0.4s ease;
          }
        }

        &:hover .title-highlight {
          background-size: 100% 100%;
          color: #fff;
          text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
          transform: translateY(-2px);

          &::after {
            transform: scaleX(1);
            transform-origin: left;
          }
        }

        &:active .title-highlight {
          transform: translateY(0);
        }
      }
    }

    .meta-box-wrap {
      display: flex;
      align-items: center;
      overflow: hidden;
      gap: 30px;

      @media (max-width: 767px) {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
      }
    }

    .author-info {
      display: flex;
      align-items: center;
      animation: fadeIn 1s ease-out 0.2s both;
    }

    .author-img {
      position: relative;
      display: block;

      img {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid rgba(239, 35, 60, 0.5);
        transition: all 0.3s ease;
      }

      .author-badge {
        position: absolute;
        bottom: -2px;
        right: -2px;
        width: 14px;
        height: 14px;
        background: linear-gradient(135deg, #ef233c, #d90429);
        border-radius: 50%;
        border: 2px solid #2b2d42;
        animation: pulse 2s ease-in-out infinite;
      }

      &:hover img {
        transform: scale(1.1);
        border-color: #ef233c;
        box-shadow: 0 4px 12px rgba(239, 35, 60, 0.4);
      }
    }

    .author-text {
      display: flex;
      flex-direction: column;
      font-size: 13px;
      color: #8d99ae;
      text-transform: uppercase;
      padding-left: 15px;
      gap: 4px;

      .author-name {
        text-decoration: none;
        transition: all 0.3s ease;
        color: #cacdce;
        font-weight: 600;
        letter-spacing: 0.5px;
        position: relative;
        display: inline-block;

        &::after {
          content: "";
          position: absolute;
          bottom: -2px;
          left: 0;
          width: 0;
          height: 2px;
          background: #ef233c;
          transition: width 0.3s ease;
        }

        &:hover {
          color: #ef233c;

          &::after {
            width: 100%;
          }
        }
      }

      .comments-count {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 11px;
        color: #8d99ae;

        i {
          color: #ef233c;
          font-size: 12px;
        }
      }
    }

    .button-wrap {
      display: none;

      .read-more-btn {
        text-decoration: none;
        background: linear-gradient(135deg, #ef233c 0%, #d90429 100%);
        border: 2px solid transparent;
        color: #fff;
        padding: 12px 24px;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        text-transform: uppercase;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 1px;
        border-radius: 50px;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(239, 35, 60, 0.3);

        &::before {
          content: "";
          position: absolute;
          top: 50%;
          left: 50%;
          width: 0;
          height: 0;
          border-radius: 50%;
          background: rgba(255, 255, 255, 0.2);
          transform: translate(-50%, -50%);
          transition: width 0.6s ease, height 0.6s ease;
        }

        .btn-text,
        .btn-icon {
          position: relative;
          z-index: 1;
        }

        .btn-icon {
          transition: transform 0.4s ease;
        }

        &:hover {
          transform: translateY(-3px);
          box-shadow: 0 8px 25px rgba(239, 35, 60, 0.5);
          background: linear-gradient(135deg, #d90429 0%, #b00320 100%);

          &::before {
            width: 300px;
            height: 300px;
          }

          .btn-icon {
            transform: translateX(5px);
          }
        }

        &:active {
          transform: translateY(-1px);
          box-shadow: 0 4px 15px rgba(239, 35, 60, 0.4);
        }
      }
    }
  }
}

.pagination-wrap {
  display: none;

  .swiper-pagination {
    bottom: unset;
    display: inline-grid;
    top: 50%;
    right: 3.5%;
    transform: translateY(-50%);
    gap: 8px;
  }

  .swiper-pagination-bullet {
    width: 10px;
    height: 40px;
    display: inline-block;
    border-radius: 5px;
    background: rgba(237, 242, 244, 0.3);
    margin: 0;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    position: relative;
    cursor: pointer;

    &::before {
      content: "";
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 4px;
      height: 0;
      background: #fff;
      border-radius: 2px;
      transition: height 0.4s ease;
    }

    &:hover {
      background: rgba(239, 35, 60, 0.5);
      transform: scale(1.1);

      &::before {
        height: 20px;
      }
    }

    &.swiper-pagination-bullet-active {
      background: linear-gradient(180deg, #ef233c 0%, #d90429 100%);
      height: 50px;
      box-shadow: 0 0 20px rgba(239, 35, 60, 0.6);

      &::before {
        height: 30px;
      }
    }
  }
}

.thumbs-slide-wrap {
  width: 100%;
  margin: auto !important;

  .slide-item {
    position: relative;
    cursor: pointer;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    border-radius: 8px;
    overflow: hidden;

    .image-wrap {
      width: 100%;
      height: 100%;
      position: relative;
      overflow: hidden;

      &::before {
        position: absolute;
        height: 100%;
        width: 100%;
        top: 0;
        background: linear-gradient(
          to bottom,
          rgba(0, 0, 0, 0.2) 0%,
          rgba(0, 0, 0, 0.7) 100%
        );
        content: "";
        transition: all 0.4s ease;
        z-index: 1;
      }

      &::after {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, #ef233c 0%, #d90429 100%);
        opacity: 0;
        transition: opacity 0.4s ease;
        z-index: 2;
        mix-blend-mode: multiply;
      }
    }

    .thumb-img {
      height: 97px;
      width: 100%;
      object-fit: cover;
      opacity: 0.4;
      transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
      transform: scale(1);
    }

    .content {
      position: absolute;
      bottom: 0;
      padding: 10px;
      z-index: 10;
      width: 100%;
      transform: translateY(0);
      transition: transform 0.4s ease;
    }

    .title {
      font-size: 14px;
      line-height: 22px;
      font-weight: 700;
      overflow: hidden;
      text-overflow: ellipsis;
      display: -webkit-box;
      line-clamp: 2;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      color: #fff;
      text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
      transition: all 0.3s ease;

      a {
        text-decoration: none;
        color: inherit;
        transition: all 0.3s ease;
        position: relative;

        &:hover {
          color: #fff;
          text-shadow: 0 0 10px rgba(239, 35, 60, 0.8);
        }
      }
    }

    .category {
      text-decoration: none;
      color: #ef233c;
      position: relative;
      padding-right: 10px;
      transition: all 0.3s ease;
      font-weight: 600;
      background: rgba(255, 255, 255, 0.9);
      padding: 2px 8px;
      border-radius: 12px;
      font-size: 9px;
      display: inline-flex;
      align-items: center;
      gap: 4px;

      i {
        font-size: 8px;
      }

      &:hover {
        background: #fff;
        transform: translateY(-2px);
        box-shadow: 0 2px 8px rgba(239, 35, 60, 0.3);
      }
    }

    .date {
      padding-left: 8px;
      color: rgba(255, 255, 255, 0.9);
      font-size: 9px;
      display: inline-flex;
      align-items: center;
      gap: 4px;

      i {
        font-size: 8px;
      }
    }

    .category-date {
      display: flex;
      align-items: center;
      flex-wrap: wrap;
      gap: 8px;
      font-size: 9px;
      text-transform: uppercase;
      margin-bottom: 8px;
      font-weight: 700;
    }

    .thumb-overlay {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 5;
      opacity: 0;
      transition: all 0.4s ease;

      .play-icon {
        font-size: 48px;
        color: #fff;
        filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.5));
        animation: pulse 2s ease-in-out infinite;
      }
    }

    &.swiper-slide-thumb-active {
      .thumb-img {
        opacity: 1;
        transform: scale(1.05);
      }

      .image-wrap::before {
        background: linear-gradient(
          to bottom,
          rgba(239, 35, 60, 0.1) 0%,
          rgba(217, 4, 41, 0.4) 100%
        );
      }

      .image-wrap::after {
        opacity: 0.2;
      }

      .title {
        color: #fff;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.8);
      }
    }

    &:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);

      .thumb-img {
        opacity: 1;
        transform: scale(1.1);
      }

      .image-wrap::before {
        background: linear-gradient(
          to bottom,
          rgba(0, 0, 0, 0.1) 0%,
          rgba(0, 0, 0, 0.5) 100%
        );
      }

      .image-wrap::after {
        opacity: 0.3;
      }

      .content {
        transform: translateY(-5px);
      }

      .thumb-overlay {
        opacity: 1;
      }

      .title {
        color: #fff;
      }
    }
  }
}

.swiper-container {
  margin-left: unset;
  margin-right: unset;
}

.thumb-slide-navi-wrap {
  display: flex;
  align-items: center;
  position: relative;
  background: #2b2d42;
  transition: all 0.3s ease;
}

.thumb-navi-wrap {
  display: none;
  position: absolute;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  pointer-events: none;

  .nav-button {
    writing-mode: vertical-rl;
    text-orientation: mixed;
    font-size: 14px;
    color: #edf2f4;
    text-transform: uppercase;
    font-weight: 700;
    position: absolute;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 5px;
    background: rgba(43, 45, 66, 0.8);
    border: none;
    font-family: inherit;
    z-index: 20;
    padding: 20px 8px;
    pointer-events: auto;
    height: 100%;
    top: 0;
    letter-spacing: 2px;

    i {
      writing-mode: horizontal-tb;
      font-size: 16px;
      transition: all 0.3s ease;
      margin: 5px 0;
    }

    span {
      writing-mode: vertical-rl;
      text-orientation: upright;
    }

    &:hover,
    &:focus {
      color: #fff;
      background: rgba(239, 35, 60, 0.9);
    }

    &:focus {
      outline: 2px solid #ef233c;
      outline-offset: -2px;
    }

    &:active {
      background: rgba(217, 4, 41, 0.95);
    }
  }

  .button-prev {
    left: 0;
    border-right: 2px solid rgba(239, 35, 60, 0.5);
  }

  .button-next {
    right: 0;
    border-left: 2px solid rgba(239, 35, 60, 0.5);
  }
}

// Responsive Design
@media (min-width: 768px) {
  .property-slider-container {
    padding: 0 30px;
  }

  .main-slider-wrap {
    .slide-item {
      .content-wrap {
        padding-left: 50px;
        padding-right: 0;
        max-width: 500px;
      }

      .slide-meta-top {
        font-size: 11px;
        margin-bottom: 18px;
      }

      .slide-title {
        font-size: 28px;
        margin-bottom: 35px;
      }

      .slide-img {
        width: 64.4%;
        height: 267px;
        padding: 0 70px 10px 0;
      }

      .image-wrap::before {
        height: 40px;
        content: "";
      }

      .author-text {
        font-size: 12px;
        padding-left: 12px;
      }

      .author-img img {
        width: 50px;
        height: 50px;
      }

      .button-wrap {
        display: flex;

        .read-more-btn {
          padding: 10px 20px;
          font-size: 12px;
        }
      }

      .meta-box-wrap {
        flex-direction: row;
        gap: 30px;
      }
    }

    .pagination-wrap {
      display: block;

      .swiper-pagination {
        right: 35px;
      }
    }
  }

  .thumbs-slide-wrap {
    width: 81%;

    .slide-item {
      .thumb-img {
        height: 112px;
      }

      .content {
        padding: 20px;
      }

      .category-date {
        font-size: 10px;
        margin-bottom: 10px;
      }

      .title {
        font-size: 14px;
      }
    }
  }

  .thumb-navi-wrap {
    display: block;

    .nav-button {
      font-size: 12px;
      padding: 15px 6px;
    }

    .button-next {
      right: 0;
    }

    .button-prev {
      left: 0;
    }
  }
}

@media (min-width: 1024px) {
  .main-slider-wrap {
    .slide-item {
      .slide-title {
        font-size: 42px;
        line-height: 58px;
        margin-bottom: 80px;
      }

      .content-wrap {
        padding-left: 100px;
        max-width: 668px;
      }

      .slide-meta-top {
        font-size: 13px;
        margin-bottom: 22px;

        .meta-badge {
          padding: 7px 16px;
        }
      }

      .slide-img {
        height: 507px;
        padding: 0 100px 10px 0;
      }

      .image-wrap::before {
        height: 70px;
      }

      .author-text {
        font-size: 14px;
        padding-left: 15px;
      }

      .author-img img {
        width: 60px;
        height: 60px;
      }

      .button-wrap {
        .read-more-btn {
          padding: 14px 28px;
          font-size: 14px;
        }
      }
    }

    .pagination-wrap {
      .swiper-pagination {
        right: 50px;
      }
    }
  }

  .thumbs-slide-wrap {
    width: 79%;

    .slide-item {
      .thumb-img {
        height: 226px;
      }

      .content {
        padding: 40px;
      }

      .category-date {
        font-size: 12px;
        margin-bottom: 20px;
      }

      .title {
        font-size: 18px;
      }
    }
  }

  .thumb-navi-wrap {
    .nav-button {
      font-size: 14px;
      padding: 20px 8px;
    }

    .button-next {
      right: 0;
    }

    .button-prev {
      left: 0;
    }
  }

  .thumbnail-slider-wrap {
    .thumbnail-card {
      height: 145px;

      .thumbnail-content {
        padding: 14px 18px;

        .card-date {
          font-size: 12px;
        }

        .card-title {
          font-size: 14px;
        }

        .card-play-icon {
          font-size: 32px;
        }
      }
    }
  }
}

@media (min-width: 1440px) {
  .thumbs-slide-wrap {
    width: 86%;
  }

  .thumbnail-slider-wrap {
    .thumbnail-card {
      height: 155px;

      .thumbnail-content {
        padding: 16px 20px;

        .card-date {
          font-size: 13px;
        }

        .card-title {
          font-size: 15px;
        }

        .card-play-icon {
          font-size: 36px;
        }
      }
    }
  }

  .main-slider-wrap {
    .slide-item {
      .slide-meta-top {
        font-size: 14px;

        .meta-badge {
          padding: 8px 18px;
        }
      }

      .author-img img {
        width: 65px;
        height: 65px;
      }

      .author-text {
        font-size: 15px;
      }

      .button-wrap {
        .read-more-btn {
          padding: 15px 30px;
          font-size: 15px;
        }
      }
    }
  }
}

// Loading states
.slide-item {
  .slide-img,
  .thumb-img {
    &[src=""],
    &:not([src]) {
      background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
      background-size: 200% 100%;
      animation: loading 1.5s infinite;
    }
  }
}

@keyframes loading {
  0% {
    background-position: 200% 0;
  }
  100% {
    background-position: -200% 0;
  }
}

// Professional animations
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

@keyframes pulse {
  0%,
  100% {
    transform: scale(1);
    opacity: 1;
  }
  50% {
    transform: scale(1.1);
    opacity: 0.8;
  }
}

@keyframes shimmer {
  0% {
    background-position: -1000px 0;
  }
  100% {
    background-position: 1000px 0;
  }
}

// Focus indicators for accessibility
.slide-item:focus,
.read-more-btn:focus,
.author-name:focus,
.category:focus {
  outline: 2px solid #ef233c;
  outline-offset: 2px;
}

// High contrast mode support
@media (prefers-contrast: high) {
  .slide-title a {
    background: #000;
    color: #fff;

    &:hover {
      background: #333;
    }
  }

  .read-more-btn {
    border-color: #000;
    color: #000;

    &:hover {
      background: #000;
      color: #fff;
    }
  }
}

// Reduced motion support
@media (prefers-reduced-motion: reduce) {
  * {
    transition: none !important;
    animation: none !important;
  }
}
</style>
