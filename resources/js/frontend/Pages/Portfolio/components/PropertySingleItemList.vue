<template>
  <div
    class="col-xl-12 fadeinup wow"
    style="visibility: visible; animation-name: fadeinup"
  >
    <div class="popular-list-1 list-style">
      <div class="thumb-wrapper">
        <div
          class="th-slider h-100 swiper-fade swiper-initialized swiper-horizontal swiper-autoheight swiper-watch-progress swiper-backface-hidden"
          data-slider-options='{"loop":false, "autoplay": false,"autoHeight": true, "effect":"fade"}'
          ref="sliderRef"
        >
          <div
            class="swiper-wrapper h-100"
            id="swiper-wrapper-7f7ecfd0cf6105b46"
            aria-live="polite"
          >
            <div
              class="swiper-slide h-100"
              v-for="(image, index) in property?.banner_image || [
                '/assets/frontend/img/popular/popular-1-1.jpg',
                '/assets/frontend/img/popular/popular-1-2.jpg',
              ]"
              :key="index"
            >
              <a class="popular-popup-image" :href="image"
                ><img :src="image" alt="Property Image"
              /></a>
            </div>
          </div>
          <div class="icon-wrap">
            <button
              class="slider-arrow slider-prev swiper-button-disabled"
              disabled=""
              tabindex="-1"
              aria-label="Previous slide"
              aria-controls="swiper-wrapper-7f7ecfd0cf6105b46"
              aria-disabled="true"
            >
              <i class="fa fa-arrow-left"></i>
            </button>
            <button
              class="slider-arrow slider-next"
              tabindex="0"
              aria-label="Next slide"
              aria-controls="swiper-wrapper-7f7ecfd0cf6105b46"
              aria-disabled="false"
            >
              <i class="fa fa-arrow-right"></i>
            </button>
          </div>
          <span
            class="swiper-notification"
            aria-live="assertive"
            aria-atomic="true"
          ></span>
        </div>
        <div class="actions">
          <a href="javascript:void(0);" class="icon-btn"
            ><i class="fas fa-heart"></i
          ></a>
        </div>
        <div class="actions-style-2-wrapper">
          <div class="actions style-2">
            <a href="#" class="icon-btn"
              ><span class="action-text">Add To Favorite</span>
              <i class="fa-solid fa-bookmark"></i> </a
            ><a href="#" class="icon-btn" @click.prevent="openImageGallery"
              ><span class="action-text">View all img</span>
              <i class="fa-solid fa-camera"></i
            ></a>
          </div>
        </div>
        <div class="popular-badge">
          <img src="assets/frontend/img/icon/sell_rent_icon.svg" alt="icon" />
          <p>
            {{ property?.property_status == "sale" ? "For Sale" : "For Rent" }}
          </p>
        </div>
      </div>
      <div class="property-content">
        <div class="media-body">
          <h3 class="box-title">
            <Link
              :href="`/portfolio/property-details?slug=${property?.slug}`"
              >{{ property?.property_name }}</Link
            >
          </h3>
          <div class="box-text">
            <div class="icon">
              <img
                src="assets/frontend/img/icon/popular-location.svg"
                alt="icon"
              />
            </div>
            {{
              property?.property_address ||
              "298 South Goran ,Khilgaon ,Dhaka-1219"
            }}
          </div>
        </div>
        <ul class="property-featured">
          <li
            v-for="(feature, index) in (
              property?.facts_and_features || []
            ).slice(0, 3)"
            :key="index"
          >
            <div class="icon mr-1">
              <!-- <img src="/assets/frontend/img/icon/bed.svg" alt="icon" /> -->
              <span><i :class="feature?.icon"></i></span>
            </div>
            {{ feature?.title }}
          </li>
        </ul>
        <div class="property-bottom">
          <h6 class="box-title">৳ {{ property?.price?.toLocaleString() }}</h6>
          <Link
            class="th-btn sm style3 pill"
            :href="`/portfolio/property-details?slug=${property?.slug}`"
            >View More</Link
          >
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    property: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      images: [
        "assets/frontend/img/popular/popular-1-1.jpg",
        "assets/frontend/img/popular/popular-1-2.jpg",
      ],
    };
  },
  methods: {
    initializeSlider() {
      const sliderElement = this.$refs.sliderRef;
      if (!sliderElement || sliderElement.swiper) return;
      if (!window.Swiper) {
        setTimeout(() => this.initializeSlider(), 200);
        return;
      }
      try {
        new window.Swiper(sliderElement, {
          loop: false,
          autoplay: false,
          autoHeight: true,
          effect: "fade",
          navigation: {
            nextEl: sliderElement.querySelector(".slider-next"),
            prevEl: sliderElement.querySelector(".slider-prev"),
          },
        });
      } catch (error) {
        console.error("Error initializing slider:", error);
      }
    },
    openImageGallery() {
      const images = this.property?.banner_image || [
        "/assets/frontend/img/popular/popular-1-1.jpg",
        "/assets/frontend/img/popular/popular-1-2.jpg",
      ];
      if (!window.$ || !$.magnificPopup) {
        console.error("Magnific Popup library not available");
        return;
      }
      const galleryItems = images.map((image, index) => ({
        src: image,
        type: "image",
        title: `Property Image ${index + 1}`,
      }));
      $.magnificPopup.open({
        items: galleryItems,
        gallery: {
          enabled: true,
          navigateByImgClick: true,
          preload: [0, 1],
        },
        type: "image",
        mainClass: "mfp-img-mobile",
        image: {
          verticalFit: true,
          titleSrc: function (item) {
            return item.el ? item.el.attr("title") : "Property Image";
          },
        },
      });
    },
  },
  mounted() {
    this.$nextTick(() => {
      setTimeout(() => this.initializeSlider(), 100);
    });
  },
};
</script>

<style scoped>
.swiper-slide img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center center;
}
/* .popular-list-1.list-style
  .thumb-wrapper
  .th-slider.swiper-fade.swiper-initialized {
  height: 100% !important;
}
@media (max-width: 767px) {
  .popular-list-1.list-style
    .thumb-wrapper
    .th-slider.swiper-fade.swiper-initialized {
    height: 100%;
  }
} */
</style>
