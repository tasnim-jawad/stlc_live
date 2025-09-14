<template>
  <div class="widget">
    <h3 class="widget_title">Featured Listings</h3>
    <div class="recent-post-wrap featured-listing">
      <div
        class="recent-post"
        v-for="(blog, index) in random_blogs?.data"
        :key="index"
      >
        <div class="media-img">
          <Link :href="`/blog/details?slug=${blog?.slug}`"
            ><img
              :src="
                '/' + blog?.thumbnail_image ||
                'assets/frontend/img/blog/featured-listing-sidebar-1-1.jpg'
              "
              alt="Image"
          /></Link>
        </div>
        <div class="media-body">
          <h4 class="post-title">
            <Link
              class="text-inherit"
              :href="`/blog/details?slug=${blog?.slug}`"
              >{{ blog?.title }}</Link
            >
          </h4>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { store as blog_store } from "../Store/blog_store.js";
import { mapState, mapActions } from "pinia";
export default {
  created: function () {
    this.fetch_random_blogs();
    console.log("Blogs in store dsd:", this.random_blogs);
  },
  methods: {
    ...mapActions(blog_store, ["fetch_random_blogs"]),
  },
  computed: {
    ...mapState(blog_store, ["random_blogs"]),
  },
};
</script>

<style lang="scss" scoped></style>
