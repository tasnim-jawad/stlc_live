<template>
  <div class="gallery-container">
    <h3 class="page-title mt-50 mb-30 fadeinup wow">From Amazing Gallery</h3>
    <div class="row gy-4 fadeinup wow">
      <div
        v-for="(image, index) in gallery"
        :key="index"
        :class="getColumnClass(index)"
      >
        <div class="property-gallery-card">
          <div class="property-gallery-card-img">
            <img
              class="w-100"
              :src="image ? '/' + image : image"
              :alt="`Gallery image ${index + 1}`"
            />
          </div>
          <a
            class="icon-btn gallery-image-link"
            :href="image ? '/' + image : image"
            @click.prevent="openImagePopup($event, index)"
          >
            <i class="fa-solid fa-eye"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    gallery: {
      type: Array,
      required: true,
    },
  },
  mounted() {
    this.initMagnificPopup();
  },
  updated() {
    this.initMagnificPopup();
  },
  beforeDestroy() {
    // Clean up Magnific Popup instances thoroughly
    if (window.$ && window.$.fn.magnificPopup && this.$el) {
      try {
        $.magnificPopup.close();
        $(this.$el)
          .find(".image-popup")
          .each(function () {
            if ($(this).data("magnificPopup")) {
              $(this).magnificPopup("destroy");
            }
          });
      } catch (e) {
        console.log("Error during cleanup:", e);
      }
    }
  },
  methods: {
    getColumnClass(index) {
      // Create a pattern: col-xl-7, col-xl-5, col-xl-5, col-xl-7, col-xl-7, col-xl-5, ...
      const pattern = [7, 5, 5, 7, 7, 5];
      const colSize = pattern[index % pattern.length];
      return `col-xl-${colSize}`;
    },
    initMagnificPopup() {
      // Completely destroy any existing instances first
      if (window.$ && window.$.fn.magnificPopup) {
        try {
          // Close any open popupsfuio9ohguyffy9 vf   99bookv
          $.magnificPopup.close();

          // Remove all existing magnific popup data and events
          $(".image-popup").each(function () {
            if ($(this).data("magnificPopup")) {
              $(this).magnificPopup("destroy");
            }
          });
        } catch (e) {
          console.log("Error cleaning up existing popups:", e);
        }
      }

      // Wait for DOM to be fully ready
      this.$nextTick(() => {
        setTimeout(() => {
          if (!window.$ || !window.$.fn.magnificPopup) {
            console.error("Magnific Popup not available");
            return;
          }

          const $container = $(this.$el);
          const $imageLinks = $container.find(".image-popup");

          if ($imageLinks.length === 0) {
            console.log("No image-popup elements found");
            return;
          }

          try {
            $imageLinks.magnificPopup({
              type: "image",
              gallery: {
                enabled: true,
                navigateByImgClick: true,
                preload: [0, 1],
              },
              image: {
                titleSrc: function (item) {
                  return "Gallery image " + (item.index + 1);
                },
              },
              zoom: {
                enabled: true,
                duration: 300,
              },
              callbacks: {
                beforeOpen: function () {
                  // Additional safety check
                  if (!this.st.el || this.st.el.length === 0) {
                    console.log("Element not found, preventing popup");
                    return false;
                  }

                  // Check if element is still in DOM
                  if (!$.contains(document, this.st.el[0])) {
                    console.log("Element not in DOM, preventing popup");
                    return false;
                  }

                  return true;
                },
                open: function () {
                  console.log("Magnific popup opened successfully");
                },
                close: function () {
                  console.log("Magnific popup closed");
                },
              },
            });

            console.log(
              "Magnific Popup initialized for",
              $imageLinks.length,
              "elements"
            );
          } catch (error) {
            console.error("Error initializing Magnific Popup:", error);
          }
        }, 200);
      });
    },
    openImagePopup(event, index) {
      event.preventDefault();

      if (!window.$ || !window.$.fn.magnificPopup) {
        console.error("Magnific Popup not available");
        // Fallback: open in new window
        window.open(event.currentTarget.href, "_blank");
        return;
      }

      // Create items array for gallery
      const items = this.gallery.map((image, i) => ({
        src: image ? "/" + image : image,
        title: `Gallery image ${i + 1}`,
      }));

      try {
        $.magnificPopup.open(
          {
            items: items,
            gallery: {
              enabled: true,
            },
            type: "image",
            mainClass: "mfp-img-mobile",
            image: {
              titleSrc: "title",
            },
          },
          index
        );
      } catch (error) {
        console.error("Error opening popup:", error);
        // Fallback: open in new window
        window.open(event.currentTarget.href, "_blank");
      }
    },
  },
};
</script>

<style lang="scss" scoped></style>
