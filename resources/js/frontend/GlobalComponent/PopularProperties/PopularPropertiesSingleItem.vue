<template>
  <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 filter-item cat3 cat1">
    <div class="popular-list-1">
      <div class="thumb-wrapper">
        <div
          class="th-slider"
          data-slider-options='{"loop":false, "autoplay": false,"autoHeight": true, "effect":"fade"}'
        >
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <a
                class="popular-popup-image"
                href="/assets/frontend/img/popular/popular-1-1.jpg"
                ><img
                  src="/assets/frontend/img/popular/popular-1-1.jpg"
                  alt="Image"
              /></a>
            </div>
            <div class="swiper-slide">
              <a
                class="popular-popup-image"
                href="/assets/frontend/img/popular/popular-1-2.jpg"
                ><img
                  src="/assets/frontend/img/popular/popular-1-2.jpg"
                  alt="Image"
              /></a>
            </div>
            <div class="swiper-slide">
              <a
                class="popular-popup-image"
                href="/assets/frontend/img/popular/popular-1-1.jpg"
                ><img
                  src="/assets/frontend/img/popular/popular-1-1.jpg"
                  alt="Image"
              /></a>
            </div>
            <div class="swiper-slide">
              <a
                class="popular-popup-image"
                href="/assets/frontend/img/popular/popular-1-2.jpg"
                ><img
                  src="/assets/frontend/img/popular/popular-1-2.jpg"
                  alt="Image"
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
              <i class="fa-solid fa-bookmark"></i> </a
            ><a
              href="/assets/frontend/img/popular/popular-1-1.jpg"
              class="icon-btn popular-popup-image"
              ><span class="action-text">View all img</span>
              <i class="fa-solid fa-camera"></i
            ></a>
          </div>
        </div>
        <div class="popular-badge">
          <img src="/assets/frontend/img/icon/sell_rent_icon.svg" alt="icon" />
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
                src="/assets/frontend/img/icon/popular-location.svg"
                alt="icon"
              />
            </div>
            39581 Rohan Estates, New York
          </div>
        </div>
        <ul class="property-featured">
          <li>
            <div class="icon">
              <img src="/assets/frontend/img/icon/bed.svg" alt="icon" />
            </div>
            Bed 4
          </li>
          <li>
            <div class="icon">
              <img src="/assets/frontend/img/icon/bath.svg" alt="icon" />
            </div>
            Bath 2
          </li>
          <li>
            <div class="icon">
              <img src="/assets/frontend/img/icon/sqft.svg" alt="icon" />
            </div>
            1500 sqft
          </li>
        </ul>
        <div class="property-bottom">
          <h6 class="box-title">$179,800.00</h6>
          <Link class="th-btn sm style3 pill" href="/portfolio/property-details"
            >View More</Link
          >
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style lang="scss" scoped></style>
