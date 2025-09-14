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
            <h2 class="blog-inner-title h4">Comments (3)</h2>
            <ul class="comment-list">
              <li class="th-comment-item">
                <div class="th-post-comment">
                  <div class="comment-avater">
                    <img
                      src="/assets/frontend/img/blog/comment-author-1.jpg"
                      alt="Comment Author"
                    />
                  </div>
                  <div class="comment-content">
                    <h3 class="name">Adam Jhon</h3>
                    <span class="commented-on">25 Jun, 2025 08:56pm</span>
                    <p class="text">
                      Through this blog, we aim to inspire readers and of the
                      blog to embrace education as a lifelong journey and to
                      advocate for quality education
                    </p>
                    <div class="reply_and_edit">
                      <a href="blog-details.html" class="reply-btn"
                        ><i class="fa-solid fa-reply"></i> Reply</a
                      >
                    </div>
                  </div>
                </div>
                <ul class="children">
                  <li class="th-comment-item">
                    <div class="th-post-comment">
                      <div class="comment-avater">
                        <img
                          src="/assets/frontend/img/blog/comment-author-2.jpg"
                          alt="Comment Author"
                        />
                      </div>
                      <div class="comment-content">
                        <h3 class="name">Jhon Abraham</h3>
                        <span class="commented-on">25 Jun, 2025 08:56pm</span>
                        <p class="text">
                          Education News and Trends: and of the blog We provide
                          updates on the latest blog and developments and trends
                          in the education sector.
                        </p>
                        <div class="reply_and_edit">
                          <a href="blog-details.html" class="reply-btn"
                            ><i class="fa-solid fa-reply"></i> Reply</a
                          >
                        </div>
                      </div>
                    </div>
                  </li>
                </ul>
              </li>
              <li class="th-comment-item">
                <div class="th-post-comment">
                  <div class="comment-avater">
                    <img
                      src="/assets/frontend/img/blog/comment-author-3.jpg"
                      alt="Comment Author"
                    />
                  </div>
                  <div class="comment-content">
                    <h3 class="name">Anadi Juila</h3>
                    <span class="commented-on">25 Jun, 2025 08:56pm</span>
                    <p class="text">
                      We discuss strategies to and of the blog help students and
                      other people public make informed decisions about their
                      educational and career paths.
                    </p>
                    <div class="reply_and_edit">
                      <a href="blog-details.html" class="reply-btn"
                        ><i class="fa-solid fa-reply"></i> Reply</a
                      >
                    </div>
                  </div>
                </div>
              </li>
            </ul>
          </div>
          <div class="th-comment-form blog-comment-wrap">
            <div class="form-title mb-25">
              <h3 class="blog-inner-title h4">Leave a Reply</h3>
              <p class="form-text">
                Your email address will not be published. Required fields are
                marked
              </p>
            </div>
            <div class="row">
              <div class="col-md-6 form-group style-border">
                <i class="fa-regular fa-user"></i>
                <input
                  id="name"
                  name="name"
                  type="text"
                  placeholder="Your name*"
                  class="form-control"
                />
              </div>
              <div class="col-md-6 form-group style-border">
                <i class="fa-regular fa-envelope"></i>
                <input
                  id="email"
                  name="email"
                  type="text"
                  placeholder="Your email*"
                  class="form-control"
                />
              </div>
              <div class="col-12 form-group style-border">
                <i class="fa-solid fa-globe"></i>
                <input
                  id="website"
                  name="name"
                  type="text"
                  placeholder="Website*"
                  class="form-control"
                />
              </div>
              <div class="col-12 form-group style-border">
                <i class="fa-regular fa-pen"></i>
                <textarea
                  placeholder="Comment*"
                  class="form-control"
                ></textarea>
              </div>
              <div class="col-12 form-group">
                <input id="reviewcheck" name="reviewcheck" type="checkbox" />
                <label for="reviewcheck"
                  >Save my name, email, and website in this browser for the next
                  time I comment.<span class="checkmark"></span
                ></label>
              </div>
              <div class="col-12 form-group style-border mb-0">
                <button class="th-btn radius">Send Message</button>
              </div>
            </div>
          </div>
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
import { store as blog_details_store } from "./Store/blog_details_store.js";
import { mapState, mapActions } from "pinia";

export default {
  name: "BlogDetails",
  components: {
    SidebarArea,
  },
  created: function () {
    const urlParams = new URLSearchParams(window.location.search);
    const slug = urlParams.get("slug");
    if (slug) {
      this.fetch_single_blog(slug);
    }
    console.log("Single blog in store:", this.single_blog);
  },
  computed: {
    ...mapState(blog_details_store, ["single_blog", "loading", "error"]),
  },
  methods: {
    ...mapActions(blog_details_store, [
      "fetch_single_blog",
      "getTagsArray"
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
