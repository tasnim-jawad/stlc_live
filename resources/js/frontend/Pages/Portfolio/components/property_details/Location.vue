<template>
  <h3 class="page-title mt-50 mb-30 fadeinup wow">Location</h3>
  <div class="location-map fadeinup wow">
    <div class="contact-map">
      <iframe
        :src="map_location_url"
        allowfullscreen=""
        loading="lazy"
      ></iframe>
    </div>
    <div class="location-map-address">
      <div class="thumb p-2">
        <img 
          src="/assets/frontend/img/icon/popular-location.svg"
          alt="img"
        />
      </div>
      <div class="media-body">
        <h4 class="title">Address:</h4>
        <p class="text">{{ property_address }}</p>
        <!-- <h4 class="title">Post Code:</h4>
        <p class="text">12345</p> -->
      </div>
    </div>
  </div>
</template>

<script>
export default {
    props: {
        map_location_url: {
            type: String,
            required: true
        },
        property_address: {
            type: String,
            required: true
        }
    }
};
</script>

<style lang="scss" scoped></style>
