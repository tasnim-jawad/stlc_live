<template>
  <div class="swiper-slide">
    <div class="blog-card style-2">
      <div class="blog-img">
        <Link :href="`/blog/details?slug=${news?.slug}`"
          ><img :src="'/' + news?.thumbnail_image" alt="Image"
        /></Link>
        <div class="date">
          <Link :href="`/blog/details?slug=${news?.slug}`"
            ><span>{{ new Date(news?.publish_date).getDate() }}</span> <span>{{ new Date(news?.publish_date).toLocaleString('default', { month: 'short' }) }}</span></Link
          >
        </div>
      </div>
      <div class="blog-content">
        <div class="blog-meta">
          <Link :href="`/blog`"
            ><i class="fa-solid fa-user"></i>{{ news?.writer ?? "Admin" }}</Link
          >
          <Link :href="`/blog`"
            ><i class="fa-solid fa-tag"></i> {{ news?.blog_category?.title }}
          </Link>
        </div>
        <h3 class="box-title">
          <Link :href="`/blog/details?slug=${news?.slug}`">{{
            news?.title
          }}</Link>
        </h3>
        <Link
          :href="`/blog/details?slug=${news?.slug}`"
          class="th-btn pill style3"
          >Read More</Link
        >
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    news: {
      type: Object,
      required: true,
    },
  },
};
</script>

<style lang="scss" scoped></style>
