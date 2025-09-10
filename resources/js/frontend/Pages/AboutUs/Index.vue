<template>
  <div
    class="breadcumb-wrapper"
    data-bg-src="assets/frontend/img/bg/breadcrumb-bg.jpg"
    style="background-image: url('assets/frontend/img/bg/breadcrumb-bg.jpg')"
  >
    <div class="container">
      <div class="breadcumb-content">
        <h1 class="breadcumb-title mt-5">About Us</h1>
        <ul class="breadcumb-menu">
          <li><a href="index.html">Home</a></li>
          <li>About Us</li>
        </ul>
      </div>
    </div>
  </div>
  <!-- --------------------------------------- -->
  <!-- ----------AboutUs----------------- -->
  <!-- --------------------------------------- -->
  <AboutUs />
  <!-- --------------------------------------- -->
  <!-- ----------AboutUs----------------- -->
  <!-- --------------------------------------- -->

  <!-- --------------------------------------- -->
  <!-- ----------Service----------------- -->
  <!-- --------------------------------------- -->
  <Service />
  <!-- --------------------------------------- -->
  <!-- ----------Service----------------- -->
  <!-- --------------------------------------- -->

  <!-- --------------------------------------- -->
  <!-- ----------TeamSlider2----------------- -->
  <!-- --------------------------------------- -->
  <!-- <TeamSlider2 /> -->
  <!-- --------------------------------------- -->
  <!-- ----------TeamSlider2----------------- -->
  <!-- --------------------------------------- -->
   
  <!-- --------------------------------------- -->
  <!-- ----------TeamSlider----------------- -->
  <!-- --------------------------------------- -->
  <TeamSlider />
  <!-- --------------------------------------- -->
  <!-- ----------TeamSlider----------------- -->
  <!-- --------------------------------------- -->

  <!-- --------------------------------------- -->
  <!-- ----------AtAGlance----------------- -->
  <!-- --------------------------------------- -->
  <AtAGlance />
  <!-- --------------------------------------- -->
  <!-- ----------AtAGlance----------------- -->
  <!-- --------------------------------------- -->

  <!-- --------------------------------------- -->
  <!-- ----------Testimonials2----------------- -->
  <!-- --------------------------------------- -->
  <Testimonials2 />
  <!-- --------------------------------------- -->
  <!-- ----------Testimonials2----------------- -->
  <!-- --------------------------------------- -->

  <!-- --------------------------------------- -->
  <!-- ----------ContactForm----------------- -->
  <!-- --------------------------------------- -->
  <ContactForm />
  <!-- --------------------------------------- -->
  <!-- ----------ContactForm----------------- -->
  <!-- --------------------------------------- -->








</template>

<script>
import { ref, computed, onMounted, onUnmounted } from "vue";
import { Link } from "@inertiajs/vue3";
import $ from "jquery";
import "magnific-popup";
import "magnific-popup/dist/magnific-popup.css";

import AboutUs from "../../GlobalComponent/AboutUs/AboutUs.vue";
import Service from "../../GlobalComponent/Service/Service.vue";
import TeamSlider2 from "../../GlobalComponent/TeamSlider2/TeamSlider2.vue";
import TeamSlider from "../../GlobalComponent/TeamSlider/TeamSlider.vue";
import AtAGlance from "../../GlobalComponent/AtAGlance/AtAGlance.vue";
import Testimonials2 from "../../GlobalComponent/Testimonials2/Testimonials2.vue";
import ContactForm from "../../GlobalComponent/ContactForm/ContactForm.vue";

export default {
  components: {
    Link,
    AboutUs,
    AtAGlance,
    Service,
    TeamSlider2,
    TeamSlider,
    Testimonials2,
    ContactForm,
  },
};
</script>
