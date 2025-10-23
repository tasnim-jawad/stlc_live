<template>
  <div
    class="breadcumb-wrapper background-image"
    style="background-image: url('assets/frontend/img/common/2.jpeg')"
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
      <div class="row justify-content-center">
        <div class="col-xl-7">
          <div class="title-area text-center mb-2">
            <p
              class="sub-title fadeinup wow"
              data-wow-duration="1.5s"
              data-wow-delay="0.1s"
            >
              <span class="double-line"></span> Projects
            </p>
            <h2
              class="sec-title mb-4 fadeinup wow"
              data-wow-duration="1.5s"
              data-wow-delay="0.3s"
            >
              Welcome to Our Projects
            </h2>
            <p
              class="chat-text-wrap text-center pe-xl-5 ps-xl-5 mb-5 fadeinup wow"
            >
              Our projects, including 21 Towers, Rose Garden Towers, DGC-G Plot,
              Mirpur Model Towers, and Sun View Towers, showcase modern design,
              durability, and innovation. Every project reflects our commitment
              to quality, transparency, and long-term client value.
            </p>
            <div
              class="filter-menu style-2 indicator-active filter-menu-active mt-2 justify-content-center fadeinup wow"
              data-wow-duration="1.5s"
              data-wow-delay="0.5s"
            ></div>
          </div>
        </div>
      </div>
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
            <!-- Show skeleton placeholders when loading -->
            <template v-if="loading">
              <PropertySingleItemGrid
                v-for="n in 6"
                :key="`skeleton-${n}`"
                :property="{}"
                :is-loading="true"
              />
            </template>
            <!-- Show actual data when loaded -->
            <template v-else>
              <template
                v-for="(property, index) in properties?.data"
                :key="index"
              >
                <PropertySingleItemGrid
                  :property="property"
                  :is-loading="false"
                />
              </template>
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
                <!-- Show skeleton placeholders when loading -->
                <template v-if="loading">
                  <PropertySingleItemList
                    v-for="n in 4"
                    :key="`skeleton-list-${n}`"
                    :property="{}"
                    :is-loading="true"
                  />
                </template>
                <!-- Show actual data when loaded -->
                <template v-else>
                  <template
                    v-for="(property, index) in properties?.data"
                    :key="index"
                  >
                    <PropertySingleItemList
                      :property="property"
                      :is-loading="false"
                    />
                  </template>
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
    console.log("Portfolio component created");
    this.fetch_property_categories();
    const urlParams = new URLSearchParams(window.location.search);
    const categoryId = urlParams.get("property_category_id");
    if (categoryId) {
      console.log("Setting category ID:", categoryId);
      this.set_property_category_id(categoryId);
    } else {
      console.log("Fetching initial properties, page 1");
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
      console.log(
        "Current properties.current_page:",
        this.properties.current_page
      );
      console.log("Total pages:", this.properties.last_page);

      if (page < 1 || page > (this.properties.last_page || 1)) {
        console.log("Page out of range, ignoring");
        return;
      }

      console.log("Fetching page:", page);
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
    ...mapState(property_store, [
      "properties",
      "property_categories",
      "loading",
    ]),
  },
  watch: {
    loading(newValue, oldValue) {
      console.log("Portfolio loading state changed:", {
        old: oldValue,
        new: newValue,
      });
      console.log(
        "Properties data:",
        this.properties?.data?.length || 0,
        "items"
      );
    },
    "properties.current_page"(newValue, oldValue) {
      console.log("Current page changed:", { old: oldValue, new: newValue });
      console.log("Total pages:", this.properties?.last_page);
    },
  },
};
</script>

<style scoped>
@import url("./css/index.css");
</style>
