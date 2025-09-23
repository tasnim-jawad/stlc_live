<template>
  <h3 class="page-title mt-50 mb-30 fadeinup wow">Location</h3>
  <div class="location-map fadeinup wow">
    <div class="contact-map" v-if="isValidMapUrl">
      <iframe
        :src="map_location_url"
        allowfullscreen=""
        loading="lazy"
        @error="handleMapError"
      ></iframe>
    </div>
    <div class="map-error" v-else>
      <div class="error-content">
        <img
          src="/assets/frontend/img/icon/popular-location.svg"
          alt="Location not available"
          class="error-icon"
        />
        <h4>Location Not Available</h4>
        <p>
          Map location is currently unavailable. Please check the address below.
        </p>
      </div>
    </div>
    <div class="location-map-address">
      <div class="thumb p-2">
        <img src="/assets/frontend/img/icon/popular-location.svg" alt="img" />
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
      required: true,
    },
    property_address: {
      type: String,
      required: true,
    },
  },
  data() {
    return {
      mapError: false,
    };
  },
  computed: {
    isValidMapUrl() {
      // Check if URL is valid and not empty
      if (!this.map_location_url || this.map_location_url.trim() === "") {
        return false;
      }

      // Basic URL validation
      try {
        new URL(this.map_location_url);
        return !this.mapError;
      } catch (e) {
        return false;
      }
    },
  },
  methods: {
    handleMapError() {
      this.mapError = true;
    },
  },
};
</script>

<style lang="scss" scoped>
.map-error {
  min-height: 300px;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: #f8f9fa;
  border: 2px dashed #dee2e6;
  border-radius: 8px;

  .error-content {
    text-align: center;
    padding: 2rem;

    .error-icon {
      width: 60px;
      height: 60px;
      opacity: 0.5;
      margin-bottom: 1rem;
    }

    h4 {
      color: #6c757d;
      margin-bottom: 0.5rem;
      font-size: 1.25rem;
    }

    p {
      color: #6c757d;
      margin: 0;
      font-size: 0.95rem;
    }
  }
}
</style>
