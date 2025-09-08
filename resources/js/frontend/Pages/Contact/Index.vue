<template>
  <div
    class="breadcumb-wrapper"
    data-bg-src="assets/frontend/img/bg/breadcrumb-bg.jpg"
    style="background-image: url('assets/frontend/img/bg/breadcrumb-bg.jpg')"
  >
    <div class="container">
      <div class="breadcumb-content">
        <h1 class="breadcumb-title">Contact</h1>
        <ul class="breadcumb-menu">
          <li><a href="index.html">Home</a></li>
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
              <p class="contact-feature_label">Mosque Address</p>
              <a href="https://www.google.com/maps" class="contact-feature_link"
                >123 Academic Way City, State, 1234, New York City.</a
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
              <a href="tel:+011123234567890" class="contact-feature_link"
                >+011 (123) 234 567 890</a
              >
              <a href="tel:+09456876543210" class="contact-feature_link"
                >+09 (456) 876 543 210</a
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
              <a href="mailto:info@examplemail.edu" class="contact-feature_link"
                >info@examplemail.edu</a
              >
              <a
                href="mailto:admission@examplemail.edu"
                class="contact-feature_link"
                >admission@examplemail.edu</a
              >
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
  <LocationMap />
  <!-- LocationMap -->

</template>

<script>
import ContactForm2 from "../../GlobalComponent/ContactForm2.vue";
import LocationMap from "../../GlobalComponent/LocationMap.vue";
export default {
  components: {
    ContactForm2,
    LocationMap
  }
};
</script>

<style></style>
