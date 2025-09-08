<template>
  <div
    class="col-xl-4 col-lg-6 col-md-6 fadeinup wow animated"
    style="visibility: visible; animation-name: fadeinup"
  >
    <div class="popular-list-1 grid-style">
      <div class="thumb-wrapper">
        <div
          class="th-slider swiper-fade swiper-initialized swiper-horizontal swiper-autoheight swiper-watch-progress"
          data-slider-options='{"loop":false, "autoplay": false,"autoHeight": true, "effect":"fade"}'
        >
          <div
            class="swiper-wrapper"
            id="swiper-wrapper-a3733fa910d9a109a"
            aria-live="polite"
            style="transition-duration: 0ms; transition-delay: 0ms; height: 0px"
          >
            <div class="swiper-slide">
              <a
                class="popular-popup-image"
                href="assets/frontend/img/popular/popular-1-1.jpg"
                ><img
                  src="assets/frontend/img/popular/popular-1-1.jpg"
                  alt="Image"
              /></a>
            </div>
            <div class="swiper-slide">
              <a
                class="popular-popup-image"
                href="assets/frontend/img/popular/popular-1-2.jpg"
                ><img
                  src="assets/frontend/img/popular/popular-1-2.jpg"
                  alt="Image"
              /></a>
            </div>
          </div>
          <div class="icon-wrap">
            <button
              class="slider-arrow slider-prev"
              tabindex="0"
              aria-label="Previous slide"
              aria-controls="swiper-wrapper-a3733fa910d9a109a"
              aria-disabled="false"
            >
              <i class="far fa-arrow-left"></i>
            </button>
            <button
              class="slider-arrow slider-next"
              tabindex="0"
              aria-label="Next slide"
              aria-controls="swiper-wrapper-a3733fa910d9a109a"
              aria-disabled="false"
            >
              <i class="far fa-arrow-right"></i>
            </button>
          </div>
          <span
            class="swiper-notification"
            aria-live="assertive"
            aria-atomic="true"
          ></span>
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
              <i class="fa-solid fa-bookmark"></i> </a
            ><a
              href="assets/frontend/img/popular/popular-1-1.jpg"
              class="icon-btn popular-popup-image"
              ><span class="action-text">View all img</span>
              <i class="fa-solid fa-camera"></i
            ></a>
          </div>
        </div>
        <div class="popular-badge">
          <img src="assets/frontend/img/icon/sell_rent_icon.svg" alt="icon" />
          <p>For Sale</p>
        </div>
      </div>
      <div class="property-content">
        <div class="media-body">
          <h3 class="box-title">
            <a href="property-details.html">Charming Beach House</a>
          </h3>
          <div class="box-text">
            <div class="icon">
              <img
                src="assets/frontend/img/icon/popular-location.svg"
                alt="icon"
              />
            </div>
            39581 Rohan Estates, New York
          </div>
        </div>
        <ul class="property-featured">
          <li>
            <div class="icon">
              <img src="assets/frontend/img/icon/bed.svg" alt="icon" />
            </div>
            Bed 4
          </li>
          <li>
            <div class="icon">
              <img src="assets/frontend/img/icon/bath.svg" alt="icon" />
            </div>
            Bath 2
          </li>
          <li>
            <div class="icon">
              <img src="assets/frontend/img/icon/sqft.svg" alt="icon" />
            </div>
            1500 sqft
          </li>
        </ul>
        <div class="property-bottom">
          <h6 class="box-title">$179,800.00</h6>
          <a class="th-btn sm style3 pill" href="property-details.html"
            >View More</a
          >
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style scoped></style>
