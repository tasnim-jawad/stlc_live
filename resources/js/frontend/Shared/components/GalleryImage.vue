<template>
  <div class="footer-bottom-community">
    <div class="content">
      <p>@pillar on Instagram</p>
      <h4 class="box-title">Nice Gallery</h4>
    </div>
    <div class="footer-gallery-wrapper">
      <div class="simple-gallery-card" v-for="image in images" :key="image.id">
        <div class="gallery-img">
          <img :src="'/' + image.image" :alt="image.title" />
          <a :href="'/' + image.image" class="icon-btn popup-image"
            ><i class="fa-brands fa-instagram"></i
          ></a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { store as footer_store } from "../Store/footer_store.js";
import { mapActions, mapState } from "pinia";
import "magnific-popup/dist/magnific-popup.css";
import "magnific-popup/dist/jquery.magnific-popup.min.js";

export default {
  methods: {
    ...mapActions(footer_store, ["fetch_images"]),
  },
  computed: {
    ...mapState(footer_store, ["images"]),
  },
  created: function () {
    this.fetch_images();
  },
  mounted() {
    this.$nextTick(() => {
      if (window.$ && window.$.fn.magnificPopup) {
        $(".popup-image").magnificPopup({
          type: "image",
          gallery: {
            enabled: true,
          },
        });
      }
    });
  },
};
</script>

<style lang="scss" scoped></style>
