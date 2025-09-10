<template>
  <div class="swiper-slide">
    <div class="testi-block style-2" dir="ltr">
      <div class="top-wrap">
        <div class="quote">
          <img src="assets/frontend/img/icon/testi-2quote.svg" alt="quote" />
        </div>
      </div>
      <div class="testi-content pe-xl-5 px-xl-5">
        <p class="box-text" v-html="testimonial?.feedback"></p>
      </div>
      <div class="bottom-wrap">
        <!-- <div class="box-review">
          <i class="fa-sharp fa-solid fa-star"></i>
          <i class="fa-sharp fa-solid fa-star"></i>
          <i class="fa-sharp fa-solid fa-star"></i>
          <i class="fa-sharp fa-solid fa-star"></i>
          <i class="fa-sharp fa-solid fa-star"></i>
        </div> -->
        <div class="team-img">
          <img src="assets/frontend/img/testimonial/testi-2-1.jpg" alt="Team" />
        </div>
        <div class="content">
          <h3 class="box-title">{{ testimonial?.name }}</h3>
          <p class="text">{{ testimonial?.designation }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    testimonial: {
      type: Object,
      required: true,
    },
  },
};
</script>

<style lang="scss" scoped></style>
