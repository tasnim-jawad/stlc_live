<template>
  <section class="popular-sec-1 space">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-7">
          <div class="title-area text-center mb-2">
            <p
              class="sub-title fadeinup wow"
              data-wow-duration="1.2s"
              data-wow-delay="0.1s"
            >
              <span class="double-line"></span> Popular Properties
            </p>
            <h2
              class="sec-title mb-4 fadeinup wow"
              data-wow-duration="1.3s"
              data-wow-delay="0.3s"
            >
              Best Properties Sale
            </h2>
            <div
              class="filter-menu indicator-active filter-menu-active mt-2 justify-content-center fadeinup wow"
              data-wow-duration="1.5s"
              data-wow-delay="0.5s"
            >
              <button
                data-filter="*"
                :class="[
                  'th-btn tab-btn',
                  { active: property_category_id === null },
                ]"
                type="button"
                @click.prevent.stop="handleCategoryFilter(null)"
              >
                View All
              </button>
              <button
                v-for="category in property_categories?.data"
                :key="category.id"
                @click.prevent.stop="handleCategoryFilter(category?.id)"
                :class="[
                  'th-btn tab-btn',
                  { active: property_category_id === category.id },
                ]"
                type="button"
              >
                {{ category?.name }}
              </button>
            </div>
          </div>
        </div>
      </div>
      <div class="row gy-30 justify-content-center filter-active">
        <!-- <p>{{ properties }} Properties Found</p> -->
        <template v-for="(property, index) in properties?.data" :key="index">
          <PopularPropertiesSingleItem :property="property" />
        </template>
      </div>
      <div class="col-xxl-12 text-center mt-5">
        <!-- <Pagination
          :currentPage="properties.current_page || 1"
          :totalPages="properties.last_page || 1"
          @prev="goToPage(properties.current_page - 1)"
          @next="goToPage(properties.current_page + 1)"
          @change="goToPage"
        /> -->
        <Link class="th-btn rounded" href="/portfolio">See more</Link>
      </div>
    </div>
  </section>
</template>

<script>
import Pagination from "../Pagination/Pagination.vue";
import PopularPropertiesSingleItem from "./PopularPropertiesSingleItem.vue";
import { store as property_store } from "./Store/propertiesStore.js";
import { mapState, mapActions } from "pinia";
export default {
  components: {
    PopularPropertiesSingleItem,
    Pagination,
  },
  created: function () {
    this.fetch_property_categories();
    this.fetch_properties({ page: 1 });
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
    handleCategoryFilter(categoryId) {
      // Prevent event bubbling that might affect other components
      event?.stopPropagation();
      this.set_property_category_id(categoryId);
    },
  },
  computed: {
    ...mapState(property_store, [
      "properties",
      "property_categories",
      "property_category_id",
    ]),
  },
};
</script>

<style lang="scss" scoped>
/* Scoped styles to prevent conflicts with other components */
.popular-sec-1 {
  isolation: isolate;
}

.filter-menu {
  position: relative;
  z-index: 1;
}

.tab-btn {
  position: relative;
  z-index: 2;
}
</style>
