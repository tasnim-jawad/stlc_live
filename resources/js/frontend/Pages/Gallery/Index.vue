<template>
  <div
    class="breadcumb-wrapper background-image"
    style="background-image: url('assets/frontend/img/bg/breadcrumb-bg.jpg')"
  >
    <div class="container">
      <div class="breadcumb-content">
        <h1 class="breadcumb-title mt-5">Amazing Gallery</h1>
        <ul class="breadcumb-menu">
          <li><a href="index.html">Home</a></li>
          <li>Gallery</li>
        </ul>
      </div>
    </div>
  </div>
  <section class="gallery-inner-sec space">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-7">
          <div class="title-area text-center mb-2">
            <p
              class="sub-title fadeinup wow"
              data-wow-duration="1.5s"
              data-wow-delay="0.1s"
            >
              <span class="double-line"></span> Gallery
            </p>
            <h2
              class="sec-title mb-4 fadeinup wow"
              data-wow-duration="1.5s"
              data-wow-delay="0.3s"
            >
              Stunning Pillar Gallery
            </h2>
            <div
              class="filter-menu style-2 indicator-active filter-menu-active mt-2 justify-content-center fadeinup wow"
              data-wow-duration="1.5s"
              data-wow-delay="0.5s"
            >
              <button
                data-filter="*"
                class="th-btn tab-btn active"
                type="button"
              >
                View All
              </button>
              <button data-filter=".cat1" class="th-btn tab-btn" type="button">
                Apartment
              </button>
              <button data-filter=".cat2" class="th-btn tab-btn" type="button">
                Commercial
              </button>
              <button data-filter=".cat3" class="th-btn tab-btn" type="button">
                Land or Plot
              </button>
              <button data-filter=".cat4" class="th-btn tab-btn" type="button">
                Farm
              </button>
            </div>
          </div>
        </div>
      </div>
      <div class="row gy-4 justify-content-center filter-active">
        <Images :galleryImages="galleryItems" />
      </div>
    </div>
  </section>
</template>

<script>
import { Link } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";
import Images from "./Images.vue";
import Videos from "./Videos.vue";

export default {
  components: {
    Link,
    Images,
    Videos,
  },
  data() {
    return {
      galleryItems: [
        {
          src: "assets/frontend/img/gallery/gallery-inner-1.jpg",
        },
        {
          src: "assets/frontend/img/gallery/gallery-inner-2.jpg",
        },
        {
          src: "assets/frontend/img/gallery/gallery-inner-3.jpg",
        },
        {
          src: "assets/frontend/img/gallery/gallery-inner-4.jpg",
        },
        {
          src: "assets/frontend/img/gallery/gallery-inner-5.jpg",
        },
        {
          src: "assets/frontend/img/gallery/gallery-inner-6.jpg",
        },
        {
          src: "assets/frontend/img/gallery/gallery-inner-7.jpg",
        },
        {
          src: "assets/frontend/img/gallery/gallery-inner-8.jpg",
        },
        {
          src: "assets/frontend/img/gallery/gallery-inner-9.jpg",
        },
        {
          src: "assets/frontend/img/gallery/gallery-inner-10.jpg",
        },
        {
          src: "assets/frontend/img/gallery/gallery-inner-11.jpg",
        },
        {
          src: "assets/frontend/img/gallery/gallery-inner-12.jpg",
        },
      ],
    };
  },
};
</script>
