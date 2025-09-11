<template>
  <div
    v-for="(item, index) in images"
    :key="index"
    :class="`col-lg-4 col-xl-4 col-md-6 col-xxl-auto filter-item fadeinup wow animated`"
  >
    <div class="gallery-card2">
      <div class="gallery-img">
        <img :src="item?.image" alt="gallery image" />
        <a class="popular-popup-image" :href="item?.image"
          ><i class="fa-solid fa-eye"></i
        ></a>
      </div>
    </div>
  </div>
</template>

<script>
import "magnific-popup/dist/magnific-popup.css";
import "magnific-popup/dist/jquery.magnific-popup.min.js";

export default {
  props: {
    images: {
      type: Array,
      required: true,
    },
  },
  mounted() {
    this.$nextTick(() => {
      $(".popular-popup-image").magnificPopup({
        type: "image",
        gallery: {
          enabled: true,
        },
      });
    });
  },
  created: function () {
    console.log("Images in gallery images:", this.images);
  },
};
</script>

<style lang="scss" scoped></style>
