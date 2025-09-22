<template>
<div
    class="breadcumb-wrapper"
    :style="{ backgroundImage: `url('/${custom_page_data?.banner_image}')` }"
  >
    <div class="container">
      <div class="breadcumb-content">
        <h1 class="breadcumb-title mt-5">{{ custom_page_data?.title }}</h1>
        <ul class="breadcumb-menu">
          <li><Link href="/">Home</Link></li>
          <li>{{ custom_page_data?.title }}</li>
        </ul>
      </div>
    </div>
  </div>
  <section class="th-blog-wrapper blog-details space-top space-extra-bottom">
    <div class="container">
      <div class="row">
        <div class="col-xxl-12 col-lg-12">
          <div class="th-blog blog-single">
            <div class="blog-content">
              <p v-html="custom_page_data?.description"></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { Link } from "@inertiajs/vue3";
import { store as custom_page_store } from "./Store/custom_page_store.js";
import { mapState, mapActions } from "pinia";
import { event } from "jquery";

export default {
  name: "custom_page_index",
  components: {
    Link,
  },
  props: {
    event: {
      type: Object,
      default: () => ({}),
    },
  },
  created: function () {
    const event_permalink = this.event?.permalink;
    console.log("event_permalink:", event_permalink);

    if (event_permalink) {
      this.fetch_custom_page(event_permalink);
    }
    console.log("Custom page in store:", this.custom_page_data);
  },
  computed: {
    ...mapState(custom_page_store, ["custom_page_data"]),
  },
  methods: {
    ...mapActions(custom_page_store, ["fetch_custom_page"]),
  },
};
</script>

<style lang="scss" scoped></style>
