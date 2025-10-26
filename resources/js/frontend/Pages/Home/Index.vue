<template>
  <!-- slider section -->
  <!-- slider section -->
  <!-- <HeroSlider></HeroSlider> -->

  <!-- slider section -->
  <!-- slider section -->

  <!--ThumbnailSlider section -->
  <!--ThumbnailSlider section -->
  <ThumbnailSlider></ThumbnailSlider>

  <!--ThumbnailSlider section -->
  <!--ThumbnailSlider section -->

  <!-- AboutUs section -->
  <!-- AboutUs section -->

  <AboutUs />

  <!-- AboutUs section -->
  <!-- AboutUs section -->
  <!-- <ProjectsSlider></ProjectsSlider> -->
  <PropertySlider></PropertySlider>
  <!-- TeamSlider section -->
  <!-- TeamSlider section -->

  <TeamSlider />

  <!-- TeamSlider section -->
  <!-- TeamSlider section -->

  <!-- MissionVisionCore section -->
  <!-- MissionVisionCore section -->

  <MissionVisionCore />

  <!-- MissionVisionCore section -->
  <!-- MissionVisionCore section -->

  <!-- WhyChooseUs section -->
  <!-- WhyChooseUs section -->

  <WhyChooseUs />

  <!-- WhyChooseUs section -->
  <!-- WhyChooseUs section -->

  <!-- Testimonials section -->
  <!-- Testimonials section -->

  <Testimonials />

  <!-- Testimonials section -->
  <!-- Testimonials section -->

  <!-- Service section -->
  <!-- Service section -->

  <Service />

  <!-- Service section -->
  <!-- Service section -->

  <!-- <ServiceSingleItemLatest /> -->

  <!-- PopularProperties section -->
  <!-- PopularProperties section -->

  <PopularProperties />

  <!-- PopularProperties section -->
  <!-- PopularProperties section -->
  <!-- --------------------------------------- -->
  <!-- ----------ContactForm----------------- -->
  <!-- --------------------------------------- -->
  <ContactForm />
  <!-- --------------------------------------- -->
  <!-- ----------ContactForm----------------- -->
  <!-- --------------------------------------- -->
</template>

<script>
import CircleText from "./components/CircleText.vue";
import HeroSlider from "./components/HeroSlider.vue";
import ThumbnailSlider from "./components/ThumbnailSlider.vue";
import AboutUs from "../../GlobalComponent/AboutUs/AboutUs.vue";
import ProjectsSlider from "../../GlobalComponent/Slider/ProjectsSlider.vue";
import TeamSlider from "../../GlobalComponent/TeamSlider/TeamSlider.vue";
import PopularProperties from "../../GlobalComponent/PopularProperties/PopularProperties.vue";
import PropertySlider from "../../GlobalComponent/PopularProperties/PropertySlider.vue";
import MissionVisionCore from "../../GlobalComponent/MissionVisionCore/MissionVisionCore.vue";
import WhyChooseUs from "../../GlobalComponent/WhyChooseUs/WhyChooseUs.vue";
import Testimonials from "../../GlobalComponent/Testimonials2/Testimonials2.vue";
import Service from "../../GlobalComponent/Service/Service.vue";
import ContactForm from "../../GlobalComponent/ContactForm/ContactForm.vue";
import ServiceSingleItemLatest from "../../GlobalComponent/WhyChooseUs/components/ServiceSingleItemLatest.vue";

export default {
  name: "HomePage",
  components: {
    CircleText,
    HeroSlider,
    AboutUs,
    TeamSlider,
    PopularProperties,
    MissionVisionCore,
    WhyChooseUs,
    Testimonials,
    Service,
    ContactForm,
    ThumbnailSlider,
    ProjectsSlider,
    ServiceSingleItemLatest,
    PropertySlider,
  },
};
</script>

<style scoped>
/* Ensure pagination dots are visible */
.swiper-pagination {
  position: relative !important;
  margin-top: 20px;
}

.swiper-pagination-bullet {
  width: 12px !important;
  height: 12px !important;
  background: #ccc !important;
  opacity: 1 !important;
  margin: 0 5px !important;
}

.swiper-pagination-bullet-active {
  background: #007bff !important;
}

.slider-pagination {
  text-align: center;
  margin-top: 20px;
}

.slider-pagination .swiper-pagination-bullet {
  width: 12px;
  height: 12px;
  background: #ccc;
  border-radius: 50%;
  display: inline-block;
  margin: 0 5px;
  cursor: pointer;
  transition: all 0.3s ease;
}

.slider-pagination .swiper-pagination-bullet-active {
  background: #007bff;
}

/* Progress bar for testimonial slider */
.swiper-pagination-progressbar {
  background: rgba(255, 255, 255, 0.3) !important;
  height: 4px !important;
}

.swiper-pagination-progressbar-fill {
  background: #007bff !important;
}
</style>
