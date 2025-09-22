<template>
  <div
    class="breadcumb-wrapper background-image"
    style="background-image: url('assets/frontend/img/blog/breadcrumb-bg.jpg')"
  >
    <div class="container">
      <div class="breadcumb-content">
        <h1 class="breadcumb-title mt-5">Properties</h1>
        <ul class="breadcumb-menu">
          <li><Link href="/">Home</Link></li>
          <li>Properties</li>
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
              Property Listing
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
              <div class="nav" role="tablist">
                <a
                  class="active"
                  href="#"
                  id="tab-shop-list"
                  data-bs-toggle="tab"
                  data-bs-target="#tab-list"
                  role="tab"
                  aria-controls="tab-grid"
                  aria-selected="false"
                  ><i class="fa-solid fa-list"></i
                ></a>
                <a
                  href="#"
                  id="tab-shop-grid"
                  data-bs-toggle="tab"
                  data-bs-target="#tab-grid"
                  role="tab"
                  aria-controls="tab-grid"
                  aria-selected="true"
                  ><i class="fa-light fa-grid-2"></i
                ></a>
              </div>
              <form class="woocommerce-ordering" method="get">
                <select
                  name="orderby"
                  class="orderby"
                  aria-label="Shop order"
                  @change="onCategoryChange"
                >
                  <option value="all" selected="selected">
                    Default Sorting
                  </option>
                  <option
                    v-for="category in property_categories?.data"
                    :key="category.id"
                    :value="category.id"
                  >
                    Sort by {{ category.name }}
                  </option>
                </select>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="tab-content" id="nav-tabContent">
        <div
          class="tab-pane fade"
          id="tab-grid"
          role="tabpanel"
          aria-labelledby="tab-shop-grid"
        >
          <div class="row gy-40">
            <template v-for="(property, index) in properties?.data" :key="index"  >
              <PropertySingleItemGrid :property="property" />
            </template>

            <!-- <Pagination /> -->
            <div class="col-xxl-12">
              <Pagination
                :currentPage="properties.current_page || 1"
                :totalPages="properties.last_page || 1"
                @prev="goToPage(properties.current_page - 1)"
                @next="goToPage(properties.current_page + 1)"
                @change="goToPage"
              />
            </div>
          </div>
        </div>
        <div
          class="tab-pane fade active show"
          id="tab-list"
          role="tabpanel"
          aria-labelledby="tab-shop-list"
        >
          <div class="row gy-40 justify-content-center">
            <div class="col-xl-8 col-lg-12">
              <div class="row gy-30">
                <template v-for="(property, index) in properties?.data" :key="index">
                  <PropertySingleItemList :property="property" />
                </template>

                <div class="col-xxl-12">
                  <Pagination
                    :currentPage="properties.current_page || 1"
                    :totalPages="properties.last_page || 1"
                    @prev="goToPage(properties.current_page - 1)"
                    @next="goToPage(properties.current_page + 1)"
                    @change="goToPage"
                  />
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-lg-12">
              <SidebarArea />
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { Link } from "@inertiajs/vue3";

import PropertySingleItemGrid from "./components/PropertySingleItemGrid.vue";
import PropertySingleItemList from "./components/PropertySingleItemList.vue";
import Pagination from "../../GlobalComponent/Pagination/Pagination.vue";
import SidebarArea from "./components/SidebarArea.vue";
import { store as property_store } from "./Store/propertiesStore.js";
import { mapState, mapActions } from "pinia";

import $ from "jquery";
import "magnific-popup";
import "magnific-popup/dist/magnific-popup.css";

export default {
  components: {
    Link,
    PropertySingleItemGrid,
    PropertySingleItemList,
    Pagination,
    SidebarArea,
  },
  
  created: function () {
    this.fetch_property_categories();
    const urlParams = new URLSearchParams(window.location.search);
    const categoryId = urlParams.get('property_category_id');
    if (categoryId) {
      this.set_property_category_id(categoryId);
    }else {
      this.fetch_properties({ page: 1 });
    }
    
  },
  methods: {
    ...mapActions(property_store, [
      "fetch_properties",
      "fetch_property_categories",
      "set_property_category_id",
    ]),
    goToPage(page) {
      console.log("Going to page:", page);
      if (page < 1 || page > (this.properties.last_page || 1)) return;
      this.fetch_properties({ page });
    },
    onCategoryChange(event) {
      const categoryId = event.target.value;
      if (categoryId !== "menu_order") {
        this.set_property_category_id(categoryId);
      }
    },
  },
  computed: {
    ...mapState(property_store, ["properties", "property_categories"]),
  },
};
</script>

<style scoped>

@import url('./css/index.css');
</style>