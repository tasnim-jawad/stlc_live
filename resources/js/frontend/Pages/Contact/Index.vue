<template>
  <div
    class="breadcumb-wrapper"
    data-bg-src="assets/frontend/img/bg/breadcrumb-bg.jpg"
    style="background-image: url('assets/frontend/img/bg/breadcrumb-bg.jpg')"
  >
    <div class="container">
      <div class="breadcumb-content">
        <h1 class="breadcumb-title mt-5">Contact</h1>
        <ul class="breadcumb-menu">
          <li><Link href="/">Home</Link></li>
          <li>Contact with Us</li>
        </ul>
      </div>
    </div>
  </div>
  <div class="contact-area-2 space-top" id="contact-sec">
    <div class="container">
      <div class="row gy-4 justify-content-center">
        <div class="col-xl-4 col-lg-6 contact-feature-wrap">
          <div class="contact-feature">
            <div class="contact-feature-icon">
              <i class="fas fa-location-dot"></i>
            </div>
            <div class="media-body">
              <p class="contact-feature_label">Address</p>
              <a
                href="javascript:void(0);"
                class="contact-feature_link"
                v-for="address in getSettingValuesByTitle('address')"
                :key="address"
                >{{ address }}</a
              >
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-lg-6 contact-feature-wrap">
          <div class="contact-feature">
            <div class="contact-feature-icon">
              <i class="fas fa-phone"></i>
            </div>
            <div class="media-body">
              <p class="contact-feature_label">Phone Number</p>
              <a
                href="javascript:void(0);"
                class="contact-feature_link"
                v-for="phone in getSettingValuesByTitle('phone_numbers')"
                :key="phone"
                >{{ phone }}</a
              >
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-lg-6 contact-feature-wrap">
          <div class="contact-feature">
            <div class="contact-feature-icon">
              <i class="fas fa-envelope"></i>
            </div>
            <div class="media-body">
              <p class="contact-feature_label">Email Address</p>
              <a
                href="javascript:void(0);"
                class="contact-feature_link"
                v-for="email in getSettingValuesByTitle('emails')"
                :key="email"
                >{{ email }}
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ContactForm2 -->
  <ContactForm2 />
  <!-- ContactForm2 -->

  <!-- LocationMap -->
  <LocationMap/>
  <!-- LocationMap -->
</template>

<script>
import { mapActions, mapState } from "pinia";
import ContactForm2 from "../../GlobalComponent/ContactForm2/ContactForm2.vue";
import LocationMap from "../../GlobalComponent/LocationMap/LocationMap.vue";

import { store as contact_store } from "./Store/contact_store.js";
export default {
  components: {
    ContactForm2,
    LocationMap,
  },
  methods: {
    ...mapActions(contact_store, [
      "fetch_website_settings",
      "fetch_addresses",
      "getSettingValuesByTitle",
      "getFirstSettingValueByTitle",
    ]),
    
  },
  created: function () {
    this.fetch_website_settings();
  },
  computed: {
    ...mapState(contact_store, ["website_settings"]),
  },
};
</script>

<style>
.contact-feature_link {
  word-break: break-all;   /* or break-word */
  overflow-wrap: anywhere; /* modern & better */
}
</style>
