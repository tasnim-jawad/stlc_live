<template>
  <div
    class="breadcumb-wrapper background-image"
    style="background-image: url('/assets/frontend/img/bg/breadcrumb-bg.jpg')"
  >
    <div class="container">
      <div class="breadcumb-content">
        <h1 class="breadcumb-title mt-5">Amazing Video Gallery</h1>
        <ul class="breadcumb-menu">
          <li><Link href="/">Home</Link></li>
          <li><Link href="/gallery/videos">Gallery Videos</Link></li>
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
                @click.prevent="set_video_category_id(null)"
              >
                View All
              </button>
              <button
                v-for="category in video_categories?.data"
                :key="category.id"
                @click.prevent="set_video_category_id(category?.id)"
                class="th-btn tab-btn"
                type="button"
              >
                {{ category?.name }}
              </button>
            </div>
          </div>
        </div>
      </div>
      <div
        class="row gy-4 justify-content-center filter-active"
        v-if="videos?.data?.length"
      >
        <Videos :videos="videos?.data" />
      </div>
    </div>
  </section>
</template>

<script>
import { Link } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";
import Videos from "../components/Videos.vue";
import { store as gallery_store } from "../Store/gallery_store";
import { mapState, mapActions } from "pinia";

export default {
  components: {
    Link,
    Videos,
  },
  created: function () {
    this.fetch_videos();
    this.fetch_video_categories();
    console.log("Gallery Videos component created");
    
  },
  methods: {
    ...mapActions(gallery_store, [
      "fetch_images",
      "fetch_videos",
      "fetch_image_categories",
      "fetch_video_categories",
      "set_image_category_id",
      "set_video_category_id",
    ]),
  },
  computed: {
    ...mapState(gallery_store, [
      "images",
      "videos",
      "image_categories",
      "video_categories",
      "image_category_id",
      "video_category_id",
    ]),
  },
};
</script>
<style lang="scss" scoped>
.gallery-inner-sec {
  .title-area {
    .sec-title {
      font-size: 2.5rem;
      font-weight: 700;
      margin-bottom: 1.5rem;
    }
  }
}
</style>