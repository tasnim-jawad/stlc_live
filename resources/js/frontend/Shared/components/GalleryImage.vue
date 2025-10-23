<template>
  <div class="footer-bottom-community">
    <div class="content">
      <h4 class="box-title">Nice Gallery</h4>
    </div>
    <div class="footer-gallery-wrapper">
      <div class="simple-gallery-card" v-for="image in images" :key="image.id">
        <div class="gallery-img">
          <img :src="'/' + image.image" :alt="image.title" />
            <a :href="'/' + image.image" class="icon-btn popup-image"
            ><i class="fa-solid fa-eye"></i
          ></a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { store as footer_store } from "../Store/footer_store.js";
import { mapActions, mapState } from "pinia";
import $ from "jquery";
import "magnific-popup/dist/magnific-popup.css";
import "magnific-popup/dist/jquery.magnific-popup.min.js";

export default {
  methods: {
    ...mapActions(footer_store, ["fetch_images"]),
    initializeMagnificPopup() {
      this.$nextTick(() => {
        // Ensure jQuery is available globally
        window.$ = window.jQuery = $;

        // Destroy existing popup instances if any
        if ($(".popup-image").length && $.fn.magnificPopup) {
          $(".popup-image").magnificPopup("close");
          $(".popup-image").off(".mfp");
        }

        // Initialize magnificPopup
        if ($ && $.fn.magnificPopup) {
          $(".popup-image").magnificPopup({
            type: "image",
            gallery: {
              enabled: true,
            },
            image: {
              titleSrc: function (item) {
                return item.el.find("img").attr("alt") || "";
              },
            },
          });
        } else {
          console.error("magnificPopup is not available");
        }
      });
    },
  },
  computed: {
    ...mapState(footer_store, ["images"]),
  },
  watch: {
    images: {
      handler() {
        this.$nextTick(() => {
          this.initializeMagnificPopup();
        });
      },
      deep: true,
    },
  },
  created: function () {
    this.fetch_images();
  },
  mounted() {
    this.initializeMagnificPopup();
  },
  beforeUnmount() {
    // Clean up magnificPopup instances
    if ($ && $.fn.magnificPopup && $(".popup-image").length) {
      $(".popup-image").magnificPopup("close");
      $(".popup-image").off(".mfp");
    }
  },
};
</script>

<style lang="scss" scoped></style>
