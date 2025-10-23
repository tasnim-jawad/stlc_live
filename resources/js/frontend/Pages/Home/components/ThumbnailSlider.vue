<template>
  <div class="thumbnail-slider-container">
    <swiper
      :modules="modules"
      :slides-per-view="1"
      :space-between="0"
      navigation
      :pagination="{
        clickable: true,
        dynamicBullets: true,
      }"
      :scrollbar="{ draggable: true, hide: false }"
      :parallax="true"
      :speed="1500"
      effect="fade"
      :fadeEffect="{
        crossFade: true,
      }"
      :autoplay="{
        delay: 3000,
        disableOnInteraction: false,
        pauseOnMouseEnter: true,
      }"
      :loop="true"
      @swiper="onSwiper"
      @slideChange="onSlideChange"
      class="thumbnail-swiper"
    >
      <swiper-slide>
        <div class="slide-content">
          <div class="hero-img-shape-1">
            <div class="logo-icon-wrap border">
              <a href="javascript:void(0)" class="logo-icon popup-video fs-3"
                ><i class="fa-solid fa-people-roof"></i
              ></a>
              <CircleText />
            </div>
          </div>
          <div class="parallax-bg" data-swiper-parallax="-23%">
            <img
              src="/assets/frontend/img/hero/hero_bg_1_3.jpg"
              alt="Property 1"
            />
            <div class="overlay-gradient"></div>
          </div>
          <div class="container">
            <div class="row">
              <div class="slide-text">
                <h3 data-swiper-parallax="100">Luxury Villa</h3>
                <p data-swiper-parallax="200">
                  sf property with modern amenities and stunning
                  fdsf getFirstSetting ValueByTitle modern amenities and stunning
                  saf dfg property modern amenities and stunning
                  sagfdsfdsf jgh property with amenities and stunning
                  architecture
                </p>
                <button class="th-btn style2 pill" data-swiper-parallax="300">
                  View Details
                </button>
              </div>
            </div>
          </div>
        </div>
      </swiper-slide>
      <swiper-slide>
        <div class="slide-content">
          <div class="parallax-bg" data-swiper-parallax="-23%">
            <img
              src="/assets/frontend/img/hero/hero_bg_1_3.jpg"
              alt="Property 1"
            />
            <div class="overlay-gradient"></div>
          </div>
          <div class="container">
            <div class="row">
              <div class="slide-text">
                <h3 data-swiper-parallax="100">Luxury Villa</h3>
                <p data-swiper-parallax="200">
                  Beautiful property with modern amenities and stunning
                  architecture Beautiful modern amenities and stunning
                  architecture Beautiful property modern amenities and stunning
                  architecture Beautiful property with amenities and stunning
                  architecture
                </p>
                <button class="th-btn style2 pill" data-swiper-parallax="300">
                  View Details
                </button>
              </div>
            </div>
          </div>
        </div>
      </swiper-slide>
      <!-- <swiper-slide>
        <div class="slide-content">
          <div class="parallax-bg" data-swiper-parallax="-23%">
            <img
              src="/assets/frontend/img/hero/hero_bg_1_2.jpg"
              alt="Property 2"
            />
            <div class="overlay-gradient"></div>
          </div>
          <div class="slide-text" data-swiper-parallax="-300">
            <div class="property-badge new" data-swiper-parallax="-50">
              New Listing
            </div>
            <h3 data-swiper-parallax="-100">Modern Apartment</h3>
            <p data-swiper-parallax="-200">
              Stunning city view with premium facilities and contemporary design
            </p>
            <div class="property-details" data-swiper-parallax="-250">
              <span class="price">$1,890,000</span>
              <span class="location">📍 Manhattan, NY</span>
            </div>
            <button class="cta-button" data-swiper-parallax="-300">
              View Details
            </button>
          </div>
        </div>
      </swiper-slide>
      <swiper-slide>
        <div class="slide-content">
          <div class="parallax-bg" data-swiper-parallax="-23%">
            <img
              src="/assets/frontend/img/hero/hero_bg_1_3.jpg"
              alt="Property 3"
            />
            <div class="overlay-gradient"></div>
          </div>
          <div class="slide-text" data-swiper-parallax="-300">
            <div class="property-badge family" data-swiper-parallax="-50">
              Family Friendly
            </div>
            <h3 data-swiper-parallax="-100">Family House</h3>
            <p data-swiper-parallax="-200">
              Perfect home for your growing family with spacious rooms and
              garden
            </p>
            <div class="property-details" data-swiper-parallax="-250">
              <span class="price">$950,000</span>
              <span class="location">📍 Suburban Hills, TX</span>
            </div>
            <button class="cta-button" data-swiper-parallax="-300">
              View Details
            </button>
          </div>
        </div>
      </swiper-slide>
      <swiper-slide>
        <div class="slide-content">
          <div class="parallax-bg" data-swiper-parallax="-23%">
            <img
              src="/assets/frontend/img/hero/hero_bg_1_4.jpg"
              alt="Property 4"
            />
            <div class="overlay-gradient"></div>
          </div>
          <div class="slide-text" data-swiper-parallax="-300">
            <div class="property-badge luxury" data-swiper-parallax="-50">
              Luxury
            </div>
            <h3 data-swiper-parallax="-100">Penthouse Suite</h3>
            <p data-swiper-parallax="-200">
              Exclusive penthouse with panoramic views and world-class amenities
            </p>
            <div class="property-details" data-swiper-parallax="-250">
              <span class="price">$5,200,000</span>
              <span class="location">📍 Miami Beach, FL</span>
            </div>
            <button class="cta-button" data-swiper-parallax="-300">
              View Details
            </button>
          </div>
        </div>
      </swiper-slide>
      <swiper-slide>
        <div class="slide-content">
          <div class="parallax-bg" data-swiper-parallax="-23%">
            <img
              src="/assets/frontend/img/hero/hero_bg_1_1.jpg"
              alt="Property 5"
            />
            <div class="overlay-gradient"></div>
          </div>
          <div class="slide-text" data-swiper-parallax="-300">
            <div class="property-badge waterfront" data-swiper-parallax="-50">
              Waterfront
            </div>
            <h3 data-swiper-parallax="-100">Waterfront Condo</h3>
            <p data-swiper-parallax="-200">
              Luxurious living by the water with breathtaking ocean views
            </p>
            <div class="property-details" data-swiper-parallax="-250">
              <span class="price">$3,750,000</span>
              <span class="location">📍 Malibu, CA</span>
            </div>
            <button class="cta-button" data-swiper-parallax="-300">
              View Details
            </button>
          </div>
        </div>
      </swiper-slide>
      <swiper-slide>
        <div class="slide-content">
          <div class="parallax-bg" data-swiper-parallax="-23%">
            <img
              src="/assets/frontend/img/hero/hero_bg_1_2.jpg"
              alt="Property 6"
            />
            <div class="overlay-gradient"></div>
          </div>
          <div class="slide-text" data-swiper-parallax="-300">
            <div class="property-badge garden" data-swiper-parallax="-50">
              Garden View
            </div>
            <h3 data-swiper-parallax="-100">Garden Townhouse</h3>
            <p data-swiper-parallax="-200">
              Spacious home with private garden and modern architectural design
            </p>
            <div class="property-details" data-swiper-parallax="-250">
              <span class="price">$1,350,000</span>
              <span class="location">📍 Portland, OR</span>
            </div>
            <button class="cta-button" data-swiper-parallax="-300">
              View Details
            </button>
          </div>
        </div>
      </swiper-slide> -->
    </swiper>
  </div>
  <div class="search-area">
    <form action="https://html.themeholy.com/submit-form">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-xl-10">
            <div class="search-wrap">
              <h5>
                “Constructing Excellence” – this is not just our slogan, it is
                our promise. Every project we take on is executed with
                precision, dedication, and a commitment to surpass expectations.
              </h5>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>
<script>
import CircleText from "./CircleText.vue";
import { store as home_store } from "../Store/home_store";
import { mapActions, mapState } from "pinia";
import { store as header_store } from "../../../Shared/Store/header_store.js";

// import Swiper core and required modules
import {
  Navigation,
  Pagination,
  Scrollbar,
  A11y,
  Parallax,
  Autoplay,
  EffectFade,
} from "swiper/modules";

// Import Swiper Vue.js components
import { Swiper, SwiperSlide } from "swiper/vue";

// Import Swiper styles
import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";
import "swiper/css/scrollbar";
import "swiper/css/effect-fade";

// Import Swiper styles
export default {
  components: {
    Swiper,
    SwiperSlide,
    CircleText,
  },
  setup() {
    const onSwiper = (swiper) => {
      console.log("Swiper initialized:", swiper);
    };
    const onSlideChange = () => {
      console.log("Slide changed");
    };
    return {
      onSwiper,
      onSlideChange,
      modules: [
        Navigation,
        Pagination,
        Scrollbar,
        A11y,
        Parallax,
        Autoplay,
        EffectFade,
      ],
    };
  },
};
</script>

<style scoped>
.thumbnail-slider-container {
  position: relative;
  margin: 0;
  padding: 0;
}

.thumbnail-swiper {
  width: 100%;
  /* padding: 0 60px; */
  overflow: hidden;
}

.slide-content {
  width: 100%;
  height: 100vh;
  min-height: 600px;
  position: relative;
  overflow: hidden;
  background: -webkit-linear-gradient(left, transparent, var(--gray-color));
  background: linear-gradient(90deg, transparent, var(--gray-color));
  display: flex;
  align-items: center;
}

.parallax-bg {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-size: cover;
  background-position: center;
}

.parallax-bg img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  filter: brightness(0.8) contrast(1.1);
  transition: all 0.8s ease;
}

.overlay-gradient {
  content: "";
  width: 100%;
  height: 100%;
  position: absolute;
  inset: 0;
  background: -webkit-linear-gradient(left, transparent, var(--gray-color));
  background: linear-gradient(90deg, transparent, var(--gray-color));
  z-index: 1;
  opacity: 0.5;
}

.slide-text {
  color: white;
  z-index: 3;
  position: relative;
}

.property-badge {
  display: inline-block;
  padding: 8px 16px;
  border-radius: 20px;
  font-size: 0.8rem;
  font-weight: bold;
  text-transform: uppercase;
  letter-spacing: 1px;
  margin-bottom: 15px;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

.property-badge {
  background: linear-gradient(135deg, #ff6b6b, #ee5a24);
}

.property-badge.new {
  background: linear-gradient(135deg, #00d2d3, #54a0ff);
}

.property-badge.family {
  background: linear-gradient(135deg, #5f27cd, #341f97);
}

.property-badge.luxury {
  background: linear-gradient(135deg, #feca57, #ff9ff3);
}

.property-badge.waterfront {
  background: linear-gradient(135deg, #48dbfb, #0abde3);
}

.property-badge.garden {
  background: linear-gradient(135deg, #00d2d3, #1dd1a1);
}

.slide-text h3 {
  font-size: 80px;
  font-weight: 800;
  margin-bottom: 45px;
  margin-top: -0.2em;
  color: var(--white-color);
  line-height: 1.1;
}

.slide-text p {
  font-size: 18px;
  color: var(--smoke-color);
  max-width: 600px;
  font-family: var(--body-font);
  margin: 0 0 18px 0;
  line-height: 1.75;
}

.property-details {
  display: flex;
  gap: 20px;
  margin-bottom: 25px;
  align-items: center;
}

.price {
  font-size: 1.8rem;
  font-weight: bold;
  color: #feca57;
  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
}

.location {
  font-size: 1rem;
  opacity: 0.9;
  background: rgba(255, 255, 255, 0.1);
  padding: 5px 12px;
  border-radius: 15px;
  backdrop-filter: blur(10px);
}

.cta-button {
  background: linear-gradient(135deg, #667eea, #764ba2);
  color: white;
  border: none;
  padding: 15px 30px;
  border-radius: 50px;
  font-size: 1rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
  text-transform: uppercase;
  letter-spacing: 1px;
}

.cta-button:hover {
  transform: translateY(-3px);
  box-shadow: 0 12px 35px rgba(102, 126, 234, 0.4);
  background: linear-gradient(135deg, #764ba2, #667eea);
}

/* Navigation buttons */
:deep(.swiper-button-next),
:deep(.swiper-button-prev) {
  color: white;
  /* background: linear-gradient(
    135deg,
    rgba(255, 255, 255, 0.2),
    rgba(255, 255, 255, 0.1)
  ); */
  width: 60px;
  height: 60px;
  border-radius: 50%;
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
  margin-top: -30px;
  backdrop-filter: blur(10px);
  /* border: 1px solid rgba(255, 255, 255, 0.2); */
  transition: all 0.3s ease;
}

:deep(.swiper-button-next:after),
:deep(.swiper-button-prev:after) {
  font-size: 20px;
  font-weight: bold;
}

:deep(.swiper-button-next:hover),
:deep(.swiper-button-prev:hover) {
  background: linear-gradient(
    135deg,
    rgba(255, 255, 255, 0.3),
    rgba(255, 255, 255, 0.2)
  );
  transform: scale(1.1) translateY(-2px);
  box-shadow: 0 12px 35px rgba(0, 0, 0, 0.3);
}

/* Pagination */
:deep(.swiper-pagination) {
  bottom: 20px !important;
}

:deep(.swiper-pagination-bullet) {
  background: rgba(255, 255, 255, 0.5);
  opacity: 0.7;
  width: 12px;
  height: 12px;
  margin: 0 6px !important;
  transition: all 0.3s ease;
  border-radius: 6px;
}

:deep(.swiper-pagination-bullet-active) {
  opacity: 1;
  background: linear-gradient(135deg, var(--theme-color), var(--theme-color2));
  transform: scale(1.3);
  width: 15px;
  border-radius: 15px;
  box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
}

/* Scrollbar */
:deep(.swiper-scrollbar) {
  background: rgba(255, 255, 255, 0.2);
  border-radius: 10px;
  height: 6px;
}

:deep(.swiper-scrollbar-drag) {
  background: linear-gradient(135deg, var(--theme-color), var(--theme-color2));
  border-radius: 10px;
  box-shadow: 0 2px 10px rgba(102, 126, 234, 0.3);
}

/* Responsive design */
@media (max-width: 1024px) {
  /* .slide-content {
    height: 70vh;
    min-height: 500px;
  } */

  .slide-text h3 {
    font-size: 60px;
    margin-bottom: 25px;
  }
  


  .property-details {
    flex-direction: column;
    align-items: flex-start;
    gap: 10px;
  }
}

@media (max-width: 768px) {
  .thumbnail-slider-container {
    margin: 0;
    padding: 0;
  }

  /* .thumbnail-swiper {
    padding: 0 30px;
  } */
  .slide-text h3 {
    font-size: 40px;
    margin-bottom: 25px;
  }

  .cta-button {
    padding: 12px 25px;
    font-size: 0.9rem;
  }

  :deep(.swiper-button-next),
  :deep(.swiper-button-prev) {
    width: 45px;
    height: 45px;
    margin-top: -22px;
  }

  :deep(.swiper-button-next:after),
  :deep(.swiper-button-prev:after) {
    font-size: 16px;
  }
}

@media (max-width: 480px) {
  /* .thumbnail-swiper {
    padding: 0 20px;
  } */

  .property-badge {
    font-size: 0.7rem;
    padding: 6px 12px;
  }

  .slide-text h3 {
    font-size: 40px;
  }

  :deep(.swiper-button-next),
  :deep(.swiper-button-prev) {
    width: 40px;
    height: 40px;
    margin-top: -20px;
  }

  :deep(.swiper-button-next:after),
  :deep(.swiper-button-prev:after) {
    font-size: 14px;
  }
}

/* Fade effect enhancement */
:deep(.swiper-slide) {
  opacity: 0;
  transition: opacity 1.5s ease-in-out;
}

:deep(.swiper-slide-active) {
  opacity: 1;
}

:deep(.swiper-fade .swiper-slide) {
  pointer-events: none;
}

:deep(.swiper-fade .swiper-slide-active) {
  pointer-events: auto;
}

/* Loading animation */
@keyframes shimmer {
  0% {
    transform: translateX(-100%);
  }
  100% {
    transform: translateX(100%);
  }
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
</style>
