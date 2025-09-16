<template>
  <div class="space-top">
    <div class="container-fluid p-0">
      <div class="contact-map">
        <iframe
          :src="firstAddressMapLink() != '' ? firstAddressMapLink() : 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3746527.452679472!2d90.3443647!3d23.506657!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30adaaed80e18ba7%3A0xf2d28e0c4e1fc6b!2sBangladesh!5e0!3m2!1sen!2sbd!4v1758005870458!5m2!1sen!2sbd' "
          allowfullscreen=""
          loading="lazy"
        ></iframe>
       
        <div class="contact-icon">
          <img src="assets/frontend/img/icon/con-location-dot.svg" alt="img" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>

import { mapActions, mapState } from "pinia";
import { store as location_store } from "./Store/location_store.js";

export default {
  created: function () {
    this.fetch_addresses();
  },
  methods: {
    ...mapActions(location_store, [
      "fetch_addresses",
      "firstAddressMapLink"
    ]),
  },
  computed: {
    ...mapState(location_store, ["addresses"]),
  },
};

</script>

<style scoped>

</style>
