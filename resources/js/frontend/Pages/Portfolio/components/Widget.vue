<template>
  <div class="widget">
    <h3 class="widget_title">Featured Listings</h3>
    <div class="recent-post-wrap featured-listing">
      <div
        class="recent-post"
        v-for="(property, index) in random_properties?.data"
        :key="index"
      >
        <div class="media-img">
          <Link :href="`/portfolio/property-details?slug=${property?.slug}`"
            ><img
              :src="'/' + 
                property?.banner_image[0] ||
                'assets/frontend/img/blog/featured-listing-sidebar-1-1.jpg'
              "
              alt="Image"
          /></Link>
        </div>
        <div class="media-body">
          <h4 class="post-title">
            <Link
              class="text-inherit"
              :href="`/portfolio/property-details?slug=${property?.slug}`"
              >{{ property?.property_name }}</Link
            >
          </h4>
          <div class="property-features-wrap">
            <template
              v-for="(feature, index) in (
                property?.facts_and_features || []
              ).slice(0, 3)"
              :key="index"
            >
              <div class="property-features-item">
                <!-- <div class="thumb">
                  <img src="assets/frontend/img/icon/bed.svg" alt="icon" />
                </div> -->
                <div class="icon mr-1">
                  <span><i :class="feature?.icon"></i></span>
                </div>
                <h5 class="feature-title">{{ feature?.title }}</h5>
              </div>
                <div class="divider" v-if="index < ((property?.facts_and_features || []).slice(0, 3).length - 1)"></div>
            </template>
          </div>
          <div class="recent-post-meta">
            <Link :href="`/portfolio/property-details?slug=${property?.slug}`">৳ {{ property?.price?.toLocaleString() }}</Link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { store as propertiesStore } from "../Store/propertiesStore";
import { mapState, mapActions } from "pinia";
export default {
  created: function () {
    this.fetch_random_properties();
    console.log("Properties in store dsd:", this.random_properties);
  },
  methods: {
    ...mapActions(propertiesStore, ["fetch_random_properties"]),
  },
  computed: {
    ...mapState(propertiesStore, ["random_properties"]),
  },
};
</script>

<style lang="scss" scoped></style>
