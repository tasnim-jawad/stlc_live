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
        <div
          class="col-lg-4 col-xl-4 col-md-6 col-xxl-auto filter-item cat3 cat2 cat4"
        >
          <div class="gallery-card2">
            <div class="gallery-img">
              <img
                src="assets/frontend/img/gallery/gallery-inner-1.jpg"
                alt="gallery image"
              />
              <a
                class="popular-popup-image"
                href="assets/frontend/img/gallery/gallery-inner-1.jpg"
                ><i class="fa-solid fa-eye"></i
              ></a>
            </div>
          </div>
        </div>
        <div
          class="col-lg-4 col-xl-4 col-md-6 col-xxl-auto filter-item cat3 cat3 cat4"
        >
          <div class="gallery-card2">
            <div class="gallery-img">
              <img
                src="assets/frontend/img/gallery/gallery-inner-2.jpg"
                alt="gallery image"
              />
              <a
                class="popular-popup-image"
                href="assets/frontend/img/gallery/gallery-inner-2.jpg"
                ><i class="fa-solid fa-eye"></i
              ></a>
            </div>
          </div>
        </div>
        <div
          class="col-lg-4 col-xl-4 col-md-6 col-xxl-auto filter-item cat2 cat0 cat4"
        >
          <div class="gallery-card2">
            <div class="gallery-img">
              <img
                src="assets/frontend/img/gallery/gallery-inner-3.jpg"
                alt="gallery image"
              />
              <a
                class="popular-popup-image"
                href="assets/frontend/img/gallery/gallery-inner-3.jpg"
                ><i class="fa-solid fa-eye"></i
              ></a>
            </div>
          </div>
        </div>
        <div
          class="col-lg-4 col-xl-4 col-md-6 col-xxl-auto filter-item cat2 cat0 cat3"
        >
          <div class="gallery-card2">
            <div class="gallery-img">
              <img
                src="assets/frontend/img/gallery/gallery-inner-4.jpg"
                alt="gallery image"
              />
              <a
                class="popular-popup-image"
                href="assets/frontend/img/gallery/gallery-inner-4.jpg"
                ><i class="fa-solid fa-eye"></i
              ></a>
            </div>
          </div>
        </div>
        <div
          class="col-lg-4 col-xl-4 col-md-6 col-xxl-auto filter-item cat3 cat1 cat2"
        >
          <div class="gallery-card2">
            <div class="gallery-img">
              <img
                src="assets/frontend/img/gallery/gallery-inner-5.jpg"
                alt="gallery image"
              />
              <a
                class="popular-popup-image"
                href="assets/frontend/img/gallery/gallery-inner-5.jpg"
                ><i class="fa-solid fa-eye"></i
              ></a>
            </div>
          </div>
        </div>
        <div
          class="col-lg-4 col-xl-4 col-md-6 col-xxl-auto filter-item cat1 cat2 cat3"
        >
          <div class="gallery-card2">
            <div class="gallery-img">
              <img
                src="assets/frontend/img/gallery/gallery-inner-6.jpg"
                alt="gallery image"
              />
              <a
                class="popular-popup-image"
                href="assets/frontend/img/gallery/gallery-inner-6.jpg"
                ><i class="fa-solid fa-eye"></i
              ></a>
            </div>
          </div>
        </div>
        <div
          class="col-lg-4 col-xl-4 col-md-6 col-xxl-auto filter-item cat3 cat1 cat4"
        >
          <div class="gallery-card2">
            <div class="gallery-img">
              <img
                src="assets/frontend/img/gallery/gallery-inner-7.jpg"
                alt="gallery image"
              />
              <a
                class="popular-popup-image"
                href="assets/frontend/img/gallery/gallery-inner-7.jpg"
                ><i class="fa-solid fa-eye"></i
              ></a>
            </div>
          </div>
        </div>
        <div
          class="col-lg-4 col-xl-4 col-md-6 col-xxl-auto filter-item cat2 cat0 cat1"
        >
          <div class="gallery-card2">
            <div class="gallery-img">
              <img
                src="assets/frontend/img/gallery/gallery-inner-8.jpg"
                alt="gallery image"
              />
              <a
                class="popular-popup-image"
                href="assets/frontend/img/gallery/gallery-inner-8.jpg"
                ><i class="fa-solid fa-eye"></i
              ></a>
            </div>
          </div>
        </div>
        <div
          class="col-lg-4 col-xl-4 col-md-6 col-xxl-auto filter-item cat4 cat3 cat4"
        >
          <div class="gallery-card2">
            <div class="gallery-img">
              <img
                src="assets/frontend/img/gallery/gallery-inner-9.jpg"
                alt="gallery image"
              />
              <a
                class="popular-popup-image"
                href="assets/frontend/img/gallery/gallery-inner-9.jpg"
                ><i class="fa-solid fa-eye"></i
              ></a>
            </div>
          </div>
        </div>
        <div
          class="col-lg-4 col-xl-4 col-md-6 col-xxl-auto filter-item cat1 cat0 cat1"
        >
          <div class="gallery-card2">
            <div class="gallery-img">
              <img
                src="assets/frontend/img/gallery/gallery-inner-10.jpg"
                alt="gallery image"
              />
              <a
                class="popular-popup-image"
                href="assets/frontend/img/gallery/gallery-inner-10.jpg"
                ><i class="fa-solid fa-eye"></i
              ></a>
            </div>
          </div>
        </div>
        <div
          class="col-lg-4 col-xl-4 col-md-6 col-xxl-auto filter-item cat0 cat1 cat3"
        >
          <div class="gallery-card2">
            <div class="gallery-img">
              <img
                src="assets/frontend/img/gallery/gallery-inner-11.jpg"
                alt="gallery image"
              />
              <a
                class="popular-popup-image"
                href="assets/frontend/img/gallery/gallery-inner-11.jpg"
                ><i class="fa-solid fa-eye"></i
              ></a>
            </div>
          </div>
        </div>
        <div
          class="col-lg-4 col-xl-4 col-md-6 col-xxl-auto filter-item cat1 cat2 cat0"
        >
          <div class="gallery-card2">
            <div class="gallery-img">
              <img
                src="assets/frontend/img/gallery/gallery-inner-12.jpg"
                alt="gallery image"
              />
              <a
                class="popular-popup-image"
                href="assets/frontend/img/gallery/gallery-inner-12.jpg"
                ><i class="fa-solid fa-eye"></i
              ></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { Link } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";

export default {
  components: {
    Link,
  },
};
</script>
