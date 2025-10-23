<template>
  <div
    class="breadcumb-wrapper"
    data-bg-src="/assets/frontend/img/common/2.jpeg"
    style="background-image: url('/assets/frontend/img/common/2.jpeg')"
  >
    <div class="container">
      <div class="breadcumb-content">
        <h1 class="breadcumb-title mt-5">Services Details</h1>
        <ul class="breadcumb-menu">
          <li><Link href="/">Home</Link></li>
          <li><Link href="/service">Service</Link></li>
          <li>Services Details</li>
        </ul>
      </div>
    </div>
  </div>
  <section class="th-blog-wrapper blog-details space-top space-extra-bottom">
    <div class="container">
      <div class="row">
        <div class="col-xxl-12 col-lg-12">
          <div class="th-blog blog-single">
            <div class="blog-img">
              <img
                class="w-100"
                :src="'/' + single_service?.primary_image"
                alt="Image"
              />
            </div>
            <div class="blog-content">
              <h2 class="blog-title">
                {{ single_service?.title ?? "N/A" }}
              </h2>
              <hr />
              <div>
                <p>{{ single_service?.description ?? "N/A" }}</p>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { Link } from "@inertiajs/vue3";
import { store as service_store } from "./Store/service_store.js";
import { mapState, mapActions } from "pinia";

export default {
  name: "ServiceDetails",
  components: {
    Link,
  },
  created: function () {
    const urlParams = new URLSearchParams(window.location.search);
    const slug = urlParams.get("slug");
    if (slug) {
      this.fetch_single_service(slug);
    }
    console.log("Single service in store:", this.single_service);
  },
  
  computed: {
    ...mapState(service_store, ["single_service"]),

  },
  methods: {
    ...mapActions(service_store, ["fetch_single_service"]),
   
  },
};
</script>

<style lang="scss" scoped>
.blog-img {
  max-height: 600px;
  display: flex;
  justify-content: center;
  align-items: center;
  overflow: hidden;
  
  img {
    border-radius: 8px;
    object-position: center;
    object-fit: cover;
    height: 100%;
    width: 100%;
  }
}
</style>
