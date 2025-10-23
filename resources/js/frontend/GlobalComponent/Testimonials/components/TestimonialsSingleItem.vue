<template>
  <div class="swiper-slide">
    <div class="testi-block" dir="ltr">
      <div class="top-wrap">
        <div class="quote">
          <img src="/assets/frontend/img/icon/quote.svg" alt="quote" />
        </div>
        <div class="logo">
          <img src="/assets/frontend/img/icon/brand-logo-1.png" alt="Team" />
        </div>
      </div>
      <div class="testi-content">
        <p class="box-text" v-html="testimonial?.feedback"></p>
      </div>
      <div class="bottom-wrap">
        <div class="content">
          <h3 class="box-title">
            {{
              testimonial?.name?.length > 12
                ? testimonial?.name?.slice(0, 12) + "..."
                : testimonial?.name
            }}
          </h3>
          <p class="text">
            {{
              testimonial?.designation?.length > 15
                ? testimonial?.designation?.slice(0, 15) + "..."
                : testimonial?.designation
            }}
          </p>
        </div>
        <div class="team-img">
          <img
            :src="
              testimonial?.image
                ? '/' + testimonial?.image
                : '/uploads/default_man.jpeg'
            "
            alt="Team"
          />
          <!-- <div class="box-review">
            <i class="fa-sharp fa-solid fa-star"></i>
            <div class="rating"><span>{{ testimonial?.rating }}</span></div>
          </div> -->
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
