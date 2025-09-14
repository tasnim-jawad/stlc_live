<template>
  <div
    class="breadcumb-wrapper"
    data-bg-src="assets/frontend/img/blog/breadcrumb-bg.jpg"
    style="background-image: url('assets/frontend/img/blog/breadcrumb-bg.jpg')"
  >
    <div class="container">
      <div class="breadcumb-content">
        <h1 class="breadcumb-title mt-5">Blog Grid</h1>
        <ul class="breadcumb-menu">
          <li><Link href="/">Home</Link></li>
          <li>Blog Grid</li>
        </ul>
      </div>
    </div>
  </div>
  <section class="th-blog-wrapper space-top space-extra-bottom">
    <div class="container">
      <div class="th-sort-bar property-style">
        <div class="row justify-content-between align-items-center">
          <div class="col-md">
            <h4
              class="box-title text-start fadeinup wow"
              data-wow-duration="1.5s"
              data-wow-delay="0.1s"
              style="
                visibility: visible;
                animation-duration: 1.5s;
                animation-delay: 0.1s;
                animation-name: fadeinup;
              "
            >
              Blog Listing
            </h4>
          </div>
          <div class="col-md-auto">
            <div
              class="sorting-filter-wrap fadeinup wow"
              data-wow-duration="1.5s"
              data-wow-delay="0.3s"
              style="
                visibility: visible;
                animation-duration: 1.5s;
                animation-delay: 0.3s;
                animation-name: fadeinup;
              "
            >
              
              <form class="woocommerce-ordering" method="get">
                <select
                  name="orderby"
                  class="orderby"
                  aria-label="Shop order"
                  @change="onCategoryChange"
                >
                  <option value="all" selected="selected">
                    All images
                  </option>
                  <option
                    v-for="category in blog_categories?.data"
                    :key="category.id"
                    :value="category.id"
                  >
                    Sort by {{ category.title }}
                  </option>
                </select>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="row gy-30 justify-content-center">
        <template v-for="blog in blogs?.data" :key="blog.id">
          <BlogSingleItem :blog="blog" />
        </template>

        <div class="col-12">
          <Pagination
            :currentPage="blogs.current_page || 1"
            :totalPages="blogs.last_page || 1"
            @prev="goToPage(blogs.current_page - 1)"
            @next="goToPage(blogs.current_page + 1)"
            @change="goToPage"
          />
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { ref, computed } from "vue";
import { Link } from "@inertiajs/vue3";
import BlogSingleItem from "./components/BlogSingleItem.vue";
import Pagination from "../../GlobalComponent/Pagination/Pagination.vue";
import { mapState, mapActions } from "pinia";
import { store as blog_store } from "./Store/blog_store.js";
import $ from "jquery";
import "magnific-popup";
import "magnific-popup/dist/magnific-popup.css";

export default {
  components: {
    Link,
    BlogSingleItem,
    Pagination,
  },
  created: function () {
    this.fetch_blog_categories();
    this.fetch_blogs({ page: 1 });
    console.log("Blogs in store dsd:", this.blogs);
  },
  methods: {
    ...mapActions(blog_store, [
      "fetch_blogs",
      "fetch_blog_categories",
      "set_blog_category_id",
    ]),
    goToPage(page) {
      console.log("Going to page:", page);
      if (page < 1 || page > (this.blogs.last_page || 1)) return;
      this.fetch_blogs({ page });
    },
    onCategoryChange(event) {
      const categoryId = event.target.value;
      if (categoryId !== "menu_order") {
        this.set_blog_category_id(categoryId);
      }
    },
  },
  computed: {
    ...mapState(blog_store, ["blogs", "blog_categories"]),
  },
};
</script>
