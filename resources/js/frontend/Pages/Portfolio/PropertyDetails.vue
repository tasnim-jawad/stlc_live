<template>
  <div
    class="breadcumb-wrapper"
    style="background-image: url('/assets/frontend/img/blog/breadcrumb-bg.jpg')"
  >
    <div class="container">
      <div class="breadcumb-content">
        <h1 class="breadcumb-title mt-5">Property Details</h1>
        <ul class="breadcumb-menu">
          <li><Link href="/">Home</Link></li>
          <li>Property Details</li>
        </ul>
      </div>
    </div>
  </div>
  <section class="property-details space overflow-hidden">
    <div class="container">
      <div class="row gy-40 gx-50">
        <div class="col-xxl-8 col-lg-7">
          <div class="row gy-30">
            <div class="col-12">
              <BannerImageSlider
                :banner_images="single_property?.banner_image || []"
              />
            </div>
            <div class="col-12">
              <div class="property-page-single">
                <div class="page-content">
                  <div class="property-meta-wrap mb-55 fadeinup wow">
                    <div class="property-meta">
                      <a class="property-tag" href="/portfolio">{{
                        single_property?.category?.name
                      }}</a>
                      <a href="blog.html"
                        ><i class="fa-solid fa-calendar-days"></i>
                        {{
                          new Date(single_property?.date)
                            .toLocaleDateString("en-GB", {
                              day: "2-digit",
                              month: "short",
                              year: "numeric",
                            })
                            .replace(/ (\d{4})$/, ", $1")
                        }}</a
                      >
                      <a href="blog.html"
                        ><i class="fa-solid fa-diagram-project"></i>
                        {{
                          single_property?.property_status == "sale"
                            ? "For Sale"
                            : "For Rent"
                        }}</a
                      >
                    </div>
                    <!-- <div class="wishlist-icon">
                      <a href="wishlist.html" class="icon-btn"
                        ><i class="fa-solid fa-heart"></i
                      ></a>
                    </div> -->
                  </div>
                  <div class="page-title-wrap fadeinup wow">
                    <h2 class="page-title mb-2">
                      {{ single_property?.property_name }}
                    </h2>
                    <h4 class="page-title">
                      ৳ {{ single_property?.price?.toLocaleString() }}
                    </h4>
                  </div>
                  <div class="page-features fadeinup wow">
                    <div class="box-text">
                      <div class="icon">
                        <img
                          src="/assets/frontend/img/icon/popular-location.svg"
                          alt="icon"
                        />
                      </div>
                      {{
                        single_property?.property_address ||
                        "298 South Goran ,Khilgaon ,Dhaka-1219"
                      }}
                    </div>
                    <ul class="property-featured">
                      <li
                        v-for="feature in (
                          single_property?.facts_and_features || []
                        ).slice(0, 3)"
                        :key="feature"
                      >
                        <div class="icon">
                          <!-- <img src="/assets/frontend/img/icon/bed.svg" alt="icon" /> -->
                          <i :class="feature?.icon"></i>
                        </div>
                        {{ feature?.title }}
                      </li>
                    </ul>
                  </div>
                  <p
                    class="mb-30 fadeinup wow"
                    v-html="single_property?.property_description"
                  ></p>

                  <!-- ----------------------------------------------------------------------
                  ---------------------- PropertyDetail Component ----------------------
                  ---------------------------------------------------------------------- -->
                  <PropertyDetail
                    :property_detail="single_property?.property_detail"
                    :property_status="
                      single_property?.property_status == 'sale'
                        ? 'For Sale'
                        : 'For Rent'
                    "
                  />

                  <!-- ----------------------------------------------------------------------
                  ---------------------- FactsAndFeatures Component ----------------------
                  ---------------------------------------------------------------------- -->
                  <FactsAndFeatures
                    :facts_and_features="single_property?.facts_and_features"
                  />

                  <!-- ----------------------------------------------------------------------
                  ---------------------- Gallery Component ----------------------
                  ---------------------------------------------------------------------- -->
                  <Gallery :gallery="single_property?.gallery" />

                  <!-- ----------------------------------------------------------------------
                  ---------------------- Amenities Component ----------------------
                  ---------------------------------------------------------------------- -->
                  <Amenities :amenities="single_property?.amenities" />

                  <!-- ----------------------------------------------------------------------
                  ---------------------- FloorPlan Component ----------------------
                  ---------------------------------------------------------------------- -->
                  <FloorPlan :floor_plan="single_property?.floor_plan" />

                  <!-- ----------------------------------------------------------------------
                  ---------------------- Location Component ----------------------
                  ---------------------------------------------------------------------- -->
                  <Location
                    :map_location_url="single_property?.map_location_url"
                    :property_address="single_property?.property_address"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-lg-5">
          <SidebarArea />
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import SidebarArea from "./components/SidebarArea.vue";
import BannerImageSlider from "./components/property_details/BannerImageSlider.vue";
import PropertyDetail from "./components/property_details/PropertyDetail.vue";
import FactsAndFeatures from "./components/property_details/FactsAndFeatures.vue";
import FloorPlan from "./components/property_details/FloorPlan.vue";
import Location from "./components/property_details/Location.vue";
import Gallery from "./components/property_details/Gallery.vue";
import Amenities from "./components/property_details/Amenities.vue";

import "magnific-popup";
import "magnific-popup/dist/magnific-popup.css";

import { store as property_details_store } from "./Store/property_details_store.js";
import { mapActions, mapState } from "pinia";

export default {
  components: {
    SidebarArea,
    BannerImageSlider,
    PropertyDetail,
    FactsAndFeatures,
    FloorPlan,
    Location,
    Gallery,
    Amenities,
  },
  created: function () {
    const urlParams = new URLSearchParams(window.location.search);
    const slug = urlParams.get("slug");
    if (slug) {
      this.fetch_single_property(slug);
    } else {
      console.error("No slug parameter found in the URL.");
    }
  },
  methods: {
    ...mapActions(property_details_store, ["fetch_single_property"]),
  },
  computed: {
    ...mapState(property_details_store, ["single_property"]),
  },
};
</script>

<style lang="scss" scoped></style>
