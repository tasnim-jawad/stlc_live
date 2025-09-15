<template>
  <div
    class="breadcumb-wrapper"
    style="background-image: url('/assets/frontend/img/blog/breadcrumb-bg.jpg')"
  >
    <div class="container">
      <div class="breadcumb-content">
        <h1 class="breadcumb-title mt-5">Blog Details</h1>
        <ul class="breadcumb-menu">
          <li><Link href="/">Home</Link></li>
          <li>Blog Details</li>
        </ul>
      </div>
    </div>
  </div>
  <section class="th-blog-wrapper blog-details space-top space-extra-bottom">
    <div class="container">
      <div class="row">
        <div class="col-xxl-8 col-lg-7">
          <div class="th-blog blog-single">
            <div class="blog-img">
              <img :src="'/' + single_blog?.thumbnail_image" alt="Image" />
            </div>
            <div class="blog-content">
              <div class="blog-meta">
                <a href="javascript:void(0)"
                  ><i class="fa-light fa-user"></i>
                  {{ single_blog?.writer ?? "Admin" }}</a
                >
                <a href="javascript:void(0)"
                  ><i class="fa-regular fa-calendar"></i>
                  {{ formatDate(single_blog?.publish_date) }}</a
                >
                <a href="blog.html"
                  ><i class="fa fa-tag"></i>
                  {{ single_blog?.blog_category?.title ?? "N/A" }}</a
                >
              </div>
              <h2 class="blog-title">
                {{ single_blog?.title ?? "N/A" }}
              </h2>
              <hr />
              <p v-html="single_blog?.description"></p>

              <div class="share-links clearfix">
                <div class="row justify-content-between">
                  <div class="col-sm-auto">
                    <span class="share-links-title">Tags:</span>
                    <div class="tagcloud">
                      <a
                        v-for="(tag, index) in getTagsArray(single_blog?.tags)"
                        :key="index"
                        href="javascript:void(0)"
                        >{{ tag }}</a
                      >
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="th-comments-wrap">
            <h2 class="blog-inner-title h4">Comments ({{ commentsCount }})</h2>

            <div v-if="loading" class="text-center">
              <p>Loading comments...</p>
            </div>

            <div v-else-if="error" class="alert alert-danger">
              {{ error }}
            </div>

            <ul v-else-if="displayedComments.length > 0" class="comment-list">
              <Comments
                v-for="comment in displayedComments"
                :key="comment.id"
                :comment="comment"
              />
            </ul>

            <div v-else>
              <p>No comments yet. Be the first to comment!</p>
            </div>

            <!-- See More/See Less Button -->
            <div
              v-if="hasMoreComments || showAllComments"
              class="text-center mt-3"
            >
              <button @click="toggleShowAllComments" class="th-btn style2">
                {{
                  showAllComments
                    ? "See Less"
                    : `See More (${comments.length - commentsPerPage} more)`
                }}
              </button>
            </div>
          </div>
          <CommentForm :blog-id="single_blog?.id" />
        </div>
        <div class="col-xxl-4 col-lg-5">
          <SidebarArea />
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { Link } from "@inertiajs/vue3";
import SidebarArea from "./components/SidebarArea.vue";
import CommentForm from "./components/CommentForm.vue";
import Comments from "./components/Comments.vue";
import { store as blog_details_store } from "./Store/blog_details_store.js";
import { store as blog_comments_store } from "./Store/blog_comments_store.js";
import { mapState, mapActions } from "pinia";

export default {
  name: "BlogDetails",
  components: {
    SidebarArea,
    CommentForm,
    Comments,
    Link,
  },
  created: function () {
    const urlParams = new URLSearchParams(window.location.search);
    const slug = urlParams.get("slug");
    if (slug) {
      this.fetch_single_blog(slug);
    }
    console.log("Single blog in store:", this.single_blog);
  },
  watch: {
    single_blog: {
      handler(newBlog) {
        if (newBlog?.id) {
          this.fetchComments(newBlog.id);
        }
      },
      immediate: true,
    },
  },
  computed: {
    ...mapState(blog_details_store, ["single_blog"]),
    ...mapState(blog_comments_store, [
      "comments",
      "displayedComments",
      "showAllComments",
      "commentsPerPage",
      "loading",
      "error",
      "commentsCount",
      "hasMoreComments",
    ]),
  },
  methods: {
    ...mapActions(blog_details_store, ["fetch_single_blog", "getTagsArray"]),
    ...mapActions(blog_comments_store, [
      "fetchComments",
      "toggleShowAllComments",
    ]),

    formatDate(dateString) {
      if (!dateString) return "N/A";
      const date = new Date(dateString);
      const day = date.getDate().toString().padStart(2, "0");
      const month = (date.getMonth() + 1).toString().padStart(2, "0");
      const year = date.getFullYear();
      return `${day}/${month}/${year}`;
    },
  },
};
</script>

<style lang="scss" scoped></style>
