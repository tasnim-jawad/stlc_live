<template>
  <div class="col-lg-6 col-md-6">
    <div class="blog-card">
      <div class="blog-img">
        <Link :href="`/blog/details?slug=${blog?.slug}`">
          <img :src="'/' + (blog?.thumbnail_image ?? 'uploads/default.jpg')" alt="Image" />
        </Link>
        />
        <div class="date">
          <a href="blog.html">{{ formatDate(blog?.publish_date) }}</a>
        </div>
      </div>
      <div class="blog-content">
        <div class="blog-meta">
          <a href="javascript:void(0)"
            ><i class="fa-solid fa-user"></i> {{ blog?.writer ?? "Admin" }}</a
          >
          <a href="javascript:void(0)"
            ><i class="fa-solid fa-tag"></i>
            {{ blog?.blog_category?.title ?? "General" }}</a
          >
        </div>
        <h3 class="box-title">
          <Link :href="`/blog/details?slug=${blog?.slug}`">
            {{ blog?.title }}
          </Link>
        </h3>
        <Link
          :href="`/blog/details?slug=${blog?.slug}`"
          class="th-btn pill style3"
          >Read More</Link
        >
      </div>
    </div>
  </div>
</template>

<script>
import { Link } from "@inertiajs/vue3";

export default {
  props: {
    blog: {
      type: Object,
      required: true,
    },
  },
  methods: {
    formatDate(dateString) {
      const date = new Date(dateString);
      return date.toLocaleDateString("en-US", {
        year: "numeric",
        month: "short",
        day: "numeric",
      });
    },
  },
};
</script>

<style lang="scss" scoped></style>
