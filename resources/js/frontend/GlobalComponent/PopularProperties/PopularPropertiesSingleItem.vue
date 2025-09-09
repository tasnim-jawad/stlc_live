<template>
  <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 filter-item cat3 cat1">
    <div class="popular-list-1">
      <div class="thumb-wrapper">
        <div
          class="th-slider h-100"
          :id="`property-slider-${property?.id || Math.random()}`"
          data-slider-options='{"loop":false, "autoplay": false,"autoHeight": true, "effect":"fade"}'
        >
          <div class="swiper-wrapper h-100">
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
            <button class="slider-arrow slider-prev">
              <i class="fa fa-arrow-left"></i>
            </button>
            <button class="slider-arrow slider-next">
              <i class="fa fa-arrow-right"></i>
            </button>
          </div>
        </div>
        <div class="actions">
          <a href="wishlist.html" class="icon-btn"
            ><i class="fas fa-heart"></i
          ></a>
        </div>
        <div class="actions-style-2-wrapper">
          <div class="actions style-2">
            <a href="#" class="icon-btn"
              ><span class="action-text">Add To Favorite</span>
              <i class="fa-solid fa-bookmark"></i>
            </a>
            <a
              href="#"
              class="icon-btn view-all-images-btn"
              @click.prevent="openImageGallery"
              ><span class="action-text">View all img</span>
              <i class="fa-solid fa-camera"></i
            ></a>
          </div>
        </div>
        <div class="popular-badge">
          <img src="/assets/frontend/img/icon/sell_rent_icon.svg" alt="icon" />
          <p>
            {{ property?.property_status == "sale" ? "For Sale" : "For Rent" }}
          </p>
        </div>
      </div>
      <div class="property-content">
        <div class="media-body">
          <h3 class="box-title">
            <a href="property-details.html">{{ property?.property_name }}</a>
          </h3>
          <div class="box-text">
            <div class="icon">
              <img
                src="/assets/frontend/img/icon/popular-location.svg"
                alt="icon"
              />
            </div>
            {{ property?.property_address || "39581 Rohan Estates, New York" }}
          </div>
        </div>
        <ul class="property-featured">
          <li
            v-for="(feature, index) in property?.facts_and_features"
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
import { onMounted, onUpdated, nextTick, ref, onBeforeUnmount } from "vue";

export default {
  name: "PopularPropertiesSingleItem",
  props: {
    property: {
      type: Object,
      required: true,
    },
  },
  setup(props) {
    const swiperInstance = ref(null);
    const initializationAttempts = ref(0);
    const maxAttempts = 10;

    const openImageGallery = () => {
      // Get all banner images from the property
      const images = props.property?.banner_image || [
        "/assets/frontend/img/popular/popular-1-1.jpg",
        "/assets/frontend/img/popular/popular-1-2.jpg",
      ];

      // Check if Magnific Popup is available
      if (!window.$ || !$.magnificPopup) {
        console.error("Magnific Popup library not available");
        return;
      }

      // Prepare gallery items
      const galleryItems = images.map((image, index) => ({
        src: image,
        type: "image",
        title: `Property Image ${index + 1}`,
      }));

      // Open Magnific Popup gallery
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
            return item.el.attr("title") || "Property Image";
          },
        },
      });
    };

    const initializeSlider = () => {
      const sliderElements = document.querySelectorAll(".th-slider");

      sliderElements.forEach((sliderElement) => {
        // Skip if already initialized
        if (sliderElement.swiper) {
          return;
        }

        if (!window.Swiper) {
          initializationAttempts.value++;
          if (initializationAttempts.value < maxAttempts) {
            setTimeout(() => initializeSlider(), 200);
          } else {
            console.error(
              "Swiper library not available after multiple attempts"
            );
          }
          return;
        }

        try {
          // Parse data-slider-options if present
          let options = {};
          const optionsAttr = sliderElement.getAttribute("data-slider-options");
          if (optionsAttr) {
            options = JSON.parse(optionsAttr);
          }

          // Normalize string values to proper types
          const normalizeOptions = (obj) => {
            for (const key in obj) {
              if (typeof obj[key] === "string") {
                if (obj[key] === "true") obj[key] = true;
                else if (obj[key] === "false") obj[key] = false;
                else if (!isNaN(obj[key]) && obj[key] !== "")
                  obj[key] = Number(obj[key]);
              } else if (typeof obj[key] === "object" && obj[key] !== null) {
                normalizeOptions(obj[key]);
              }
            }
          };
          normalizeOptions(options);

          // Add navigation
          const nextBtn = sliderElement.querySelector(".slider-next");
          const prevBtn = sliderElement.querySelector(".slider-prev");
          if (nextBtn && prevBtn) {
            options.navigation = {
              nextEl: nextBtn,
              prevEl: prevBtn,
            };
          }

          // Initialize slider with merged options
          new window.Swiper(sliderElement, {
            autoplay: false,
            autoHeight: true,
            loop: false,
            spaceBetween: 0,
            ...options,
          });

          console.log("Popular property slider initialized successfully");
        } catch (error) {
          console.error("Error initializing popular property slider:", error);
          // Retry on error
          initializationAttempts.value++;
          if (initializationAttempts.value < maxAttempts) {
            setTimeout(() => initializeSlider(), 500);
          }
        }
      });
    };

    const destroySliders = () => {
      const sliderElements = document.querySelectorAll(".th-slider");
      sliderElements.forEach((sliderElement) => {
        if (
          sliderElement.swiper &&
          typeof sliderElement.swiper.destroy === "function"
        ) {
          sliderElement.swiper.destroy(true, true);
          console.log("Popular property slider destroyed");
        }
      });
    };

    // Initialize on mount
    onMounted(async () => {
      await nextTick();
      // Multiple initialization attempts with different delays
      setTimeout(() => initializeSlider(), 100);
      setTimeout(() => initializeSlider(), 300);
      setTimeout(() => initializeSlider(), 600);
    });

    // Reinitialize on updates if needed
    onUpdated(async () => {
      await nextTick();
      setTimeout(() => initializeSlider(), 100);
    });

    // Cleanup on unmount
    onBeforeUnmount(() => {
      destroySliders();
    });

    return {
      swiperInstance,
      openImageGallery,
    };
  },
};
</script>

<style lang="scss" scoped></style>
